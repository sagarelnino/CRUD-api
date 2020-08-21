<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../objects/player.php';
$player = new Player();

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(!empty($data->userid)){
    $data->userid = $player->filter($data->userid);
    if($player->isExistPlayerByUserid($data->userid)){
        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Player already exists with this userid"));
    }else{
        if(!empty($data->playername)){
            $data->playername = $player->filter($data->playername);
        }else{
            $data->playername = NULL;
        }
        if(!empty($data->Vault)){
            $data->Vault = implode(',',$data->Vault);
        }else{
            $data->Vault = NULL;
        }
        if(!empty($data->Inventory)){
            $data->Inventory = implode(',',$data->Inventory);
        }else{
            $data->Inventory = NULL;
        }
        if($player->store($data->playername,$data->userid,$data->Vault,$data->Inventory)){
            // set response code - 201 created
            http_response_code(201);
            // tell the user
            echo json_encode(array("message" => "Player was created."));
        }else{
            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to create player."));
        }
    }
}else{
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create player. Data is incomplete."));
}