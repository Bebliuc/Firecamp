<?php

/**
 * Firecamp
 *
 * @package		Firecamp
 * @author		Bebliuc George
 * @copyright	Copyright (c) 2008 - 2011, Bebliuc.
 * @link		http://bebliuc.ro
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Comments plugin
 *
 * @package		Firecamp
 * @subpackage	Plugins
 * @author		Bebliuc George
 * @link		http://george.bebliuc.eu
 */

Plugin::setInfos(array(
		'id' => 'comments',
		'title' => 'Comments',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Comments for everything.'));
if(plugin::isEnabled('comments')) {
	$comments = record::findAllFrom('comments', 'status = 2');
	$queue = 0;
	foreach($comments as $comment) $queue++;
}
else $queue = 0;
Plugin::addController('comments', 'Comments <span class="count">'.$queue.'</span>');

// add 'Article' behavior

Behavior::add('article', 'Article');

Observer::observe('page', 'submit_comment');

templateTags::add('comments:start', '<?php foreach(record::findAllFrom("comments", "page_id = ? AND status = 1", array($page->id)) as $comment): ?>');
templateTags::add('comment:author', '<?php echo $comment->author; ?>');
templateTags::add('comment:email', '<?php echo $comment->email; ?>');
templateTags::add('comment:website', '<?php echo $comment->website; ?>');
templateTags::add('comment:content', '<?php echo $comment->content; ?>');
templateTags::add('comment:date', '<?php echo $comment->date; ?>');
templateTags::add('comment:avatar', '<?php echo "http://www.gravatar.com/avatar/".main::gravatar($comment->email)."?s=92"; ?>');
templateTags::add('comments:end', '<?php endforeach; ?>');
templateTags::add('comments:message', '<?php global $message; echo $message; ?>');

function submit_comment( $page ) {

	if(isset($_POST['author'])) {
		
		if(Record::countFrom('comments', 'ip = ? AND page_id = ?', array(getIp(), $page->id))) {
		
			$comment = Record::findOneFrom('comments', 'ip = ? AND page_id = ? ORDER BY date DESC', array(getIp(), $page->id));
			
			$current_date = Main::dateToString(date('H:i:s - Y/m/d'), array(':', ' ', '-', '/'));
			$latest_comment_date = Main::dateToString($comment->date, array(':', ' ', '-', '/'), 3);
			
			if(strlen($latest_comment_date - $current_date) == 11)
				$minute = str_split(($latest_comment_date - $current_date), 3);
			else
				$minute = str_split(($latest_comment_date - $current_date), 2);
			$minutes = floor($minute[0] / 60);
			
			if($latest_comment_date > $current_date) {
				if($minutes != '-1')
					$GLOBALS['message'] = '<span class="error">Please wait '.$minutes.'  minute(s) after posting a new comment.</span>';
				else 
					$GLOBALS['message'] = '<span class="error">Less then a minute to wait so you can post a new comment.</span>';
				return;
			}
		}
		if(trim($_POST['author']) == '') {
		 	$GLOBALS['message'] = '<span class="error">Please enter a valid name.</span>';
			return $GLOBALS['message'];
		}
		if(!valid_email($_POST['email'])) {
			$GLOBALS['message'] = '<span class="error">The posted email is not valid.</span>';
			return $GLOBALS['message'];
		}
		if(trim($_POST['content']) == '') {
			$GLOBALS['message'] = '<span class="error">Opinion-less ? No message no comment.</span>';
			return $GLOBALS['message'];
		}
		
		use_helper('Kses');
		use_helper('Akismet');
		
		$allowed_tags = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'abbr' => array(
				'title' => array()
			),
			'acronym' => array(
				'title' => array()
			),
			'b' => array(),
			'blockquote' => array(
				'cite' => array()
			),
			'br' => array(),
			'code' => array(),
			'em' => array(),
			'i' => array(),
			'p' => array(),
			'strike' => array(),
			'strong' => array()
		);
		
		$clean = array();
		
		$clean['author'] 		= strip_tags($_POST['author']);
		$clean['e-mail']		= strip_tags($_POST['email']);
		$clean['website']		= strip_tags($_POST['website']);
		$clean['content']		= kses($_POST['content'], $allowed_tags);
		
		$WordPressAPIKey = Setting::get('akismet_api');
		$MyBlogURL = BASE_URL.'blog';
		 
		$akismet = new Akismet($MyBlogURL ,$WordPressAPIKey);
		$akismet->setCommentAuthor($_POST['author']);
		$akismet->setCommentAuthorEmail($_POST['email']);
		$akismet->setCommentAuthorURL($_POST['website']);
		$akismet->setCommentContent($_POST['content']);
		$akismet->setPermalink(BASE_URL.page::getPathToPage($page->id));
		 
		if($akismet->isCommentSpam())
		  $status = 2;
		else
		  $status = 1;
		
		$comment = array(
			'id' => NULL,
			'author' => $clean['author'],
			'email' => $clean['e-mail'],
			'website' => $clean['website'],
			'content' => $clean['content'],
			'ip' => getIp(),
			'date' => date('H:i:s - Y/m/d'),
			'page_id' => $page->id,
			'status' => $status
			);
			
		if(Record::insert('comments', $comment)) {
			if(!Setting::get('auto_approve_comments')) {
				$GLOBALS['message'] = '<span class="success">Your comment is waiting for moderation.</span>';
			}
			else
				$GLOBALS['message'] = '<span class="success">Your comment has been posted succesfully.</span>';
		}
		else
			$GLOBALS['message'] = '<span class="error">A problem has been encountered while saving the comment.</span>';
			
	}
}

Observer::observe('setting.page.index', 'comments_setting_page');

function comments_setting_page() {
	$akismet = Setting::get('akismet_api');
	echo <<<COMMENT
	<fieldset>
        <legend>Comments</legend>
         <div class="form-row ">
        	<div class="form-label">
    			<label for="akismet_api">Akismet API key</label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" title="Get Akismet API key from Wordpress.com account." name="akismet_api" size="11" value="$akismet">
            </div>
         </div>
    </fieldset>
	
COMMENT;
}


function getIp() {
	
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			//check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	
}