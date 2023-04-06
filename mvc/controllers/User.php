<?php
class User extends Controller
{
   private $UserModel;
   private $SkillModel;
   private $SubjectModel;

   public function __construct()
   {
      $this->CheckLogin();
      $this->UserModel = $this->model('UserModel');
      $this->SkillModel = $this->model('SkillModel');
      $this->SubjectModel = $this->model('SubjectModel');
   }

   public function user_list($currentPage = 1, $input = '', $birth = '', $sex = '')
   {
      
      $strInput = '';
      $strBirth = '';
      $strSex = '';
      $tempBirth1="";
      if($input !=''){
         $tempInput = explode('=',$input);
         $strInput = $tempInput[1];
      }
      if($birth !=''){
         $tempBirth = explode('=',$birth);//tách dấu bằng ra khỏi chuỗi
         $tempBirth1=str_replace('-','/',$tempBirth[1]);//birth trả về đsung định dạng
         //var_dump($tempBirth1);
         if($tempBirth[1]!=""){
         $tempBirth2=explode('-',$tempBirth[1]);//tạo arr chứa các phần tử d-m-y
         $arrBirth=[
            $tempBirth2[2],
            $tempBirth2[1],
            $tempBirth2[0],
         ];
         $arrBirth1=implode('-',$arrBirth);//đảo ngược chuỗi từ d/m/y thành y/m/d để phục vụ tìm kiếm
         $strBirth = $arrBirth1;
      }
      else
      {
         $strBirth="";
      }
      }
      if($sex !=''){
         $tempSex = explode('=',$sex);
         $strSex = $tempSex[1];
      }
      $begin = 0;
      if ($currentPage == 1) {
         $begin = 0;
      } else {
         $begin = ($currentPage * 5) - 5;
      }

      $arrParam = explode("/", $_GET['url']);

      $sqlWhere = "";
      // $arrParam = [];
      $params = "";

      //if ($birth !="" || $sex != null || $input != null) {
      $arrParam = [
         'input' => $strInput,
         'birth' => $strBirth,
         'sex' => $strSex,
      ];
      //arr này trả về cái date đúng định dạng
      $arrParam_return = [
         'input' => $strInput,
         'birth' => $tempBirth1,
         'sex' => $strSex,
      ];
      $params = 'input='.$arrParam['input'] . '/birth=' . $arrParam['birth'] . '/sex=' .  $arrParam['sex'];
      $where = array();
      if (trim($arrParam['input']) != "") {
         $where[] =  "(email LIKE '%{$arrParam['input']}%' OR username LIKE '%{$arrParam['input']}%' OR job LIKE '%{$arrParam['input']}%')";
      }
      if (trim($arrParam['birth']) != "") {
         $where[] = "birth = '{$arrParam['birth']}'";
      }
      if (trim($arrParam['sex']) != "") {
         $where[] = "sex = '{$arrParam['sex']}'";
      }

      if ($where) {
         $sqlWhere .= ' WHERE ' . implode(' AND ', $where); //tác các phần tử trong mảng = chữ and và chuyển chúng về dạng string
      }
      // }
      $data = $this->UserModel->get_user_limit("*", $sqlWhere, '', $begin, 5, "ORDER BY id_user DESC");
      if ($data) {
         $records =  $data['records'];
         $totalRecords = $data['total_records'];
         $pagingHtml = $this->paging($totalRecords, $currentPage, 5, '/User/user_list', $params);
         // var_dump($arrParam);
         $this->view(
            'user/user_list',
            [
               'user' => $records, 'currentPage' => $currentPage, 'pagingHtml' => $pagingHtml, 'total' => $totalRecords, 'search_input' => $arrParam_return
            ]
         );
      } else {
         $this->view(
            'user/user_list',
            [
               'user' => [], 'currentPage' => 1, 'pagingHtml' => '', 'dataParam' => []
            ]
         );
      }
   }
   public function user_create()
   {
      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
         $this->view('user/user_create', []);
      } else {
         $username = $_POST['username'];
         $password = $_POST['password'];
         $birth = $_POST['birth'];
         $email = $_POST['email'];
         $phone = $_POST['phone'];
         $sex = $_POST['sex_input'];
         $job = $_POST['job'];
         $dataError = [];

         $picture = $_FILES['photo'];
         $name_picture = $picture['name'];
         $name_picture = explode('.', $name_picture);
         $type_of_pic = end($name_picture);
         $new_name_pic = md5(uniqid()) . '.' . $type_of_pic;
         $imageData = '';
         if ($picture['tmp_name'] != "") {
            if (in_array($type_of_pic, ['', 'jpg', 'png', 'jpeg', 'gif'])) {
               //kiểm tra dung lượng file có vượt quá 10mb hay k
               if ($picture['size'] <= 10485760) {
                  $aExtraInfo = getimagesize($picture['tmp_name']);
                  $imageData = "data:" . $aExtraInfo["mime"] . ";base64," . base64_encode(file_get_contents($picture['tmp_name']));
                  $upload = move_uploaded_file($picture['tmp_name'], getcwd() . '/front_end/pictures/' . $new_name_pic);
                  //header("location: user_list.php");
               } else {
                  $dataError['err_photo'] = 'the size of the picture too large';
               }
            } else {
               $dataError['err_photo'] = "your type of picture is wrong. please choese the file has tpye of 'jpg', 'png', 'jpeg', 'gif'. ";
            }
         }

         if (!isset($sex) || $sex == "") {
            $dataError['err_sex'] = "Please! tick into this buttons";
         }
         if ($username != null || trim($username) !== "") {
            if (strlen($username) > 2) {
               $get_row_name = $this->UserModel->get_user("count(1) as countrow", "Where username='$username'",);
               $row_name = $get_row_name[0]['countrow'];
               if ($row_name > 0) {
                  $dataError['err_username'] = "This username is exsist";
               }
            } else {
               $dataError['err_username'] =  'User name must be >= 2 character';
            }
         } else {
            $dataError['err_username'] =  'User name is required ';
         }
         $strBirth = null;
         if ($birth != null || trim($birth) != "") { 
            $parts = explode("-", $birth);
            $checkdate = checkdate($parts[1], $parts[0], $parts[2]);
            if ($checkdate == false) {
               $dataError['err_birth'] = 'Your type of the date is wrong. check again';
            }else{
               $strBirth = $parts[2] .'-'. $parts[1].'-'. $parts[0];
            }
         } else {
            $dataError['err_birth'] = "Please enter your birth";
         }
         if ($email === null || trim($email) === "") {
            $dataError['err_email'] = "Please enter your email";
         }
         if ($password != null || trim($password) != "") {
            if (strlen($password) < 4) {
               $dataError['err_password'] = "Your password must have at least 4 numbers";
            }
         } else {
            $dataError['err_password'] = "Please enter your password";
         }
         $pass_encode = $this->encrypt($password);
         if ($job === null || trim($job) === "") {
            $dataError['err_job'] = "Please enter your job";
         }
         if ($phone === null || trim($phone) === "") {
            $dataError['err_phone'] = "Please enter your phone";
         }
         $arrInput =
            [
               'username' =>$username,
               'password' => $_POST['password'],
               'birth' => $strBirth,
               'email' => $_POST['email'],
               'phone' => $_POST['phone'],
               'sex' => $_POST['sex_input'],
               'job' => $_POST['job'],
               'experience' => $_POST['experience'],
               'school' => $_POST['school'],
               'photo' => $new_name_pic,
               'imageData' => $imageData,
               'pass_save' => $pass_encode
            ];
         if (count($dataError) > 0) {
            $this->view('user/user_create', ['input' => $arrInput], $dataError);
            // $this->view('user/user_create', ['input' => $arrInput , 'error'=> $dataError]);
         } else {
            $result  = $this->UserModel->user_save($arrInput);
            if ($result) {
               header('location: /User/user_list');
               //$this->view('user/user_create', ['input' => $result]);
            }
         }
      }
   }

   public function user_update($id_user)
   {
      if (isset($id_user) && $_SERVER['REQUEST_METHOD'] === 'GET') {
         $user = $this->UserModel->get_user("*", "Where id_user=$id_user", "");
         $pass_decrypt = $this->decrypt($user[0]['password']);
         $user[0]['password'] = $pass_decrypt;
         $this->view('/user/user_edit', ['user' => $user[0]]);
      } else {
         $username = $_POST['username'];
         $password = $_POST['password'];
         $pass_encrypt = $this->encrypt($password);
         $birth = $_POST['birth'];
         $email = $_POST['email'];
         $phone = $_POST['phone'];
         $sex = $_POST['sex_input'];
         $job = $_POST['job'];
         $dataError = [];

         $picture = $_FILES['photo'];
         $name_picture = $picture['name'];
         $name_picture = explode('.', $name_picture);
         $type_of_pic = end($name_picture);
         $new_name_pic = md5(uniqid()) . '.' . $type_of_pic;
         $imageData = '';
         if ($picture['tmp_name'] != "") {
            if (in_array($type_of_pic, ['', 'jpg', 'png', 'jpeg', 'gif'])) {
               //kiểm tra dung lượng file có vượt quá 10mb hay k
               if ($picture['size'] <= 10485760) {
                  $aExtraInfo = getimagesize($picture['tmp_name']);
                  $imageData = "data:" . $aExtraInfo["mime"] . ";base64," . base64_encode(file_get_contents($picture['tmp_name']));
                  $upload = move_uploaded_file($picture['tmp_name'], getcwd() . '/front_end/pictures/' . $new_name_pic);
                  //header("location: user_list.php");
               } else {
                  $dataError['err_photo'] = 'the size of the picture too large';
               }
            } else {
               $dataError['err_photo'] = "your type of picture is wrong. please choese the file has tpye of 'jpg', 'png', 'jpeg', 'gif'. ";
            }
         }

         if (!isset($sex) || $sex == "") {
            $dataError['err_sex'] = "Please! tick into this buttons";
         }
         if ($username != null || trim($username) !== "") {
            if (strlen($username) > 2) {
               $get_row_name = $this->UserModel->get_user("count(1) as countrow", "Where username='$username' AND id_user !=$id_user",);
               $row_name = $get_row_name[0]['countrow'];
               if ($row_name > 0) {
                  $dataError['err_username'] = "This username is exsist";
               }
            } else {
               $dataError['err_username'] =  'User name must be >= 2 character';
            }
         } else {
            $dataError['err_username'] =  'User name is required ';
         }
         $strBirth = null;
         if ($birth != null || trim($birth) != "") {
            $parts = explode("-", $birth);
            $checkdate = checkdate($parts[1], $parts[0], $parts[2]);
            if ($checkdate == false) {

               $dataError['err_birth'] = 'Your type of the date is wrong. check again';
            }else{
               $strBirth = $parts[2] .'-'. $parts[1].'-'. $parts[0];
            }
         } else {
            $dataError['err_birth'] = "Please enter your birth";
         }
         if ($email === null || trim($email) === "") {
            $dataError['err_email'] = "Please enter your email";
         }
         if ($password != null || trim($password) != "") {
            if (strlen($password) < 4) {
               $dataError['err_password'] = "Your password must have at least 4 numbers";
            }
         } else {
            $dataError['err_password'] = "Please enter your password";
         }
         $pass_encode = $this->encrypt($password);
         if ($job === null || trim($job) === "") {
            $dataError['err_job'] = "Please enter your job";
         }
         if ($phone === null || trim($phone) === "") {
            $dataError['err_phone'] = "Please enter your phone";
         }
         $arrInput =
            [
               'username' => $_POST['username'],
               'password' => $_POST['password'],
               'birth' => $strBirth,
               'email' => $_POST['email'],
               'phone' => $_POST['phone'],
               'sex' => $_POST['sex_input'],
               'job' => $_POST['job'],
               'experience' => $_POST['experience'],
               'school' => $_POST['school'],
               'photo' => $new_name_pic,
               'imageData' => $imageData,
               'id_user' => $id_user,
               'pass_save'=>$pass_encode
            ];
         if (count($dataError) > 0) {
            $this->view('user/user_edit', ['user' => $arrInput, 'dataError' => $dataError]);
            // $this->view('user/user_create', ['input' => $arrInput , 'error'=> $dataError,'id'=>$id]);
         } else {
            $arrInput['password'] = $pass_encrypt;
            $result  = $this->UserModel->user_save($arrInput, $id_user);
            if ($result) {
               header('location: /User/user_list');
               //$this->view('user/user_edit', ['input' => $result]);
            }
         }
      }
   }

   public function delete_user($id_user)
   {

      $result = $this->UserModel->get_user('photo', "WHERE id_user=$id_user", "");
      $link = "./front_end/pictures/" . $result[0]['photo'];
      if (file_exists($link)) {
         unlink($link);
      }
      $this->UserModel->delete_user($id_user);
   }


   
}
