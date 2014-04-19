<?php
	session_start();
	include("config.php");

	if(!(isset($_SESSION['username'])))
		header("location:index.php");		



			$id=$_GET['id'];
			$query="SELECT * from problem where id='$id';";
			$resultQuery=pg_query($query);
			$row = pg_fetch_row($resultQuery);
         $solQuery = "SELECT * from solution where solution_prob = $id";
          $resultSolQuery = pg_query($solQuery);
          $numOfSols = pg_num_rows($resultSolQuery);
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
 
  </head>


	<body>
	   <!-- Fixed navbar -->
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
            <li><a href="panel.php">Posted problems</a></li>
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
        <h2>Title: <?php echo $row[2]; ?></h2>
        <table class="table table-striped table-bordered table-hover">
					<thead>
						<th>Internal ID</th>
						<th>Code</th>
						<th>Title</th>
						<th>Deadline</th>
						<th>Programming Language</th>

					</thead>
					<tbody>
					<?php 
						if(time() > strtotime($row[4]))
							$rowclass = "danger";
						else
							$rowclass = "warning";
						echo "<tr class=$rowclass>";
						echo "<td>$row[0]</td>";
						echo "<td>$row[1]</td>";
						echo "<td>$row[2]</td>";
						echo "<td>$row[4]</td>";
						echo "<td>$row[5]</td>";
            if($row[6]=='p')
            {
                if($numOfSols==0)
                $postClass= "\"btn btn-success\" disabled=\"disabled\"";
                else
                $postClass="\"btn btn-success\"";
                echo "<td><button class = $postClass>Post</button></td>";
            }
						echo "</tr>";
					?>
					</tbody>
				</table>
        <?php 
        
        echo '<h6 style="color:red">*A problem cannot be posted until a valid judge trio has been uploaded</h6>';
        ?>
        <br><br><br>
				<h2>Problem Description</h2>
				<?php
					echo nl2br(htmlspecialchars($row[3]));
				?>
				<br><br>
        <br>
                <h2>Judge Files</h2>

        <table class="table table-striped table-bordered table-hover">
          <thead>
            <th>Internal ID</th>
            <th>Input</th>
            <th>Output</th>
            <th>Driver</th>
            <th>Programming Language</th>

          </thead>
          <tbody>
        <?php
       

          while($rowSol = pg_fetch_row($resultSolQuery))
           {
            echo "<tr>";
            echo "<td>$rowSol[0]</td>";
            echo "<td>$rowSol[1]</td>";
            echo "<td>$rowSol[2]</td>";
            echo "<td>$rowSol[4]</td>";
            echo "<td>$rowSol[5]</td>";
            echo "</tr>";
           }



        ?>

            </tbody>
        </table>
        <a href="addsolution.php?id=<?php echo $id?>"><button  class="btn btn-default btn-primary btn-lg">Add Solution</button></a>
				<a href="panel.php"><button  class="btn btn-default btn-warning btn-lg">Back</button></a>
			 
			</div>
		</div>



			    <script src="js/bootstrap.min.js"></script>
			    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	</body>
</html>