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
 * Class Products
 *
 * @package BebliuCMS
 * @subpackage products
 * @todo Add new category feature
 * 
 * @version 0.1
 * @since 0.1
 */

class Products extends Record
{
	
	const TABLE_NAME = 'products';
	public $products;
	
	function __construct( )
	{
		# code...
	}
	
	/**
	 * findAll()
	 *
	 * Return all products matching $args parameters.
	 * 
	 * @param string $args 
	 * @return stdClass object
	 * @author Bebliuc George
	 */
	
	public static function findAll($args = null) {
		
		$where    = isset($args['where']) ? 'AND '.trim($args['where']) : '';
		$order_by = isset($args['order']) ? 'ORDER BY '.trim($args['order']) : '';
		$offset   = isset($args['offset']) ? (int) $args['offset'] : 0;
		$limit    = isset($args['limit']) ? (int) $args['limit'] : 0;
		$limit_string = $limit > 0 ? "LIMIT $offset, $limit" : '';
		
		global $__CONN__;
		
		$sql = "SELECT p.*, c.id AS category_id, c.name
		FROM products AS p, products_categories as c
		WHERE c.id = p.category $where $order_by $limit_string";
		
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute();
		
		$products = array();
		
		while($product = $stmt->fetchObject())
			$products[] = $product;
		
		return $products;
		
	}
	
	/**
	 * findCategories
	 *
	 * Returns all categories
	 *
	 * @return void
	 * @author Bebliuc George
	 */
	
	public static function findCategories() 
	{
		return Record::findAllFrom('products_categories', 'parent = 0');
	}
    
	/**
	* findSubcategories
	*
	* Returns a list of subcategories of specified id
	* @var $id
	* @return array
	* @author Bebliuc George
	*/
	
	public static function findSubcategories( $id ) 
	{
		return Record::findAllFrom('products_categories', 'parent = ? AND parent != 0', array($id));
	}
	
    public static function getSubcategoryName( $id ) {
        if($id == 0) return NULL;
        $subcategory  = record::findOneFrom('products_categories', 'id = ?', array($id));
        return $subcategory->name;
    }
    
    public static function getCategoryName( $id ) {
        if($id == 0) return NULL;
        $subcategory  = record::findOneFrom('products_categories', 'id = ?', array($id));
        return $subcategory->name;
    }
    
	public static function thumbnail( $filename ) 
	{
		return BASE_URL.'/public/products/90x90/'.$filename;
	}
	
    public static function caption( $filename ) 
	{
		return BASE_URL.'/public/products/captions/'.$filename;
	}
	
	public static function image( $filename )
	{
		return BASE_URL.'/public/products/original/'.$filename;
	}
	
	public static function attachement ( $filename )
	{
		return BASE_URL.'/public/products/support/'.$filename;
	}
	
	public static function formatSlug( $slug )
	{
		return strtolower(str_replace(array('!','@','#','$','%','^','&','*','(',')','+','=', '/',' ', '----', '---', '--'), '-', $slug));
	}
	
	public static function formatFile( $filename )
	{
		return strtolower(str_replace(array('!','@','#','$','%','^','&','*','(',')','+','=', '/',' ', '----', '---', '--'), '', $filename));
	}
	public static function formatCategory( $category )
	{
		return strtolower(str_replace(array('!','@','#','$','%','^','&','*','(',')','+','=', '/',' ', '----', '---', '--'), '', $category));
	}

}