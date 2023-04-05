<link rel="stylesheet" href="/front_end/css/main.css">
<link rel="stylesheet" href="/front_end/css/header.css">
<link rel="stylesheet" href="/front_end/css/table.css">

<?php
if (isset($_SESSION['user']) && $_SESSION['user'] !='') { ?>
<?php 
$mark_user="class='label-hover'";
$mark_subject="class='label-hover'";
$explode=explode('/', $_GET['url']);
if($explode[0]=="User")
{
  $mark_user="class='label-hover action'";
}
if($explode[0]=="Subject")
{
  $mark_subject="class='label-hover action'";
}
?>
  <div class="div-inline">
    <div class="div-nav" id="">
      <nav class="navbar">
        <ul class="navbar-nav" style="margin-right: unset;">
          <li><a class="navbar-brand label-hover" href="/User/user_list">
              <h2>Managerment System</h2>
            </a></li>
          <li>
            <a <?=$mark_user?> href="/User/user_list">User Managerment</a>
          </li>
          <li>
            <a <?=$mark_subject?> href="/Subject/subject_list">Subject Managerment</a>
          </li>
        </ul>
      </nav>
    </div>
    <div class="logout">
      <label  style="color: white; margin-left: 45%; margin-right: 5%">Welcome: <?= $_SESSION['user']?></label>
      <a class="label-hover a-button" onclick="if (confirm('Do you want logout?')){return true;}else{return false};" href="/Login/logout/" href="" class="logout-btn">Log out</a></div>
  </div>
<?php
}
?>
<?php
require_once './mvc/config/config.php';
require_once './mvc/core/Database.php';
require_once './mvc/core/App.php';
require_once './mvc/core/Controller.php';

$app = new App();
