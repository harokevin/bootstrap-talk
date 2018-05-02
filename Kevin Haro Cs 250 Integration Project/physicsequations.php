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
<link href="projectStyle.css" type="text/css" rel="stylesheet" />
</head>

<body>

	<div id="navBar">
		<ul>
			<li>	<a href="home.php">Home</a>					</li>
			<li>	<a href="physicsequations.php">Physics Equations</a>	</li>
			<li>	<a href="suggestions.php">Suggestions</a>		</li>
		</ul>
	</div>
	
	<div id="pageContent">
		
		<h1>PHYSICS EQUATIONS</h1>
		
			<!--	Extract Information From Database	-->
			<!--	Display Extracted Information		-->
			<table id="kinematicEquationTable">
			<caption>Kinematic Equations</caption>
			<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
			<?php echo	getEquations("kinematic");	?>
			</table>
			
			<!--	Extract Information From Database	-->
			<!--	Display Extracted Information		-->
			<table id="circularEquationTable">
			<caption>Circular Motion Equations</caption>
			<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
			<?php echo	getEquations("circular");	?>
			</table>

			<!--	Extract Information From Database	-->
			<!--	Display Extracted Information		-->
			<table id="gravityEquationTable">
			<caption>Gravitational Force Equations</caption>
			<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
			<?php echo	getEquations("gravity");	?>
			</table>
			
			<!--	Extract Information From Database	-->
			<!--	Display Extracted Information		-->
			<table id="orbitEquationTable">
			<caption>Equations For Satellites In Circular Orbit</caption>
			<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
			<?php echo	getEquations("orbit");	?>
			</table>
		
			<!--	Extract Information From Database	-->
			<!--	Display Extracted Information		-->
			<table id="torqueEquationTable">
			<caption>Torque Equations</caption>
			<tr>	<th>Equation:</th>	<th>Variables:</th>	</tr>
			<?php echo	getEquations("torque");	?>
			</table>
		
		<!-- <h2>Miscellaneous Equations</h2>	-->
			<!--	Extract Information From Database	-->
			<!--	Display Extracted Information		-->
			
			
			<table id="userEquationTable">
			<caption>User Equations:</caption>
			<tr>	<th>User:</th>	<th>Equation:</th>	</tr>
		
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
					
					<textarea rows="5" cols="100" name="userEquation"> Enter Your Equation Here..</textarea>
					<p>
						<label>Please Enter Your Name:</label>
						<input id="userName" name="userName" size="20" type="text"/>
					</p>
					
					
					<p>
						<input value="Catalog Equation" type="submit" name="submitButton"/>
					</p>					
					
				</fieldset>	
			</form>
		</div>
		
	</div>
	
	<script src="userEquation.js" type="text/javascript"></script>
</body>
</html>