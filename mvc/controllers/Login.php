<?php
class Login extends Controller
{
   private $UserModel;
   public function __construct()
   {
      $this->UserModel = $this->model('UserModel');
   }

   public function get_view()
   {
      $this->view('login');
   }

   public function check_login()
   {
      $error=[];
      $username = $_POST['username'];
      $pass = $_POST['password'];
      if (trim($username) == "" || $username == null) {
         $error['username'] = "Enter your username";
      }
      if (trim($pass) == "" || $pass == null) {
         $error['password'] = "Enter your password";
      }

      if (empty($error)==false) {
         $this->view('/login', ['err' => $error]);
      } else {
         $password = $this->UserModel->get_user("password", "WHERE username='$username'");
         $new_pass= $this->decrypt($password[0]['password']);
         if($pass==$new_pass){
            $_SESSION['user']=$username;
            header('location: /User/user_list');
         } 
         else {
            $error['login'] = "Your username or password is wrong";
            $this->view('/login', ['err' => $error]);
         }
      }
   }
   public function logout(){
      session_destroy();
      header('location: /Login/login');
   }
}
