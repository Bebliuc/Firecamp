<?php

	global $__CONN__;
	
	
	
	$sql = "CREATE TABLE IF NOT EXISTS banner_rotator (
				  id int(20) NOT NULL AUTO_INCREMENT,
				  imagine varchar(255) DEFAULT NULL,
				  descriere varchar(255) DEFAULT NULL,
				  blend varchar(20) DEFAULT NULL,
				  PRIMARY KEY (id)
				) ENGINE=MyISAM AUTO_INCREMENT=19 ;
	
				INSERT INTO pagini VALUES (NULL, 'banner_rotator', 'banner_rotator', ?, 'banner_rotator', 'banner_rotator', 
				'banner_rotator', '0', '', 'May 14, 2009, 10:52 pm', 'May 14, 2009, 10:52 pm', 1);";
	
	$stmt = $__CONN__->prepare($sql);
	
	$continut = '<?xml version="1.0"?> 
	<Banner 
	bannerWidth="640"
	bannerHeight="350"
	textSize="12"
	textColor=""
	textAreaWidth=""
	textLineSpacing="0"	
	textLetterSpacing="-0.5"	
	textMarginLeft="12"
	textMarginBottom="5"
	transitionType="5"
	transitionDelayTimeFixed="2" 
	transitionDelayTimePerWord=".3"
	transitionSpeed="8"
	transitionBlur="yes"
	transitionRandomizeOrder="no"	
	showTimerClock="yes"
	showBackButton="yes"
	showNumberButtons="no"
	showNumberButtonsAlways="no"
	showNumberButtonsHorizontal="no"
	showNumberButtonsAscending="no"
	autoPlay="yes">
	<?php 
	global $__CONN__;
	$sql = "SELECT * FROM banner_rotator";
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
	while($item = $stmt->fetchObject()) { ?>
	<item image="<?php echo PUBLIC_URI.\'/banner_rotator/\'.$item->imagine; ?>" 
		textBlend="<?php echo $item->blend; ?>"><![CDATA[<?php if($item->color != NULL) { ?><font color="<?php echo $item->color; ?>"><?php } ?><?php echo $item->descriere; ?>
	<?php if($item->color != NULL) { ?></font><?php } ?>]]></item>
	<?php } ?>
</Banner>';
	
	if(!$stmt->execute(array($continut))) {
		
		Flash::set('error', 'Pluginul <b>Banner rotator</b> nu a fost activat cu succes.');
		
	}
