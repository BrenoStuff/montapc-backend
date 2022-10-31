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
        $result["success"]["id"] = $id;
        $result["success"]["name"] = $name;
        $result["success"]["description"] = $description;
        $result["success"]["socket"] = $socket;
        $result["success"]["typeMemory"] = $typeMemory;
        $result["success"]["pciExpress"] = $pciExpress;
        $result["success"]["price"] = $price;
        $result["success"]["image"] = $image;
        Output::response($result);
    }

    public function list(){
        Router::allowedMethod('GET');

        $motherboard = new Motherboard(null, null, null, null, null, null, null, null);
        $listMotherboards = $motherboard->list();

        $result["success"]["message"] = "Motherboards listed successfully";
        $result["success"]["data"] = $listMotherboards;
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
            $result["success"]["id"] = $id;
            $result["success"]["name"] = $name;
            $result["success"]["description"] = $description;
            $result["success"]["socket"] = $socket;
            $result["success"]["typeMemory"] = $typeMemory;
            $result["success"]["pciExpress"] = $pciExpress;
            $result["success"]["price"] = $price;
            $result["success"]["image"] = $image;
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
            $result["success"]["id"] = $id;
            Output::response($result);
        } else {
            $result["error"]["message"] = "Motherboard not found to be deleted";
            Output::response($result, 404);
        }
    }
}
?>