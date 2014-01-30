<?php

class TranslateController extends Controller {


	function language( $lang = 'ro' ) {
		setcookie('language',$lang , time()+3600*24, '/');
		redirect(get_url(''));
	}


}