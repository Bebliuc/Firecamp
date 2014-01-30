<?php

class EasyAdministrationController extends PluginController {
    
    function __constructor() {
        
    }
    
    function _fetchPage( $id ) {
        if (preg_match('/\W/', $id) || !$id) {
            // if $_GET['callback'] contains a non-word character,
            // this could be an XSS attack.
            header('HTTP/1.1 400 Bad Request');
            exit();
        }
        $page = record::findOneFrom('pages', 'id = ?', array($id));
        $page = (array) $page;
        echo json_encode($page);
    }
    
    function _fetchBox( $id ) {
        if (preg_match('/\W/', $id) || !$id) {
            // if $_GET['callback'] contains a non-word character,
            // this could be an XSS attack.
            header('HTTP/1.1 400 Bad Request');
            exit();
        }
        $box = record::findOneFrom('boxes', 'id = ?', array($id));
        $box= (array) $box;
        echo json_encode($box);
    }
    
    function _deployPage() {
        
        $page = $_POST;
        $id = $page['id'];
        if(record::update('pages',$page, $id))
            echo json_encode(array('result' => 'success'));
        else
            echo json_encode(array('result' => 'fail'));
        
    }
    
    function template( $id ) {
        if($id == "page_edit") {
            
            $sabloane = "";
            $templates = record::findAllFrom('templates');
            foreach($templates as $template)
            $sabloane .= '<a href="#" title="'.$template->nume.'" rel="'.$template->id.'">'.$template->nume.'</a>';
            
            echo '<form method="POST" action="#" id="edit_page">
                    <p>
                        <label for="titlu">TITLU PAGINA</label>
                        <input type="text" value="" class="page_title" name="titlu" />
                    </p>
                    <p style="display:none">
                        <label for="titlu">ADRESA PAGINA</label>
                        <input type="text" value="" class="page_url" name="adresa" />
                    </p>
                    <p>
                        <label for="titlu">CONTINUT</label>
                        <textarea name="ea_content" class="page_content"></textarea>
                    </p>
                    <p style="display:none">
                        <label for="sablon">SABLON PAGINA</label>
                        <input type="hidden" value="" name="template" class="page_template" />
                        <div class="ea_selectables" style="display:none">
                            '.$sabloane.'
                            <div style="clear:both"></div>
                        </div>
                    </p>
                    <p style="display:none">
                        <label for="status">STARE PAGINA</label>
                        <input type="hidden" value="" name="status" class="page_status" />
                        <div class="ea_switch" style="display:none">
                            <a href="#published" rel="1">'.__('Published').'</a>
                            <a href="#closed" rel="2">'.__('Closed').'</a>
                        </div>
                    </p>
                    <p>
                        <a href="#submit" class="ea_submit_page" id="ea_submit">'.__('Save changes').'</a>
                    </p>
                </form>';
        }
        
        elseif($id == "box_edit") {
              echo '<form method="POST" action="#" id="edit_page">
                    <p>
                        <label for="titlu">TITLU SECTIUNE</label>
                        <input type="text" value="" class="box_title" name="titlu" />
                    </p>
                    <p>
                        <label for="titlu">CONTINUT</label>
                        <textarea name="box_content" class="box_content"></textarea>
                    </p>
                    <input type="hidden" name="box_id" id="box_id" value="" />
                    <p>
                        <a href="#submit" class="ea_submit_box" id="ea_submit">'.__('Save changes').'</a>
                    </p>
                </form>';
        }
        
        elseif($id == "default") {
            $statistics = render_chart_ea();
            echo '
            <p><label>STATISTICI : VIZITE / VIZITE UNICE</label</p>
            <div class="ea_statistics">
                <img src="'.$statistics.'" />
            </div>';
            
        }
    }
    
    function _deployBox() {
        
        $box = $_POST;
        $id = $box['id'];
        if(record::update('boxes',$box, $id))
            echo json_encode(array('result' => 'success'));
        else
            echo json_encode(array('result' => 'fail'));
        
    }
    
    
}