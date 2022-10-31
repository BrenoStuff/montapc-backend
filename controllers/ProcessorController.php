<?php
class ProcessorController{
    public function create(){
        Router::allowedMethod('POST');

        $data = Input::getData();
        if(!isset($data['name']) ||
            !isset($data['description']) ||
            !isset($data['socket']) ||
            !isset($data['typeMemory']) ||
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

        $processor = new Processor(null, $name, $description, $socket, $typeMemory, $pciExpress, $price, $image);
        $id = $processor->create();

        $result["success"]["message"] = "Processor created successfully";
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

        $processor = new Processor(null, null, null, null, null, null, null, null);
        $listProcessors = $processor->list();

        $result["success"]["message"] = "Processors listed successfully";
        $result["success"]["data"] = $listProcessors;
        Output::response($result);
    }

    public function update(){
        Router::allowedMethod('PUT');

        $data = Input::getData();
        if(!isset($data['id']) ||
            !isset($data['name']) ||
            !isset($data['description']) ||
            !isset($data['socket']) ||
            !isset($data['typeMemory']) ||
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

        $processor = new Processor($id, $name, $description, $socket, $typeMemory, $pciExpress, $price, $image);
        $updated = $processor->update();

        if($updated){
            $result["success"]["message"] = "Processor updated successfully";
            $result["success"]["id"] = $id;
            $result["success"]["name"] = $name;
            $result["success"]["description"] = $description;
            $result["success"]["socket"] = $socket;
            $result["success"]["typeMemory"] = $typeMemory;
            $result["success"]["pciExpress"] = $pciExpress;
            $result["success"]["price"] = $price;
            $result["success"]["image"] = $image;
            Output::response($result);
        }else{
            $result["error"]["message"] = "Processor not found";
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

        $processor = new Processor($id, null, null, null, null, null, null, null);
        $deleted = $processor->delete();

        if($deleted){
            $result["success"]["message"] = "Processor deleted successfully";
            $result["success"]["id"] = $id;
            Output::response($result);
        }else{
            $result["error"]["message"] = "Processor not found to be deleted";
            Output::response($result, 404);
        }
    }
}
?>