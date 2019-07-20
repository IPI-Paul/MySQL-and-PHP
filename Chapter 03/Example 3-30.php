<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Example 3-30</title>
		<?php
			include '../IPI/settings.php';
			include IPI.'IPI Functions.php';

			ob_start();
			/*
			Let's pass in a $_GET variable to our example, in this case it's aid for actor_id in our Sakila database. 
			Let's make it default to 1, and cast it to an integer as to avoid SQL inject and/or related security 
			problems. Handling all of this goes beyond the scope of tis simple example. 
			Example:
			http://example.org/script.php?aid=42
			*/
			if (isset($_GET['aid']) && is_numeric($_GET['aid'])){
				$aid = (int) $_GET['aid'];
			} else {
				$aid = 1;
			}

			/* 
			Connecting to and selecting a MySQL databasenamed sakila 
			Hostname: 127.0.0.1, username: your_user, password: your_pass, db: Sakila
			*/
			$mysqli = new mysqli($host, $usr, $pwd, DB[1]);
			
			// Oh no! A connect_errno exists so the connection attempt failed!
			if ($mysqli->connect_errno){
				/*
				The connection failed. What do you want to do?
				You could contact yourself (email?), log the error, show a nice page, etc.
				You do not want to reveal sensitive information 

				Let's try this:
				*/
				echo "Sorry this website is experiencing problems." . BR;
				
				/*
				Something you should not do on a public site, but this example will show you anyways, is print out 
				MySQL error related information -- you might log this 
				*/
				echo "Error: Failed to make a MySQL connection, here is why: \n" . BR;
				echo "Errno: " . $mysqli->connect_errno . NB;
				echo "Error: " . $mysqli->connect_error . NB;

				/*
				You might want to show them something nice, but we will simply exit 
				*/
				exit;
			}

			// Perform an SQL query
			$sql = "select actor_id, first_name, last_name from actor where actor_id = $aid";
			if (!$result = $mysqli->query($sql)){
				// Oh no! The query failed.
				echo "Sorry, the website is experiencing problems.";

				// Again, do not do this on a public site, but we'll show you how to get the error information
				echo "Error: Our query failed to execute and here is why: \n" . BR;
				echo "Query: " . $sql . NB;
				echo "Errno: " . $mysqli->errno . NB;
				echo "Error: " . $mysqli->error . NB;
				exit;
			}

			// Phew, we made it. We know our MySQL connection and query succeeded, but do we have a result?
			if ($result->num_rows == 0){
				/* 
				Oh, no rows! Sometimes that's expected and okay, sometimes it is not. You decide. In this case maybe 
				actor_id was too large?
				*/
				echo "We could not find a match for ID $aid, sorry about that. PLease try again." . BR;
				exit;
			}

			/*
			Now, we know only one result will exist in this example so let's fetch it into an associated array where the 
			array's keys are the table's column names
			*/
			$actor = $result->fetch_assoc();
			echo "Sometimes I see " . $actor['first_name'] . " " . $actor['last_name'] . " on TV." . BR;

			/*
			Now let's fetch five random actors and output their names to a list.
			We'll add less error handling here as you can do that on your own now
			*/
			$sql = "select actor_id, first_name, last_name from actor order by rand() limit 5";
			if (!$result = $mysqli->query($sql)){
				echo "Sorry, the website is experiencing problems." . BR;
				exit;
			}

			// Print our 5 random actors in a list, and link to each actor
			echo "<ul>\n" . BR;
			while ($actor = $result->fetch_assoc()){
				// not working $_SERVER['SCRIPT_FILENAME']
				echo "<li><a href='" . $_SERVER['SCRIPT_NAME'] . "?aid=" . $actor['actor_id'] . "'>" . NL;
				echo $actor['first_name'] . ' ' . $actor['last_name'];
				echo "</a></li>" . NB;
			}
			echo "</ul>" . NB;

			/*
			The script will automatically free the result and close the ySQL connection when it exits, but let's
			just do it anyways
			*/
			$result->free();
			$mysqli->close();
			$dStr = ob_get_clean();
		?>
	</head>
	<body>
		<p>
		<h1>MySQLi extension overview example</h1>
		<hr />
		<div name="retStr"></div>
		<table name="retRes" width="100%"></table>
		<br />
		<?php 
			nodeToDiv('p', $dStr);
			include $tmpl.'get date.php'; 
		?>
		</p>
	</body>
</html>