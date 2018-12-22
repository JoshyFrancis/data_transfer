<?php
class Session{
	public static $session=null;
	public static $id=null;
	private $database=null;
	private $lifetime=600;
	public function __construct($lifetime=600,$connection='sqlite:data.sqlite3'){
		$this->database =new \PDO($connection);
		$this->database->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		$this->database->exec('CREATE TABLE IF NOT EXISTS sessions(
			id VARCHAR(64) PRIMARY KEY
			,data TEXT
			,date_access INT
			)');
		$this->lifetime=$lifetime;
		$this->gc();
		Session::$session=$this;
	}
	public function read($id,$default=''){
		$stmt = $this->database->query('SELECT data FROM sessions WHERE id="'.$id.'" LIMIT 1',\PDO::FETCH_ASSOC);
		$rows =$stmt!==false?$stmt->fetchAll():[];
		if(count($rows)>0){
			return $rows[0]['data'];
		} else {
			return $default;
		}
	}
	public function write($id, $data){
		$date_access = time()+$this->lifetime;
		$stmt = $this->database->query('SELECT date_access FROM sessions WHERE id="'.$id.'" LIMIT 1',\PDO::FETCH_ASSOC);
		$rows =$stmt!==false?$stmt->fetchAll():[];
		if(count($rows)>0){
			//$date_access=intval($rows[0]['date_access']);// prevent extending session time
		}
		$row=[];
		$row[] = $id;
		$row[] = $data;
		$row[] = $date_access;
		//$statement=$this->database->prepare('REPLACE INTO sessions(id,`data`,date_access) VALUES (?, ?, ?)');//mysql
		$statement=$this->database->prepare('INSERT OR REPLACE INTO sessions(id,data,date_access) VALUES (?, ?, ?)');
		return $statement->execute($row);
	}
	public function destroy($id){
		if ($this->database->exec('DELETE FROM sessions WHERE id="'.$id.'" LIMIT 1')>0) {
			return true;
		} else {
			return false;
		}
	}
	public function close(){
		if($this->database!==null){
			$this->database=null;
			return true;
		}
		return false;
	}
	public function gc($max=0){
		// Calculate what is to be deemed old
		$old = time() - $max;
		if ($this->database->exec('DELETE FROM sessions WHERE date_access < '. $old)>0) {
			return true;
		} else {
			return false;
		}
	}
	public function __destruct(){
		$this->close();
	}
}
function session(){
	$args=func_get_args();
	if(count($args)===1){
		$key=$args[0];
		$data=unserialize( Session::$session->read(Session::$id));
		return isset($data[$key])?$data[$key]:null;
	}else{
		$key=$args[0];
		$val=$args[1];
		$data=unserialize( Session::$session->read(Session::$id));
		$data[$key]=$val;
		Session::$session->write(Session::$id,serialize($data));
	}
}
