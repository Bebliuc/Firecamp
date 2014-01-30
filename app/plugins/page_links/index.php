<?php

Plugin::setInfos(array(
		'id' => 'page_links',
		'title' => 'Page links',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Simple page links for : download / demo / buy .'));

Observer::observe('page.add.dropable', 'add_page_links_dropable');
Observer::observe('page.edit.dropable', 'edit_page_links_dropable');
Observer::observe('page.before.save', 'save_links');
Observer::observe('page.before.edit', 'edit_links');
Observer::observe('page.before.delete', 'delete_links');

function delete_links( $id ) {
	record::delete(pagelinks::TABLE_NAME, 'id = ?', array($id));
}
function edit_links( $id ) {
	
	$sql = "UPDATE ".pagelinks::TABLE_NAME." SET download = ? , demo = ?, buy = ?, photo = ? WHERE page_id = ?";
	global $__CONN__;
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute(array($_POST['download'], $_POST['demo'], $_POST['buy'], $_POST['photo'], $id));

}

function save_links() {
	
	// Get page increment value
	$sql = "SHOW TABLE STATUS LIKE ?";
	global $__CONN__;
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute(array('pages'));
	$result = $stmt->fetch();

	$page_id = $result['Auto_increment'];
	
	$_dl = $_POST['download'];
	$_demo = $_POST['demo'];
	$_buy = $_POST['buy'];
	$_photo = $_POST['photo'];
	
	record::save(pagelinks::TABLE_NAME, array('id' => NULL, 'page_id' => $page_id, 'download' => $_dl, 'demo' => $_demo, 'buy' => $buy, 'photo' => $_photo));
	
}

function edit_page_links_dropable( $page ) {
	
	$link = new PageLinks($page->id);
	
	echo '
		<div id="dropable">
			<h2>Page links</h2>
			<div class="content">
			<div class="form-row">
	    		<div class="form-label">
	    			<label for="photo">'.__('Photo link').'</label>
	    		</div>

	    		<div class="form-field">
	    		  <input type="text" name="photo" size="45" value="'.$link->photo.'" title="Article photo for homepage + 1st column." />
	            </div>
	        </div>
			 	<div class="form-row">
		    		<div class="form-label">
		    			<label for="tags">'.__('Download link').'</label>
		    		</div>

		    		<div class="form-field">
		    		  <input type="text" name="download" size="45" value="'.$link->download.'" title="Download link for the 3-rd column." />
		            </div>
		        </div>
				<div class="form-row">
		    		<div class="form-label">
		    			<label for="tags">'.__('Try now link').'</label>
		    		</div>

		    		<div class="form-field">
		    		  <input type="text" name="demo" size="45" value="'.$link->demo.'" title="Try now link for the 3-rd column." />
		            </div>
		        </div>
				<div class="form-row">
		    		<div class="form-label">
		    			<label for="tags">'.__('Buy now link').'</label>
		    		</div>

		    		<div class="form-field">
		    		  <input type="text" name="buy" size="45" value="'.$link->buy.'" title="Buy now link for the 3-rd column." />
		            </div>
		        </div>
			</div>
		</div>
	';
	
}
function add_page_links_dropable() {
	echo '
		<div id="dropable">
			<h2>Page links</h2>
			<div class="content">
		 	<div class="form-row">
	    		<div class="form-label">
	    			<label for="photo">'.__('Photo link').'</label>
	    		</div>

	    		<div class="form-field">
	    		  <input type="text" name="photo" size="45" title="Article photo for homepage + 1st column." />
	            </div>
	        </div>
		 	<div class="form-row">
	    		<div class="form-label">
	    			<label for="tags">'.__('Download link').'</label>
	    		</div>

	    		<div class="form-field">
	    		  <input type="text" name="download" size="45" title="Download link for the 3rd column." />
	            </div>
	        </div>
				<div class="form-row">
		    		<div class="form-label">
		    			<label for="tags">'.__('Try now link').'</label>
		    		</div>

		    		<div class="form-field">
		    		  <input type="text" name="demo" size="45" title="Try now link for the 3rd column." />
		            </div>
		        </div>
				<div class="form-row">
		    		<div class="form-label">
		    			<label for="tags">'.__('Buy now link').'</label>
		    		</div>

		    		<div class="form-field">
		    		  <input type="text" name="buy" size="45" title="Buy now link for the 3rd column." />
		            </div>
		        </div>
			</div>
		</div>
	';
}

templateTags::add('page:links:initiate', '<?php $links = new PageLinks($page->id); ?>');
templateTags::add('page:links:photo', '<?php echo $links->photo; ?>');
templateTags::add('page:links:download', '<?php echo $links->download; ?>');
templateTags::add('page:links:demo', '<?php echo $links->demo; ?>');
templateTags::add('page:links:buy', '<?php echo $links->buy; ?>');

class PageLinks extends Page {
	
	const TABLE_NAME = 'page_links';
	
	public $download;
	public $demo;
	public $buy;
	public $photo;
	
	function __construct( $id ) {
		$link = record::findOneFrom(self::TABLE_NAME, 'page_id = ?', array($id));
		
		$this->photo = $link->photo;
		$this->download = $link->download;
		$this->demo = $link->demo;
		$this->buy = $link->buy;
	}
	
}