<?php
class SubjectModel
{
   private $db;
   public function __construct()
   {
      $this->db = new Database();
   }

   public function get_subject($column = '*', $where = "", $join = "" )
   {
      $sql = "SELECT $column FROM subject $where";
      $result = $this->db->select($sql);
      return $result;
   }

   public function get_subject_limit($column = "*", $where = "", $join = "", $begin = 0, $limit = 5, $orderby="")
   {
      $sqlData = "SELECT $column FROM ". $where != null ? $where : ''.";";
      $sqlTotalRow = "SELECT count(1) as RowCount FROM subject $where";

      if ($where != null) {
         $sqlData = "SELECT $column FROM subject  $where";
         $sqlTotalRow = "SELECT count(1) as TotalRows FROM subject $where";
      } else {
         $sqlData = "SELECT $column FROM subject ";
         $sqlTotalRow = "SELECT count(1) as TotalRows FROM subject";
      }
      $sqlData .= "$orderby LIMIT $begin, $limit";

      $resultData = $this->db->select($sqlData);
      $resultTotalRow = $this->db->select($sqlTotalRow);
      $result = [
         "records" => $resultData,
         "total_records" => $resultTotalRow[0]['TotalRows']
      ];
      
      return $result;
   }

   public function subject_save($arr = [], $id = null, $param)
   {
      
      $sql = "";
      if ($id != null) {
         $sql = "UPDATE subject SET name_subject='$param'  WHERE id_subject=$id ";
      } else {
         $sql = "INSERT INTO subject (name_subject) VALUES ('$param')";
      }
      $result = $this->db->execute($sql);
      return  $result;
   }

   public function delete_subject($id)
   {
      $sql = "DELETE FROM subject WHERE id_subject=$id";
      $result = $this->db->execute($sql);
      if ($result == true) {
         header('location: /Subject/subject_list');
      } else {
         die('loi truy van');
      }
   }

   
}
