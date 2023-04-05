<?php
class Database{
   private $host=HOST_DB;
   private $Servername=SEVER_DB;
   private $password=PASS_DB;
   private $db_name=NAME_DB;
   private $connectionString;

   public function __construct() {
      $this->connectionString= new mysqli($this->host, $this->Servername, $this->password, $this->db_name);
   }
   public function select($sql)
   {
      $data=null;
      $result=$this->connectionString->query($sql);
      if($result->num_rows >0)
      {
         while($row=$result->fetch_assoc())
         {
            $data[]=$row;
         }
         return $data;
      }
   }

   public function execute($sql)
   {
      $result=$this->connectionString->query($sql);
      if($result)
      {
         return true;
      }
      else
      {
         return false;
      }

   }

   public function executeWithTransaction($arr=[])
   {
      $this->connectionString->begin_transaction();
      try{
         for($i=0;$i<count($arr);$i++)
         {
            $result=$this->connectionString->query($arr[$i]);
         }
         $result=$this->connectionString->commit();
      }
      catch(Exception $e)
      {
         $result=$this->connectionString->rollback();
         echo "Failed: " . $e->getMessage();
      }
      return $result;
   }
   

}