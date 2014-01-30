<?php
class Template extends Record {
	
	const TABLE_NAME = "templates";
	private static $theme_dir = '/themes/';
	public static $tags = array();
	
	private $id;
	private $name;
	private $type;
	public $content;
	private $rendered_content;
	private static $replacements = array();
	public static $themes = array();
    public static $watches = array();
   
	function __construct($id) {
		$bm = Benchmark::get('total');
		$basic_tags = array('{benchmark}' => $bm['time'], '{public_url}' => PUBLIC_URL);
		self::addTags($basic_tags);
		
		self::getTemplateById($id);
		$this->id = $id;
		
	}
	
	/**
	* getTemplateById($id)
	*
	*	Sets the data of the template given by $id
	*	@var: $id = the id of the requested template
	*
	*/
	private function getTemplateById($id) {
		
		global $__CONN__;
		
		$sql = "SELECT * FROM ".self::TABLE_NAME." WHERE id = ?";
		$stmt = $__CONN__->prepare($sql);
		if (!$stmt->execute(array($id)))
			throw new Exception('Template could not match id : <b>'.$id.'</b> .');
		
		$template = $stmt->fetchObject();
		
		//set datas to $this object
		
		$this->name = $template->nume;
		$this->type = $template->tip;
		$this->content = $template->continut;
	
	}
	/**
	* addTags($tags = array())
	*
	*	Adds new tags to the render engine
	*	@var: $tags = tags to be converted in the template, in array format, usage: array('{tag_name}' => 'tag_replacement');
	*
	*/
	public static function addTags($tags = array()) {
	
		foreach($tags as $key => $value)
			if(array_key_exists($key, self::$tags)) 
				throw new Exception('The following template tag is already in use: '.$key);

		self::$tags = array_merge(self::$tags, $tags);
		
	}
	public static function part($name, $vars = array()) {
		if( record::countFrom('templates_parts', 'name LIKE ?', array( $name ))) {
			$snippet = record::findOneFrom('templates_parts', ' name LIKE ?', array( $name ));
			
			error_reporting(E_ALL);
			global $page;
			extract($vars, EXTR_SKIP);
			
			Observer::notify('snippet.before.eval', $snippet);
			
			eval('?>'.$snippet->content);

		}
	
	}

	public static function process($content) {
		
		preg_match_all('/{.+?}/i', $content, $matches);

		$last_class = array();
		$i = 0;
		
		foreach($matches[0] as $k => $v):
			$i++;
			if(!array_key_exists($v, self::$tags)) {
			 
				$properties = explode(':', str_replace(array('{', '}'), '', $v));
				$ctrl = (isset($properties[0]) ? $properties[0] : NULL);
				$action = (isset($properties[1]) ? $properties[1] : NULL);
				$value = $v;
				try {
					$values = get_class_vars($ctrl);
					if(isset($values['template'][$action])) {
						
						self::$replacements = array_merge(self::$replacements, array($value => $values['template'][$action]));
					}
					else {
						$method = new ReflectionMethod( $ctrl.'::'.$action );
						if ( $method->isStatic() ) {
							$params = (isset($properties[2]) ? explode(';',$properties[2]) : array());
							$p = array();
							foreach($params as $k => $v) {
								$parameter = explode('=', str_replace(array('\'', '"'), '', $v));
								$p[$parameter[0]] = (isset($parameter[1]) ? $parameter[1] : NULL);
							}
							$rendered = call_user_func(array($ctrl, $action), $p);
							self::$replacements = array_merge(self::$replacements, array($value => $rendered));
						}
						else {
			
							$params = (isset($properties[2]) ? explode(';',$properties[2]) : array());
							$p = array();
			
							foreach($params as $k => $v) {
								$parameter = explode('=', str_replace(array('\'', '"'), '', $v));
								$p[$parameter[0]] = (isset($parameter[1]) ? $parameter[1] : NULL);
							}
							$class = new $ctrl;
							self::$replacements = array_merge(self::$replacements, array($value => $class->$action($p)));
						}
					}
				}
				catch ( ReflectionException $e ) {
					echo $e->getMessage().'<br />';
				}
				
			}
			else {
				self::$replacements = array_merge(self::$replacements, self::$tags);
			}
		endforeach;
		return str_replace(array_keys(self::$replacements), array_values(self::$replacements), $content);
	}
	
	public static function addHook($key, $value) {
		
		self::$hook[$key] = $value;
		
	}
	
	public function render() {
		
		Observer::notify('template.render', $this);
		
		$this->rendered_content = self::process($this->content);
		
	}
	

	public function init($id) {
		if($this->type == '')
            $this->type = 'text/html';
        // set content-type and charset of the page
        header('Content-Type: '.$this->type.'; charset=UTF-8');    	
    	Observer::notify('frontend.page.init', $id);
		
		eval('?>'.$this->rendered_content);
		Observer::notify('frontend.page.end', $id);
	}
	
	public static function templatesToList($id = "") {
		
		$sql = "SELECT id, nume FROM ".self::TABLE_NAME;
		global $__CONN__;
		
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute();
	
		while($template = $stmt->fetchObject()) {
			if($template->id == $id)
				$selected = ' selected=""';
			else
				$selected = '';
				
			echo '<option'.$selected.' value="'.$template->id.'">'.$template->nume.'</option>';
		}
	}
	
	public static function getTemplateTypeById($id = "") {
		
		$template = self::findOneFrom(self::TABLE_NAME, 'id = '.$id);
		return $template->tip;
		
	}
	
	public static function getThemes() {
		$dir = PUBLIC_URL.self::$theme_dir;
		if ($handle = opendir($dir))
		{
			while (false !== ($theme_id = readdir($handle)))
			{
				if ( is_dir($dir.$theme_id) && strpos($theme_id, '.') !== 0)
				{
					$xml_file = $dir . $theme_id . '/info.xml';
					if (file_exists($xml_file)) {
						$xml = simplexml_load_file($xml_file);
						self::$themes[$theme_id]['id']					= (string) $xml->id;
						self::$themes[$theme_id]['name']				= (string) $xml->name;
						self::$themes[$theme_id]['description']			= (string) $xml->description;
						self::$themes[$theme_id]['author']				= (string) $xml->author;
						self::$themes[$theme_id]['path'] 				= (string) $dir . $theme_id;
					}
				}
			}
			closedir($handle);
		}

		ksort(self::$themes);
		return self::$themes;
		
	}
	
	public static function isUsed($layout_id) {
		
		if(Record::countFrom('pages', 'template = '.$layout_id))
			return true;
		return false;
		
	}
	
	public static function isUnique($layout_name) {
		
		if(Record::countFrom('templates', 'nume = "'. $layout_name.'"') OR Record::countFrom('templates_parts', 'name = "' . $layout_name.'"'))
			return false;
			
		return true;
		
	}
	
	public static function makeName($name) {
		
		$name = explode('.', $name);
		$name = ucwords($name[0]);
		return str_replace("_", " ", $name);
		
	}
	public static function getScreenshot($theme_id) {
		
		Template::getThemes();
		
		$screenshot_path = Template::$themes[$theme_id]['path'];
		
		if(file_exists($screenshot_path.'/screenshot.png'))
			return BASE_URL.'public/themes/' . Template::$themes[$theme_id]['id'] . '/screenshot.png';
		else
			return BASE_URL.'app/layouts/admin/resources/images/screenshot.png';
		
	}
	public static function isInstalled($theme_id) {
		if(Record::countFrom('templates_themes', 'name = "'.$theme_id.'"'))
			return true;
		return false;
	}
	
	public static function _save_part($data) {
		if(Record::save('templates_parts', $data)) 
			return true;
		return false;
	}
	
	public static function _update_part($data, $id) {
		if(Record::update('templates_parts', $data, $id))
			return true;
		return false;
	}
	
	public static function _delete_part($id) {
		if(Record::delete('templates_parts', 'id = '.$id))
			return true;
		return false;
	}
	public static function getter() {
		print_r(self::$tags);
	}
	
}

class Variable {

	private static $vars = array();

	function __construct() {

	}

	function assign($params = array()) {
		debug($params);
		foreach($params as $k => $v) {
		
			$rendered = eval('?>'.$v);
			
			self::$vars[$k] = $v;
		}

		return NULL;
	}

	function get($params = array()) {
		foreach($params as $k => $v)
			return self::$vars[$k];

	}

}