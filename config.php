<?php

	
  define("DB_HOST", "localhost");
  define("DB_USER", "pmanageadmin");
  define("DB_PASS", "akosibatman");
  define("DB_NAME", "probsetmanager");
  
	
  $connection_string = "host=".DB_HOST." user=".DB_USER." password=".DB_PASS." dbname=".DB_NAME;
  	
  $connection = pg_connect($connection_string) or die("ERROR");
?>

<?php
  // EOF: config.php
?>
