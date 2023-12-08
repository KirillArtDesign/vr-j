<?
Class Parser {
	public function sh($arr){
		echo "\n//===============\n<pre>";
		print_r($arr);
		echo "</pre>\n//===============\n";
	} 
	public function DBL(){
		global $DBLINK;
		return $DBLINK;
	}
	public function condb($con){
		global $DBLINK;
		$DBLINK = mysqli_connect($con['host'], $con['user'], $con['pass']) or die('No connect to Server');
		mysqli_select_db($DBLINK, $con['db']) or die('No connect to DB');
		mysqli_query($DBLINK, "SET NAMES 'utf8'") or die('Cant set charset');		
	}
	public function SQL($qver){
		global $DBLINK;
		$res = mysqli_query($DBLINK,$qver);
		return $res;
	}
	public function SMQ($tab,$arr){
		global $DBLINK;
		$ms01 = array();
		foreach($tovar as $field => $infor) $ms01[] = "$field='$infor'";
		$sts = implode(',',$ms01);
		$this->SQL($DBLINK,"INSERT INTO $tab SET $sts");
	}
	public function SQE(){
		global $DBLINK;
		return mysqli_error($DBLINK); 
	}
	public function Dubl($qver){
		global $DBLINK;
		$sqq = $this->SQL($qver);
		if (mysqli_num_rows($DBLINK,$sqq) == 0) return ''; else return $sqq;
	}
	public function logs($inf){
		$fd = fopen('logs.txt','a');
		fwrite($fd, '<p>['.$inf.'] ['.date('Y-m-d-H-i-s').']</p>'); 
		fclose($fd);
	}
	public function wfile($file,$data){
		$fd = fopen($file,'w'); 
		fwrite($fd, serialize($data)); 
		fclose($fd);
	}
	public function sfile($file,$data){
		$fd = fopen($file,'w'); 
		fwrite($fd, $data); 
		fclose($fd);
	}	
	public function loadf($file){
		return file_get_contents($file);
	}
	public function loadfs($file){
		return unserialize(file_get_contents($file));
	}	
	public function loadhtml($url,$cash = ''){
		if ($cash != ''){
			if (file_exists($cash.'.txt')){
				$result = $this->loadf($cash.'.txt');
			} else {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_REFERER, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$result = curl_exec($ch);
				curl_close($ch);
				$this->sfile($cash.'.txt',$result);
			}			
		} else {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_REFERER, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$result = curl_exec($ch);
			curl_close($ch);
		}
		return $result;
	}
	public function loadimg($par){
		if (array_key_exists('url',$par) && array_key_exists('path',$par)){
			$pic = explode('/',$par['url']);
			if (array_key_exists('orig',$par)) {
				if ($par['orig']) $nam = $pic[count($pic)-1]; else {
					if (array_key_exists('name',$par)){
						$nam = $par['name'];
					} else $nam = $pic[count($pic)-1];
				}
			} else $nam = $pic[count($pic)-1];
			if ($nam != ''){
				$load = $par['path'].'/'.$nam;
				if (!file_exists($load)){
					$curl = curl_init($par['url']);
					curl_setopt($curl, CURLOPT_HEADER, 0);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl, CURLOPT_BINARYTRANSFER,1);
					$content = curl_exec($curl);
					curl_close($curl);
					$fp = fopen($load,'x');
					fwrite($fp, $content);
					fclose($fp);
					return $load;
				} else { return $load; }
			} else { return ''; }
		}		
	}
	public function ptag($fm,$rz,$str){
		$fm = str_replace('###','(.*?)',$fm);
		$mm = explode($rz,$fm);
		preg_match_all('#'.$mm[0].'(.+?)'.$mm[1].'#su', $str, $res);
		return $res;
	}
	public function fnw($find,$info){
		$find = str_replace('###','(.*?)',$find);
		preg_match_all('#'.$find.'#su', $info, $res);
		return $res;
	}
	public function find($hu,$work){
		$ln1 = strlen($work);
		$rs1 = str_replace($hu,'',$work);
		$ln2 = strlen($rs1);
		if ($ln1 == $ln2) return false; else return true;
	}
}
?>