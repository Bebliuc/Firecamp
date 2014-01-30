<?php

/**
 * @package BebliuCMS
 * @subpackage plugin
 *
 * @author Bebliuc George <george@bebliuc.ro>
 * @version 0.1
 * @copyright Bebliuc George, 2009
 */

/**
 * Class ProductsController
 *
 * @package BebliuCMS
 * @subpackage products
 * @todo Add new category feature
 * 
 * @version 0.1
 * @since 0.1
 */

class ProductsController extends PluginController
{
	
	const TABLE_NAME = 'products';
	
	function __construct() {
		$this->setLayout('admin/index');
	}
	
	function index($page = 0)
	{
		User::isLogged();

		//Simple pagination algorithm 
		$from = ($page == 0 ? 0 : $page * 10);
		$to = $from + 10;
		$total = Record::countFrom('products');
		$total_pages = (ceil($total / 10) - 1);
		
		//Pagination style
		$pagination = array();	
		$pagination['next'] = ($total > $to ? '<a href="'.get_url('plugin/products/index/'.($page + 1)).'">Pagina urmatoare &raquo;</a>' : NULL);	
		$pagination['previous'] = ($page > 0 ? '<a href="'.get_url('plugin/products/index/'.($page - 1)).'">&laquo; Pagina anterioara</a>' : NULL);	
		$pagination['first_page'] = get_url('plugin/products/index/0');
		$pagination['last_page'] = get_url('plugin/products/index/'.$total_pages);
		$pagination['total_pages'] = $total_pages;
		
		
		$this->display('products/views/index', array('products' => Products::findAll(array('limit' => 10, 'offset' => $from)), 
					   'pagination' => $pagination, 'page' => $page));
	}
	
    function categories() {
        $this->display('products/views/categories');
    }
    
    function delete_category( $id ) {
        
        $category = record::findOneFrom('products_categories', 'id = ?', array($id));
    
        
        if(record::delete('products_categories', 'id = ?', array($id)))
            Flash::set('success', 'Categoria <i>'.$category->name.'</i> fost stearsa cu succes.');
        else
            Flash::set('error', 'Categoria nu a fost stearsa. O eroare necunoscuta a intervenit. P::cat::delete');
        
        go_to('plugin/products/categories');
    }
    
    function category_add() {

        $data = array('id' => NULL, 'name' => $_POST['name'], 'image' => "NULL", 'parent' => $_POST['category']);
        
        if(record::save('products_categories', $data))
            Flash::set('success', 'Categoria a fost adaugata cu succes');
        else 
            Flash::set('error', 'Categoria nu a fost adaugata. O eroare neasteptata a intervenit. P::add::category'); 
 
        go_to('plugin/products/categories');
 
    }
	function save( $action, $id = NULL ) 
	{
		User::isLogged();
		
		if( $action == 'new' ) 
		{
			//Preparing data for insert
			$data = $_POST;
			$data['slug'] = Products::formatSlug($_POST['title']);
			
			//Validating data from $_POST ( $data )
			
			$error = NULL;
			
			if(empty($data['title']))				$error .= 'Campul <b>Titlu Produs</b> este mandator. <br />';
			if(empty($data['description']))			$error .= 'Campul <b>Descriere Produs</b> este mandator. <br />';
			if($data['category'] == "0")			$error .= 'Va rugam sa alegeti o categorie.<br />';
	       	if($data['subcategory'] == "0")			$error .= 'Va rugam sa alegeti o subcategorie.';
            if(empty($data['file']))                $data['file'] = 'default';
            
            if(record::countFrom('products', 'slug = ?', array($data['slug']))) {
                Flash::set('error', 'Numele produsului este alocat altui produs.');
                go_to('plugin/products/add');
            }
            
			//Alert in case of error
			if(!empty($error)) { Flash::set('error', $error); go_to('plugin/products/add'); }
			
			//let's rename the uploaded files for more SEO
			
			//first the image
			$file_extension = main::file_extension($data['file']);
			$image_extension = main::file_extension($data['image']);
            $promotion_image_extension = main::file_extension($data['promotion_image']);
            
			rename(PRODUCTS_PATH.'original/'.$data['image'], PRODUCTS_PATH.'original/'.products::formatfile($data['slug']).'.'.$image_extension);
			rename(PRODUCTS_PATH.'90x90/'.$data['image'], PRODUCTS_PATH.'90x90/'.products::formatfile($data['slug']).'.'.$image_extension);
			rename(PRODUCTS_PATH.'captions/'.$data['promotion_image'], PRODUCTS_PATH.'captions/'.products::formatfile($data['slug']).'.'.$image_extension);
            if($data['promotion'] == 1) {
                rename(PRODUCTS_PATH.'promotions/'.$data['promotion_image'], PRODUCTS_PATH.'promotions/'.products::formatfile($data['slug']).'.'.$promotion_image_extension);
			}
            $data['image'] = products::formatfile($data['slug']).'.'.$image_extension;
            	unset($data['promotion_image']);
			//We want to go home and submit ^^
			
            if(record::insert(self::TABLE_NAME, $data)) { Flash::set('success', 'Produsul a fost adaugat cu succes.'); go_to('plugin/products');}
			
			//If nothing goes well, smth is wrong
			
			Flash::set('error', 'O eroare necunoscuta a intervenit. Va rugam sa raportati. P:add:db');
			go_to('plugin/products/add');
		}
		elseif( $action == 'edit' )
		{
			$data = $_POST;
			$data['slug'] = Products::formatSlug($_POST['title']);
			
			//Validating data from $_POST ( $data )
			
			$error = NULL;
			
			if(empty($data['title']))				$error .= 'Campul <b>Titlu Produs</b> este mandator. <br />';
			if(empty($data['description']))			$error .= 'Campul <b>Descriere Produs</b> este mandator. <br />';
			if($data['category'] == "0")			$error .= 'Va rugam sa alegeti o categorie.<br />';
			if($data['subcategory'] == "0")			$error .= 'Va rugam sa alegeti o subcategorie.';
            
			//Alert in case of error
			if(!empty($error)) { Flash::set('error', $error); go_to('plugin/products/edit/'.$id); }
			
			//let's rename the uploaded files for more SEO
			
			//first the image
			$file_extension = main::file_extension($data['file']);
			$image_extension = main::file_extension($data['image']);
			
            $promotion_image_extension = main::file_extension($data['promotion_image']);
            
			rename(PRODUCTS_PATH.'original/'.$data['image'], PRODUCTS_PATH.'original/'.products::formatfile($data['slug']).'.'.$image_extension);
			rename(PRODUCTS_PATH.'90x90/'.$data['image'], PRODUCTS_PATH.'90x90/'.products::formatfile($data['slug']).'.'.$image_extension);
            rename(PRODUCTS_PATH.'captions/'.$data['promotion_image'], PRODUCTS_PATH.'captions/'.products::formatfile($data['slug']).'.'.$image_extension);
            if($data['promotion'] == 1) {
                rename(PRODUCTS_PATH.'promotions/'.$data['promotion_image'], PRODUCTS_PATH.'promotions/'.products::formatfile($data['slug']).'.'.$promotion_image_extension);
			}
            $data['image'] = products::formatfile($data['slug']).'.'.$image_extension;
			unset($data['promotion_image']);
			//now the support file
			
			//We want to go home and submit ^^
			if(record::update(self::TABLE_NAME, $data, $id)) { Flash::set('success', 'Produsul <b>'.$data['title'].'</b> fost modificat cu succes.'); go_to('plugin/products');}
			
			//If nothing goes well, smth is wrong
			
			Flash::set('error', 'O eroare necunoscuta a intervenit. Va rugam sa raportati. P:add:db');
			go_to('plugin/products/edit/'.$id);
		}
		
	}
	
	function edit( $id )
	{
		$product = record::findOneFrom(self::TABLE_NAME, 'id= ?', array($id));
		$this->display('products/views/edit', array('product' => $product));
	}
	
	function delete( $id )
	{
		$product = record::findOneFrom(self::TABLE_NAME, 'id = ?', array($id));
		
		if(file_exists(PRODUCTS_PATH.'original/'.$product->image)) unlink(PRODUCTS_PATH.'original/'.$product->image);
		if(file_exists(PRODUCTS_PATH.'90x90/'.$product->image)) unlink(PRODUCTS_PATH.'90x90/'.$product->image);
        if(file_exists(PRODUCTS_PATH.'captions/'.$product->image)) unlink(PRODUCTS_PATH.'captions/'.$product->image);
        if(file_exists(PRODUCTS_PATH.'promotions/'.$product->image)) unlink(PRODUCTS_PATH.'promotions/'.$product->image);
		if(file_exists(PRODUCTS_PATH.'support/'.$product->file)) unlink(PRODUCTS_PATH.'support/'.$product->file);
		
		if(record::delete(self::TABLE_NAME, 'id = ?', array($id))) 
			Flash::set('success', 'Produsul <b>'.$product->title.'</b> a fost sters cu succes.');
		else
			Flash::set('error', 'O eroare necunoscuta a intervenit. Va rugam sa raportati. P:delete:db');
			
		go_to('plugin/products/index');
		
	}
	
	function get( $category, $subcategory,  $product )
	{
    
		# first we get the layout with the name Products details
		$layout = record::findOneFrom('templates', 'nume LIKE ?', array('Product details'));

		# then we attach $product->all details :D
		global $__CONN__;
		
		$sql = "SELECT p.*, c.id AS category_id, c.name
		FROM products AS p, products_categories as c
		WHERE c.id = p.category AND p.slug = ?";
        
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($product));
		
		$product = $stmt->fetchObject();
        
		if ($layout->tip == '')
                $layout->tip = 'text/html';

            // set content-type and charset of the page
            header('Content-Type: '.$layout->tip.'; charset=UTF-8');

            Observer::notify('page_before_execute_layout', $layout);

            // execute the layout code
            eval('?>'.$layout->continut);
		# it should be easy, NOT
	}
	
	function add()
	{
		$this->display('products/views/add');
	}
	
	function add_category()
	{
		# add products category, in @todo
	}
	
	function ajax_upload() 
	{
		
		$image = strtolower(str_replace(" ", "_", $_FILES['product_image']['name']));
		
		if(!file_exists(PRODUCTS_PATH.'original/'))
			mkdir(PRODUCTS_PATH.'original/', 0755, true);
		
		if(!file_exists(PRODUCTS_PATH.'90x90/'))
			mkdir(PRODUCTS_PATH.'90x90', 0755, true);
            
        if(!file_exists(PRODUCTS_PATH.'captions/'))
			mkdir(PRODUCTS_PATH.'90x90', 0755, true);
		
		if(file_exists(PRODUCTS_PATH.'original/' . $image)) {
			echo $image.'::'.'Imaginea aleasa este deja existenta.::error'; die;
		}

		
		if(file_exists(PRODUCTS_PATH.'90x90/' . $image)) {
			echo $image.'::'.'Imaginea aleasa este deja existenta.::error'; die;
		}
  
        
		Image::thumb($_FILES['product_image']['tmp_name'], PRODUCTS_PATH.'90x90/' . $image, '90', '90');
        

        
		if(!move_uploaded_file($_FILES['product_image']['tmp_name'], PRODUCTS_PATH.'original/' . $image))
			var_dump($_FILES);
		else
			echo $image.'::'.'Upload success message::success';
		
		
		# upload original file
		
		# thumbnail 100x100
		
		# thumbnail template size
		
		# return thumbnail 100x100
	}
	
	function ajax_upload_promotion() 
	{
		
        
		$filename = strtolower(str_replace(" ", "_", $_FILES['product_promotion_image']['name']));
		
		if(!file_exists(PRODUCTS_PATH.'promotions/'))
			mkdir(PRODUCTS_PATH.'promotions/', 0755, true);
		
        if(file_exists(PRODUCTS_PATH.'captions/' . $filename)) {
			echo $image.'::'.'Imaginea aleasa este deja existenta.::error'; die;
		}
		
        Image::thumb($_FILES['product_promotion_image']['tmp_name'], PRODUCTS_PATH.'captions/' . $filename, '80', '40');
        
		if(!move_uploaded_file($_FILES['product_promotion_image']['tmp_name'], PRODUCTS_PATH.'promotions/' . $filename))
			var_dump($_FILES);
		else
			echo $filename.'::'.'Upload success message::success';
		
	}
	
	function get_subcategories( $id ) {
		$return = "";
		$subcategories = Products::findSubcategories( $id );
		foreach($subcategories as $subcategory)
			$return .= '<option value="'.$subcategory->id.'">'.$subcategory->name.'</option>';
		
		echo $return;
	}
}
