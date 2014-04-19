<?php 


  session_start();
  include("config.php");

  if(!(isset($_SESSION['username'])))
    header("location:index.php");

	$id = $_POST['id'];

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
    <script>
    $(document).ready(function(){
		    	jQuery.fn.visible = function() {
		    return this.css('visibility', 'visible');
		};

		jQuery.fn.invisible = function() {
		    return this.css('visibility', 'hidden');
		};

		jQuery.fn.visibilityToggle = function() {
		    return this.css('visibility', function(i, visibility) {
		        return (visibility == 'visible') ? 'hidden' : 'visible';
		    });
		};
		
		var inch = $('#inch');
		var drivech = $('#drivech');

		inch.click(function(){
			if(inch.is(":checked")){
				$("#inblock").visibilityToggle();
			}
			else{
				$("#inblock").visibilityToggle();
			}
			appendString("Input");

		});

		drivech.click(function(){
			if(drivech.is(":checked")){
				$("#driveblock").visibilityToggle();
			}
			else{
				$("#driveblock").visibilityToggle();
			}
			appendString("Driver");
		});

	});
    </script>

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
            <li><a href="#contact">Contact</a></li>
           
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
      	
      	<h2>Add Judge File</h2><br><br>
      	<div class="form-group">
      		<form action= "showsolution.php" enctype="multipart/form-data" method="post" role="form">
		    <label for="outch" class="col-sm-2 control-label">Output</label>
      		<input type="checkbox" name="outch"  id="outch" onclick="return false" checked>	<br><br>
      	
  			<label for="inch" class="col-sm-2 control-label">Input</label>
  			<input type="checkbox" name="inch"  id="inch">	<br><br>
   			<label for="drivech" class="col-sm-2 control-label">Driver</label>
  			<input type="checkbox" name="drivech"  id="drivech">	<br><br>
   		</div>
      		<br><br>

      	<div class="form-group">
      		<div id="outblock">
      			<label for="output" class="col-sm-2 control-label">Output File</label>
				<input type="file" name="output"  id="output" required><br>
			</div>
      		<div id="inblock" style="visibility:hidden">
      			<label for="input" class="col-sm-2 control-label">Input File</label>
      			<input type="file" name="input"  id="input" ><br>
      		</div>
      		<div id="driveblock" style="visibility:hidden">
   				<label for="driver" class="col-sm-2 control-label">Driver File</label>
      			<input type="file" name="driver"  id="driver"><br>
   			</div>		
   		</div>


			<h6 style="color:red">*Every batch of judge files should have an output file</h6>
      		<button type="submit" class="btn btn-primary btn-lg">Add Output </button>
      	</form>
      </div>
  </div>



			    <script src="js/bootstrap.min.js"></script>

	</body>


</html>