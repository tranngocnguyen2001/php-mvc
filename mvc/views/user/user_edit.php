<?php
$method=isset($data['method']) ? $data['method'] : [];
$data_user= isset($data['user']) ? $data['user'] : [];
if(isset($data_user['birth'])){
   $newDate = date("d-m-Y", strtotime($data_user['birth'])) ;
}
$dataError = isset($data['dataError']) ? $data['dataError'] : [];


?>
<div class="wrapper">
   <div class="container">
      <div class="mb-30">
         <div class="left-h2">
            <h2>User Managerment</h2>
         </div>
      </div>
      <div class="form">
         <form class="" action="/User/user_update/<?php echo $data_user['id_user']?>" method="POST" enctype="multipart/form-data">
            <div class="div-center">
               <div class="div-label"><label for="title" class="bold">Username<span class="red-span">*</span></label></div>
               <input class="input-center" name="username" type="text" id="username" value="<?php echo isset($data_user['username']) ? $data_user['username'] : ''; ?>" autocomplete="off">
            </div>
            <div class="span-div"><span style="color:red"><?php echo isset($dataError['err_username']) ? $dataError['err_username'] : ''; ?></span></div>

            <div class="div-center">
            <div class="div-label"><label for="title" class="bold">Password<span class="red-span">*</span></label></div>
               <input class="input-center" name="password" type="text" id="password" value="<?php echo isset($data_user['password']) ? $data_user['password'] : ''; ?>" autocomplete="off">
            </div>
            <div class="span-div"><span style="color:red"><?php echo isset($dataError['err_password']) ? $dataError['err_password'] : ''; ?></span></div>
            
            <div class="div-center">
            <div class="div-label"><label for="title" class="bold">Sex<span class="red-span">*</span></label></div>
            <div style="border: none" class="input-center">
            <input checked name="sex_input" class="" type="radio" value="male" <?php if (isset($data_user['sex']) &&  $data_user['sex'] == "male") {
                                                                                    echo "checked";
                                                                                 } else {
                                                                                    echo "";
                                                                                 } ?>><span class="mr10">Male</span>
               <input name="sex_input" class="" type="radio" value="female" <?php if (isset($data_user['sex']) &&  $data_user['sex'] == "female") {
                                                                                       echo "checked";
                                                                                    } else {
                                                                                       echo "";
                                                                                    } ?>><span class="mr10">Female</span>
               <span style="color:red"><?php echo isset($dataError['err_sex']) ? $dataError['err_sex'] : ''; ?></span>
            </div>   
            </div>

            <div class="div-center">
            <div class="div-label"><label for="title" class="bold">Birth<span class="red-span">*</span></label></div>
               <input class="input-center" name="birth" type="text" id="birth" value="<?php echo isset($newDate) ? $newDate : ''; ?>" autocomplete="off">
            </div>
            <div class="span-div"><span id="err_birth" style="color:red"><?php echo isset($dataError['err_birth']) ? $dataError['err_birth'] : ''; ?></span></div>

            <div class="div-center">
            <div class="div-label"><label for="title" class="bold">Email<span class="red-span">*</span></label></div>
               <input class="input-center" name="email" type="text" id="email" value="<?php echo isset($data_user['email']) ? $data_user['email'] : ''; ?>" autocomplete="off">
            </div>
            <div class="span-div"><span id="err_email" style="color:red"><?php echo isset($dataError['err_email']) ? $dataError['err_email'] : ''; ?></span></div>
            
            <div class="div-center">
            <div class="div-label"><label for="title" class="bold">Phone<span class="red-span">*</span></label></div>
               <input class="input-center" name="phone" type="text" id="phone" value="<?php echo isset($data_user['phone']) ? $data_user['phone'] : ''; ?>" autocomplete="off">
            </div>
            <div class="span-div"><span id="err_phone" style="color:red"><?php echo isset($dataError['err_phone']) ? $dataError['err_phone'] : ''; ?></span></div>

            <div class="div-center">
            <div class="div-label"><label for="title" class="bold">Job<span class="red-span">*</span></label></div>
               <input class=" input-center" name="job" type="text" id="job" value="<?php echo isset($data_user['job']) ? $data_user['job'] : ''; ?>" autocomplete="off">
            </div>
            <div class="span-div"><span style="color:red"><?php echo isset($dataError['err_job']) ? $dataError['err_job'] : ''; ?></span></div>

            <div class="div-center">
            <div class="div-label"><label for="title" class="bold">School</label></div>
               <input class="input-center" name="school" type="text" id="school" value="<?php echo isset($data_user['school']) ? $data_user['school'] : ''; ?>" autocomplete="off">
            </div>
            <div class="div-center">
            <div class="div-label"><label for="title" class="bold">Experience</label></div>
               <textarea class="input-center" name="experience" id="experience" rows="4" autocomplete="off"><?php echo isset($data_user['experience']) ? $data_user['experience'] : ''; ?></textarea>
            </div>
            <div class="div-center">
            <div class="div-label"><label for="title" class="bold">Photo</label></div>
               <input style="border: none; padding-left: 0px;" class="input-center" accept="image/*" class="" name="photo" type="file" id="photo" value="">
               <span style="color:red;"><?php echo isset($dataError['err_photo']) ? $dataError['err_photo'] : ''; ?></span>
            </div>
            <div class=" text-center">
               <a style="text-decoration: auto;" href="/User/user_list" title="">
                  <button class="btn-blue" type="button">Back</button>
               </a>
               <button class="btn-green" type="submit" onclick="return check()">Save</button>
            </div>
      </form>
      <img style="width: 150px; height:200px; margin-left: 24%" id="blah" src="/front_end/pictures/<?php echo isset($data_user['photo']) ? $data_user['photo'] : ''; ?>" alt="your image" />
      </div>
   </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
   function readURL(input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();

         reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
         }

         reader.readAsDataURL(input.files[0]);
      }
   }

   $("#photo").change(function() {
      readURL(this);
   });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
   $(document).ready(function() {
      $("#birth").datepicker({
         dateFormat: 'dd-mm-yy'
      });
   });
</script>
<script>
function check() { 
   var email = document.getElementById('email'); 
    var filter_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
    if (!filter_email.test(email.value)) { 
             $('#err_email').text('your type of email is wrong');
             email.focus; 
             return false; 
    }
    var birth = document.getElementById('birth'); 
    var filter_birth = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/; 
    if (!filter_birth.test(birth.value)) { 
             $('#err_birth').text('your type of birth is wrong');
             birth.focus; 
             return false; 
    }
    var phone = document.getElementById('phone'); 
    var filter_phone = /^\d{4}\-\d{3}\-\d{3}$/; 
    if (!filter_phone.test(phone.value)) { 
             $('#err_phone').text('your type of phone must be xxxx-xxx-xxx');
             phone.focus; 
             return false; 
    }
} 
</script>

