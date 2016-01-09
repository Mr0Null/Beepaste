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

class signup extends CI_Controller
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
	//$f1 = 0; $f2 = 0;
	//$f1 = 0;
	//$f2 = 0;
	function index() 
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_check_database');
	    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('confpassword', 'Password Confirmation', 'trim|required|xss_clean|callback_check_pass_conf');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|callback_check_email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('signup');
		}
		else
		{
			//$username = $this->input->post('username');
			//$password = $this->input->post('password');
			//$email = $this->input->post('email');
			//echo $username." ".$password." ".$email;
			//echo "slm";
            //redirect('/');

            $username = $this->input->post('username');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$pwdc = $this->input->post('confpassword');
			$this->login_model->signupUser();
			redirect('/');
		}
	}
	
	function check_database($username) {
		$res = $this->login_model->get_username($username);
		if ($res > 0) {
			$this->form_validation->set_message('check_database', 'Username exists! please choose another username.');
			return false;
		}
		$f1 = 1;
		return true;
	}

	function check_pass_conf($pwdc) {
		$username = $this->input->post('username');
		$pwd = $this->input->post('password');
		if ($pwd != $pwdc) {
			$this->form_validation->set_message('check_pass_conf', 'Password Confirmation should be equal to Password!');
		    return false;
		}
		$f2 = 1;
		return true;
	}

	function check_email($email) {
$res = $this->login_model->get_email($email);
		if ($res > 0) {
			$this->form_validation->set_message('check_email', 'Your email has been used for another account! please choose another Email.');
			return false;
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    $this->form_validation->set_message('check_email', 'Invalid email address! please enter your email address correctly.');
			return false;
		}
		
		//if ($f1 == 1 && $f2 == 1) {
			//$this->db->insert('users', $data);
		//	$sql = "INSERT INTO users (username, password, email) VALUES ('".$username."','".md5($pwdc)."','" . $email. "')";
		//	$query = $this->db->query($sql);
			return true;
		//}
		//$this->form_validation->set_message('check_email', 'ERROR');
		//return false;
	}
}
?>