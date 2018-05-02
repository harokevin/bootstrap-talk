<?php
function getEquations($tableName){

		//Open The Database
		$pdoObject = new PDO("sqlite:./integration_project.sqlite");


		// Write the SQL statement string to select all users
		$sqlStatement = "SELECT * FROM ".$tableName."";

		// Execute the SQL query
		$pdoStatement = $pdoObject->query($sqlStatement);

		//Initialize the returned variable to rows of equations
		$kinematicEquations = "";
		foreach($pdoStatement as $row){
			$kinematicEquations .= "<tr>		<td class=\"eq\">".$row['Equation']."</td>	<td class=\"var\">".$row['Variables']."</td>	</tr>";
		}

		//Close the database
		$pdoObject = NULL;

		return $kinematicEquations;

}//End Function getUsers()

function getUserEquations($tableName){

		//Open The Database
		$pdoObject = new PDO("sqlite:./integration_project.sqlite");


		// Write the SQL statement string to select all users
		$sqlStatement = "SELECT * FROM ".$tableName."";

		// Execute the SQL query
		$pdoStatement = $pdoObject->query($sqlStatement);

		//Initialize the returned variable to rows of equations
		$kinematicEquations = "";
		foreach($pdoStatement as $row){
			$kinematicEquations .= "<tr>		<td class=\"eq\">".$row['user_name']."</td>	<td class=\"var\">".$row['equation']."</td>	</tr>";
		}

		//Close the database
		$pdoObject = NULL;

		return $kinematicEquations;

}//End Function getUsers()

function addUserEquation($userName,$equation){

	//Open The Database
	$pdoObject = new PDO("sqlite:./integration_project.sqlite");

	//Create the insert statement
	$sqlStatement = "INSERT INTO userequations(user_name,equation)VALUES('".$userName."','".$equation."')";

	$pdoObject->exec($sqlStatement);

	//Prepare the SQL statement to be executed
	//$pdoStatement = $pdoObject->prepare($sqlStatement);
	/*
	//Bind the values to the parameters
	$pdoStatement->bindValue(1,$userName);
	$pdoStatement->bindValue(2,$suggestion);
	*/

	//Run the query(returns true or false)
	//$success = $pdoStatement->execute();

	//Close the database
	$pdoObject = NULL;

	//return $success;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Account: cs250001_20
Honor Code: I pledge that this code represents my own work: Kevin Haro
-->
<!--		-->

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>Physics Equations</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="CS 250 Integration Project Physics Equations" />
		<meta name="keywords" content="CWU, CS, 250, Physics Equations" />
		<meta name="author" content="Kevin Haro" />
		<!-- <link href="projectStyle.css" type="text/css" rel="stylesheet" /> -->
		<!-- <link href="projectStyle.css" type="text/css" rel="stylesheet" /> -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>

	<body>

		<!-- <div id="navBar">
			<ul>
				<li>	<a href="home.php">Home</a>					</li>
				<li>	<a href="physicsequations.php">Physics Equations</a>	</li>
				<li>	<a href="suggestions.php">Suggestions</a>		</li>
			</ul>
		</div> -->

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href=	"home.php">CS 250 Project</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item">
		        <a class="nav-link" href="home.php">Home</a>
		      </li>
		      <li class="nav-item active">
		        <a class="nav-link" href="physicsequations.php">Physics Equations<span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="suggestions.php">Suggestions</a>
		      </li>
		    </ul>
		  </div>
		</nav>

		<div id="pageContent">

			<h1 class="my-4 text-center">PHYSICS EQUATIONS</h1>

				<!--	Extract Information From Database	-->
				<!--	Display Extracted Information		-->
				<table id="kinematicEquationTable" class="table">
					<caption>Kinematic Equations</caption>
					<thead class="thead-dark">
						<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
					</thead>
					<?php echo	getEquations("kinematic");	?>
				</table>

				<!--	Extract Information From Database	-->
				<!--	Display Extracted Information		-->
				<table id="circularEquationTable" class="table">
					<caption>Circular Motion Equations</caption>
					<thead class="thead-dark">
						<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
					</thead>
					<?php echo	getEquations("circular");	?>
				</table>

				<!--	Extract Information From Database	-->
				<!--	Display Extracted Information		-->
				<table id="gravityEquationTable" class="table">
					<caption>Gravitational Force Equations</caption>
					<thead class="thead-dark">
						<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
					</thead>
					<?php echo	getEquations("gravity");	?>
				</table>

				<!--	Extract Information From Database	-->
				<!--	Display Extracted Information		-->
				<table id="orbitEquationTable" class="table">
					<caption>Equations For Satellites In Circular Orbit</caption>
					<thead class="thead-dark">
						<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
					</thead>
					<?php echo	getEquations("orbit");	?>
				</table>
				<hr class="my-4"></hr>

				<!--	Extract Information From Database	-->
				<!--	Display Extracted Information		-->
				<table id="torqueEquationTable" class="table">
					<caption>Torque Equations</caption>
					<thead class="thead-dark">
						<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
					</thead>
					<?php echo	getEquations("torque");	?>
				</table>

			<!-- <h2>Miscellaneous Equations</h2>	-->
				<!--	Extract Information From Database	-->
				<!--	Display Extracted Information		-->


				<table id="userEquationTable" class="table">
					<caption>User Equations:</caption>
					<thead class="thead-dark">
						<tr>	<th>User:</th>	<th>Equation:</th>	</tr>
					</thead>

					<?php

					// if this page has just called itself with user input data
					//(i.e. the user pressed the submit button)
					if(isset($_POST['submitButton'])) {
						if(isset($_POST['userEquation']) && !empty($_POST['userEquation']) &&
							isset($_POST['userName']) && !empty($_POST['userName'])){
							//put in database
							addUserEquation($_POST['userName'], $_POST['userEquation']);
						}
						else{
							//Print an error
							echo "<div id=\"error\">";
							echo "<p>Input is not valid</p>"; // show the error messages
							echo "</div>";
						}
					}
					?>

					<?php echo	getUserEquations("userequations"); ?>
				</table>



				<div id="userEqauationInput">
					<!-- take in suggestion -->
					<!-- put suggestion into database -->
					<form id="overallForm" action="" method="post">
						<fieldset id="userEquationInput">

							<!-- <textarea rows="5" cols="100" name="userEquation"> Enter Your Equation Here..</textarea> -->
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Enter Your Equation Here..</span>
								</div>
								<textarea class="form-control" name="userEquation" aria-label="With textarea"></textarea>
							</div>
							<p>
								<!-- <label>Please Enter Your Name:</label> -->
								<input id="userName" class="form-control" aria-label="Please Enter Your Name:" name="userName" size="20" type="text"/>
							</p>

							<p>
								<input value="Catalog Equation" type="submit" name="submitButton"/>
							</p>

						</fieldset>
					</form>
				</div>

		</div>

		<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="userEquation.js" type="text/javascript"></script>
	</body>
</html>
