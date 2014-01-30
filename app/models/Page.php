<?php



class Page extends Record {

	

	const TABLE_NAME = "pages";

	const STATUS = 1;

	const LOGIN_REQUIRED = 0;

	

	public static $template = array();

	public $page;

	

	public $id;

	public $parent_id;

	public $level;

	public $name;

	public $slug;

	public $title;

	public $content_raw;

	public $content;

	public $tags;

	public $meta_keywords;

	public $meta_description;

	public $layout;

	public $status;

	public $created_time;

	public $modified_time;

	public $login_required;

	public $author;

	public $root;

	public $behavior;

	public $date;

	

	

	

	function __construct($id = NULL) {

		

		//check status

		$page = record::findOneFrom(self::TABLE_NAME, 'id = ?', array($id));



		if($page->status != 1 AND $page->behavior == 'page') {

			$logger = new Logger(__('Notice : Page flagged as closed/draft : <b>%url%</b>', array('%url%' => green::getCurrentUrl())));

			$logger->log();

			$maintenance = new PluginController();

				$maintenance->setLayout('');

				$message = __(' Notice : Page status is set to closed or draft.');

				$details = __('<h2> If you are the website owner and the page should not be closed, please contact us.</h2>');

				$maintenance->display('offline/html/index', array('message' => $message, 									      		      'details' => $details));

		}

		

		if($page->publish_time > date('Y-m-d')) {

			$logger = new Logger(__('Notice : Page not published : <b>%url%</b>', array('%url' => green::getCurrentUrl())));

			$logger->log();

			$maintenance = new PluginController();

				$maintenance->setLayout('');

				$message = __(' Notice: Page not published, yet.');

				$details = __('<h2> If you are the website owner and the page should be published, please contact us.</h2>');

				$maintenance->display('offline/html/index', array('message' => $message, 											      'details' => $details));	

		}

		//check date

	

		$this->page = Record::findOneFrom(self::TABLE_NAME, 'id = ? AND publish_time <= \''.date('Y-m-d').'\'', array($id));

		Observer::notify('page.constructor', $this->page);

	}

	

	public function id() { return $this->page->id; }

	public function parent_id() { return $this->page->parent_id; }

	public function level() { return $this->page->level; }

	public function name() { return $this->page->name; }

	public function slug() { return $this->page->slug; }

	public function title() { return $this->page->title; }

	public function content_raw() { return $this->page->content; }

	public function tags() { return $this->page->tags; }

	public function meta_keywords() { return $this->page->meta_keywords; }

	public function meta_description() { return $this->page->meta_description; }

	public function layout() { return $this->page->template; }

	public function status() { return $this->page->status; }

	public function created_time() { return $this->page->created_time; }

	public function modified_time() { return $this->page->modified_time; }

	public function login_required() { return $this->page->login_required; }

	public function author() { return $this->page->author; }

	public function root() { return $this->page->root; } 

	public function date() { return $this->page->date; }

	public function behavior() { return $this->page->behavior; }

	

	public function content() 

	{

		ob_start();

		Observer::notify('page_before_eval_layout', $this);

        eval('?>'.$this->content_raw());

        $out = ob_get_contents();

        ob_end_clean();

        return $out;

	}

	

	public function snippet( $name ) { 

		if( record::countFrom('templates_parts', 'name LIKE ?', array( $name ))) {

			$snippet = record::findOneFrom('templates_parts', ' name LIKE ?', array( $name ));

            eval('?>'.$snippet->content);

		}

    }

	

	// ONLY USE TO FETCH EVAL CONTENT / SECURITY NON-SAFE

	

	private function _evalt( $content ) 

	{

		global $page;

		ob_start();

        eval('?>'.$content);

        $out = ob_get_contents();

        ob_end_clean();

        return $out;

	}

	

	public function _executeLayout() {

		$page = $this->page;

		$GLOBALS['page'] = $page;

		$layout = record::findOneFrom('templates', 'id = ?', array($this->layout()));



		if(!$layout AND $page->template != '_blank') {

			//log error

			$logger = new Logger(__('Missing template with id : <b>%id%</b> on <b>%url%</b>', array('%id%' => $this->layout, '%url%' => green::getCurrentUrl())));

			$logger->log();

			

			$maintenance = new PluginController();

				$maintenance->setLayout('');

				$message = __(' Missing template');

				$details = __('<h2> There was an error while rendering this page.</h2>');

				$maintenance->display('offline/html/index', array('message' => $message, 											      'details' => $details));

		}

		

		if($page->template != '_blank') {

					

            // if content-type not set, we set html as default

            if ($layout->tip == '')

                $layout->tip = 'text/html';



			// postprocess the php code from the template

			// last time process

			

			// for further remote modifications

            Observer::notify('page_before_execute_layout', $layout);



            $layout->continut = $this->_evalt($layout->continut);

			

			// for further remote modifications

            Observer::notify('page_after_execute_layout', $layout);



			// set content-type and charset of the page



			header('Content-Type: '.$layout->tip.'; charset=UTF-8');

			// BoooOOOooMMMMm



			echo $layout->continut;

		}

	}



	/**

	* getContent($id)

	*

	*	Get all the objects of a page

	*	@var: $id = id of the page

	*	@return: array() : $page objects : $id, $parent_id, $level, $name, $slug, $title, $content, $meta_keywords, 	

	*	                                   $meta_description, $template, $created_ time, $modified_time, $owner 				       

	*

	*/

	public function getContent() {

	

		

		$id = self::$template['id'];

		

		if(!self::countFrom(self::TABLE_NAME, 'id = ?', array($id)))

			die("The page with the id ".$id." could not be found.");

			

		$page = Record::findOneFrom(self::TABLE_NAME, 'id = ?', array($id));

		return $page;

	}		

	

	

	

	/**

	* getSlugById($id)

	*

	* 	Fetch the URL slug of a page.

	*	@var: $id = id of the page

	*	@return: Raw page slug. For use with echo

	*

	*/

	

	public static function getSlugById($id) {

		

		global $__CONN__;

		

		$sql = "SELECT slug FROM ".self::TABLE_NAME." WHERE id = ?";

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute(array($id));

		

		$page = $stmt->fetchObject();

		

		return $page->slug;

		

	}

	

	/**

	* getChildsOfParent($id)

	* 

	*	Fetch all the childs of a parent. 

	*	@var: $id = id of the page

	*	@return: array();

	*

	*/ 

	public static function getChildsOfParent($id) {

		

		global $__CONN__;

		

		$sql = 'SELECT slug, parent_id FROM '.self::TABLE_NAME.' WHERE id = ?;';

	

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute(array($id));

		$page = $stmt->fetchObject();

			

		// save the path in this array

		$path = array();

		

		// only continue if this $node isn't the root node

		// (that's the node with no parent)

		if ($page->parent_id != 0) {

	 		// the last part of the path to $node, is the name

			// of the parent of $node

			$path[] = self::getSlugById($page->parent_id);



	 		// we should add the path to the parent of this node

			// to the path

			$path = array_merge(self::getChildsOfParent($page->parent_id), $path);

		}



		// return the full path

		return $path;

	

	} 

	

	/**

	* getPathToPage($id)

	*

	*	Returns the full path of a page. For use with addRoute();

	*	@var: $id = id of the page

	* 	@return: full path

	*

	*/

	

	public static function getPathToPage($id) {

		

		global $__CONN__;

		

		$sql = "SELECT slug, parent_id FROM ".self::TABLE_NAME." WHERE id = ?";

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute(array($id));

		

		$page = $stmt->fetchObject();

		$slug = $page->slug;

		

		if($page->parent_id == 0)

			return $slug;

			

		$path = self::getChildsOfParent($id);

	

		return $path = implode('/', $path).'/'.$slug;

		

	}

	

	/**

	* getRootPage()

	*

	*	Returns the id of the root page(root = 1)

	*	@return: (int) id page

	*

	*/

	

	public static function getRootPage() {

		

		global $__CONN__;

		

		$page = record::findOneFrom(self::TABLE_NAME, 'root = 1');

		

		if(!$page) {

			//log error

			$logger = new Logger(__('No root page'));

			$logger->log();

			

			$maintenance = new PluginController();

				$maintenance->setLayout('');

				$message = __('No root page');

				$details = __('<h2>There was an error while rendering this page.</h2>');

				$maintenance->display('offline/html/index', array('message' => $message, 											      'details' => $details));

		}

		

		$sql = "SELECT id FROM ".self::TABLE_NAME." WHERE root = 1";

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute();

		

		$page = $stmt->fetchObject();

		

		return $page->id;

		

	}

	

	/**

	* unsetRootPage()

	*

	*	Sets current root page value to 0

	*	

	*/

	

	

	public static function unsetRootPage() {

		self::update(self::TABLE_NAME, array('root' => NULL), self::getRootPage());

	}

	

	/**

	* buildRoutes()

	*

	*	Returns an array with the routed pages ( based on slug )

	*	@return: (array) $routes : to be used with AddRoute(buildRoutes());

	*

	*/

	

	public static function buildRoutes() {

		

		global $__CONN__;



		$sql = "SELECT id FROM ".self::TABLE_NAME;

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute();

		$routes = array();

		while($page = $stmt->fetchObject()) {

			$routes[Page::getPathToPage($page->id)] = 'index/page/'.$page->id;

		}

			

		return $routes;

	}

	

	/**

	* hasChilds($id)

	*

	*	Returns true if $id has childs

	*	@return: true/false

	*/

	

	public static function hasChilds($id) {

		

		if(!self::countFrom(self::TABLE_NAME, 'parent_id = '.$id))

			return false;

		

		return true;

	}

	

	public static function js($lastID) {

	

		global $__CONN__;

		

		$sql = "SELECT parent_id FROM ".self::TABLE_NAME." WHERE parent_id IS NOT NULL GROUP BY parent_id";

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute();

		

		while($child = $stmt->fetchObject())

		{				

		

						if($child->parent_id != NULL AND $child->parent_id != $lastID) 

							echo '

							

										jQuery(".deschide-'.$child->parent_id.'").click(function() {

										   jQuery(".expand-'.$child->parent_id.'").toggleRow();

										

										});

										jQuery(".expand-'.$child->parent_id.'").hideRow();

								

							';

							

		}

		

	}

	

	/**

	* getStatus($status_id)

	*

	*	Converts 0,1,2 into Draft, Published, Closed

	* 	@return: string

	*

	*/

	public static function getStatus($status_id) {

			

		if($status_id == 0)

			$status = __('Draft');

		elseif($status_id == 1)

			$status = __('Published');

		elseif($status_id == 2)

			$status = __('Closed');

		else

			$status = __('unknown');



		return $status;

			

	}

	

	/**

	* pagesToList($id)

	*

	*	For *private* use

	*	@return: options for the <select> element

	*	@var: $id = current page used;

	*

	*/

	public static function pagesToList($id = "") {

		

		$sql = "SELECT id, name FROM ".self::TABLE_NAME;

		global $__CONN__;

		

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute();

	

		while($page = $stmt->fetchObject()) {

			if($page->id == $id)

				$selected = ' selected=""';

			else

				$selected = '';

				

			echo '<option'.$selected.' value="'.$page->id.'">'.$page->name.'</option>';

		}

	}

	

	/**

	* getParentLevel($id)

	*

	*	Gets the level of the parent

	*	@return: level of parent

	*	@var: $id = parent id;

	*

	*/

	public static function getParentLevel($id) {

		

		$page = self::findOneFrom(self::TABLE_NAME, 'id = '.$id);

		return $page->level;

		

	}

	

	public static function inheritTemplate($id) {

		

	}

	

	

	public static function inheritAuth($id) {

		

		

	}

	

	/**

	* _save($data)

	*

	*	Saves page from data

	*	@return: true/false

	*	@var: $data = array();

	*

	*/

	public static function _save($data = NULL) {

		if(self::save(self::TABLE_NAME, $data)) 

			return true;

		return false;

	}

	

	public static function _edit($data, $id) {

		if(self::update(self::TABLE_NAME, $data, $id)) 

			return true;

		return false;	

	}

	

	public static function _delete($id) {

		if(self::delete(self::TABLE_NAME, 'id = '.$id.' OR parent_id = '.$id))

			return true;

		return false;

	}

	

	public static function generatePages($id = 0) {

		

		$pages = self::findAllFrom(self::TABLE_NAME, 'parent_id = '.$id);

		foreach($pages as $page) {

			

			$status = Page::getStatus($page->status);

			

			if($page->parent_id != NULL)

				$isChild = 'class="expand-'.$page->parent_id.'"';

			else

				$isChild = '';

				

			if(Page::hasChilds($page->id)) 

				$hasChilds = '<a class="deschide-'.$page->id.' expander" href="#"><img src="'.BASE_URL.'app/layouts/admin_v2/images/i-title-arrow.png" /> </a>';

			else

				$hasChilds = '<a class="expander"><img src="'.BASE_URL.'app/layouts/admin_v2/images/i-title-arrow.png" style="visibility:hidden;" /> </a>';

			

		echo '<tr '.$isChild.'>

			<td style="width:400px;">'.str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$page->level).$hasChilds.''.$page->name.'</td>

			<td><sup class="role user-type-yellow">'.$status.'</sup></td>

			<td><sup class="role user-type-invited">'.$page->author.'</sup></td>

			<td class="tbl-right">

				<sup class="role user-type-owner"><a href="'.get_url('pages/edit/'.$page->id).'">

					'.__("Edit").'

				</a></sup>

				<sup class="role user-type-owner"><a href="'.get_url(Page::getPathToPage($page->id)).'" target="_BLANK">

					'.__("View").'

				</a></sup>

				<sup class="role user-type-owner"><a href="'.get_url('pages/add/'.$page->id).'">

					'.__("Add child").'

				</a></sup>

				<sup class="role user-type-admin"><a href="'.get_url('pages/delete/'.$page->id).'" class="sterge">

                    '.__("Delete").'

				</a></sup>

			</td>

		</tr>';

		self::generatePages($page->id);

		}

		

		

	}

	

	public static function getPageTitleById( $id = NULL) {

		if(!$id) return __('Unmaked');

		$page = record::findOneFrom(self::TABLE_NAME, 'id = ?', array($id));

		return $page->name;

	}

	

	public static function getParentTitle( $child_id = 30) {

		// get childs parent id

		

		global $__CONN__;

		$sql = "SELECT parent_id FROM ".self::TABLE_NAME." WHERE id = ?";

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute(array($child_id));

		//childs id

		$child = $stmt->fetchColumn();

		

		$sql = "SELECT name FROM ".self::TABLE_NAME." WHERE id = ?";

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute(array($child));

		//parent title

		$parent = $stmt->fetchColumn();

		

		return $parent;

	}



		

	function getChildsFromId($id) {



		$results = array();

		$i = 0;

		global $__CONN__;



		$sql = "SELECT name, id FROM pages WHERE parent_id = ? ORDER BY id ASC";

		$stmt = $__CONN__->prepare($sql);

		$stmt->execute(array($id));



		$pages = $stmt->fetchAll(PDO::FETCH_CLASS);

		foreach($pages as $page)

			$results[$i++] = (object) array('name' => $page->name, 'url' => page::getPathToPage($page->id));



		return $results;

	}



	public static function getIdFromUrl( $url = NULL) {

		if(!$url) return __('Unknown');

		$page = record::findOneFrom(self::TABLE_NAME, 'slug = ?', array($url));

		return $page->id;

	}

	

}

