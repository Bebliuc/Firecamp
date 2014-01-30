<?php

/**
*	Frontend pages generator
*
*	@author Bebliuc <office@bebliuc.ro>
*	@access public
*   @copyright GPL
*/
//$textile = new Textile();
//$continut = $textile->TextileThis($continut);


		global $__CONN__;
        
        $sql = 'SELECT * FROM templates WHERE id = ?';
        
        $stmt = $__CONN__->prepare($sql);
        $stmt->execute(array($template_id));
        
        if($template = $stmt->fetchObject())
        {
            
	        if($template->tip == '')
                $template->tip = 'text/html';
            
            // set content-type and charset of the page
            header('Content-Type: '.$template->tip.'; charset=UTF-8');
                
               

        	Observer::notify('frontend.page.init', $id, $template->tip);
        	
        	eval('?>'.$template->continut);
        	
        	Observer::notify('frontend.page.end', $id, $template->tip);
			
        }