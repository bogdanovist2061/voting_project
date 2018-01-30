<!DOCTYPE html>

<!--
	Beckman
	Voting.php
-->

<html>
    <head>
        <meta charset = "utf-8">
        <title>Search Results</title>
		<style type = "text/css">
			body  { 
				font-family: Calibri, sans-serif;
				font-weight: bold;
				text-align: center;
				background-color: lightseagreen;
				color: black;
			}
		</style>
    </head>
    <body>
    <?php
	
		$voterID = $_POST["voterID"];
		$mayor = $_POST["mayor"];
		$sixthWard = $_POST["sixthWard"];
		$prop1 = $_POST["prop1"];
		$prop2 = $_POST["prop2"];
		$prop3 = $_POST["prop3"];		
		
		// Connect to MySQL
        if ( !( $database = mysql_connect( "localhost",
		"root", "") ) ) {                      
            die( "Could not connect to database </body></html>" );
		}
   
        // open database
        if ( !mysql_select_db( "voterregistry", $database ) ) {
            die( "Could not open database </body></html>" );
		}
		
		//First we need to check if the voterID is valid
		if ( !( $result = mysql_query( "SELECT FirstName, LastName FROM" .
		" VoterRegistry WHERE VoterID = $voterID", $database))) {
			print( "<p>Your voter ID is invalid.</p>" );
			die( mysql_error() );
		}
		
		//Adding one vote for the mayoral candidate
		if ($mayor != "") {
			if ( !( mysql_query( "UPDATE CandidateResults" .
			" SET Votes = Votes + 1" .
			" WHERE CandidateFirstName = '$mayor'", $database))) {
				print( "<p>Could not execute query!</p>" );
				die( mysql_error() );
			}			
		}
		
		//Adding one vote for  the Sixth Ward Candidate
		if ($sixthWard != "") {
			if ( !( mysql_query( "UPDATE CandidateResults" .
			" SET Votes = Votes + 1" .
			" WHERE CandidateFirstName = '$sixthWard'", $database))) {
				print( "<p>Could not execute query!</p>" );
				die( mysql_error() );
			}
		}
		
		//Adding one vote for either prop1 "yes" or prop1 "no"
		if ($prop1 != "") {
			if ($prop1 == "yes"){
				if ( !( mysql_query( "UPDATE ProposalResults" .
				" SET ProposalVotes = ProposalVotes + 1" .
				" WHERE ProposalName = 'Recreational Marijuana Usage: Yes'", $database))) {
					print( "<p>Could not execute query!</p>" );
					die( mysql_error() );
				} 
			} else {
				if ( !( mysql_query( "UPDATE ProposalResults" .
				" SET ProposalVotes = ProposalVotes + 1" .
				" WHERE ProposalName = 'Recreational Marijuana Usage: No'", $database))) {
					print( "<p>Could not execute query!</p>" );
					die( mysql_error() );
				}
			}
		}
		
		//Adding one vote for either prop2 "yes" or prop2 "no"
		if ($prop2 != "") {
			if ($prop2 == "yes"){
				if ( !( mysql_query( "UPDATE ProposalResults" .
				" SET ProposalVotes = ProposalVotes + 1" .
				" WHERE ProposalName = 'City-wide Progressive Tax: Yes'", $database))) {
					print( "<p>Could not execute query!</p>" );
					die( mysql_error() );
				} 
			} else {
				if ( !( mysql_query( "UPDATE ProposalResults" .
				" SET ProposalVotes = ProposalVotes + 1" .
				" WHERE ProposalName = 'City-wide Progressive Tax: No'", $database))) {
					print( "<p>Could not execute query!</p>" );
					die( mysql_error() );
				}
			}
		}
		
		//Adding one vote for either prop3 "yes" or prop3 "no"
		if ($prop3 != "") {
			if ($prop3 == "yes"){
				if ( !( mysql_query( "UPDATE ProposalResults" .
				" SET ProposalVotes = ProposalVotes + 1" .
				" WHERE ProposalName = 'Free College Tuition: Yes'", $database))) {
					print( "<p>Could not execute query!</p>" );
					die( mysql_error() );
				} 
			} else {
				if ( !( mysql_query( "UPDATE ProposalResults" .
				" SET ProposalVotes = ProposalVotes + 1" .
				" WHERE ProposalName = 'Free College Tuition: No'", $database))) {
					print( "<p>Could not execute query!</p>" );
					die( mysql_error() );
				}
			}
		}
		
		mysql_close($database);
		
		//Generating successful vote message
		$array = mysql_fetch_assoc($result);
		$first = $array['FirstName'];
		$last = $array['LastName'];
		
		print("<h1>$first $last, thank you for voting! Your votes have been" .
			" successfully recorded.</h1><br>" .
			"<h2>Click <a href=\"\\..\\..\\CSCI330WebProject\\VotingResults\\" .
			"VotingResults.php\">here</a> to check the real-time election results" .
			"</h2><br>" .
			"<h2>Click <a href=\"\\..\\..\\CSCI330WebProject\\Home\\Home.html\">" .
			"here</a> to go return to the homepage.</h2></body></html>");
		
	?>
		
		
		
		
		
		
		
		
		
		
	   
			
		