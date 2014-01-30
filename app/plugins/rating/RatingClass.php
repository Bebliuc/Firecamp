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
 * Products Plugin
 *
 * @package BebliuCMS
 * @subpackage products
 * @todo Add new category feature
 * 
 * @version 0.1
 * @since 0.1
 */

class Rating extends Record {
	
	const TABLE_NAME = 'ratings';
	
	public static function rateMe( $id ) 
	{
		if(!record::countFrom(rating::TABLE_NAME, 'identifier = ? AND ip = ?', array($id, rating::getip()))) {
			$counts = record::countFrom(rating::TABLE_NAME, 'identifier = ?', array( $id ));
			$values = record::findAllFrom(rating::TABLE_NAME, 'identifier = ?', array( $id ));
			$rate = 0;
			
			foreach($values as $value) 
				$rate = $rate + $value->value;
			
            if($counts == 0) $final = 0;
            else $final = ceil($rate / $counts);
			
			$template  = '<div id="rating" class="active">';
			$template .= '<ul id="'.$id.'">';
			$rest = 5 - $final;
			for ($i = 1; $i <= $final; $i++) {
			    $template .= '<li class="disabled"><a href="#'.$i.'">'.$i.'</a></li>';
			}
			
			for ($i = 1; $i <= $rest; $i++) {
			    $template .= '<li><a href="#'.$i.'">'.$i.'</a></li>';
			}
			
			$template .= '</ul>';
			$template .= '</div>';
			echo $template;
		}
		else {
			$counts = record::countFrom(rating::TABLE_NAME, 'identifier = ?', array( $id ));
			$values = record::findAllFrom(rating::TABLE_NAME, 'identifier = ?', array( $id ));
			$rate = 0;
			
			foreach($values as $value) 
				$rate = $rate + $value->value;
			
			$final = ceil($rate / $counts);
			
			$template  = '<div id="rating" class="disabled">';
			$template .= '<ul id="'.$id.'">';
			$rest = 5 - $final;
			for ($i = 1; $i <= $final; $i++) {
			    $template .= '<li class="disabled"><a href="#'.$i.'">'.$i.'</a></li>';
			}
			
			for ($i = 1; $i <= $rest; $i++) {
			    $template .= '<li class="unselected"><a href="#'.$i.'">'.$i.'</a></li>';
			}
			
			$template .= '</ul>';
			$template .= '</div>';
			echo $template;
		}
	}
	
	public static function getIp() 
	{
		
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
	
	public static function getFromId( $id )
	{
		$counts = record::countFrom(rating::TABLE_NAME, 'identifier = ?', array( $id ));
		$values = record::findAllFrom(rating::TABLE_NAME, 'identifier = ?', array( $id ));
		$rate = 0;
		
		foreach($values as $value) 
			$rate = $rate + $value->value;
		if($counts == 0) {
            $final = 0;
		}
        else {
		  $final = ceil($rate / $counts);
        }
		return $final;
	}
	
}