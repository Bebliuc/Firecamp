<?php

class Pagina extends Model 
{
	
	
	public static function dropdown($id, $adancime) 
	{
		
		global $__CONN__;
		$sql = "SELECT id, parent_id, nume_pagina FROM pagini WHERE parent_id = ? ORDER BY id";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		while($child = $stmt->fetchObject())
		{		
				echo "<option value={$child->id}>".str_repeat('- ',$adancime).$child->nume_pagina."</option>";
				self::dropdown($child->id, $adancime+1);	
					
				
			
		}
	}
	
	public static function pagini($id, $adancime, $segment = "") 
	{
	
		global $__CONN__;
		
		$sql = "SELECT id, nume_pagina, parent_id, parent_name, url_pagina FROM pagini WHERE parent_id = ? ORDER BY id";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		
		while($child = $stmt->fetchObject())
		{				
				
						if(empty($child->parent_name)) { $parent = ""; } else { $parent = $child->parent_name.'/'; }
						if($adancime == 0 OR $child->parent_id == 0 OR $child->parent_name == NULL) { $segment = ""; } else { $segment = $segment.'/'; }
						
						$url = $segment.$child->url_pagina; 
						$segment = $url;
		
						if(self::hasChilds($child->id)) 
							$hasChilds = '<a href="#" class="deschide-'.$child->id.'">+</a>';
						else
							$hasChilds = '';
						
						if($child->parent_id != 0) 
							$isChild = ' expand-'.$child->parent_id;
						else
							$isChild = '';
							
						echo '<tr class="trivial'.$isChild.'">';
						echo '<td class="icon"></td>';
					
						echo '<td class="icon"></td>';
					
						echo '<td>'.str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$adancime).$child->nume_pagina. ' ' .$hasChilds.'</td>';
						echo '<td>'.$child->url_pagina.'</td>';
						echo '<td><a href="'.get_url("pagina/editeaza_pagina/".$child->id).'">Editeaza</a></td>';
						echo '<td><a href="#" class="sterge" title="'.get_url("pagina/sterge_pagina/".$child->id).'">Sterge</a></td>';
						echo '</tr>';
				
						self::pagini($child->id, $adancime+1, $url);	
			
		}

		
	}
	
	public static function js($lastID) 
	{
	
		global $__CONN__;
		
		$sql = "SELECT parent_id FROM pagini WHERE parent_id != 0 GROUP BY parent_id";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute();
		
		while($child = $stmt->fetchObject())
		{				
		
						if($child->parent_id != 0 AND $child->parent_id != $lastID) 
							echo '
							$(document).ready( function() {
										$(".deschide-'.$child->parent_id.'").click(function() {
										   $(".expand-'.$child->parent_id.'").toggleRow();
										});
										$(".expand-'.$child->parent_id.'").hideRow();
							});
							';
							
		}
		
	}
	public static function hasChilds($id) {
		
		global $__CONN__;
		
		$sql = "SELECT COUNT(*) FROM pagini WHERE parent_id = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		
		if($stmt->fetchColumn() < 1) {
			return false;	
		}
		else {
			return true;
		}
		
	}
}