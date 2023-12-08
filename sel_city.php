<?
if (!empty($_GET['needcount'])){
	
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

	$cnt = (int)$_GET['needcount'];
	$res = mysql_query("SELECT city_id,name FROM city WHERE country_id='$cnt'") or die(mysql_error());
	if (mysql_num_rows($res) != 0){
		$mas = array();
		while($row = mysql_fetch_assoc($res)){
            $mas[] = $row['name'];
        }
		echo implode('|',$mas);
	}
}
?>