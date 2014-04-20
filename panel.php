<?php
  session_start();
  include("config.php");
          $_SESSION['currprob']=false;
          $_SESSION['currsol']=false;
  if(!(isset($_SESSION['username'])))
    header("location:index.php");


  $queryAllProblems="SELECT * from problem where is_posted='a'";
  $resultQuery=pg_query($queryAllProblems);
  $queryAllCompile="SELECT * from compile";
  $resultQuery2=pg_query($queryAllCompile);

  if(isset($_SESSION['addprob']))
  {
      $alertstring=$_SESSION['addprob'];
      echo "<script>alert(\"$alertstring\");</script>";
      unset($_SESSION['addprob']);
  }
  if(isset($_SESSION['editprob']))
  {
      $alerteditstring=$_SESSION['editprob'];
      echo "<script>alert(\"$alerteditstring\");</script>";
      unset($_SESSION['editprob']);
  }
  if(isset($_SESSION['delprob']))
  {
      $alertdelstring=$_SESSION['delprob'];
      echo "<script>alert(\"$alertdelstring\");</script>";
      unset($_SESSION['delprob']);
  }
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
          <a class="navbar-brand" href="#">pManage</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="panel.php">Posted problems</a></li>
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

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Problems</h1>
        <table class="table table-striped table-bordered table-hover">
        <thead>
        <th>Code</th>
        <th>Title</th>
        <th>Programming Language</th>
        </thead>
        <tbody>
          <?php
            $count=0;

          

            while($row=pg_fetch_row($resultQuery))
            {
              echo "<tr>";
              echo "<td style=\"width:5em\"> $row[1]</td>";
              echo "<td style=\"width:20em\">$row[2]</td>";
              echo "<td style=\"width:20em\">$row[5]</td>";
              echo "<td style=\"width:30em\"><a href=\"viewproblem.php?id=$row[0]\"><button class=\"btn btn-info\">Show problem</button></a>
              <a href=\"deleteprobsuccess.php?id=$row[0]\"><button class=\"btn btn-danger\">Delete Problem</button></a></td>";
            
              echo "</tr>";
              $count++;
            }


          ?>
        </tbody>
      </table>

      <a href="addproblem.php" ><button class="btn btn-primary btn-lg">Add Problem</button></a>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
