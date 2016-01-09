<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->library('email');
     }

     //get the username & password from tbl_usrs
     function get_user($usr, $pwd)
     {
          $sql = "select * from users where username = '" . $usr . "' and password = '" . md5($pwd) . "'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
     function getpassword($email) {
          $sql = "select * from users where email = '" . $email . "'";
          $query = $this->db->query($sql);
          $password = $query[0]['password'];
          return $password;
     }
     function get_username($usr) {
          $sql = "select * from users where username = '" . $usr . "'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
     function getUsername($email) {
          $sql = "select * from users where email = '" . $email . "'";
          $query = $this->db->query($sql);
          return $query[0]['username'];
     }
     function get_email($email) {
          $sql = "select * from users where email = '" . $email . "'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     } 
     function checkTU() {
          $u = $_SESSION['username'];
          $t = $this->input->get('token');
          $sql = "select * from users where username = '" . $u . "' and token = '" . $t . "'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }   
     function logout() {
          $_SESSION['isloggedin'] = false;
          $_SESSION['username'] = NULL;
          session_unset(); 
          session_destroy();
     }
     function sendEMail($to, $subject, $message) {
          $config = array(
          'protocol' => 'smtp',
          'smtp_host' => 'your smtp host', // change it to yours
          'smtp_port' => 25,
          'smtp_user' => 'your email', // change it to yours
          'smtp_pass' => 'your password', // change it to yours
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
       ); 
       $this->load->library('email', $config);
       $this->email->from('your email', "your name"); // change it to yours
       $this->email->to($to);
       $this->email->subject($subject);
       $this->email->message($message);
        
       if (!$this->email->send())  {  
       
          show_error($this->email->print_debugger());
          return 0;
}
return 1;
     }
     function signupUser() {
          $data['username'] = $this->input->post('username');
          $data['password'] = md5($this->input->post('password'));
          $data['email'] = $this->input->post('email');
          $data['token'] = 'used';
          $email = $this->input->post('email');
          $message = 'Dear '.$data['username'].', your account with password ('.$this->input->post('password').') has successfuly created!';
          if ($this->login_model->sendEMail($email, 'Account Created!', $message) == 1)
            $this->db->insert('users', $data);
     }
     function resetPassword() {
          $email = $this->input->post('email');
          $token = md5(time().$email."add some randomized salt!!!"); // change salt!
          $this->db->where('email', $email);
          $data = array(
               'token' => $token
               );
          $username = $this->login_model->getUsername($email);
          $this->db->update('users', $data);
          $message = 'click this to reset your password: </br> <a>'.base_url().'/paste2/setpassword?token='.$token.'&username='.$username.'</a>';
          $this->login_model->sendEMail($email, 'Password Reset', $message);
     }
     function setpassword($username, $token, $password) {
          if ($token == 'used' && $_GET['action'] != "changePassword") {
               return 0;
          }
          $newpassword = md5($password);
          $data = array(
               'password' => $newpassword,
               'token' => 'used'
               );
          $this->db->where('username', $username);
          $this->db->update('users', $data);
          return 1;
     }
}?>