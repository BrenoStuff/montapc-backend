<?php
class GraphicsCardController{
    public function create(){
        Router::allowedMethod('POST');

        $data = Input::getData();
        if(!isset($data['name']) ||
            !isset($data['description']) ||
            !isset($data['pciExpress']) ||
            !isset($data['price']) ||
            !isset($data['image'])){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $name = $data['name'];
        $description = $data['description'];
        $pciExpress = $data['pciExpress'];
        $price = $data['price'];
        $image = $data['image'];

        $graphicsCard = new GraphicsCard(null, $name, $description, $pciExpress, $price, $image);
        $id = $graphicsCard->create();
        
        $result["success"]["message"] = "Graphics card created successfully";
        $result["success"]["id"] = $id;
        $result["success"]["name"] = $name;
        $result["success"]["description"] = $description;
        $result["success"]["pciExpress"] = $pciExpress;
        $result["success"]["price"] = $price;
        $result["success"]["image"] = $image;
        Output::response($result);
    }

    public function list(){
        Router::allowedMethod('GET');

        $graphicsCard = new GraphicsCard(null, null, null, null, null, null);
        $listGraphicsCards = $graphicsCard->list();

        $result["success"]["message"] = "Graphics cards listed successfully";
        $result["success"]["data"] = $listGraphicsCards;
        Output::response($result);
    }

    public function update(){
        Router::allowedMethod('PUT');

        $data = Input::getData();
        if(!isset($data['id']) ||
            !isset($data['name']) ||
            !isset($data['description']) ||
            !isset($data['pciExpress']) ||
            !isset($data['price']) ||
            !isset($data['image'])){
            $result["error"]["message"] = "Bad Request";
            Output::response($result, 400);
        }
        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $pciExpress = $data['pciExpress'];
        $price = $data['price'];
        $image = $data['image'];

        $graphicsCard = new GraphicsCard($id, $name, $description, $pciExpress, $price, $image);
        $updated = $graphicsCard->update();

        if($updated){
            $result["success"]["message"] = "Graphics card updated successfully";
            $result["success"]["id"] = $id;
            $result["success"]["name"] = $name;
            $result["success"]["description"] = $description;
            $result["success"]["pciExpress"] = $pciExpress;
            $result["success"]["price"] = $price;
            $result["success"]["image"] = $image;
            Output::response($result);
        } else {
            $result["error"]["message"] = "Graphics card not found to be updated";
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

        $graphicsCard = new GraphicsCard($id, null, null, null, null, null);
        $deleted = $graphicsCard->delete();

        if($deleted){
            $result["success"]["message"] = "Graphics card deleted successfully";
            $result["success"]["id"] = $id;
            Output::response($result);
        } else {
            $result["error"]["message"] = "Graphics card not found to be deleted";
            Output::response($result, 404);
        }
    }
}

?>