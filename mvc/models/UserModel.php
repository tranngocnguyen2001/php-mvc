<?php
class UserModel
{
   private $db; 
   public function __construct()
   {
      $this->db = new Database();
   }

   public function get_user($column = '*', $where = "", $join = "" )
   {
      $sql = "SELECT $column FROM user $where";
      $result = $this->db->select($sql);
      return $result;
   }

   public function get_user_limit($column = "*", $where = "", $join = "", $begin = 0, $limit = 5, $orderby="")
   {
      $sqlData = "SELECT $column FROM user ". $where != null ? $where : ''." ;";
      $sqlTotalRow = "SELECT count(1) as RowCount FROM user $where";

      if ($where != null) {
         $sqlData = "SELECT $column FROM user  $where ";
         $sqlTotalRow = "SELECT count(1) as TotalRows FROM user $where";
      } else {
         $sqlData = "SELECT $column FROM user ";
         $sqlTotalRow = "SELECT count(1) as TotalRows FROM user";
      }
      $sqlData .= "$orderby LIMIT $begin, $limit ";
      $resultData = $this->db->select($sqlData);
      $resultTotalRow = $this->db->select($sqlTotalRow);
      $result = [
         "records" => $resultData,
         "total_records" => $resultTotalRow[0]['TotalRows']
      ];
      //var_dump($sqlData);die;
      return $result;
   }

   public function user_save($param = [], $id = null)
   {
      $username = $param['username'];
      $password=$param['pass_save'];
      $birth = $param['birth'];
      $email = $param['email'];
      $phone = $param['phone'];
      $photo = $param['photo'];
      $sex= $param['sex'];
      $job= $param['job'];
      $school= $param['school'];
      $experience= $param['experience'];

      $sql = "";
      if ($id != null) {
         $sql = "UPDATE user SET username='$username', password ='$password', birth='$birth', email='$email', phone='$phone', photo='$photo', sex='$sex', job='$job', school='$school', experience='$experience' WHERE id_user=$id ";
      } else {
         $sql = "INSERT INTO user (username, password, birth, email, phone, photo, sex, job, school, experience) VALUES ('$username', '$password', '$birth', '$email', '$phone', '$photo', '$sex', '$job', '$school', '$experience')";
      }
      $result = $this->db->execute($sql);
      return  $result;
   }

   public function delete_user($id)
   {
      $sql = "DELETE FROM user WHERE id_user=$id";
      $result = $this->db->execute($sql);
      if ($result == true) {
         header('location: /User/user_list');
      } else {
         die('loi truy van');
      }
   }

   
}
