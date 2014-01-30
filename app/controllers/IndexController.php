<?php

class IndexController extends Controller
{
    public static $vars = array();
    function __construct()
    {
    }
    function index()
    {
        self::page(Page::getRootPage());
    }
    function page($id)
    {
        global $__CONN__;
        $sql   = 'SELECT count(*) AS count FROM pages WHERE id = ' . $id;
        $nRows = $__CONN__->query($sql)->fetchColumn();
        if (!$nRows) {
            
            $logger = new Logger(__('404: Page not found at : <b>%url%</b>', array(
                '%url' => green::getCurrentUrl()
            )));
            $logger->log();
            $maintenance = new PluginController();
            $maintenance->setLayout('');
            $message = __(' 404: Page not found');
            $details = __(' What you are searching... is not here.');
            $maintenance->display('offline/html/index', array(
                'message' => $message,
                'details' => $details
            ));
        }
        $page = new Page($id);
        Observer::notify('page', $page->page);
        Observer::notify('frontend.page.init', $page->id);
        if ($page->page->behavior != 'page')
            Observer::notify('behavior_' . $page->page->behavior, $page->page);
        $page->_executeLayout();
    }
}