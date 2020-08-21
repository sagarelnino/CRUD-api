<?php
require_once '../config/database.php';
/**
 * 
 */
class Player extends Database
{
	private $table_name = 'players';
	//table properties
	public $playername;
	public $userid;
	public $Vault;
	public $Inventory;

	//is exist player by a userid
	public function isExistPlayerByUserid($userid){
		$st = $this->conn->prepare("SELECT * FROM $this->table_name WHERE userid=:userid");
		$st->bindParam(':userid',$userid);
		$st->execute();
		if($st->rowCount() || $st->rowCount()>1){
			return true;
		}
		return false;
	}
	//get player row by a userid
	public function getPlayerByUserid($userid){
		$st = $this->conn->prepare("SELECT * FROM $this->table_name WHERE userid=:userid");
		$st->bindParam(':userid',$userid);
		$st->execute();
		$resultSet = $st->fetch(PDO::FETCH_ASSOC);
		$resultSet['Vault'] = explode(',',$resultSet['Vault']);
		$resultSet['Inventory'] = explode(',',$resultSet['Inventory']);
		return json_encode($resultSet);
	}
	//get total records of players from player table
    public function getAllPlayers(){
        $st = $this->conn->prepare("SELECT * FROM $this->table_name");
        $st->execute();
        $resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
        $rtnArr = array();
        $i = 0;
        foreach ($resultSet as $result){
            $rtnArr[$i]['playername'] = $result['playername'];
            $rtnArr[$i]['userid'] = $result['userid'];
            $rtnArr[$i]['Vault'] = explode(',',$result['Vault']);
            $rtnArr[$i]['Inventory'] = explode(',',$result['Inventory']);
            $i++;
        }
        return json_encode($rtnArr);
    }
    public function store($playername,$userid,$Vault,$Inventory){
        $st = $this->conn->prepare("INSERT INTO $this->table_name(playername,userid,Vault,Inventory) VALUES(:playername,:userid,:Vault,:Inventory)");
        $st->bindParam(':playername',$playername);
        $st->bindParam(':userid',$userid);
        $st->bindParam(':Vault',$Vault);
        $st->bindParam(':Inventory',$Inventory);
        if($st->execute()){
            return true;
        }
        return false;
    }
    public function addPlayer($userid){
        $st = $this->conn->prepare("INSERT INTO $this->table_name(userid) VALUES(:userid)");
        $st->bindParam(':userid',$userid);
        if($st->execute()){
            return true;
        }
        return false;
    }
    public function update($playername,$Vault,$Inventory,$userid){
        $st = $this->conn->prepare("UPDATE $this->table_name SET playername=:playername, Vault=:Vault, Inventory=:Inventory WHERE userid=:userid");
        $st->bindParam(':playername',$playername);
        $st->bindParam(':Vault',$Vault);
        $st->bindParam(':Inventory',$Inventory);
        $st->bindParam(':userid',$userid);
        if($st->execute()){
            return true;
        }
        return false;
    }
    public function destroy($userid){
        $st = $this->conn->prepare("DELETE FROM $this->table_name WHERE userid=:userid");
        $st->bindParam(':userid',$userid);
        if($st->execute()){
            return true;
        }
        return false;
    }
}


?>

"INSERT INTO `m_program` (`ID`, `MANAGER_TEACHER_ID`, `SCHOOL_ID`, `TITLE`, `TYPE_LIST_ITEM_ID`, `DESCRIPTION`, `START_DT`, `END_DT`, `MAX_PROGRAM_STUDENTS`, `MIN_PROGRAM_STUDENTS`, `STATUS_LIST_ITEM_ID`, `LESSON_TOTAL`, `BASE_COST`, `BASE_LESSON_DURATION`, `THUMB`, `CREATED_AT`, `UPDATED_AT`) VALUES 
(NULL, '1', '1', 'バレエ', '37', 'バレエレッスン', '2020/4/9', '2021/03/15', '10', '0', '30', '40', '2500',  '90', NULL, '2020-01-27 17:29:40', '2020-01-27 17:29:40'), 
(NULL, '2', '1', '大人のジャズダンス入門', '38', 'ダンスレッスン', '2020/4/1', '2021/03/15', '10', '0', '31', '40', '3000', '120', NULL, '2020-01-27 17:29:40', '2020-01-28 17:29:40'), 
(NULL, '3', '2', 'Npj ダンス', '38', 'ダンスレッスン', '2020/4/1', '2021/09/15', '10', '0', '32', '20', '2000', '60', NULL, '2020-01-27 17:29:40', '2020-01-29 17:29:40'), 
(NULL, '4', '1', 'のぶこジャズ', '37', '音楽レッスン', '2020/4/1', '2021/09/15', '10', '0', '34', '20', '2500', '60','NULL', '2020-01-27 17:29:40', '2020-01-30 17:29:40');        "						