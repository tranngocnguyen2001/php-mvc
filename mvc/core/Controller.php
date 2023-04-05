<?php
class Controller
{

   public function __construct() {
     
   }
   public function CheckLogin(){
      if (!isset($_SESSION['user'])) {
         header('location: /Login/login');
      }
   }
   public function model($model)
   {
      require './mvc/models/' . $model . '.php';
      return new $model;
   }

   public function view($view, $data = [], $arr = null)
   {
      require './mvc/views/' . $view . '.php';
   }
   public function paging($totalRecords = 0, $currentPage = 1, $limit = 5, $url = '', $params = '')
   {
      $totalPage = ceil($totalRecords / $limit);
      $pagingHtml = '';
      if ($totalPage > 0) {
         $pagingHtml .= '<nav aria-label="Page navigation example"><ul class="pagination">';
         for ($i = 1; $i <= $totalPage; $i++) // dùng vòng lặp for để hiển thị ra từng trang một   
         {
            $pageStyle = '';
            if ($i == $currentPage) {
               $pageStyle = "active";
            }
            $fullUrl = $url . "/$i/";
            if ($params != '') {
               $fullUrl .= $params;
            }
            $pagingHtml .= "<li class='page-item'><a class='page-link " . $pageStyle . "' href='" . $fullUrl . "'>$i</a></li>";
         }
         $pagingHtml .= '<ul/></nav>';
      }
      return $pagingHtml;
      
   }

   //mã hóa dữ liệu
   public function encrypt($data)
   {
      $key = key;
      $plaintext = $data;
      $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
      $iv = openssl_random_pseudo_bytes($ivlen);
      $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
      $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
      $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
      return $ciphertext;
   }
   //dịch mã dữ liệu

   public function decrypt($data)
   {
      $key = key;
      $c = base64_decode($data);
      $ivlen = openssl_cipher_iv_length($cipher = encryption_method);
      $iv = substr($c, 0, $ivlen);
      $hmac = substr($c, $ivlen, $sha2len = 32);
      $ciphertext_raw = substr($c, $ivlen + $sha2len);
      $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
      $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
      if (hash_equals($hmac, $calcmac)) {
         return $original_plaintext;
      }
   }
  
}
