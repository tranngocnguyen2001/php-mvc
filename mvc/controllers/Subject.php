<?php class Subject extends Controller
{
   private $SubjectModel;
   public function __construct()
   {
      $this->CheckLogin();
      $this->SubjectModel = $this->model('SubjectModel');
   }

   public function subject_list($currentPage = 1, $name = null)
   {
      $begin = 0;
      if ($currentPage == 1) {
         $begin = 0;
      } else {
         $begin = ($currentPage * 5) - 5;
      }
      $sqlwhere = "";
      if (isset($_POST['input'])) {
         $name_subject = $_POST['input'];
         $sqlwhere = "Where name_subject LIKE '%$name_subject%'";
      }
      $data = $this->SubjectModel->get_subject_limit("*", $sqlwhere, '', $begin, 5, "ORDER BY id_subject DESC");
      if ($data) {
         $records =  $data['records'];
         $totalRecords = $data['total_records'];
         $pagingHtml = $this->paging($totalRecords, $currentPage, 5, '/subject/subject_list',);
         $this->view(
            'subject/subject_list',
            [
               'subject' => $records, 'currentPage' => $currentPage, 'pagingHtml' => $pagingHtml,  'total' => $totalRecords
            ]
         );
      } else {
         $this->view(
            'subject/subject_list',
            [
               'subject' => [], 'currentPage' => 1, 'pagingHtml' => '', 'dataParam' => []
            ]
         );
      }
   }

   public function subject_create()
   {
      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
         $this->view('subject/subject_create', []);
      } else {
         $name_subject = $_POST['name_subject'];
         if (trim($name_subject) !== "" || $name_subject != null) {
            $rowcount = $this->SubjectModel->get_subject("COUNT(1) as rowcount", "WHERE name_subject='$name_subject'", "");
            if ($rowcount[0]['rowcount'] > 0) {
               $error['err_name_subject'] = "Your language is exsist";
            }
         } else {
            $error['err_name_subject'] = "enter your language";
         }
         if (isset($error)) {
            $this->view('/Subject/subject_create', ["input" => $name_subject, "error" => $error]);
         } else {
            $result = $this->SubjectModel->subject_save("", "", $name_subject);
            if (isset($result)) {
               header('location: /Subject/subject_list');
            } else {
               $this->view('/Subject/subject_create');
            }
         }
      }
   }

   public function subject_update($id_subject)
   {
      $method = '';
      if (isset($id_subject) && $_SERVER['REQUEST_METHOD'] === 'GET') {
         $subject = $this->SubjectModel->get_subject("*", "Where id_subject=$id_subject", "");
         $method = 'get';
         $this->view('/subject/subject_edit', ['subject' => $subject[0], 'method' => $method]);
      } else {
         $method = "post";
         $name_subject = $_POST['name_subject'];
         $arrInput = [
            'name_subject' => $_POST['name_subject'],
            'id_subject' => $id_subject
         ];
         if (trim($name_subject) !== "" || $name_subject != null) {
            $rowcount = $this->SubjectModel->get_subject("COUNT(1) as rowcount", "WHERE name_subject='$name_subject' AND id_subject !=$id_subject", "");
            if ($rowcount[0]['rowcount'] > 0) {
               $error['err_name_subject'] = "Your language is exsist";
            }
         } else {
            $error['err_name_subject'] = "enter your language";
         }
         if (isset($error)) {
            $this->view('/Subject/subject_edit', ["input" => $arrInput, "error" => $error]);
         } else {
            $result = $this->SubjectModel->subject_save("", "$id_subject", $name_subject);
            if (isset($result)) {
               header('location: /Subject/subject_list');
            } else {
               $this->view('/Subject/subject_edit');
            }
         }
      }
   }

   public function subject_delete($id_subject)
   {
      if(isset($id_subject))
      {
         $result=$this->SubjectModel->delete_subject($id_subject);
      }
   }
}
