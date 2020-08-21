<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../objects/player.php';
$player = new Player();

//grab the id from the url
$userid = $_GET['id'];
if($player->isExistPlayerByUserid($userid)){
	// set response code - 200 OK
    http_response_code(200);
  
    // show player data in json format
    echo $player->getPlayerByUserid($userid);
}else{
	// set response code - 200 Ok
    http_response_code(200);

    $player->addPlayer($userid);
    // tell the user that new row has been created
    echo json_encode(
        array("message" => "No player found. A new row is inserted with the given id")
    );
}