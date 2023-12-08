<?
exit;
$host='localhost';          //Хост
$db='mirora_vrj';               //Имя БД
$user_mysql='mirora_vrj';       //Имя пользователя БД
$pass_mysql='j*{t{4Y*';          //Пароль пользователя БД
$link = mysql_connect($host, $user_mysql, $pass_mysql) or die("<center><h1>Don't connect with database!!!</h1></center>");
@mysql_connect($host, $user_mysql, $pass_mysql)or die("Не могу соедениться с Мускулом...");
@mysql_select_db("$db")or die("Немогу соедениться с базой...");
@mysql_query("set names utf8");
/* 
mysql_query ("set character_set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_general_ci'");
mysql_select_db($db, $link)or die("<center><h1>ERROR CONNECT DATABASE!!!</h1></center>");
*/	

if (!empty($_GET['contr'])) $stran = $_GET['contr']; else $stran = '';
$res = mysql_query("SELECT * FROM country") or die(mysql_error());
if (mysql_num_rows($res) != 0){
	if ($stran == '') $mas = array('<option selected value="0">Выберите страну</option>');
	if ($stran != '') $mas = array('<option value="0">Выберите страну</option>');
	while($row = mysql_fetch_assoc($res)){
		if ($stran == $row['name']) $sel = 'selected'; else $sel = '';
		// $sel = '';
		$mas[] = '<option '.$sel.' value="'.$row['country_id'].'">'.$row['name'].'</option>';
	}
	echo implode('',$mas);
}
?>