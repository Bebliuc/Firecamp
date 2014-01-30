<?php



// Framework constants

defined('DEBUG')              or define('DEBUG', false);



defined('GREEN_ROOT')         or define('GREEN_ROOT', dirname(__FILE__));

defined('APP_PATH')           or define('APP_PATH', GREEN_ROOT.'/../app');

defined('HELPER_PATH')        or define('HELPER_PATH', GREEN_ROOT.'/helpers');

defined('LIBRARY_PATH')        or define('LIBRARY_PATH', GREEN_ROOT.'/libraries');

defined('VIEW_SUFFIX')        or define('VIEW_SUFFIX', '.php');



// Settings / domain



defined('DOMAIN')			  or define('DOMAIN', $cfg->public);



defined('PUBLIC_URL')		  or define('PUBLIC_URL', GREEN_ROOT.'/../public/'.DOMAIN);



defined('DIRECTORY_SEPARATOR') or define('DIRECTORY_SEPARATOR', '/');

defined('BASE_URL')           or define('BASE_URL', 'http://'.dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']) .'/?');

defined('URL_SUFFIX')         or define('URL_SUFFIX', null);





if($cfg->cdn != '')

	defined('PUBLIC_URI')			  or define('PUBLIC_URI', 'http://'.$cfg->cdn);

else

	defined('PUBLIC_URI')			  or define('PUBLIC_URI', BASE_URL.'public/'.DOMAIN);



// create domain folder



if(!file_exists(PUBLIC_URL)) { 

	$old = umask(0);

	mkdir(PUBLIC_URL, 0777, true); 

	umask($old); 

	chmod(PUBLIC_URL, 0777);

	$old = umask(0);

	mkdir(PUBLIC_URL.'/themes', 0777, true);

	umask($old); 

	chmod(PUBLIC_URL.'/themes', 0777);

	

}



defined('DEFAULT_CONTROLLER') or define('DEFAULT_CONTROLLER', 'index');

defined('DEFAULT_ACTION')     or define('DEFAULT_ACTION', 'index');



defined('ENABLE_PROFILER')    or define('ENABLE_PROFILER', false);

defined('PROFILER_ACTIVE')    or define('PROFILER_ACTIVE', true);

// setting error display depending on debug mode or not

//error_reporting((DEBUG ? E_ALL ^ E_STRICT : 0));



// no more quotes escaped with a backslash

if (PHP_VERSION < 6) {

	//set_magic_quotes_runtime(0);

	

	// This will strip slashes if magic quotes is enabled so 

	// all input data ($_GET, $_POST, $_COOKIE) is free of slashes

	if (get_magic_quotes_gpc())

	{

		$in = array(&$_GET, &$_POST, &$_COOKIE);

		while (list($k,$v) = each($in))

		{

			foreach ($v as $key => $val)

			{

				if (!is_array($val))

				{

					$in[$k][$key] = stripslashes($val);

					continue;

				}

				$in[] =& $in[$k][$key];

			}

		}

		unset($in);

	}

}



// Starting the session

if (!isset($_SESSION)) session_start();



// Adding Profiler to the page

if (ENABLE_PROFILER)

{

	include GREEN_ROOT.'/Profiler.php';

	Observer::observe('system.shutdown', array('Profiler', 'display'));

}



/*

   Class: Green



   The Green main class is responsible for mapping urls /

   routes to Controller methods. Each route that has the same number of directory

   components as the current requested url is tried, and the first method that

   returns a response with a non false / non null value will be returned via the

   Green::dispatch() method. For example:



   A route string can be a literal url such as '/pages/about' or contain

   wildcards (:any or :num) and/or regex like '/blog/:num' or '/page/:any'.

   The idea has taken from CodeIgniter.



   > Green::addRoute(array(

   > '/' => 'page/index',

   > '/about' => 'page/about,

   > '/blog/:num' => 'blog/post/$1',

   > '/blog/:num/comment/:num/delete' => 'blog/deleteComment/$1/$2'

   > ));



   Visiting /about/ would call PageController::about()

   visiting /blog/5 would call BlogController::post(5)

   visiting /blog/5/comment/42/delete would call BlogController::deleteComment(5,42)



   Add your routes before dispatching because after this method it is too late.

*/



final class Green

{

	public static $routes = array();

	public static $params = array();

	private static $url = '';

    public static $watches = array('toggleSidebar' => TRUE);

	

	/*

	   Method: addRoute

	   Add a new route to the application

	*/

	public static function addRoute($route, $destination=null)

	{

		if ($destination != null)

			$route = array($route => $destination);



		self::$routes = array_merge(self::$routes, $route);

	}



	/*

	   Method: dispatch

	   Check for matching route then execute the action from the controller needed

	*/

	public static function dispatch($url=null)

	{

		Flash::init();

		Benchmark::start('dispatch');

		

		if ($url === null) $url = $_SERVER['QUERY_STRING'];

		

		// we populate the $_GET table

		if( $pos = strpos($url,'&') ) parse_str(substr($url, $pos), $_GET);



		// remove slashes (for route convention)

		$url = trim($url, '/');



		// removing the suffix for search engine static simulations

		if (URL_SUFFIX != null and ($pos_to_cut = strrpos($requested_url, $suffix)) !== false)

			$requested_url = substr($requested_url, 0, $pos_to_cut);



		self::$url = $url;



		if (empty($url))

		{

		    return self::executeAction(self::getController(), self::getAction(), self::getParams());

		}

		// do we even have any custom routing to deal with?

		else if (count(self::$routes) === 0)

		{

			self::$params = explode('/', $url);

			return self::executeAction(self::getController(), self::getAction(), self::getParams());

		}

		// is there a literal match? If so we're done

		else if (isset(self::$routes[$url]))

		{

			self::$params = explode('/', self::$routes[$url]);

			return self::executeAction(self::getController(), self::getAction(), self::getParams());

		}



		// loop through the route array looking for wildcards

		foreach (self::$routes as $rule => $route)

		{

			// convert wildcards to regex

			if (strpos($rule, ':') !== false)

				$rule = str_replace(':any', '(.+)', str_replace(':num', '([0-9]+)', $rule));



			// does the regex match?

			if (preg_match('#^'.$rule.'$#', $url))

			{

				// do we have a back-reference?

				if (strpos($route, '$') !== false and strpos($rule, '(') !== false)

					$route = preg_replace('#^'.$rule.'$#', $route, $url);



				self::$params = explode('/', $route);

				// we fund it, so we can break the loop now!

				return self::executeAction(self::getController(), self::getAction(), self::getParams());

			}

		}



		self::$params = explode('/', $url);

		return self::executeAction(self::getController(), self::getAction(), self::getParams());

	} // dispatch



	/*

	   Method: getCurrentUrl

	   Give the requested url

	*/

	public static function getCurrentUrl()

	{

		return self::$url;

	}



	/*

	   Method: getController

	   Give the controller used

	*/

	public static function getController()

	{

		if (isset(self::$params[0]) && self::$params[0] == 'plugin' )

        {

            $loaded_plugins = Plugin::$plugins;

            if (isset(self::$params[1]) && !isset($loaded_plugins[self::$params[1]])) {

                unset(self::$params[0]);

                unset(self::$params[1]);

            }

        }        





		return isset(self::$params[0]) ? self::$params[0]: DEFAULT_CONTROLLER;

	}



	/*

	   Method: getAction

	   Give the action performed

	*/

	public static function getAction()

	{

		if(isset(self::$params[1]))

			$url = explode('&', self::$params[1]);



		return isset($url[0]) ? $url[0]: DEFAULT_ACTION;

	}



	/*

	   Method: getParams

	   Give all additional parameters passed in the url

	*/

	public static function getParams()

	{

		return array_slice(self::$params, 2);

	}

	

	/*

		Function: get_current_url

		Returns the current url

	*/

	public static function get_current_url() {

		 $pageURL = 'http';

		 	$pageURL .= "://";

		 if ($_SERVER["SERVER_PORT"] != "80") {

		 	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

		 } else {

		 	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

		 }

		 return $pageURL;

	}

	

	/*

		Function: segment

		@param: $segment_position = returns the segment of the current url

	*/

	

	public static function segment($segment_position) {



		$plugin_url = BASE_URL;

		$plugin_segments = str_replace($plugin_url, "", Green::get_current_url());

		$plugin_segment = explode("/", $plugin_segments);

		

		if(isset($plugin_segment[$segment_position]))

			return $plugin_segment[$segment_position];

		else

			return "";

	}

	/*

	   Method: executeAction

	   Load the controller and execute the action

	*/

	public static function executeAction($controller, $action, $params)

	{

		$controller_class = Inflector::camelize($controller);

		$controller_class_name = $controller_class . 'Controller';



		// get a instance of that controller

		if (class_exists($controller_class_name))

			$controller = new $controller_class_name();

		

		

		if (!$controller instanceof Controller)

			throw new Exception("Class '{$controller_class_name}' does not extends Controller class!");		



		Observer::notify('system.execute');

		Benchmark::start('execute');



		// execute the action

		$controller->execute($action, $params);

	}



	public function getter() {

	

		 print_r(self::$params);

	

	}

} // end Green class



/*

   Class: Controller



   The Controller class should be the parent class of all of your Controller sub classes

   that contain the business logic of your application (render a blog post, log a user in,

   delete something and redirect, etc).



   In the Frog class you can define what urls / routes map to what Controllers and

   methods.

*/



class Controller

{

	protected $layout = false;

	protected $layout_vars = array();



	/*

	   Method: execute

	   Method use by the controller to validate and execute the action

	*/

	public function execute($action, $params)

	{

		// it's a private method of the class or action is not a method of the class

		if (substr($action, 0, 1) == '_' or !method_exists($this, $action)) {

	

				// Create new instance of Controller Class so we can display a nice looking layout

				// without hardcoding it

				

				$maintenance = new Controller();

				$maintenance->assignToLayout('action', $action);

				$maintenance->setLayout('errors/error');

				$maintenance->display('empty');

				

			}



		call_user_func_array(array($this, $action), $params);

	}



	/*

	   Method: setLayout

	   Set the layout file 



	   the file will use the same extention as the view

	*/

	public function setLayout($layout)

	{

		$this->layout = $layout;

	}



	/*

	   Method: assign

	   Assign specific variable to the layout

	*/

	public function assignToLayout($var, $value)

	{

		if (is_array($var))

			array_merge($this->layout_vars, $var);

		else

			$this->layout_vars[$var] = $value;

	}



	public function addPart($name, $part)

	{

		self::assignToLayout($name, new View('../layouts/backend/nav/'.$part));

	}



	/*

	   Method: render

	   Render the view and the layout if setted and return it as a string

	*/

	public function render($view, $vars=array())

	{

		if ($this->layout)

		{

			$this->layout_vars['content_for_layout'] = new View($view, $vars);

			return new View('../layouts/'.$this->layout, $this->layout_vars);

		}

		else return new View($view, $vars);

	}



	/*

	   Method: display

	   Display the view and the layout if setted

	*/

	public function display($view, $vars=array(), $exit=true)

	{

		Observer::notify('system.display');



		echo $this->render($view, $vars);



		if ($exit)

		{

			Observer::notify('system.shutdown');

			exit;

		}

	}



} // end Controller class



/*

   Class: View



   The template object takes a valid path to a template file as the only 

   argument required, but you can add directly all properties to the template, 

   which become available as local vars in the template file. You can then call

   display() to get the output of the template, or just call print on the 

   template directly thanks to PHP 5's __toString magic method.

   

   > echo new View('my_template', array(

   >     'title' => 'My Title',

   >     'body' => 'My body content'

   > ));



   my_template.php might look like this:

   > <html>

   > <head><title><?php echo $title;?></title></head>

   > <body>

   >   <h1><?php echo $title;?></h1>

   >   <p><?php echo $body;?></p>

   > </body>

   > </html>

*/



class View

{

	private $file;           // path of template file

	private $vars = array(); // array of template variables



	public function __construct($file, $vars=false)

	{

		$this->file = APP_PATH.'/views/'.$file.VIEW_SUFFIX;

		

		if ( ! file_exists($this->file))

			throw new Exception("View '{$file}' not found!");

		

		if ($vars !== false)

			$this->vars = $vars;

	}



	/*

	   Method: assign

	   Assign specific variable to the template

	*/

	public function assign($name, $value=null)

	{

		if (is_array($name))

			array_merge($this->vars, $name);

		else

			$this->vars[$name] = $value;

	}



	/*

	   Method: render

	   Render the template and return it as string

	*/

	public function render()

	{

		ob_start();

		

		extract($this->vars, EXTR_SKIP);

		include $this->file;

		

		$content = ob_get_clean();

		return $content;

	}



	/*

	   Method: display

	   Display the template

	*/

	public function display()

	{

		echo $this->render();

	}



	public function __toString()

	{

		try

		{

			return $this->render();

		}

		catch (Exception $e)

		{

			// Display the exception using its internal __toString method

			return (string) $e;

		}

	}

	

	

} // end View class



/*

   Class: i18n

   

   Internationalization

   

   About: i18n 

   	Provide multi/language support , with default language

   	

   About: __( $string, $args )

   	Function to use instead of default echo

   	

   About: I18N_PATH

   	Language files location

   	

   About: DEFAULT_LOCALE

   	Default language file

   

*/



defined('I18N_PATH') or define('I18N_PATH', APP_PATH.DIRECTORY_SEPARATOR.'languages');

define('DEFAULT_LOCALE', 'cn');



function __($string, $args=null) {

    if (I18n::getLocale() != DEFAULT_LOCALE)

        $string = I18n::getText($string);



    if ($args === null) return $string;



    return strtr($string, $args);

}



class I18n {

    private static $locale = DEFAULT_LOCALE;

    public static $array = array();



    public static function setLocale($locale) {

        self::$locale = $locale;

        if ($locale != DEFAULT_LOCALE)

            self::loadArray();

    }



    public static function getLocale() {

    	

        return self::$locale;

        

    }



    public static function getText($string) {

        return isset(self::$array[$string]) ? self::$array[$string] : $string;

    }



    public static function loadArray() {

        $catalog_file = I18N_PATH.DIRECTORY_SEPARATOR.self::$locale.'-language.php';

        // assign returned value of catalog file

        // file return a array (source => traduction)

        if (file_exists($catalog_file)) {

            $array = include $catalog_file;

            self::add($array);

        }

    }



    public static function add($array) {

        if (!empty($array))

            self::$array = array_merge(self::$array, $array);

    }



    /**

     * Determines preferred languages set by the user in the browser.

     *

     * Returns empty array when unable to determine language preferences.

     *

     * @return array Array of iso 639-1 language codes.

     */

    public static function getPreferredLanguages() {

        $languages = array();



        if ( isset( $_SERVER["HTTP_ACCEPT_LANGUAGE"] ) ) {

            $list = strtolower( $_SERVER["HTTP_ACCEPT_LANGUAGE"] );

            $list = str_replace( ' ', '', $list );

            $list = explode( ",", $list );



            foreach ( $list as $language ) {

                $languages[] = substr( $language, 0, 2 );

            }

        }



        return $languages;

    }



} // end I18n class





/*

	Class: Behavior

*/



class Behavior {

	

	private static $behaviors = array();

	

	public static function add( $type, $title ) {

		self::$behaviors[$type] = $title;

	}

	

	public static function findAll() {

		return self::$behaviors;

	}

}



class TemplateTags {

	

	public static $_tags = array();

	

	const LEFT_DELIMITER = '</fc:';

	const RIGHT_DELIMITER = '>';

	

	public static function add( $tag , $replacement ) {

		self::$_tags = array_merge(array($tag => $replacement), self::$_tags);

	} 

	

	public static function parse( $content ) {

		$tags = array();

		$replacements = array();

		foreach(self::$_tags as $tag => $replacement) {

			array_push($tags, self::LEFT_DELIMITER.$tag.self::RIGHT_DELIMITER);

			array_push($replacements, $replacement);

		}

		$content = str_replace($tags, $replacements, $content);

		

		return $content;

	}

	

}



	

	// Basic stuff

	

	templateTags::add('base_url', BASE_URL);

	

	// Code

	

	templateTags::add('code', '<pre class="prettyprint">');

	templateTags::add('/code', '</pre>');

	

	// Pages Controller

	





/*

   Class: Observer



   This is the event observer class



   About: system.init

    Called just after including all files to the core framework



   About: system.page_not_found

    Called just before processing the 404.php default view.



   About: system.execute

    Controller locating and initialization. A controller object will be

    created and executed just after



   About: system.display

    Displays the output that the framework has generated.



   About: system.shutdown

    Last event to run, just before PHP starts to shut down.

*/

final class Observer

{

	private static $events = array(); // events callback



	/*

	   Method: observe

	   Attach a callback to an event queue.

	*/

	public static function observe($name, $callback)

	{

		if ( ! isset(self::$events[$name]))

			self::$events[$name] = array();



		self::$events[$name][] = $callback;

	}

	

	/*

	   Method: clear

	   Detach a callback to an event queue.

	*/

	public static function clear($name, $callback=false)

	{

		if ( ! $callback)

		{

			self::$events[$name] = array();

		}

		else if (isset(self::$events[$name]))

		{

			foreach (self::$events[$name] as $i => $event_callback)

			{

				if ($callback === $event_callback)

					unset(self::$events[$name][$i]);

			}

		}

	}



	public static function get($name)

	{

		return empty(self::$events[$name]) ? array(): self::$events[$name];

	}



	/*

	   Method: notify

	   If your event does not need to process the returned value from any

	   observers use this instead of get()

	*/

	public static function notify($name)

	{

		// removing event name from the arguments

		$args = func_num_args() > 1 ? array_slice(func_get_args(), 1): array();

		

		foreach (self::get($name) as $callback)

			call_user_func_array($callback, $args);

	}



} // end Event class



/*

   Class: Flash



   Purpose of this service is to make some data available across pages. Flash

   data is available on the next page but tdeleted when execution reach its end.



   Usual use of Flash is to make possible that current page pass some data

   to the next one (for instance success or error message before HTTP redirect).



   Example:

   > Flash::set('errors', 'Blog not found!');

   > Flass::set('success', 'Blog have been saved with success!');

   > Flash::get('success');



   Flash service as a concep is taken from Rails. This thing is really useful!

*/

final class Flash

{

	const SESSION_KEY = 'flash_vars';

	

	private static $_previous = array(); // Data that prevous page left in the Flash



	/*

	   Method: init

	   This function will read flash data from the $_SESSION variable

	   and load it into $this->previous array

	*/

	public static function init()

	{

		// Get flash data...

		if (!empty($_SESSION[self::SESSION_KEY]) and is_array($_SESSION[self::SESSION_KEY]))

			self::$_previous = $_SESSION[self::SESSION_KEY];



		$_SESSION[self::SESSION_KEY] = array();

	}



	/*

	   Method: get

	   Return specific variable from the flash. If value is not found NULL is

	   returned

	*/

	public static function get($var_name)

	{

		return isset(self::$_previous[$var_name]) ? self::$_previous[$var_name]: null;

	}



	/*

	   Method: set

	   Add specific variable to the flash. This variable will be available on the

	   next page unlease removed with the removeVariable() or clear() method

	*/

	public static function set($var_name, $var_value)

	{

		$_SESSION[self::SESSION_KEY][$var_name] = $var_value;

	}



	/*

	   Method: clear

	   Call this function to clear flash. Note that data that previous page

	   stored will not be deleted - just the data that this page saved for

	   the next page

	*/

	public static function clear()

	{

		$_SESSION[self::SESSION_KEY] = array();

	}



} // end Flash class



/*

   Class: AutoLoader



   The AutoLoader class is an object oriented hook into PHP's __autoload functionality. You can add



   - Single Files AutoLoader::addFile('Blog','/path/to/Blog.php');

   - Multiple Files AutoLoader::addFile(array('Blog'=>'/path/to/Blog.php','Post'=>'/path/to/Post.php'));

   - Whole Folders AutoLoader::addFolder('path');



   When adding a whole folder each file should contain one class named the same as the file without ".php" (Blog => Blog.php)

*/

class AutoLoader

{

	protected static $files = array();

	protected static $folders = array();

	

	/*

	   Method: addFile

	   Add directly the file need for a specific class

	*/

	  public static function addFile($class_name, $file=null)

    {

        if ($file == null && is_array($class_name)) {

            array_merge(self::$files, $class_name);

        } else {

            self::$files[$class_name] = $file;

        }

    }

	

	/*

	   Method: addFolder

	   Add a folder to soearch for the class

	*/

	public static function addFolder($folder)

	{

		if (!is_array($folder))

			$folder = array($folder);

		

		self::$folders = array_merge(self::$folders, $folder);

	}

	

	/*

	   Method: load

	   Will be called by PHP (trying to load the class)

	*/

	public static function load($class_name)

	{

		if (isset(self::$files[$class_name]))

		{

			require self::$files[$class_name];

			return;

		}

		else

		{

			foreach (self::$folders as $folder)

			{

				$file = $folder.$class_name.'.php';

				if (file_exists($file))

				{

					require $file;

					return;

				}

			}

		}

		if(DEBUG) {

			throw new Exception("Class '{$class_name}' not found!");

			}

		else {

		

			$logger = new Logger('404: Page not found at : <b>'.green::getCurrentUrl().'</b>');

			$logger->log();

	

			$maintenance = new PluginController();

			$maintenance->setLayout('');

			

			$sql = 'SELECT * FROM pages WHERE title LIKE "%'.green::getController().'%" LIMIT 1';

			global $__CONN__;

			

			$stmt = $__CONN__->prepare($sql);

			$stmt->execute();

			$page = $stmt->fetchObject();

			

			

			

			$url = BASE_URL.Page::getPathToPage($page->id);

			$message = ' 404 : Page not found at : <b>'.green::getCurrentUrl().'</b>';

			$details = ' <h2><a href="'.$url.'">Our system generated a possible solution for what your are looking</a></h2>';

	

			$maintenance->display('offline/html/index', array('message' => $message, 									      		      'details' => $details));

		}

	}

	

} // end AutoLoader class



if ( ! function_exists('__autoload')) {

	AutoLoader::addFolder(array(APP_PATH.'/models/', APP_PATH.'/controllers/'));

	AutoLoader::addFile('Model', GREEN_ROOT.'/Model.php');

	AutoLoader::addFile('Bebliuc', GREEN_ROOT.'/Bebliuc.php');

	

	function __autoload($class_name)

	{

		AutoLoader::load($class_name);

	}

}



/*

   Class: Benchmark



   This class enables you to mark points and calculate the time difference

   between them.  Memory consumption can also be displayed.

*/

final class Benchmark

{

	public static $marks = array();



	/*

	   Method: Start

	   Set a benchmark start point.

	*/

	public static function start($name)

	{

		if (!isset(self::$marks[$name]))

		{

			self::$marks[$name] = array

			(

				'start'        => microtime(true),

				'stop'         => false,

				'memory_start' => function_exists('memory_get_usage') ? memory_get_usage() : 0,

				'memory_stop'  => false

			);

		}

	}



	/*

	   Method: stop

	   Set a benchmark stop point.

	*/

	public static function stop($name)

	{

		if (isset(self::$marks[$name]))

		{

			self::$marks[$name]['stop'] = microtime(true);

			self::$marks[$name]['memory_stop'] = function_exists('memory_get_usage') ? memory_get_usage() : 0;

		}

	}



	/*

	   Method: get

	   Get the elapsed time between a start and stop of a mark name, TRUE for all.

	*/

	public static function get($name, $decimals = 4)

	{

		if ($name === true)

		{

			$times = array();



			foreach(array_keys(self::$marks) as $name)

				$times[$name] = self::get($name, $decimals);



			return $times;

		}



		if (!isset(self::$marks[$name]))

			return false;



		if (self::$marks[$name]['stop'] === false)

			self::stop($name);



		return array

		(

			'time'   => number_format(self::$marks[$name]['stop'] - self::$marks[$name]['start'], $decimals),

			'memory' => convert_size(self::$marks[$name]['memory_stop'] - self::$marks[$name]['memory_start'])

		);

	}



} // end Benchmark class



Benchmark::start('total');



/*

   Class: Inflector



   Static class used to pass from underscrore_string to CamelizeString to 

   underscored_one or to Humanize string

*/

final class Inflector 

{

	/*

	   Method: camelize

	   Format a string from an underscore string to an CamelizeSyntaxed.

	*/

	public static function camelize($string)

	{

		return str_replace(' ','',ucwords(str_replace('_',' ', $string)));

	}



	/*

	   Method: underscore

	   Format a string from an camelize string to an underscore_syntaxed.

	*/

	public static function underscore($string)

	{

		return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $string));

	}



	/*

	   Method: humanize

	   Format a string from an underscore string to an Humanized syntaxed.

	*/

	public static function humanize($string)

	{

		return ucfirst(str_replace('_', ' ', $string));

	}



} // end Inflector class



/*

   Section: General Functions 

*/



/*

   Function: use_helper

   Load all classes and/or functions from the helper file(s)



*/

function use_helper()

{

	static $helpers = array();



	foreach (func_get_args() as $helper)

	{

		if (in_array($helper, $helpers)) continue;



		$helper_file = HELPER_PATH.DIRECTORY_SEPARATOR.$helper.'.php';



		if (!file_exists($helper_file))

			throw new Exception("Helper file '{$helper}' not found!");



		include $helper_file;

		$helpers[] = $helper;

	}

}





function use_library()

{

	static $helpers = array();



	foreach (func_get_args() as $helper)

	{

		if (in_array($helper, $helpers)) continue;



		$helper_file = LIBRARY_PATH.DIRECTORY_SEPARATOR.$helper.'.php';



		if (!file_exists($helper_file))

			throw new Exception("Library file '{$helper}' not found!");



		include $helper_file;

		return new $helper;

		$helpers[] = $helper;

	}

	

}





/*

   Function: use_model

   Load a model (faster then waiting for the __autoloader)



   example:

   use_model('Blog', 'Tag', 'User');

*/

function use_model()

{

	static $models = array();



	foreach (func_get_args() as $model)

	{

		if (in_array($model, $models)) continue;



		$model_file = APP_PATH.'/models/'.$model.'.php';



		if (!file_exists($model_file))

			throw new Exception("Model file '{$model}' not found!");



		include $model_file;

		$models[] = $model;

	}

}



/*

   Function: get_url

   Give a full url with suffix and anchor (if needed)

*/

function get_url($url, $auchor='')

{

	return BASE_URL.$url.URL_SUFFIX.$auchor;

}



function url($url, $auchor='') { echo get_url($url, $auchor=''); }



/*

   Function: redirect or redirect_to

   Redirect this page to the url needed

*/

function redirect($url)

{

	header('Location: '.$url);

	Observer::notify('system.shutdown');

	exit;

}

function redirect_to($url) { redirect($url); }

function go_to($url) { redirect(get_url($url)); }

function goto_plugin($url) { redirect(get_url('plugin/'.$url)); }



/*

   Function: html_encode

   Encode a HTML string with the UTF-8 charset

*/

function html_encode($string)

{

	return htmlentities($string, ENT_QUOTES, 'UTF-8') ;

}

function html_decode($string)

{

	return html_entity_decode($string, ENT_QUOTES, 'UTF-8') ;

}



/*

   Function: valid_email

   Validate email address

*/

function valid_email($email)

{

	return (bool) preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);

}



/*

	Function: debug

	Description: returns a detailed table about $var

*/

function debug($var, $end = FALSE, $i = 1)

{

	echo '<pre style="overflow:scroll; width:96%;color: #699; background-color: #ffc; font-family: monospace; line-height: 12px; padding: 20px; margin: 0 auto; position: fixed; bottom: 0; right: 0; z-index: 1; text-shadow: 0px 0px 0px #000000;">'; var_dump($var); echo '</pre>'; 

	if($end) die;

}



function is_odd($int)

{

	return ($int & 1);

}



/*

   Function: get_request_method

   Give the request method used to send this page (GET, POST or AJAX)

*/

function get_request_method()

{

	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') return 'AJAX';

	else if (!empty($_POST)) return 'POST';

	else return 'GET';

}



/*

   Function: page_not_found

   Display a 404 page not found and exit

*/

function page_not_found()

{

	Observer::notify('system.page_not_found');

	

	header("HTTP/1.0 404 Not Found");

	echo new View('404');

	

	Observer::notify('system.shutdown');

	exit;

}



// convert size in byte to the easiest humain readable size

function convert_size($num)

{

	if ($num >= 1073741824) $num = round($num / 1073741824 * 100) / 100 .' gb';

	else if ($num >= 1048576) $num = round($num / 1048576 * 100) / 100 .' mb';

	else if ($num >= 1024) $num = round($num / 1024 * 100) / 100 .' kb';

	else $num .= ' b';

	return $num;

}



// debug fonction displaying reversed trace ----------------------------------



function green_framework_exception_handler($e)

{

	

	if (PROFILER_ACTIVE AND !ENABLE_PROFILER) 

	{

		// display Profiler

		include GREEN_ROOT.'/Profiler.php';

		Profiler::displayTrace($e);

		Profiler::display();

	}

	elseif (PROFILER_ACTIVE AND ENABLE_PROFILER) 

	{

		Profiler::displayTrace($e);

		Profiler::display();

	}

	else 

	{

		//display 404 page

		page_not_found();

	}

}



//SQL functions 





set_exception_handler('green_framework_exception_handler');



Observer::notify('system.init');

