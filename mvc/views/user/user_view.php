<?php
$data_user = isset($data['user']) ? $data['user'] : [];
$data_skill_list = isset($data['skill_list']) ? $data['skill_list'] : [];
$data_skill = isset($data['skill']) ? $data['skill'] : [];
$error = isset($data['err']) ? $data['err'] : [];
$id_user = $data_user["id_user"];
$data_subject = isset($data['subject']) ? $data['subject'] : "";


$selection = "<select style='height: 25px' form='my_form' name='id_subject[]'>";
$selection .= "<option value='' disabled selected>Select Language</option>";
foreach ($data_subject as $subject) : extract($subject);
   $selection .= "<option value='" . $id_subject . "'>" . $name_subject . "</option>";
endforeach;
$selection .= "</select>";

function subject_selection($data_subject, $id_sub_input="")
{
$select="";
$selection = "<select style='height: 25px' form='my_form' name='id_subject[]'>";
$selection .= "<option value='' disabled selected>Select Language</option>";
foreach ($data_subject as $subject) : extract($subject);
if($id_subject==$id_sub_input)
{ 
   $select='selected';
} 
 else{
   $select='';
}
   $selection .= "<option value='" . $id_subject . "'".$select.">" . $name_subject . "</option>";
endforeach;
$selection .= "</select>";
return $selection;
}


?>
<div class="wrapper">
   <div class="container">
      <div class="div_img"><img class="img-big" width="500px" height="700px" src="/front_end/pictures/<?php echo $data_user['photo'] ?>"></div>
      <div class="mb-30">
         <h1 class="text-center">PERSONALITY INFORMATION</h1>
      </div>
      <div class="mb-30">
         <table style="border: 2px solid black;" class="infor-table">
            <tr>
               <td style="font-weight: bold;" colspan="2">INFORMATION</td>
               <td class="text-center" rowspan="7">
                  <div class=" img">
                     <img class="img" width="150px" height="200px" src="/front_end/pictures/<?php echo $data_user['photo'] ?>">
                  </div>
               </td>

            </tr>
            <tr>
               <input type="hidden" value="<?= $data_user['id_user'] ?>">
               <td style="width: 15%; " class="td-lable-infor"><label class="bold-view" for="">Username:</label></td>
               <td style="width: 85%; "><?= $data_user['username'] ?></td>
            </tr>
            <tr>
               <td style="width: 15%; "><label for="">Birth:</label></td>
               <td style="width: 85%; "><?php $newDate = date("d-m-Y", strtotime($data_user['birth']));
                                          echo $newDate ?></td>
            </tr>
            <tr>
               <td style="width: 15%; "><label for="">Sex:</label></td>
               <td style="width: 85%; "><?= $data_user['sex'] ?></td>
            </tr>
            <tr>
               <td style="width: 15%; "><label for="">Email:</label></td>
               <td style="width: 85%; "><?= $data_user['email'] ?></td>
            </tr>
            <tr>
               <td style="width: 15%; "><label for="">Phone:</label></td>
               <td style="width: 85%; "><?= $data_user['phone'] ?></td>
            </tr>
            <tr>
               <td style="width: 15%; "><label for="">Job:</label></td>
               <td style="width: 85%; "><?= $data_user['job'] ?></td>
            </tr>
         </table>
      </div>
      <div class="mb-30">
         <table style="border: 2px solid black;" class="infor-table">
            <tr>
               <td style="font-weight: bold;" colspan="2">CERFITICATE AND EXPERIENCE</td>
            </tr>
            <tr>
               <td style="width: 15%; ">Cerfiticate</td>
               <td><?= $data_user['school'] ?></td>
            </tr>
            <tr>
               <td style="width: 15%; ">Work-Experience</td>
               <td>
                  <p rows="4" style="border: none; width: 100% "><?= $data_user['experience'] ?></p>
               </td>
            </tr>
         </table>
      </div>
      <div class="mb-30">
         <button id="add-btn" style="margin-left: 93%;" class="btn-green">Add row</button>
      </div>
      <div class="mb-10">
         <form method="POST" action="/Skill/user_view/<?php echo $data_user['id_user'] ?>" id="my_form"></form>
         <input type="hidden" name="id_user" value="<?= $data_user['id_user'] ?>" />
         <table style="border: 2px solid black;" class="infor-table">
            <thead>
               <tr>
                  <td style="font-weight: bold;" colspan="11">PERSONALITY SKILL</td>
               </tr>
               <tr>
                  <td rowspan="2"></td>
                  <td style="width: 15%;" class="text-center" rowspan="2">Languages</td>
                  <td style="width: 15%;" class="text-center" rowspan="2">Experience_years</td>
                  <td style="width: 15%;" class="text-center" rowspan="2">Last used</td>
                  <td class="text-center" colspan="5">Level</td>
                  <td class="text-center" rowspan="2" colspan="2">Action</td>
               </tr>
               <tr>
                  <td class="text-center">1</td>
                  <td class="text-center">2</td>
                  <td class="text-center">3</td>
                  <td class="text-center">4</td>
                  <td class="text-center">5</td>
               </tr>
            </thead>
            <tbody id="tbody-skill">
            <?php foreach($data_skill_list as $skill ) {
                  
                  $ai1 = "";
                  $ai2 = "";
                  $ai3 = "";
                  $ai4 = "";
                  $ai5 = "";
                  switch ($level = $skill['level']) {
                     case 1:
                        $ai1 = "<span style=' font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     case 2:
                        $ai2 = "<span style='font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     case 3:
                        $ai3 = "<span style='font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     case 4:
                        $ai4 = "<span style='font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     case 5:
                        $ai5 = "<span style='font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     default:
                        $ai1 = "";
                  }
                  ?>
                  <tr class="tr-row-index">
                     <td class="row-index text-center">
                        <p></p>
                     </td>
                     <td  style="width: 15%;" class="text-center"><?= isset($skill['name_subject']) ? $skill['name_subject'] : [] ?></td>
                     <td  style="width: 15%;" class="text-center"><?= isset($skill['experience_year']) ? $skill['experience_year'] : [] ?></td>
                     <td  style="width: 15%;" class="text-center"><?= isset($skill['last_use']) ? $skill['last_use'] : []?></td>
                     <td  style="width: 5%;" class="text-center"><?=$ai1?></td>
                     <td  style="width: 5%;" class="text-center"><?=$ai2?></td>
                     <td  style="width: 5%;" class="text-center"><?=$ai3?></td>
                     <td  style="width: 5%;" class="text-center"><?=$ai4?></td>
                     <td  style="width: 5%;" class="text-center"><?=$ai5?></td>
                     <td  colspan="2" style="padding: 10px ;" class="text-center"><a onclick="if (confirm('Do you want delete selected item?')){return true;}else{return false};" href="/Skill/delete_skill/<?=$id_user?>/<?=$skill['id_subject']?>" type="submit" style="display: inline-block; width: 52px;" class="btn-red">Delete</a></td>
                  </tr>
                  <?php }?>
                  <?php for($i=0;$i<sizeof($data_skill);$i++) {
                  $ai1 = "";
                  $ai2 = "";
                  $ai3 = "";
                  $ai4 = "";
                  $ai5 = "";
                  switch ($level = $data['skill'][$i]['level']) {
                     case 1:
                        $ai1 = "<span style=' font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     case 2:
                        $ai2 = "<span style='font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     case 3:
                        $ai3 = "<span style='font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     case 4:
                        $ai4 = "<span style='font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     case 5:
                        $ai5 = "<span style='font-family: wingdings; font-size: 100%;'>&#252;</span>";
                        break;
                     default:
                        $ai1 = "";
                  }
                  ?>
                  <tr class="tr-row-index" classremove="<?="data-input-". $i?>">
                     <td rowspan="2" class="row-index text-center">
                        <p></p>
                     </td>
                     <td rowspan="1" style="width: 15%;" class="text-center"><?=subject_selection($data_subject, $data['skill'][$i]['id_subject'])?> </td>
                     <td rowspan="1" style="width: 15%;" class="text-center"><input name="experience_years[]" type="number" form="my_form" value="<?= isset($data['skill'][$i]['experience_year']) ? $data['skill'][$i]['experience_year'] : [] ?>" autocomplete="off"/></td>
                     <td rowspan="1" style="width: 15%;" class="text-center"><input name="last_used[]" type="number" form="my_form" value="<?= isset($data['skill'][$i]['last_use']) ? $data['skill'][$i]['last_use'] : []?>" autocomplete="off"/></td>
                     <td  style="width: 5%; display: none" class="text-center"><input name="level-radio-<?=$i+1?>" type="radio" value="" form="my_form" checked/></td>
                     <td  style="width: 5%;" class="text-center"><input name="level-radio-<?=$i+1?>" type="radio" value="1" form="my_form" <?php if(isset($data['skill'][$i]['level']) && $data['skill'][$i]['level']==1){ echo"checked";} else{ echo "";} ?>/></td>
                     <td  style="width: 5%;" class="text-center"><input name="level-radio-<?=$i+1?>" type="radio" value="2" form="my_form" <?php if(isset($data['skill'][$i]['level']) && $data['skill'][$i]['level']==2){ echo"checked";} else{ echo "";} ?>/></td>
                     <td  style="width: 5%;" class="text-center"><input name="level-radio-<?=$i+1?>" type="radio" value="3" form="my_form" <?php if(isset($data['skill'][$i]['level']) && $data['skill'][$i]['level']==3){ echo"checked";} else{ echo "";} ?>/></td>
                     <td  style="width: 5%;" class="text-center"><input name="level-radio-<?=$i+1?>" type="radio" value="4" form="my_form" <?php if(isset($data['skill'][$i]['level']) && $data['skill'][$i]['level']==4){ echo"checked";} else{ echo "";} ?>/></td>
                     <td  style="width: 5%;" class="text-center"><input name="level-radio-<?=$i+1?>" type="radio" value="5" form="my_form" <?php if(isset($data['skill'][$i]['level']) && $data['skill'][$i]['level']==5){ echo"checked";} else{ echo "";} ?>/></td>
                     <td rowspan="2" colspan="2" class="text-center">
                        <a class="btn-red remove" style="padding: 9px 11px;" href="#" type="button">Remove</button>
                     </td>
                  </tr>
                  <tr classremove="<?="data-input-". $i?>">
                     <td class="text-center"><span style="color:red"><?php echo isset($data['err'][$i]['err_row_id_subject']) ? $data['err'][$i]['err_row_id_subject'] : ""; ?></span></td>
                     <td class="text-center"><span style="color:red"><?php echo isset($data['err'][$i]['err_row_ex_year']) ? $data['err'][$i]['err_row_ex_year'] : ""; ?></span></td>
                     <td class="text-center"><span style="color:red"><?php echo isset($data['err'][$i]['err_row_last_used']) ? $data['err'][$i]['err_row_last_used'] : ""; ?></span></td>
                     <td class="text-center"  colspan="5"> <span style="color:red"><?php echo isset($data['err'][$i]['err_row_level']) ? $data['err'][$i]['err_row_level'] : ""; ?></span></td>
                  </tr>
               <?php  }?>
            </tbody>
         </table>
         <input type="hidden" value="<?php echo $id_user ?>" name="id_user">
      </div>
      <div style="display:inline" class="mb-10">
         <a type="button" href="/User/user_list"><button style="width: 73px; float:right" class="btn-blue">Back</button></a>
         <button form="my_form" style="width: 73px ;float:right; margin-right: 10px; " class="btn-green" type="submit">Save</button>
      </div>

      <div class="clear-fix"></div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
</script>
<script>
   $(document).ready(function() {

      // Denotes total number of rows
      var rowIdx = 0;

      // jQuery button click event to add a row
      $('#add-btn').on('click', function() {
         // Adding a row inside the tbody.
         $('#tbody-skill').append(`
         <tr ${++rowIdx} class="tr-row-index"  classremove="data-input-${rowIdx}">
                     <td class="row-index text-center">
                        <p>Row ${rowIdx}</p>
                     </td>
                     <td>
                        <?= $selection ?>
                     </td>
                     <td class="text-center">
                        <input name="experience_years[]" type="number" value="" form="my_form" autocomplete="off"/>
                     </td>
                     <td class="text-center">
                        <input name="last_used[]" type="number" value="" form="my_form" autocomplete="off"/>
                     </td>
                     <td class="text-center">
                        <input name="level-radio-${rowIdx}" type="radio" value="1" form="my_form"/>
                     </td>
                     <td class="text-center">
                        <input name="level-radio-${rowIdx}" type="radio" value="2" form="my_form"/>
                     </td>
                     <td class="text-center">
                        <input name="level-radio-${rowIdx}" type="radio" value="3" form="my_form"/>
                     </td>
                     <td class="text-center">
                        <input name="level-radio-${rowIdx}" type="radio" value="4" form="my_form"/>
                     </td>
                     <td class="text-center">
                        <input name="level-radio-${rowIdx}" type="radio" value="5" form="my_form"/>
                     </td>
                     <td colspan="2" class="text-center">
                        <button class="btn-red remove" type="button style="padding: 9px 11px;">Remove</button>
                     </td>
                  </tr>
               `);
               SetRowNumber()
      });

      // jQuery button click event to remove a row.
      $('#tbody-skill').on('click', '.remove', function(e) {
         e.preventDefault();//ngăn tình trạng cuộn trang lên đầu
         // // Getting all the rows next to the row
         // // containing the clicked button
         // var child = $(this).closest('tr').nextAll();

         // // Iterating across all the rows 
         // // obtained to change the index
         // child.each(function() {
         //    // Getting <tr> id.
         //    var id = $(this).attr('id');

         //    // Getting the <p> inside the .row-index class.
         //    var idx = $(this).children('.row-index').children('p');

         //    // Gets the row number from <tr> id.
         //    var dig = parseInt(id.substring(1));

         //    // Modifying row index.
         //    idx.html(`Row ${dig - 1}`);

         //    // Modifying row id.
         //    $(this).attr('id', `R${dig - 1}`);
         // });

         // Removing the current row.
         // tìm đến class cha, sau đó lấy giá trị của attr classremove 
         var classRemove = $(this).closest('tr').attr('classremove');
         $('#tbody-skill tr').each(function(){//đảm bảo chỉ duyệt các tr trong table #tbody-skill, không duyệt sang các table khác
            //tìm tất cả các tr có attr = classremove lấy được bên trên và xóa di
            if($(this).attr('classremove') == classRemove){
               $(this).remove();
            }
         })
         SetRowNumber();
         // Decreasing total number of rows by 1.
         // rowIdx--;
      });
      SetRowNumber();
   });
   function SetRowNumber(){
      $('#tbody-skill  > tr.tr-row-index').each(function(index, tr) { 
         var idx = $(this).children('.row-index').children('p');
         idx.html(`Row ${index+1}`);
      });
   }
</script>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function() {
      $('.img').click(function() {
         $('.div_img').show();
      });
      $('.img-big').click(function() {
         $('.div_img').hide();
      })
   })
</script>