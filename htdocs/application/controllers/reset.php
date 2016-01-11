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

class reset extends CI_Controller
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
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_checkmail');
		if ($this->form_validation->run() == FALSE && !$_SESSION['isloggedin'])
		{
			$this->load->view('reset');
		}
		else if ($_SESSION['isloggedin']) {
			redirect("/");
		}else
		{
			$this->login_model->resetPassword();
	       redirect("/login?f=1");
		}
	}

	function checkmail($email) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    $this->form_validation->set_message('checkmail', 'Invalid email address! please enter your email address correctly.');
			return false;
		}
		if ($this->login_model->get_email($email) <= 0) {
			$this->form_validation->set_message('checkmail', 'Please enter email that you have registered with!');
			return false;
		}
		return true;
	}

	function setpassword() {
		if ((!isset($_GET['email']) || !isset($_GET['token']) || !$this->login_model->checkTE() || $_GET['token'] == 'used') && !isset($_GET['error']) && $_GET['action'] != 'changePassword') {
			//echo 'Invalid Token or Email address or Token is used!';
			redirect('/setpassword?error=Invalid Token or Email address! or Token is used!');
		}else{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('confpassword', 'Password Confirmation', 'trim|required|xss_clean|callback_checkpassconf');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('setpassword');
			}else{
				//change password!
				if ($_GET['action'] = "changePassword") {
					$token = "use";
					//$email = $this->input->get('email');
					$username = $_SESSION['username'];
					$newpassword = $this->input->post('password');
					if ($this->login_model->setpassword($username, $token, $newpassword) == 0)
					//	echo "password successfully changed!";
					//else
						echo "an error has been occured!";
				}else{
					//$email = $this->input->get('email');
					//$username = $this->login_model->getUsername($email);
					$username = $this->input->get('username');
					$token = $this->input->get('token');
					$newpassword = $this->input->post('password');
					if ($this->login_model->setpassword($username, $token, $newpassword) == 0)
						//echo "password successfully changed!";
					//else
						echo "token is used!";
				}
				redirect('/');
			}
		}

	}

	function checkpassconf($pwdc) {
		$pwd = $this->input->post('password');
		if ($pwd != $pwdc) {
			$this->form_validation->set_message('checkpassconf', 'Password Confirmation should match Password!');
			return false;
		}
		return true;
	}

	public 
	function alpha_dash_dot($str) 
	{
		return (!preg_match("/^([-a-z0-9_-\.])+$/i", $str)) ? FALSE : TRUE;
	}
}
?>
