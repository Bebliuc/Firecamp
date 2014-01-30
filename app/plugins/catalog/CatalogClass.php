<?php

class Catalog extends Record {
    
    public static function findAll( $args = array() ) {
        
        $sql = "SELECT * FROM catalog";
        
        if(isset($args['where'])) $sql .= ' WHERE '.$args['where'];
        if(isset($args['order'])) $sql .= ' ORDER BY '.$args['order'];
        $offset   = isset($args['offset']) ? (int) $args['offset'] : 0;
		$limit    = isset($args['limit']) ? (int) $args['limit'] : 0;
		if($limit > 0) $sql .= " LIMIT $offset, $limit";
        
        global $__CONN__;
        
        $stmt = $__CONN__->prepare($sql);
		$stmt->execute();
		
		$results = array();
		
		while($result = $stmt->fetchObject())
			$results[] = $result;
		
		return $results;
        
    }
    
}