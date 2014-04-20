<?php

  session_start();
  include("config.php");
  error_reporting(E_ALL);

  if(!(isset($_SESSION['username'])))
    header("location:index.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>pManage| Problem set manager</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  
  </head>


	<body>	
		  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="panel.php">pManage</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a href="panel.php">Posted problems</a></li>
            <li><a href="pendingproblem.php">Pending</a></li>
            <li><a href="about.html">About</a></li>
           
          </ul>
          <ul class="nav navbar-nav navbar-right">
             <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello, <?php echo $_SESSION['username']; ?>
                   <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="logout.php">Sign Out</a></li>
                  </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>      


   <div class="container">
      <div class="jumbotron">
<?php
	 $solProb=$_POST['solution_prob'];
	 
	 $probQuery="SELECT * from problem where id=$solProb";
	 
	 $queryResult=pg_query($probQuery);
	 $rowProb = pg_fetch_row($queryResult);
	 $pl = $rowProb[5];

	 $inch = $_POST['inch'];
	 $outch = $_POST['outch'];
	 $drivech = $_POST['drivech'];
	 $score=$_POST['score'];
	 $inch = (string)$inch;
	 $outch = (string)$outch;
	 $drivech = (string)$drivech;

	 if($inch=="on")
	 	$input=file_get_contents($_FILES['input']['tmp_name']);
	 else
	 	$input="";



	 if($outch=="on")
	 	$output=file_get_contents($_FILES['output']['tmp_name']);
	 else
	 	$output="";


	 if($drivech=="on")
	 	$driver=file_get_contents($_FILES['driver']['tmp_name']);
	 else
	 	$driver="";


	 $input = pg_escape_string($input);
	 $output = pg_escape_string($output);
	 $driver = pg_escape_string($driver);




	 $insertString= "INSERT INTO solution values(DEFAULT,'$input','$output','$driver','$pl',$score,$solProb)";
	 $insertQuery=pg_query($insertString);


	 $sin =  nl2br( htmlspecialchars($input));
	 $sout= nl2br( htmlspecialchars($output));
	 $sdriver= nl2br(htmlspecialchars( $driver));

	 if($insertQuery){
	 	echo "<h2 style='color:green'>Judge files were successfully uploaded</h2><br>";
		echo "<h2>Output</h2><br>$sout<br><br>";
	 if($inch=="on")
	 	 echo "<h2>Input</h2><br>$sin<br><br>";
	 if($drivech=="on")
	 	 echo "<h2>Driver</h2><br>$sdriver<br><br>";
	 }
	 else
	 	pg_last_error($connection);


	
?>
				<a href="viewproblem.php?id=<?php echo $solProb;?>"><button  class="btn btn-default btn-warning btn-lg">Back</button></a>


</div>
</div>

</body>

</html>