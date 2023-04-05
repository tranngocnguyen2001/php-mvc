<?php
class App{
   protected $controller="Login";
   protected $action="get_view";
   protected $params=[];
   

   public function urlprocess()
   {
      
      if(isset($_GET['url']))
      {
         $url=rtrim($_GET['url'],'/');
         return explode('/', $url);
      }
   }
   public function __construct() {
      
      $url=$this->urlprocess(); 
      if(isset($url[0]))
      {
         if(file_exists('./mvc/controllers/'.$url[0].'.php'))
         {
            $this->controller=$url[0];
         }
         unset( $url[0]);
      }
      require './mvc/controllers/'.$this->controller.'.php';
      $this->controller = new $this->controller; 
      
      if(isset($url[1]))
      {
         if(method_exists($this->controller, $url[1]))
         {
            $this->action=$url[1];
         }
         unset($url[1]);
      }
      $this->params= $url? array_values($url) : [];
      call_user_func_array([$this->controller, $this->action], $this->params );
   }
}