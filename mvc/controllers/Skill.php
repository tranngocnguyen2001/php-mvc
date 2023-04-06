<?php

class Skill extends Controller
{
   private $SkillModel;
   private $SubjectModel;
   private $UserModel;
   public function __construct()
   {
      $this->CheckLogin();
      $this->SkillModel = $this->model("SkillModel");
      $this->SubjectModel = $this->model("SubjectModel");
      $this->UserModel = $this->model("UserModel");
      }

   public function get_skill()
   {
   }

   public function user_view($id_user)
   {

      if ($_SERVER['REQUEST_METHOD'] === "GET") {
         $skill = $this->SkillModel->get_skill('subject.id_subject, subject.name_subject, user_subject.experience_year, user_subject.last_use, user_subject.level ', "WHERE user.id_user=$id_user", ' LEFT JOIN user ON user_subject.id_user=user.id_user LEFT JOIN subject ON user_subject.id_subject=subject.id_subject ');
         if (empty($skill)) {
            $skill = [];
         }
         $subject = $this->SubjectModel->get_subject("id_subject, name_subject", "", "");
         $user = $this->UserModel->get_user("*", "WHERE id_user=$id_user", "");
         $this->view('user/user_view', ['user' => $user[0], "skill_list" => $skill, "subject" => $subject]);
      } else {
         $error = [];
         $level[] = "";
         $arrUserSkill = [];
         //var_dump($_POST);
         $arrSubject = isset($_POST['id_subject']) ? $_POST['id_subject'] : [];
         $arrYears = isset($_POST['experience_years']) ? $_POST['experience_years'] : [];
         $arrLastUsed = isset($_POST['last_used']) ? $_POST['last_used'] : [];

         if (count($arrSubject) == 0 || count($arrYears) == 0 || count($arrLastUsed) == 0) {
            $error['err_input'] = "Please input skill information!";
         } else {
            $countRow = count($arrSubject);
            for ($i = 0; $i < $countRow; $i++) {
               //$arrRadio=isset($_POST['level-radio-.'($i+1)]) ? $_POST['level-radio-.'($i+1)] : [];

               $arrUserSkill[$i]['id_user'] = $id_user;
               $arrUserSkill[$i]['id_subject'] = $arrSubject[$i];
               $arrUserSkill[$i]['experience_year'] = $arrYears[$i];
               $arrUserSkill[$i]['last_use'] = $arrLastUsed[$i];
               //$arrUserSkill[$i]['level'] =$arrRadio[$i];
               if(isset($_POST['level-radio-' . ($i + 1)])){
                  $arrUserSkill[$i]['level'] = $_POST['level-radio-' . ($i + 1)];
               }else{
                  $arrUserSkill[$i]['level'] = '';
               }
            }
         }

         for ($i = 0; $i < count($arrUserSkill); $i++) {
            if (!empty($arrUserSkill[$i]['id_subject'])) {
               //check trùng trong các selector
               for($j=$i+1; $j<count($arrUserSkill); $j++)
               {
                  if($arrUserSkill[$i]['id_subject']==$arrUserSkill[$j]['id_subject'])
                  {
                     $error[$i]['err_row_id_subject'] = "this subject is exsist in selector";
                  }
               }
               $id_subject = $arrUserSkill[$i]['id_subject'];
               $result = $this->SkillModel->get_skill("count(1) as rowcount", "WHERE id_user=$id_user AND id_subject=$id_subject", "");
               if ($result[0]['rowcount'] > 0) {
                  $error[$i]['err_row_id_subject'] = "this subject is exsist in database";
               }
            } else {
               $error[$i]['err_row_id_subject'] = "this input is empty";
            }

            //check tồn tại
            if (empty($arrUserSkill[$i]['experience_year'])) {
               $error[$i]['err_row_ex_year'] = "this input is empty";
            }
            if (empty($arrUserSkill[$i]['last_use'])) {
               $error[$i]['err_row_last_used'] = "this input is empty";
            }
            if (empty($arrUserSkill[$i]['level'])) {
               $error[$i]['err_row_level'] = "this input is empty";
            }
         }
         $skill = $this->SkillModel->get_skill('subject.id_subject, subject.name_subject, user_subject.experience_year, user_subject.last_use, user_subject.level ', "WHERE user.id_user=$id_user", ' LEFT JOIN user ON user_subject.id_user=user.id_user LEFT JOIN subject ON user_subject.id_subject=subject.id_subject ');
         if (empty($skill)) {
            $skill = [];
         }
         $subject = $this->SubjectModel->get_subject("id_subject, name_subject", "", ""); //cho vào cái selector
         $user = $this->UserModel->get_user("*", "WHERE id_user=$id_user", ""); //trả vào infor
         if (count($error) > 0) {
            $this->view('User/user_view', ['user' => $user[0], 'skill' => $arrUserSkill, 'subject' => $subject, 'err' => $error,  'skill_list' => $skill]);
         } else {
            $result = $this->SkillModel->skill_multi_save($arrUserSkill);
            if ($result) {
               $skill = $this->SkillModel->get_skill('subject.id_subject, subject.name_subject, user_subject.experience_year, user_subject.last_use, user_subject.level ', "WHERE user.id_user=$id_user", ' LEFT JOIN user ON user_subject.id_user=user.id_user LEFT JOIN subject ON user_subject.id_subject=subject.id_subject ');
               if (empty($skill)) {
                  $skill = [];
               }
               $subject = $this->SubjectModel->get_subject("id_subject, name_subject", "", "");
               $user = $this->UserModel->get_user("*", "WHERE id_user=$id_user", "");
               
               // $this->view('user/user_view', ['user' => $user[0], "skill_list" => $skill, "subject" => $subject]);
            }
         }
      }
   }
   public function delete_skill($id_user, $id_subject)
   {
      $result = $this->SkillModel->delete_user_subject($id_user, $id_subject);
      if ($result) {
         $skill = $this->SkillModel->get_skill('subject.id_subject, subject.name_subject, user_subject.experience_year, user_subject.last_use, user_subject.level ', "WHERE user.id_user=$id_user", ' LEFT JOIN user ON user_subject.id_user=user.id_user LEFT JOIN subject ON user_subject.id_subject=subject.id_subject ');
         if (empty($skill)) {
            $skill = [];
         }
         $subject = $this->SubjectModel->get_subject("id_subject, name_subject", "", "");
         $user = $this->UserModel->get_user("*", "WHERE id_user=$id_user", "");
         $this->view('user/user_view', ['user' => $user[0], "skill_list" => $skill, "subject" => $subject]);
      }
   }
}
