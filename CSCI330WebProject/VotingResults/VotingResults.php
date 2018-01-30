<!DOCTYPE html>

<!--
	Beckman
	VotingResults.php
-->

<html>
    <head>
        <meta charset = "utf-8">
        <title>Search Results</title>
		<link rel="stylesheet" type="text/css" href="VotingResults.css">
    </head>
    <body>
    <?php
	
		//Navigation bar
		print("
			<div class=\"navBar\">
				<a href=\"\\..\\..\\csci330webproject\\Home\\Home.html\">Home</a>
				<a href=\"\\..\\..\\csci330webproject\\VoterSetup\\VoterSetup.html\">Registration</a>
				<a href=\"\\..\\..\\csci330webproject\\Voting\\Voting.html\">Cast Ballot</a>
				<a class=\"active\" href=\"VotingResults.php\">Real-time Election Results</a>
			</div>
		");
		
		//initialize arrays
		$candNames = ["Karl", "Emma", "Ella", "Fred"];
		$candVotes;
		$propNames = ["Recreational Marijuana Usage: Yes",
		"Recreational Marijuana Usage: No", "City-wide Progressive Tax: Yes",
		"City-wide Progressive Tax: No", "Free College Tuition: Yes",
		"Free College Tuition: No"];
		$propVotes;
		$percentageOfVote;
		
		// Connect to MySQL
        if ( !( $database = mysql_connect( "localhost",
			"root", "") ) )                      
            die( "Could not connect to database </body></html>" );
   
        // open database
        if ( !mysql_select_db( "voterregistry", $database ) )
            die( "Could not open database </body></html>" );
		
		//Add vote totals to array $candVotes for each respective candidate
		for ($i = 0; $i < count($candNames); ++$i) {
			if ( !( $result = mysql_query( "SELECT Votes FROM CandidateResults" .
			" WHERE CandidateFirstName = '$candNames[$i]'", $database))) {
				print( "<p>Could not execute query!</p>" );
				die( mysql_error() );
			}
			/*
				$result contains a string. In order to retrieve the int value of votes
				the particular candidate has, we must first create an associative array
				called "$array" using the $result row from the database. Then we can
				call the particular column of the row associatively using key-value pairs
			*/
			$array = mysql_fetch_assoc($result);
			$candVotes[$i] = $array['Votes']; 
		}
		
		//Add vote totals to array $propVotes for each respective proposal
		for ($i = 0; $i < count($propNames); ++$i) {
			if ( !( $result = mysql_query( "SELECT ProposalVotes FROM ProposalResults" .
			" WHERE ProposalName = '$propNames[$i]'", $database))) {
				print( "<p>Could not execute query!</p>" );
				die( mysql_error() );
			}
			$array = mysql_fetch_assoc($result);
			$propVotes[$i] = $array['ProposalVotes'];
		}
		
		mysql_close($database);
		
		
		/*
			Calculate current winners and percentages
			Output appropriate HTML for respective winners
		*/
		
		//Mayoral Race
		print("<div class=\"divMain\"><h1>Mayoral Results:</h1><br>");
			if ($candVotes[0] == $candVotes[1]) {
				print("<h2>There is currently a tie for mayor!</h2><br>");
			} else if ($candVotes[0] > $candVotes[1]) {
				$percentageOfVote = ($candVotes[0] / ($candVotes[0] + $candVotes[1])) * 100;
				$percentageOfVote = round($percentageOfVote, 2);
				print("<img src=\"KarlMarx.jpg\" alt=\"Photo of Karl Marx\">" .
					"<h2>$candNames[0] is currently in the lead with" .
					" $percentageOfVote% of votes cast so far.</h2><br>");
			} else {
				$percentageOfVote = ($candVotes[1] / ($candVotes[0] + $candVotes[1])) * 100;
				$percentageOfVote = round($percentageOfVote, 2);
				print("<img src=\"EmmaGoldman.jpg\" alt=\"Photo of Emma Goldman\">" .
					"<h2>$candNames[1] is currently in the lead with" .
					" $percentageOfVote% of votes cast so far.</h2><br>");
			}
		print("</div>");
			
		//Sixth Ward Race
		print("<div class=\"divMain\"><h1>Sixth Ward Results:</h1><br>");
			if ($candVotes[2] == $candVotes[3]) {
				print("<h2>There is currently a tie for the Sixth Ward!</h2><br>");
			} else if ($candVotes[2] > $candVotes[3]) {
				$percentageOfVote = ($candVotes[2] / ($candVotes[2] + $candVotes[3])) * 100;
				$percentageOfVote = round($percentageOfVote, 2);
				print("<img src=\"EllaBaker.jpg\" alt=\"Photo of Ella Baker\">" .
					"<h2>$candNames[2] is currently in the lead with" .
					" $percentageOfVote% of votes cast so far.</h2><br>");
			} else {
				$percentageOfVote = ($candVotes[3] / ($candVotes[2] + $candVotes[3])) * 100;
				$percentageOfVote = round($percentageOfVote, 2);
				print("<img src=\"FredHampton.png\" alt=\"Photo of Fred Hampton\">" .
					"<h2>$candNames[3] is currently in the lead with" .
					" $percentageOfVote% of votes cast so far.</h2><br>");
			}
		print("</div>");
			
		//Proposal Decisions
		print("<div class=\"divMain\" style='height: auto;'><h1>Ballot Proposal Results:</h1><br>");
			for ($i = 0; $i < count($propVotes); $i += 2) {
				if ($propVotes[$i] == $propVotes[$i + 1]) {
					if ($i == 0) {
						print("<h2>The Recreational Marijuana Usage proposal has equal votes" .
							" for the affirmative and negative.</h2><br>");
					} else if ($i == 2) {
						print("<h2>The City-wide Progressive Tax proposal has equal votes" .
							" for the affirmative and negative.</h2><br>");
					} else {
						print("<h2>The Free College Tuition proposal has equal votes" .
							" for the affirmative and negative.</h2><br>");
					}
				} else if ($propVotes[$i] > $propVotes[$i + 1]) {
					$percentageOfVote = ($propVotes[$i] / ($propVotes[$i] + $propVotes[$i + 1])) * 100;
					$percentageOfVote = round($percentageOfVote, 2);
					if ($i == 0) {
						print("<h2>The Recreational Marijuana Usage proposal is currently passing with" .
							" $percentageOfVote% voting 'yes'.</h2><br>");
					} else if ($i == 2) {
						print("<h2>The City-wide Progressive Tax proposal is currently passing with" .
							" $percentageOfVote% voting 'yes'.</h2><br>");
					} else {
						print("<h2>The Free College Tuition proposal is currently passing with" .
							" $percentageOfVote% voting 'yes'.</h2><br>");
					}
				} else {
					$percentageOfVote = ($propVotes[$i + 1] / ($propVotes[$i] + $propVotes[$i + 1])) * 100;
					$percentageOfVote = round($percentageOfVote, 2);
					if ($i == 0) {
						print("<h2>The Recreational Marijuana Usage proposal is currently failing with" .
							" $percentageOfVote% voting 'no'.</h2><br>");
					} else if ($i == 2) {
						print("<h2>The City-wide Progressive Tax proposal is currently failing with" .
							" $percentageOfVote% voting 'no'.</h2><br>");
					} else {
						print("<h2>The Free College Tuition proposal is currently failing with" .
							" $percentageOfVote% voting 'no'.</h2><br>");
					}
				}
			}
		print("</div></body></html>");
		
	?>
		
		
		
		