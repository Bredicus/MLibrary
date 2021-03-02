<?php
class Filter extends Controller 
{
	public static function LoginFilter($params) {
        if ($_SESSION['user_id'] == null) {
			return 'login/index';
		}		
		else {
			return false;
		}
	}
}
?>