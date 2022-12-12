<?php
class ComputerController{
    public function create(){
        Router::allowedMethod('POST');

        $data = Input::getData();
        if(!isset($data['processor']) ||
            !isset($data['motherboard']) ||
            !isset($data['graphicsCard']) ){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $processor = $data['processor'];
        $motherboard = $data['motherboard'];
        $graphicsCard = $data['graphicsCard'];

        $computer = new Computer(null, $processor, $motherboard, $graphicsCard);
        $id = $computer->create();

        $result["success"]["message"] = "Computer created successfully";
        $result["computer"]["id"] = $id;
        $result["computer"]["processor"] = $processor;
        $result["computer"]["motherboard"] = $motherboard;
        $result["computer"]["graphicsCard"] = $graphicsCard;
        Output::response($result);
    }

    public function list(){
        Router::allowedMethod('GET');

        $computer = new Computer(null, null, null, null);
        $listComputers = $computer->list();

        $result["success"]["message"] = "Computers listed successfully";
        $result["computer"] = $listComputers;
        Output::response($result);
    }

    public function listById(){
        Router::allowedMethod('GET');

        if(isset($_GET['id'])){
            $id = $_GET['id'];
        } else {
            $result['error']['message'] = "Bad Request";
            Output::response($result, 400);
        }

        $computer = new Computer($id, null, null, null);
        $selectedComputer = $computer->listById();

        $result["success"]["message"] = "Computers listed successfully";
        $result["computer"] = $selectedComputer;
        Output::response($result);
    }

    public function delete(){
        Router::allowedMethod('DELETE');

        $data = Input::getData();
        if(!isset($data['id'])){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $id = $data['id'];

        $computer = new Computer($id, null, null, null);
        $computer->delete();

        $result["success"]["message"] = "Computer deleted successfully";
        Output::response($result);
    }
}
?>