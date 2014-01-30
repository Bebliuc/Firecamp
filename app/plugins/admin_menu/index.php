<?php
Plugin::setInfos(array(
		'id' => 'admin_menu',
		'title' => 'Admin Frontend Menu',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Simple frontend administration bar.'));

if(User::hasPermissionsTo('admin_menu')) {

	Observer::observe('page_before_execute_layout', 'show_admin_menu');
	
	function show_admin_menu($layout) {
		
		global $__CONN__;
		
		// get this day hits
		$sql = "SELECT COUNT(id) FROM statistics WHERE occurance_date = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array(date('Y-m-d')));
		$counts = $stmt->fetchColumn();
		
		// get this day unique hits
		
		$sql = "SELECT DISTINCT ipaddress FROM statistics WHERE occurance_date = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array(date('Y-m-d')));
		$unique = $stmt->fetchAll();
		$count = 0;
		foreach($unique as $unq) $count++;
		$unique = $count;
		global $page;
		
		$jquery = BASE_URL.'app/plugins/jquery/jquery.js';
		$admin_menu_head = '		
	<link rel="stylesheet" href="'.BASE_URL.'app/plugins/admin_menu/style.css" media="screen" type="text/css">
	<link rel="stylesheet" href="'.BASE_URL.'app/plugins/markitup/markitup.css" media="screen" type="text/css">
    <script type="text/javascript" src="'.BASE_URL.'app/plugins/jquery/center.js"></script>
	<script type="text/javascript">
		if (typeof jQuery == \'undefined\') document.write("<scr" + "ipt type=\"text/javascript\" src=\"'.$jquery.'\"></scr" + "ipt>");
	</script>
	<script type="text/javascript" src="'.BASE_URL.'app/plugins/markitup/markitup.js"></script>
    
	'.markforup().'
		<script type="text/javascript">
		jQuery(function($) { 	
			$("#exposee .holder").center();
			$("#aperture_banner a:empty").remove();
			$("a#toggleAdminBar").toggle(
				function() {
					$("#aperture_banner").animate({ marginTop : \'0px\' });
					$(this).css("backgroundPosition", "0px -24px"); 
				},
				function() {
					$("#aperture_banner").animate({ marginTop : \'-40px\' });
					$(this).css("backgroundPosition", "0px 0px");
				});
				$("#exposee .holder .exposee_content textarea").val($("#template").val());
				
				$("#exposee_cancel_page").click(function() {
					$("#exposee").css("visibility", "hidden");
				});
				
				$("#exposee_save_page").click(function() {
					
					var update = $("textarea#fullscreen_edit").val();
					
					$.ajax({
					   type: "POST",
					   url: "'.get_url('pages/post_ajax_request/'.$page->id).'",
					   data: "content=" + update,
					   success: function(msg){
							if(msg == "1")
								$("#exposee_save_page").animate({ "background-color" : "green" });
							else
								$("#exposee_save_page").animate({ "background-color" : "#900" });
					   }
					 });
					
				});
				
				$("#toggle_exposee").click(function() {	
					var html = $.ajax({
					  url: "'.get_url('pages/ajax_request/'.$page->id).'",
					  async: false
					 }).responseText;
					$("#exposee .holder .exposee_content textarea").val(html);
					$("#exposee").css("visibility", "");
					$("#aperture_banner").animate({ marginTop : \'-40px\' });
					$("a#toggleAdminBar").css("backgroundPosition", "0px 0px");
				});
		});
		</script>
</head>';
		$admin_menu_body = PHP_EOL.'
			<div id="exposee" style="display:block; visibility:hidden;">
			    <div class="holder">
			        <div class="exposee_content" style="width:1100px; height:500px;">
					<div class="paper">
			        <h2 style="float:left">'.__('Edit page').' : '.$page->name.'</h2>
			<a class="large button red" id="exposee_cancel_page">'.__('Cancel').'</a><a class="large button red" id="exposee_save_page">'.__('Update').'</a>
					<div style="clear:both"></div>
			         <textarea id="fullscreen_edit" style="width:1057px;" name="test"></textarea></div>
			        
			        </div>
			    </div>
			</div>
		<div id="aperture_banner">
		<h1><a href="#">Aperture/a></h1>
		<ul id="aperture_banner_explore">
			<li id="vnav_1"><a target="_parent" href="#explore"><strong class="nav_arrow">Adauga</strong></a><span/>
			<div class="aperture_banner_dropdown">
				<ul>
					<li><a href="#"><em>&rsaquo;</em>Pagina</a></li>
					<li><a href="#"><em>&rsaquo;</em>Produs</a></li>
					<li><a href="#"><em>&rsaquo;</em>Stire</a></li>
					<li><a href="#"><em>&rsaquo;</em>Utilizator</a></li>
				</ul>
				<strong>  </strong>
			</div>
			</li>
			<li id="vnav_1"><a target="_parent" id="toggle_exposee" href="#explore"><strong>Editeaza</strong></a><span/>
			</li>
		</ul>
		<ul id="aperture_banner_about">
			<li id="vnav_5"><a target="_parent" href="'.BASE_URL.'login/logout"><strong>Logout</strong></a><span/></li>
		</ul>
		<ul id="aperture_banner_account">
			<li id="vnav_4"><a target="_parent" href="'.get_url('user/index').'"><strong>'.$_COOKIE['user'].'</strong></a><span/></li>
			<li class="login" id="vnav_6"><a target="_parent" href="#login"><strong>Vizite unice: '.$unique.'</strong></a><span/></li>
			<li class="login" id="vnav_6"><a target="_parent" href="#login"><strong>Vizite totale: '.$counts.'</strong></a><span/></li>
		</ul>
		<a href="#" id="toggleAdminBar">Toggle</a>
	</div>
	';
		preg_match('/<body[^>]*>/i', $layout->continut, $matches);
		if(isset($matches[0])) {
			$body = $matches[0];
			$layout->continut = str_replace($body, $body.$admin_menu_head.$admin_menu_body, $layout->continut);
		}
	}
	
	function markforup() {
		$preview_url = get_url('plugin/markitup/preview');
		$styles = '';
		$buttons = '';
		foreach(markitup::$buttons as $button)
			$buttons .= $button.',';
		foreach(markitup::$styles as $style)
			$styles .= $style.'\n';

		return <<<JS

			<script type="text/javascript">
			<!--
			jQuery(document).ready(function($)	{
				mySettings = {
					previewParserPath:	'$preview_url',
					previewInWindow: 'width=800, height=600, resizable=yes, scrollbars=yes',
					onShiftEnter:		{keepDefault:false, openWith:'\\n\\n'},
					markupSet: [
						{name:'First Level Heading', key:'1', placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '=') } },
						{name:'Second Level Heading', key:'2', placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '-') } },
						{name:'Heading 3', key:'3', openWith:'### ', placeHolder:'Your title here...' },
						{name:'Heading 4', key:'4', openWith:'#### ', placeHolder:'Your title here...' },
						{name:'Heading 5', key:'5', openWith:'##### ', placeHolder:'Your title here...' },
						{name:'Heading 6', key:'6', openWith:'###### ', placeHolder:'Your title here...' },
						{separator:'---------------' },		
						{name:'Bold', key:'B', openWith:'**', closeWith:'**'},
						{name:'Italic', key:'I', openWith:'_', closeWith:'_'},
						{separator:'---------------' },
						{name:'Bulleted List', openWith:'- ' },
						{name:'Numeric List', openWith:function(markItUp) {
							return markItUp.line+'. ';
						}},
						{separator:'---------------' },
						{name:'Picture', key:'P', replaceWith:'![[![Alternative text]!]]([![Url:!:http://]!] "[![Title]!]")'},
						{name:'Link', key:'L', openWith:'[', closeWith:']([![Url:!:http://]!] "[![Title]!]")', placeHolder:'Your text to link here...' },
						{separator:'---------------'},	
						{name:'Quotes', openWith:'> '},
						{name:'Code Block / Code', openWith:'(!(\t|!|`)!)', closeWith:'(!(`)!)'},
						{separator:'---------------'},
						{name:'Preview', call:'preview', className:"preview"},
						{separator:'---------------'},
						$buttons
						{separator:'---------------'}
					]
				}

				// mIu nameSpace to avoid conflict.
				miu = {
					markdownTitle: function(markItUp, char) {
						heading = '';
						n = $.trim(markItUp.selection||markItUp.placeHolder).length;
						for(i = 0; i < n; i++) {
							heading += char;
						}
						return '\\n'+heading;
					}
				}
				$('#fullscreen_edit').markItUp(mySettings);
			});
			-->
			</script>
			<style type="text/css">
				$styles;
			</style>
JS;
	}
}