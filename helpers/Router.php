<?php
class Router {
    static function gateKeeper(){
        self::handleCORS();

        $url = $_SERVER['REQUEST_URI']; // Get the url solicited
        $urlClean = str_replace(BASE_PATH,'',$url); // Clear the url solicited (remove the main path)
        $uppercaseUrl = array_map('ucfirst', explode('-', $urlClean)); // Divide the $urlClean by the Dash and put the first letter in uppercase (ex: get-together -> GetTogether)
        $getTogetherUrl = implode("", $uppercaseUrl); // Join the $uppercaseUrl by nothing in the middle
        $urlArray = explode('/', $getTogetherUrl); // Divide the $getTogetherUrl by the Slash
        print_r($urlArray); die;
    
        if (isset($urlArray[0]) && $urlArray[0] != '' && isset($urlArray[1]) && $urlArray[1] != '') {
            $controller = $urlArray[0] . 'Controller';
            $removeParams = explode('?', $urlArray[1]);
            $action = str_replace('-', '', $removeParams[0]);
    
            if(file_exists(CONTROLLERS_FOLDER . $controller . '.php')){
                $obj = new $controller();
                if(method_exists($obj, $action)){
                    $obj->$action();
                    die;
                }
            }
        }
    }

    static function allowedMethod($method){
        if($_SERVER['REQUEST_METHOD'] !== $method){
            $result['error']['message'] =  'Method ' . $_SERVER['REQUEST_METHOD'] . ' is not allowed';
            Output::response($result, 405);
        }
    }

    static function handleCORS(){
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Origin: " . ALLOWED_HOSTS);
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
            header("Access-Control-Allow-Headers: Access-Token");
            die;
        }
    }
}
?>