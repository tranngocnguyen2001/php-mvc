<?php
$pagingHtml = isset($data['pagingHtml']) ? $data['pagingHtml'] : '';
$currentPage = isset($data['currentPage']) ? $data['currentPage'] : '';
$dataParam = isset($data['dataParam']) ? $data['dataParam'] : [];
$datatotal = isset($data['total']) ? $data['total'] : [];
$search_input= isset($data['search_input']) ? $data['search_input'] : [];
?>
<input type="hidden" id="currentPage" value="<?=$currentPage ?>"/>
<div class="wrapper">
   <div class="container">
      <div class="mb-30">
         <div class="left-h2">
            <h2>User Managerment</h2>
         </div>
      </div>
      <div class="mb-10">
         <form method="get" action="/User/user_list" id="formSearch">
            <div class="search-form">
               <div class=" ml-20 inline-block">
                  <label class="bold">Input</label>
                  <input id="input" class="input-search" type="text" value="<?= isset($search_input['input'])  ? $search_input['input'] : ""  ?>" name="input" placeholder="Input something into here..." autocomplete="off">
               </div>
               <div class=" ml-20 inline-block">
                  <label class="bold">Birth</label>
                  <input id="birth" class="input-search" id="birth" type="text" value="<?= isset($search_input['birth'])  ? str_replace('-','/',$search_input['birth']) : ""  ?>" name="birth" autocomplete="off">
               </div>
               <div class="ml-20 inline-block">
                  <label class="bold">Sex</label>
                  <input name="sex_input" class="" type="radio" value="" checked ><span>All</span>
                  <div class="ml-10 inline-block">
                     <input name="sex_input" class="" type="radio" value="male" <?= isset($search_input['sex'])&&$search_input['sex']=='male'  ? 'checked' : ""  ?> > <span>Male</span>
                  </div>
                  <div class="ml-10 inline-block">
                     <input  name="sex_input" class="" type="radio" value="female" <?= isset($search_input['sex'])&&$search_input['sex']=='female'  ? 'checked' : "female"  ?>><span>Female</span>
                  </div>
               </div>
               <div class="ml-20 inline-block">
                  <button class="btn-blue "> Search</button>
               </div>
            </div>
         </form>
      </div>
         <div class="mb-10">
            <a href="/User/user_create" class="btn-green float-right">Create user</a>
            <div class="clear-fix"></div>
         </div>
      <div class="mb-10">
         <table class="table">
            <thead>
               <tr>
                  <th style="width: 4%;"></th>
                  <th style="width: 4%;" >ID</th>
                  <th style="width: 15%;" >Username</th>
                  <th style="width: 12%;" >Birth</th>
                  <th style="width: 5%;" >Sex</th>
                  <th style="width: 15%;" >Email</th>
                  <th style="width: 15%px;" >Phone</th>
                  <th style="width: 12%px;" >Job</th>

                  <th style="width: 4%;" ></th>
                  <th style="width: 4%;" ></th>
                  <th style="width: 4%;" ></th>
               </tr>
            </thead>
            <tbody>
               <?php if (isset($data['user'])) {
                  foreach ($data['user'] as $user) : extract($user); ?>
                     <tr>
                        <td class="text-center"><img width="50px" src="/front_end/pictures/<?php echo $photo; ?>"> </td>
                        <td class="text-center"><?php echo  $id_user; ?></td>
                        <td class="text-left"><?php echo  $username; ?></td>
                        <td class="text-right"><?php $newDate = date("d-m-Y", strtotime($birth)); echo $newDate ?></td>
                        <td class="text-left"><?php echo  $sex; ?></td>
                        <td class="text-left"><?php echo  $email; ?></td>
                        <td class="text-center"><?php echo $phone ?></td>
                        <td class="text-left"><?php echo  $job; ?></td>

                        <td class="text-center">
                           <a class="btn-blue" href="/Skill/user_view/<?=$id_user?>">View</a>
                        </td>
                        <td class="text-center">
                           <a class="btn-blue" href="/User/user_update/<?= $id_user ?>">Edit</a>
                        </td>
                        <td class="text-center">
                           <a class=" btn-red" onclick="if (confirm('Do you want delete selected item?')){return true;}else{return false};" href='/User/delete_user/<?= $id_user ?>'>Delete</a>
                           </form>
                        </td>
                     </tr>
                  <?php endforeach;
               } else { ?>
                  <tr class="tr">
                     <td colspan="9">Không có dữ liệu tìm kiếm</td>
                  </tr>
               <?php } ?>

            </tbody>
            <tfoot>
            </tfoot>
         </table>
      </div>
      <div class="mb-10 inline">
         <div style="float: left" class="mb-10">
            <span class="toltal-items">
               Total User: <?php echo $datatotal ?>
            </span>
         </div>
         <div style="float: right" class="mb-10">
            <div class="pagination text-right">
               <?php
               echo $pagingHtml;
               ?>
            </div>
         </div>
      </div>
   </div>
   <div class="clear-fix"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
   $(document).ready(function() {
      $("#birth").datepicker({
         dateFormat: 'd/m/yy'
      });
   });
   </script>
<script>

   $("#formSearch").submit(function(event) {
      event.preventDefault();
      var frmAction = this.action;
      currentPage = $('#currentPage').val();
      input = $('#input').val();
      birth = $('#birth').val().replaceAll('/','-');
      sex = $("#formsearch input[name='sex_input']:checked").val();
      var url = frmAction + '/' + currentPage + '/input=' + input + '/birth=' + birth.replaceAll('/','-') + '/sex=' + sex;
      location.href = url;
   });
</script>