<?php
/*	file:			class.Cy_trimmer.php
 *	description:	Trimming classes.
 *	usage:			date(mysql date format);
 *					byte(double);
 *
 *
 * 	�|CyMOL web modules systems by.Cybermujahidz
*/
class CyTrimmer{
	public $marr=array(
		'00' => '00',
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);
	public function date($date){
		if(substr_count($date,":")>=1){
			$date=substr($date,0,-9);
		}
		$g=explode("-",$date);
		if(empty($g[0])||empty($g[1])||empty($g[2])){return "CyMol:Invalid date string. Date cannot be parsed.";die();}
		list($y,$m,$d)=$g;
		$date=$d . " " . $this->marr[$m] . " " . $y;
		return $date;
	}
	public function datetime($date){
		$d=(is_numeric(substr($date,8,2))&&substr($date,8,2)<=31)?substr($date,8,2):false;
		$m=(is_numeric(substr($date,5,2))&&substr($date,5,2)<=12)?substr($date,5,2):false;
		$y=(is_numeric(substr($date,0,4)))?substr($date,0,4):false;
		if($d||$m||$y){return "CyMol:Invalid datetime string. Datetime cannot be parsed.";die();}
		$tm=substr($date,11);
		$date=$d . " " . $this->marr[$m] . " " . $y . " " . $tm;
		return $date;
	}
	public function byte($byte){
		$len=strlen($byte);
		if($len >= 4 && $len <= 6 )
		{$size=round($byte/1000) . " kB";}
		elseif($len >= 7 && 9 >= $len)
		{$size=round($byte/1000000) . " MB";}
		elseif($len >= 10)
		{$size=round($byte/1000000000) . " GB";}
		else
		{$size=$byte . " Bytes";}
		return $size;
	}
	public function text($text){

	}
	public function uang($integer){
		if(!is_numeric($integer)){echo "CyMol:Parse error. Integer value expected.";die();}
		$number=number_format($integer,0,'','.');
		$result = "Rp. ".$number.",-";
		return $result;
	}
}
?>
