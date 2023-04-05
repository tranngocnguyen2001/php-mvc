<?php
$error= isset($data['err']) ? $data['err'] : "";
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="div-login">
   <h1 style="text-align: center; color: #009CD1">Managerment System</h1>
   <div class="login-form">
      <form class="" action="/Login/check_login" method="POST">
         <div class="mb-10">
         <div class=" text-center">
            <div class="div-center">
               <div class="div-icon"><i style="scale: 1.4; margin-right: 7px; margin-top: 6px;" class="fa fa-user"></i></div>
               <input class="input-center-login" name="username" type="text" id="name_subject" value="">
            </div>
         </div>
         <div class="span-div"><span style="color:red"><?php echo isset($error['username']) ? $error['username'] : ''; ?></span></div>

         </div>
        <div class="mb-10">
        <div class=" text-center">
            <div class="div-center">
               <div class="div-icon"><i style="scale: 1.4; margin-right: 7px; margin-top: 6px;" class="fa fa-lock"></i></div>
               <input class="input-center-login" name="password" type="password" id="name_subject" value="">
            </div>
         </div>
         <div class="span-div"><span style="color:red"><?php echo isset($error['password']) ? $error['password'] : ''; ?></span></div>
        </div>
         <div class="login-btn">
            <button class="btn-login" type="submit">Login</button>
         </div>
         <div class="span-div-login"><span style="color:red"><?php echo isset($error['login']) ? $error['login'] : ''; ?></span></div>
      </form>
   </div>
</div>