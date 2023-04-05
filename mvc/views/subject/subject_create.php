<?php
$dataInput = isset($data['input']) ? $data['input'] : [];
$dataError = isset($data['error']) ? $data['error'] : [];
?>
<div class="wrapper">
   <div class="container">
      <div class="mb-30">
         <div class="left-h2">
            <h2>Subject Managerment</h2>
         </div>
      </div>
      <div class="form">
         <form class="" action="/Subject/subject_create" method="POST" enctype="multipart/form-data">
            <div class="div-center">
               <div class="div-label"><label for="title" class="bold">Name Subject<span class="red-span">*</span></label></div>
               <input class="input-center" name="name_subject" type="text" id="name_subject" value="<?php echo isset($dataInput['name_subject']) ? $dataInput['name_subject'] : ''; ?>" autocomplete="off">
            </div>
            <div class="span-div"><span style="color:red"><?php echo isset($dataError['err_name_subject']) ? $dataError['err_name_subject'] : ''; ?></span></div>
            <div class=" text-center">
               <a style="text-decoration: auto;" href="/Subject/subject_list" title="">
                  <button class="btn-blue" type="button">Back</button>
               </a>
               <button class="btn-green" type="submit">Save</button>
            </div>
      </form>
      </div>
   </div>
</div>


     