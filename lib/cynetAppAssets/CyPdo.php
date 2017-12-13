<?php
/*	file:			class.CyPdo.php
 *	description:	pdo helper classes.
 *	usage:			*yet undocumented
 *
 *
 * 	©|CyMOL web modules systems by.Cybermujahidz
*/
class CyPdo extends PDO{
	public $lastid=false;
public function __construct(){

	require_once("variables/db.php");
	$this->engine=$cfg['dbEngine'];
	$this->hostname=$cfg['dbHost'];
	$this->username=$cfg['dbUser'];
	$this->password=$cfg['dbPassword'];
	$this->database=$cfg['dbName'];
	$this->devmode=$cfg['dbDevmode'];
	unset($cfg);
	//connect
	try {
		$this->sbm = new PDO($this->engine.':host='.$this->hostname.';dbname='.$this->database, $this->username, $this->password, array(PDO::ATTR_PERSISTENT => true));
		$this->sbm->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		$this->error('db002',$e->getMessage());
	}
}
	public function submit($sql,$dds=null){
		try {
			$qbm=$this->sbm->prepare($sql);
			if(!$qbm->execute($dds)){
				if($this->devmode){
					$ERR_DET=$qbm->errorInfo();
					$ERR_DET=$ERR_DET[2];
					$this->error('db002',$ERR_DET);
				}else{
					$this->error('db002');
				}
			}
			$this->lastid=$this->sbm->lastInsertId();
			return $qbm;
		} catch (PDOException $e){
			echo $e->getMessage();
		}
	}
	public function fetch($sql,$dds=null){
		return $this->submit($sql,$dds)->fetchAll(PDO::FETCH_ASSOC);
	}
	//pull(<table name>,<arr cond>,[<col name>]);
	public function pull($t,$w,$f=null){
		$f=($f==null)?"*":$f;
		$s="select $f from $t where ";
		foreach($w as $k=>$v){
			$s.=$k."='".$v."' ";
		}
		$d=$this->fetch($s);
		$r=(count($d)<1)?null:$d[0];
		return $r;
		unset($r);
		unset($d);
		unset($s);
	}
	private function error($ERR_CODE,$ERR_DET=null){
		echo $ERR_DET;
		exit();
	}
}
?>
