<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../objects/player.php';
$player = new Player();

if($player->getAllPlayers()){
    // set response code - 200 OK
    http_response_code(200);

    // show player data in json format
    echo $player->getAllPlayers();
}else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no player found by this id
    echo json_encode(
        array("message" => "No records found.")
    );
}