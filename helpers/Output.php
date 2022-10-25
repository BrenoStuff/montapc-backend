<?php
class Output{
    static function response($arrayResponse, $statusCode = 200) {
        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: " . ALLOWED_HOSTS);
        http_response_code($statusCode);
        echo json_encode($arrayResponse);
        die;
    }

    static function notFound(){
        $result['message'] = "API endpoint not found";
        self::response($result, 404);
    }
}
?>