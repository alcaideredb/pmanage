<?php 


  session_start();
  include("config.php");

  if(!(isset($_SESSION['username'])))
    header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en">

<html>
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
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>      

     <div class="container">
            <div class="jumbotron">

      <h1>Add Problem</h1><br><br>
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" role="form" class="form-horizontal">

        <div class="form-group">
    <label for="code" class="col-sm-2 control-label">Code</label>
        <input type="text" name="code" id="code" required><br><br>
            
            <label for="title" class="col-sm-2 control-label">Title</label>
            <input type="text" name="title" id="title" required><br><br>

            <label for="description" class="col-sm-2 control-label" >Description</label>
            <textarea name="description" id="description" style="height:150px; width:250px" required></textarea><br><br>
        
            <label for="date" class="col-sm-2 control-label">Date</label>
        <input type="date" name="date" id="date" required><input type="time" name="time" style="height:40px" required><br><br>
            
            <label for="pl" class="col-sm-2 control-label">Programming Language</label>
          <br>
          <select name="pl" id="pl" required>
              <option value="C">C</option>
              <option value="C++">C++</option>
              <option value="Java">Java</option>
          </select>

         <br>

      </div>
            <input type="submit" name="submit">

      </form>
       <a href="panel.php"><button  class="btn btn-default">Back</button></a><br>
       
    <?php
      if(isset($_POST['submit']))
      {
        $id=$_POST['id'];
        $code=$_POST['code'];
        $title=$_POST['title'];
        $desc=$_POST['description'];
        $deadline=$_POST['date'] . " ".$_POST['time'];
        $pl=$_POST['pl'];

        $queryIntoProblem="INSERT INTO problem values(DEFAULT,'$code','$title','$desc','$deadline','$pl','p')";
        $queryResult=pg_query($queryIntoProblem);
        if($queryResult)
        {
          echo "<span style=\"color:green \">Adding Problem Success, it is now pending.</span>";
        }
        else
        {
          echo "<span style=\"color:red\">".pg_last_error($connection)."</span>";
        }
      }


    ?>
      </div>
    </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

          <script src="js/bootstrap.min.js"></script>
    
    

  </body>

</html>