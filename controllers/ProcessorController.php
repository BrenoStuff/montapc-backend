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
        $result["processor"]["id"] = $id;
        $result["processor"]["name"] = $name;
        $result["processor"]["description"] = $description;
        $result["processor"]["socket"] = $socket;
        $result["processor"]["typeMemory"] = $typeMemory;
        $result["processor"]["pciExpress"] = $pciExpress;
        $result["processor"]["price"] = $price;
        $result["processor"]["image"] = $image;
        Output::response($result);
    }

    public function list(){
        Router::allowedMethod('GET');

        $processor = new Processor(null, null, null, null, null, null, null, null);
        $listProcessors = $processor->list();

        $result["success"]["message"] = "Processors listed successfully";
        $result["processor"] = $listProcessors;
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

        $processor = new Processor($id, null, null, null, null, null, null, null);
        $selectedProcessor = $processor->listById();

        $result["success"]["message"] = "Processors listed successfully";
        $result["processor"] = $selectedProcessor;
        Output::response($result);
    }

    public function listByMotherboard(){
        Router::allowedMethod('GET');

        $data = Input::getData();
        if(!isset($data['socket'])){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $socket = $data['socket'];

        $processor = new Processor(null, null, null, $socket, null, null, null, null);
        $listProcessors = $processor->listByMotherboard();

        $result["success"]["message"] = "Processors listed successfully";
        $result["processor"] = $listProcessors;
        Output::response($result);
    }

    public function listByGraphicscard(){
        Router::allowedMethod('GET');

        $data = Input::getData();
        if(!isset($data['pciExpress'])){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $pciExpress = $data['pciExpress'];

        $processor = new Processor(null, null, null, null, null, $pciExpress, null, null);
        $listProcessors = $processor->listByGraphicscard();

        $result["success"]["message"] = "Processors listed successfully";
        $result["processor"] = $listProcessors;
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
            $result["processor"]["id"] = $id;
            $result["processor"]["name"] = $name;
            $result["processor"]["description"] = $description;
            $result["processor"]["socket"] = $socket;
            $result["processor"]["typeMemory"] = $typeMemory;
            $result["processor"]["pciExpress"] = $pciExpress;
            $result["processor"]["price"] = $price;
            $result["processor"]["image"] = $image;
            Output::response($result);
        }else{
            $result["error"]["message"] = "Processor not found to be updated";
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
            $result["processor"]["id"] = $id;
            Output::response($result);
        }else{
            $result["error"]["message"] = "Processor not found to be deleted";
            Output::response($result, 404);
        }
    }
}
?>