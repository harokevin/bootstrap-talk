<?php

function addSugggestion($userName,$suggestion){
	
	//Open The Database
	$pdoObject = new PDO("sqlite:./integration_project.sqlite");
	
	//Create the insert statement
	$sqlStatement = "INSERT INTO suggestions(user_name,suggestion)VALUES('".$userName."','".$suggestion."')";
	
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

function getEquations($tableName){

		//Open The Database
		$pdoObject = new PDO("sqlite:./integration_project.sqlite");
		
		// Write the SQL statement string to select all users
		$sqlStatement = "SELECT * FROM ".$tableName."";
		
		// Execute the SQL query
		$pdoStatement = $pdoObject->query($sqlStatement);
		
		//Initilize the returned variable to rows of equations
		$kinematicEquations = "";
		foreach($pdoStatement as $row){
			$kinematicEquations .= "<tr>		<td>".$row['user_name']."</td>	<td>".$row['suggestion']."</td>	</tr>";
		}
		
		//Close the database
		$pdoObject = NULL;
		
		return $kinematicEquations;
	
}//End Function getUsers()

function charOnlyValidation($input){
	
	$errorMessage = "";

	// error check the users name
   if (!isset($input) || empty($input)) {
      $errorMessage .= $input."is not valid<br />";
   } elseif (!preg_match('/^[A-Za-z ]+$/', $input)) {
      $errorMessage .= "Your name may only be letters or the blank character<br />";
   }
   return $errorMessage;
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
<title>Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="CS 250 Integration Project About Us" />
<meta name="keywords" content="CWU, CS, 250, About Us" />
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
		
		<h1>Suggestions</h1>
		
		<div id="suggestions">
			<!-- take in suggestion -->
			<!-- put suggestion into database -->
			<form id="overallForm" action="" method="post">
				<fieldset>
					<!-- <p>
						<label>Please Enter Your Suggestion:</label>
						<input id="suggestion" name="suggestion" size="20" type="text"/>
					</p> -->
					
					<textarea rows="5" cols="100" name="suggestion"> Enter Suggestions Here..</textarea>
					<p>
						<label>Please Enter Your Name:</label>
						<input id="userName" name="userName" size="20" type="text"/>
					</p>
					
					<?php
					// if this page has just called itself with user input data
					//(i.e. the user pressed the submit button)
					if(isset($_POST['submitButton'])) {
						if(charOnlyValidation($_POST['suggestion']) == "" && charOnlyValidation($_POST['userName']) == "" ){
							//put in database
							addSugggestion($_POST['userName'], $_POST['suggestion']);
							echo "<div id=\"suggestionThanks\">";
							echo "<p>Thank you for your input, ".$_POST['userName']."!</p>"; // show the error messages
							echo "</div>";
						}
						else{
							//Print an error
							echo "<div id=\"suggestionError\">";
							echo "<p>Input is not valid</p>"; // show the error messages
							echo "</div>";
						}
						echo "<table id=\"suggestionTable\">
								<caption>Past Suggestions:</caption>
								<tr>	<th>User:</th>	<th>Suggestion:</th>	</tr>";
								echo	getEquations("suggestions");
								echo "</table>";
					} 
					?>
					
					<p>
						<input value="Submit Suggestion" type="submit" name="submitButton"/>
					</p>					
					
				</fieldset>	
			</form>
		</div>	
	</div>
	
	
</body>
</html>