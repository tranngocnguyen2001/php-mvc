<?php
$pagingHtml = isset($data['pagingHtml']) ? $data['pagingHtml'] : '';
$currentPage = isset($data['currentPage']) ? $data['currentPage'] : '';
$dataParam = isset($data['dataParam']) ? $data['dataParam'] : [];
$datatotal = isset($data['total']) ? $data['total'] : [];
?>
<div class="wrapper">
   <div class="container">
      <div class="mb-30">
         <div class="left-h2">
            <h2>Subject Managerment</h2>
         </div>
      </div>
      <div class="mb-10">
         <form method="post" action="/Subject/subject_list">
            <div class="search-form">
               <div class=" ml-20 inline-block">
                  <label class="bold">Input</label>
                  <input class="input-search" type="text" value="" name="input" placeholder="Input something into here..." autocomplete="off">
               </div>
               
               <div class="ml-20 inline-block">
                  <button class="btn-blue "> Search</button>
               </div>
            </div>
         </form>
      </div>
         <div class="mb-10">
            <a href="/Subject/subject_create" class="btn-green float-right">Create Subject</a>
            <div class="clear-fix"></div>
         </div>
      <div class="mb-10">
         <table class="table">
            <thead>
               <tr>
                  <th style="width: 10%;" >ID</th>
                  <th style="width: 70%;">Username</th>
                  <th ></th>
                  <th ></th>
               </tr>
            </thead>
            <tbody>
               <?php if (isset($data['subject'])) {
                  foreach ($data['subject'] as $subject) : extract($subject); ?>
                     <tr>
                        <td class="text-center"><?php echo  $id_subject; ?></td>
                        <td class="text-left"><?php echo  $name_subject; ?></td>
                        <td style="padding: 6px;" class="text-center">
                           <a class="btn-blue" href="/Subject/subject_update/<?= $id_subject ?>">Edit</a>
                        </td>
                        <td style="padding: 6px;" class="text-center">
                           <a class=" btn-red" onclick="if (confirm('Do you want delete selected item?')){return true;}else{return false};" href='/Subject/subject_delete/<?= $id_subject ?>'>Delete</a>
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
               Total Subject: <?php echo $datatotal ?>
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
         dateFormat: 'd/m/y'
      });
   });
</script>