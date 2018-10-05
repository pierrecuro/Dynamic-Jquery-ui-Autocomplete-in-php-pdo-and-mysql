 <?php 

// Define database php 
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'pierre');

// Connecting database php
try {
	
$conectar = new PDO("mysql:host=".dbhost."; dbname=".dbname.";charset=UTF8", dbuser, dbpass);
$conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dbnoUTF8 = new PDO("mysql:host=".dbhost."; dbname=".dbname."", dbuser, dbpass);
$dbnoUTF8->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e) {
	echo $e->getMessage();
}
 


 
?>
