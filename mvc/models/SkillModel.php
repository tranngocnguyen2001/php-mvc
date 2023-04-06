<?php
class SkillModel
{
   private $db;
   public function __construct()
   {
      $this->db = new Database();
   }

   public function get_skill($column = '*', $where = "", $join = "")
   {
      $sql = "SELECT $column FROM user_subject  $join $where";
      $result = $this->db->select($sql);
      return $result;
   }

   public function skill_multi_save($param = [], $id = null)
   {
      $sqlArr = [];
      $sql = "";
      for ($i = 0; $i < count($param); $i++) {
         $id_user = $param[$i]['id_user'];
         $id_subject = $param[$i]['id_subject'];
         $experience_year = $param[$i]['experience_year'];
         $last_use = $param[$i]['last_use'];
         $level = $param[$i]['level']; 

         if ($id != null) {
            $sql = "UPDATE user_subject SET id_user='$id_user', id_subject ='$id_subject', experience_year='$experience_year', last_use='$last_use', level='$level'";
         } else {
            $sql = "INSERT INTO user_subject (id_user, id_subject, experience_year, last_use, level) VALUES ('$id_user', '$id_subject', '$experience_year', '$last_use', '$level')";
         }
         $sqlArr[] = $sql;
      }
      $result = $this->db->executeWithTransaction($sqlArr);
      if($result)
      {
         header('location: /Skill/user_view/'.$id_user);

      }
   } 


   public function get_skill_limit($column = "*", $where = "", $join = "", $begin = 0, $limit = 5, $orderby = "")
   {
      $sqlData = "SELECT $column FROM user_subject " . $where != null ? $where : '' . ";";
      $sqlTotalRow = "SELECT count(1) as RowCount FROM user_subject $where";

      if ($where != null) {
         $sqlData = "SELECT $column FROM user_subject $where";
         $sqlTotalRow = "SELECT count(1) as TotalRows FROM user_subject $where";
      } else {
         $sqlData = "SELECT $column FROM user_subject ";
         $sqlTotalRow = "SELECT count(1) as TotalRows FROM user_subject";
      }
      $sqlData .= "$orderby LIMIT $begin, $limit";

      $resultData = $this->db->select($sqlData);
      $resultTotalRow = $this->db->select($sqlTotalRow);
      $result = [
         "records" => $resultData,
         "total_records" => $resultTotalRow[0]['TotalRows']
      ];
      die;
      return $result;
   }

   public function skill_save($param = [], $id = null)
   {
      $id_user = $param['is_user'];
      $id_subject = $param['id_subject'];
      $experience_year = $param['experience_year'];
      $last_use = $param['last_use'];
      $level = $param['level'];

      $sql = "";
      if ($id != null) {
         $sql = "UPDATE user_subject SET id_user='$id_user', id_subject ='$id_subject', experience_year='$experience_year', last_use='$last_use', level='$level'";
      } else {
         $sql = "INSERT INTO user_subject (id_user, id_subject, experience_year, last_use, level) VALUES ('$id_user', '$id_subject', '$experience_year', '$last_use', '$level')";
      }
      die;
      $result = $this->db->execute($sql);
      return  $result;
   }

   public function delete_user_subject($id, $id_subject)
   {
      $sql = "DELETE FROM user_subject WHERE id_user=$id AND id_subject=$id_subject";
      $result = $this->db->execute($sql);
      if($result)
      {
      return $result;
      }
   }

}
