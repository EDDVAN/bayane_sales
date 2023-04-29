<?php 
/**
 * V_auth_vers Page Controller
 * @category  Controller
 */
class V_auth_versController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "v_auth_vers";
	}
}
