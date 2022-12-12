<?php
class MotherboardController{
    public function create(){
        Router::allowedMethod('POST');

        $data = Input::getData();
        if(!isset($data['name']) ||
            !isset($data['description']) ||
            !isset($data['socket']) ||
            !isset($data['typeMemory'])||
            !isset($data['pciExpress']) ||
            !isset($data['price']) ||
            !isset($data['image'])){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $name = $data['name'];
        $description = $data['description'];
        $socket = $data['socket'];
        $typeMemory = $data['typeMemory'];
        $pciExpress = $data['pciExpress'];
        $price = $data['price'];
        $image = $data['image'];

        $motherboard = new Motherboard(null, $name, $description, $socket, $typeMemory, $pciExpress, $price, $image);
        $id = $motherboard->create();
        
        $result["success"]["message"] = "Motherboard created successfully";
        $result["motherboard"]["id"] = $id;
        $result["motherboard"]["name"] = $name;
        $result["motherboard"]["description"] = $description;
        $result["motherboard"]["socket"] = $socket;
        $result["motherboard"]["typeMemory"] = $typeMemory;
        $result["motherboard"]["pciExpress"] = $pciExpress;
        $result["motherboard"]["price"] = $price;
        $result["motherboard"]["image"] = $image;
        Output::response($result);
    }

    public function list(){
        Router::allowedMethod('GET');

        $motherboard = new Motherboard(null, null, null, null, null, null, null, null);
        $listMotherboards = $motherboard->list();

        $result["success"]["message"] = "Motherboards listed successfully";
        $result["motherboard"] = $listMotherboards;
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

        $motherboard = new Motherboard($id, null, null, null, null, null, null, null);
        $selectedMotherboard = $motherboard->listById();

        $result["success"]["message"] = "Motherboard listed successfully";
        $result["motherboard"] = $selectedMotherboard;
        Output::response($result);
    }

    public function listByProcessor(){
        Router::allowedMethod('POST');

        $data = Input::getData();
        if(!isset($data['socket']) ||
            !isset($data['pciExpress'])){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $socket = $data['socket'];
        $pciExpress = $data['pciExpress'];

        $motherboard = new Motherboard(null, null, null, $socket, null, $pciExpress, null, null);
        $listMotherboards = $motherboard->listByProcessor();

        $result["success"]["message"] = "Motherboards listed successfully";
        $result["motherboard"] = $listMotherboards;
        Output::response($result);
    }

    public function update(){
        Router::allowedMethod('PUT');

        $data = Input::getData();
        if(!isset($data['id']) ||
            !isset($data['name']) ||
            !isset($data['description']) ||
            !isset($data['socket']) ||
            !isset($data['typeMemory'])||
            !isset($data['pciExpress']) ||
            !isset($data['price']) ||
            !isset($data['image'])){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $socket = $data['socket'];
        $typeMemory = $data['typeMemory'];
        $pciExpress = $data['pciExpress'];
        $price = $data['price'];
        $image = $data['image'];

        $motherboard = new Motherboard($id, $name, $description, $socket, $typeMemory, $pciExpress, $price, $image);
        $updated = $motherboard->update();

        if($updated){
            $result["success"]["message"] = "Motherboard updated successfully";
            $result["motherboard"]["id"] = $id;
            $result["motherboard"]["name"] = $name;
            $result["motherboard"]["description"] = $description;
            $result["motherboard"]["socket"] = $socket;
            $result["motherboard"]["typeMemory"] = $typeMemory;
            $result["motherboard"]["pciExpress"] = $pciExpress;
            $result["motherboard"]["price"] = $price;
            $result["motherboard"]["image"] = $image;
            Output::response($result);
        } else {
            $result["error"]["message"] = "Motherboard not found to be updated";
            Output::response($result, 404);
        }
    }

    public function delete(){
        Router::allowedMethod('DELETE');

        $data = Input::getData();
        if(!isset($data['id'])){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $id = $data['id'];

        $motherboard = new Motherboard($id, null, null, null, null, null, null, null);
        $deleted = $motherboard->delete();

        if($deleted){
            $result["success"]["message"] = "Motherboard deleted successfully";
            $result["motherboard"]["id"] = $id;
            Output::response($result);
        } else {
            $result["error"]["message"] = "Motherboard not found to be deleted";
            Output::response($result, 404);
        }
    }
}
?>