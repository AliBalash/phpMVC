<?php


//    Core App Class
class Core{
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $param = [];

    public function __construct()
    {
        $url = $this->getUrl();
//          check the currentController in the folder controllers
        if (file_exists('../app/controllers/'.ucwords($url[0].'.php'))){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

//          check the exists Method and have currentMethod
        if (isset($url[1])){
            if (method_exists($this->currentController,$url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }else{
                header('location:'.URLROOT.'public');
            }

        }
//          Get parameters
        $this->param = $url ? array_values($url) : [];

//          Call and Callback Controller Method and parameters
        call_user_func_array([$this->currentController , $this->currentMethod],$this->param);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])){
//            get the url
            $url = $_GET['url'];
//            clean url
            $url = rtrim($url, '/');
//            Allows the url filter variable number/string
            $url = filter_var($url, FILTER_SANITIZE_URL);
//            breaking url to array
            $url = explode('/', $url);
            return $url;
        }
    }
}