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

class login extends CI_Controller
{
	
	function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		//$this->load->library('Form_validation');
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

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
		}
		else
		{
               redirect('/');
		}
	}
	
	function check_database($password)
	 {
	   //Field validation succeeded.  Validate against database
	   $username = $this->input->post('username');
	 
	   //query the database
	   $result = $this->login_model->get_user($username, $password);
	 
	   if($result > 0)
	   {
	     $_SESSION['username'] = $username;
         $_SESSION['isloggedin'] = true;
	     return TRUE;
	   }
	   else
	   {
	     $this->form_validation->set_message('check_database', 'Invalid username or password');
	     return false;
	   }
	 }

	public 
	function alpha_dash_dot($str) 
	{
		return (!preg_match("/^([-a-z0-9_-\.])+$/i", $str)) ? FALSE : TRUE;
	}
}
?>
