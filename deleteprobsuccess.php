<?php
session_start();
include("config.php");

				$id=$_GET['id'];
				$code=$_POST['code'];
				$title=$_POST['title'];
				$desc=$_POST['description'];
				$deadline=$_POST['date'] . " ".$_POST['time'];
				$pl=$_POST['pl'];

				$desc=pg_escape_string($desc);
				$queryIntoProblem="Delete from problem where id = $id";
				$deleteSolutionOfProb="Delete from solution where solution_prob = $id";
				@$queryResult=pg_query($queryIntoProblem);
									$relink=$_SERVER['PHP_SELF'];

				if($queryResult)
				{
					$_SESSION['delprob']="Delete Problem Success";
					
				}
				else
				{
				$errstr=pg_last_error($connection);
				$_SESSION['delprob']=$errstr;
				}
				header("location:panel.php");

?>