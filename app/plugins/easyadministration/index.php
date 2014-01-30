<?php



if ( ! defined('FIRECAMP')) exit('No direct script access allowed');



/**

 * Firecamp

 *

 * @package		Firecamp

 * @author		Firecamp Team

 * @copyright	Copyright (c) 2010 - 2011, Bebliuc

 * @license		http://firecamp.ro/license

 * @link		http://firecamp.ro

 * @since		Version 1.0.01

 */



/**

 * 

 *

 * @package		Easy Administration

 * @author		Firecamp Team

 * @copyright	Copyright (c) 2010 - 2011, Bebliuc

 * @license		http://firecamp.ro/license

 * @link		http://firecamp.ro

 * @since		Version 1.0.01

 */





Plugin::setInfos(array(

		'id' => 'easyadministration',

		'title' => 'Easy Administration',

		'author' => 'Bebliuc George',

		'website' => 'http://george.bebliuc.eu',

		'version' => '1.0',

		'description' => 'Website administration made easy.'));

if(user::logged())

    Observer::observe('page', 'editlinks');

    

Plugin::addController('easyadministration', 'Easy Administration', false, false);



function editlinks($page) {

    $page->content = "<a href=\"#\"id=\"ea_page_edit\" title=\"".__('Edit this page')."\" rel=\"".$page->id."\">".__('Edit this page')."</a>\n<div id=\"ea_page_content\">\n".$page->content."</div>";

}


if(user::logged())
  Observer::observe('page_after_execute_layout', '_requireJs');



if(plugin::isEnabled('boxes')) {

    if(user::logged())

        Observer::observe('box.construct', '_box_edit');

    function _box_edit($box) {

        $box->content = "<a href=\"#\"id=\"ea_box_edit\" title=\"".__('Edit this box')."\" rel=\"".$box->id."\">".__('Edit this box')."</a>\n<div id=\"ea_box_content_".$box->id."\">\n".$box->content."</div>";

    }

}

function _requireJs($layout) {

    

    $javascript = '<script type="text/javascript">

    

            function toogleEa($j) {

                if($j("#easyadministration").css("left") == "0px")

                    $j("#easyadministration").stop().animate({ "left" : "-500px" });

                else

                    $j("#easyadministration").stop().animate({ "left" : "0" });

            }

            

            function setheader(heading) {

                $("#easyadministration .ea_nav h2").text(heading);

            }

            

            function ea_default() {

                setheader("Firecamp Administration");

                $.get("'.BASE_URL.'plugin/easyadministration/template/default", function(data) {

                      $(".ea_wrapper").html(data);

                });   

            }



            head.js("'.BASE_URL.'app/plugins/jquery/jquery.js", "'.BASE_URL.'app/plugins/ckeditor/ckeditor.js", function() {

                // initiate default easyadministration view

                ea_default();

                

                jQuery("#ea_box_edit").live("click", function(e) {

                   setheader("Editeaza sectiune");

                   

                   var box_id = $(this).attr("rel");

                   $.get("'.BASE_URL.'plugin/easyadministration/template/box_edit", function(data) {

                        $(".ea_wrapper").html(data);

                   $.getJSON("'.BASE_URL.'plugin/easyadministration/_fetchBox/" + box_id, function(box) {

                        $("#easyadministration").animate({ "left" : "0" }); 

                        setheader("Editeaza sectiune : " + box.title);

                        $(".box_title").val(box.title);

                        

                        $("#box_id").val(box.id);

                        

                        if (CKEDITOR.instances[\'box_content\']) {

                             CKEDITOR.instances[\'box_content\'].destroy(true);

                        }

                        CKEDITOR.replace( \'box_content\',

                            {

                                toolbar :  [

                        			[\'Undo\',\'Redo\',\'PasteFromWord\'],

                        			[\'-\',\'SelectAll\',\'RemoveFormat\'],

                        			[\'Image\',\'Table\',\'SpecialChar\'],

                        			[\'Bold\',\'Italic\',\'Strike\'],

                        			[\'NumberedList\',\'BulletedList\',\'-\',\'Outdent\',\'Indent\',\'Blockquote\'],

                        			[\'Link\',\'Unlink\'],

                        			[\'Maximize\'],

                                    [\'TextColor\',\'BGColor\']

                        		],	

                                uiColor : \'transparent\',

                                language : \'en\',

                                skin : \'kama\',

                                resize_enabled : false

                            });

                            

                        

                        

                        CKEDITOR.instances.box_content.setData(box.content);

                        

                        

                   });

                   });

                   e.preventDefault(); 

                });

                

                jQuery(".ea_submit_box").live("click", function(e) {

                    

                    var box = {

                        "id" : $("#box_id").val(),

                        "title" : $(".box_title").val(),

                        "content" : CKEDITOR.instances.box_content.getData()

                    };

                     $.ajax({

                       type: "POST",

                       url: "'.BASE_URL.'plugin/easyadministration/_deployBox/",

                       cache: false,

                       data: box,

                       success: function(response) {

                           response = jQuery.parseJSON(response);

                           if(response.result == "success")

                                $("#ea_box_content_" + box.id).html(CKEDITOR.instances.box_content.getData());

                           else

                                alert(response.result);

                           toogleEa($);

                       }

                     });

                    

                    e.preventDefault();    

                })

                

                jQuery("#ea_page_edit").click(function(e) {

                    setheader("Editeaza pagina");

                    $(".ea_wrapper").html("");

                    var page_id = $(this).attr("rel");

                    $.get("'.BASE_URL.'plugin/easyadministration/template/page_edit", function(data) {

                      $(".ea_wrapper").html(data);

                    

                    $.getJSON("'.BASE_URL.'plugin/easyadministration/_fetchPage/" + page_id, function(page) {

                        $("#easyadministration").animate({ "left" : "0" }); 

                        setheader("Editeaza pagina : " + page.name);

                       /*

                        if(typeof CKEDITOR.instances.ea_content == "object")

                             CKEDITOR.instances[\'ea_content\'].destroy(true);

                            

                        if(typeof CKEDITOR.instances.ea_content == "undefined") {

                            CKEDITOR.replace( \'ea_content\',

                            {

                                toolbar :  [

                        			[\'Undo\',\'Redo\',\'PasteFromWord\'],

                        			[\'-\',\'SelectAll\',\'RemoveFormat\'],

                        			[\'Image\',\'Table\',\'SpecialChar\'],

                        			[\'Bold\',\'Italic\',\'Strike\'],

                        			[\'NumberedList\',\'BulletedList\',\'-\',\'Outdent\',\'Indent\',\'Blockquote\'],

                        			[\'Link\',\'Unlink\'],

                        			[\'Maximize\'],

                                    [\'TextColor\',\'BGColor\']

                        		],	

                                uiColor : \'transparent\',

                                language : \'en\',

                                skin : \'kama\',

                                resize_enabled : false

                            });

                            

                        }

                        */

                        

                        if (CKEDITOR.instances[\'ea_content\']) {

                                CKEDITOR.remove(CKEDITOR.instances[\'ea_content\']);

                        }

                        CKEDITOR.replace( \'ea_content\',

                            {

                                toolbar :  [

                        			[\'Undo\',\'Redo\',\'PasteFromWord\'],

                        			[\'-\',\'SelectAll\',\'RemoveFormat\'],

                        			[\'Image\',\'Table\',\'SpecialChar\'],

                        			[\'Bold\',\'Italic\',\'Strike\'],

                        			[\'NumberedList\',\'BulletedList\',\'-\',\'Outdent\',\'Indent\',\'Blockquote\'],

                        			[\'Link\',\'Unlink\'],

                        			[\'Maximize\'],

                                    [\'TextColor\',\'BGColor\']

                        		],	

                                uiColor : \'transparent\',

                                language : \'en\',

                                skin : \'kama\',

                                resize_enabled : false

                            });

                            

                        

                        

                        CKEDITOR.instances.ea_content.setData(page.content);

                        

                        $(".page_title").val(page.name);

                        $(".page_url").val(page.slug);

                        $(".ea_selectables a.active").removeClass("active");

                        $(".ea_selectables a[rel=" + page.template + "]").addClass("active");

                        $("input.page_template").val(page.template);

                        $(".ea_switch a.active").removeClass("active");

                        $(".ea_switch a[rel=" + page.status + "]").addClass("active")

                        $("input.page_status").val(page.status);

                        });

                        e.preventDefault();    

                    });

                });

                

                jQuery(".easyadministrationtoggle").click(function(e) {

                   toogleEa(jQuery);

                   e.preventDefault();

                });

                

                jQuery("#easyadministration .buttons span a.close").click(function(e) {

                   toogleEa(jQuery);

                   ea_default();

                   e.preventDefault();

                });

                

                jQuery(".ea_selectables a").live("click", function(e) {

                   jQuery(".ea_selectables a.active").removeClass("active");

                   $(this).addClass("active");

                   $("input.page_template").val($(this).attr("rel"));

                   e.preventDefault();

                });

                

                jQuery(".ea_switch a").live("click", function(e) {

                    jQuery(".ea_switch a.active").removeClass("active");

                    $(this).addClass("active");

                    $("input.page_status").val($(this).attr("rel"));

                    e.preventDefault();    

                });

                

                jQuery(".ea_submit_page").live("click", function(e) {

                    var page = {

                        "id" : $("#ea_page_edit").attr("rel"),

                        "name" : $(".page_title").val(),

                        "slug" : $(".page_url").val(),

                        "content" : CKEDITOR.instances.ea_content.getData(),

                        "status" : $("input.page_status").val(),

                        "template" : $("input.page_template").val()

                    };

                     $.ajax({

                       type: "POST",

                       url: "'.BASE_URL.'plugin/easyadministration/_deployPage/",

                       cache: false,

                       data: page,

                       success: function(response) {

                           response = jQuery.parseJSON(response);

                           if(response.result == "success")

                                $("#ea_page_content").html(CKEDITOR.instances.ea_content.getData());

                           else

                                alert(response.result);

                           toogleEa($);

                       }

                     });

                    e.preventDefault();   

                });

            });

        </script>';

    $head = "\n\n\t<!-- LOAD FIRECAMP EASY ADMINISTRATION JAVASCRIPT FILES -->\n\t<script type=\"text/javascript\" src=\"".BASE_URL."app/plugins/easyadministration/_requirejs.js\"></script>";

    $head .= "\n\t".$javascript."\n";

    $head .= "\t<link rel=\"stylesheet\" href=\"".BASE_URL."app/plugins/easyadministration/easyadmin.css\" type=\"text/css\"/>";

    $layout->continut = str_replace("</head>", $head."\n</head>", $layout->continut);

   

    $body = '

    <div id="easyadministration">

    <!-- <a href="#edit" class="easyadministrationtoggle">'.__('Easy administration toggle').'</a> -->

                <div class="ea_nav">

                    <h2>Firecamp administration</h2>

                    <div class="buttons">

                        <span><a href="#messages" class="message_off">Messages</a></span>

                        <span><a href="#settings" class="settings">Settings</a></span>

                        <span><a href="#close" class="close">Close</a></span>

                    </div>

                </div>

                

                <div class="ea_wrapper">

                  

                </div>

            </div>';

    

    $layout->continut = str_replace("</body>", "\n".$body."\n</body>", $layout->continut);

    

}

