<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - index()
 * - login()
 * - logout()
 * - alpha_dash_dot()
 * Classes list:
 * - Auth extends CI_Controller
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * This file is part of Auth_Ldap.

    Auth_Ldap is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Auth_Ldap is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Auth_Ldap.  If not, see <http://www.gnu.org/licenses/>.
 * 
*/
/**
 * @author      Greg Wojtak <gwojtak@techrockdo.com>
 * @copyright   Copyright © 2010,2011 by Greg Wojtak <gwojtak@techrockdo.com>
 * @package     Auth_Ldap
 * @subpackage  auth demo
 * @license     GNU Lesser General Public License
 */

class logout extends CI_Controller
{
	
	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('Form_validation');
		$this->load->helper('url');
		$this->load->library('table');
		//$this->load->library('session');
	    $this->load->helper('html');
	    $this->load->database();
	    $this->load->library('form_validation');
	    //load the login model
	    $this->load->model('login_model');
	    session_start();
	}
	
	function index() 
	{
		$this->load->helper(array('form', 'url'));
		$this->login_model->logout();
		session_unset();
		redirect('/');
	}
	

	public 
	function alpha_dash_dot($str) 
	{
		return (!preg_match("/^([-a-z0-9_-\.])+$/i", $str)) ? FALSE : TRUE;
	}
}
?>
