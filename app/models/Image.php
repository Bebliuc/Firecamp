<?php

class Image extends Model {
		
	var $font;
	var $culoare;
	var $fundal;
	
	public static function rgb($hex) {
		$hex = ereg_replace("#", "", $hex);
		$color = array();
		
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
	
		return $color;
	}
	
	public static function thumb( $src_filename, $dst_filename, $max_width, $max_height ) {
		ini_set("memory_limit","12M");
        list($src_width, $src_height, $type, $attr) = getimagesize( $src_filename );
        
        switch( $type ) {
        case IMAGETYPE_JPEG:
                $src_img = imagecreatefromjpeg( $src_filename );
                break;
        case IMAGETYPE_PNG:
                $src_img = imagecreatefrompng( $src_filename );
                break;
        case IMAGETYPE_GIF:
                $src_img = imagecreatefromgif( $src_filename );
                break;
        default:
                return false;
        }
       
        if ( !$src_img ) {
                return false;
        }
 
        
        if ( $src_width / $src_height > $max_width / $max_height ) {
                $thumb_w = $max_width;
                $thumb_h = $src_height * $max_width / $src_width;
        }
        else {
                $thumb_w = $src_width * $max_height / $src_height;
                $thumb_h = $max_height;
        }
 
        
        $dst_img = ImageCreateTrueColor( $thumb_w, $thumb_h );
        
        imagealphablending($dst_img, false);
 
        // Create a new transparent color for image
        $color = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($dst_img, 0, 0, $color);
 
        // Restore transparency blending
        imagesavealpha($dst_img, true);


        imagecopyresampled( $dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_width, $src_height );
 
      
        $sharpenMatrix = array( array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1) );
        $divisor = 8;
        $offset = 0;
        imageconvolution( $dst_img, $sharpenMatrix, $divisor, $offset );
       
 
        
        $path_info = pathinfo($dst_filename);
       
      
        $return = true;
       
  
        switch ( strtolower( $path_info['extension'] ) ) {
        case 'jpg':
        case 'jpeg':
                imagejpeg( $dst_img, $dst_filename );
                break;
        case 'png':
                imagepng( $dst_img, $dst_filename );
                break;
        case 'gif':
                imagegif( $dst_img, $dst_filename );
                break;
        default:
                $return = $false;
        }
 
        imagedestroy( $dst_img );
        imagedestroy( $src_img );
       
        return $return;
	}
    
    public static function thumb_fix( $src_filename, $dst_filename, $max_width, $max_height ) {
		ini_set("memory_limit","12M");
        list($src_width, $src_height, $type, $attr) = getimagesize( $src_filename );
        
        switch( $type ) {
        case IMAGETYPE_JPEG:
                $src_img = imagecreatefromjpeg( $src_filename );
                break;
        case IMAGETYPE_PNG:
                $src_img = imagecreatefrompng( $src_filename );
                break;
        case IMAGETYPE_GIF:
                $src_img = imagecreatefromgif( $src_filename );
                break;
        default:
                return false;
        }
       
        if ( !$src_img ) {
                return false;
        }
 
        
        
                $thumb_w = $max_width;
                $thumb_h = $max_height;
 
 
        
        $dst_img = ImageCreateTrueColor( $thumb_w, $thumb_h );
        
        imagealphablending($dst_img, false);
 
        // Create a new transparent color for image
        $color = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($dst_img, 0, 0, $color);
 
        // Restore transparency blending
        imagesavealpha($dst_img, true);


        imagecopyresampled( $dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_width, $src_height );
 
      
        $sharpenMatrix = array( array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1) );
        $divisor = 8;
        $offset = 0;
        imageconvolution( $dst_img, $sharpenMatrix, $divisor, $offset );
       
 
        
        $path_info = pathinfo($dst_filename);
       
      
        $return = true;
       
  
        switch ( strtolower( $path_info['extension'] ) ) {
        case 'jpg':
        case 'jpeg':
                imagejpeg( $dst_img, $dst_filename );
                break;
        case 'png':
                imagepng( $dst_img, $dst_filename );
                break;
        case 'gif':
                imagegif( $dst_img, $dst_filename );
                break;
        default:
                $return = $false;
        }
 
        imagedestroy( $dst_img );
        imagedestroy( $src_img );
       
        return $return;
	}
	/**********************
	*@filename - path to the image
	*@tmpname - temporary path to thumbnail
	*@xmax - max width
	*@ymax - max height
	*/
	public static function resize($src,$dest,$desired_width)
	{
		ini_set("memory_limit","12M");
		$path_info = pathinfo(str_replace('/../', '/',$dest));

		/* read the source image */
		switch ( strtolower( $path_info['extension'] ) ) {
        case 'jpg':
        case 'jpeg':
                $source_image = imagecreatefromjpeg($src);
                break;
        case 'png':
                $source_image = imagecreatefrompng($src);
                break;
        case 'gif':
                $source_image = imagecreatefromgif($src);
                break;
        default:
                $source_image = imagecreatefromjpeg($src);
        }
		
		$width = imagesx($source_image);
		$height = imagesy($source_image);

		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height*($desired_width/$width));

		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width,$desired_height);

		/* copy source image at a resized size */
		imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);

		/* create the physical thumbnail image to its destination */
		switch ( strtolower( $path_info['extension'] ) ) {
        case 'jpg':
        case 'jpeg':
                imagejpeg( $virtual_image,$dest );
                break;
        case 'png':
                imagepng( $virtual_image,$dest );
                break;
        case 'gif':
                imagegif( $virtual_image,$dest );
                break;
        default:
                $return = $false;
        }
	
	}
	
	public static function config($culoare, $fundal, $font) {
		
		$this->culoare = $culoare;
		$this->fundal = $fundal;
		$this->font = $font;
		
	}
	
	public static function text($text, $size = "25", $culoare = "#FFFFFF", $font = "Champagne_Limousines.ttf") {
		
		$text = explode(" ", $text);
		$font = GREEN_ROOT.'/../app/models/image/fonts/'.$font;
		foreach($text as $cuvant) {
			
			$box = @imageTTFBbox($size,0,$font,$cuvant);

			$width = abs($box[4] - $box[0]) + 3;
			$height = abs($box[5] - $box[1]) + 5;
			
			$xcord = ($width/2)-($width/2);
			$ycord = ($height/2)+($height/2) -5;

			$img      = imagecreate($width,$height);
		 
			$white 		  = imagecolorallocate($img, 255, 238, 231)	;		
			$image_text_color	  = imagecolorallocate($img, 253, 176, 147)	;			
	
			imagefill($img, $width, $height, $white);		
		 
			imagettftext($img,$size,0,$xcord + 3, $ycord,$image_text_color,$font,$cuvant);
			
			$adresa = strtolower($cuvant);
			$nume_imagine = $adresa;
			$adresa = APP_PATH.'/models/image/'.$adresa.'.jpg';
			
			imagejpeg($img,$adresa, 100);
			
			echo '<img src="'.BASE_URL.'app/models/image/'.$nume_imagine.'.jpg" alt="'.$cuvant.'" style="padding:0px;margin-right:15px;border:0px solid #FFF;" />'; 
			
		}
	}
	
	public static function textalb($text, $size = "25", $culoare = "#FFFFFF", $font = "Champagne_Limousines.ttf") {
		
		
		$font = GREEN_ROOT.'/../app/models/image/fonts/'.$font;
		$cuvant = $text;
			
			$box = @imageTTFBbox($size,0,$font,$cuvant);

			$width = abs($box[4] - $box[0]) + 3;
			$height = abs($box[5] - $box[1]) + 5;
			
			$xcord = ($width/2)-($width/2);
			$ycord = ($height/2)+($height/2) -5;

			$img      = imagecreate($width,$height);
		 
			$white 		  = imagecolorallocate($img, 255, 255, 255)	;		
			$image_text_color	  = imagecolorallocate($img, 253, 176, 147)	;			
	
			imagefill($img, $width, $height, $white);		
		 
			imagettftext($img,$size,0,$xcord + 3, $ycord,$image_text_color,$font,$cuvant);
			
			$adresa = strtolower($cuvant);
			$nume_imagine = $adresa;
			$adresa = APP_PATH.'/models/image/'.$adresa.'.jpg';
			
			imagejpeg($img,$adresa, 100);
			
			echo '<img src="'.BASE_URL.'app/models/image/'.$nume_imagine.'.jpg" alt="'.$cuvant.'" style="margin-left:auto; padding-top:15px;border:0px solid #FFF;" />'; 
			
		
	}


}