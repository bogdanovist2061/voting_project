<!DOCTYPE html>

<!--
	Beckman
	VoterSetup.php
-->

<html>
    <head>
        <meta charset = "utf-8">
        <title>Search Results</title>
		<style type = "text/css">
			body  { 
				font-family: Calibri, sans-serif;
				background-color: lightseagreen;
			}
			h1, h2 {
				text-align: center;
			}
		</style>
    </head>
    <body>
    <?php
	  
		 $voterID = $_POST["id"];
		 $firstName = $_POST["firstName"];
		 $lastName = $_POST["lastName"];
		 $address = $_POST["address"];
		 $politicalAff = $_POST["politicalAff"];
		 $ward = $_POST["ward"];

         // build insert query
         $query = "INSERT INTO voterregistry (VoterID, FirstName, LastName,";
         $query .= "Address, PoliticalAffiliation, Ward)"; 
		 $query .= "VALUES ('$voterID', '$firstName', '$lastName', '$address',";
		 $query .= "'$politicalAff', '$ward')";


         // Connect to MySQL
         if ( !( $database = mysql_connect( "localhost",
            "root", "") ) )                      
            die( "Could not connect to database </body></html>" );
   
         // open database
         if ( !mysql_select_db( "voterregistry", $database ) )
            die( "Could not open database </body></html>" );
		
		 // insert query into databse
		 if (!($result = mysql_query($query, $database))){
			 print("<p>Could not execute query.</p>");
			 die(mysql_error());
		 }

         // query database
         if ( !( $result = mysql_query( "SELECT VoterID 
               FROM voterregistry", $database ) ) )  // extracts two fields from DB
            {
               print( "<p>Could not execute query!</p>" );
               die( mysql_error() );
            }

            mysql_close( $database );
		// end if
		
		print("<h1><strong>$firstName $lastName, thank you for registering to vote!" . 
			"</strong></h1><br>" .
			"<h2>Your voter ID is: $voterID</h2><br>" .
			"<h2>Click <a href=\"\\..\\..\\CSCI330WebProject\\Voting\\Voting.html\">here</a>" .
			" to continue to the voting page.</h2><br>" .
			"<h2>Click <a href=\"\\..\\..\\CSCI330WebProject\\Home\\Home.html\">here</a>" .
			" to return to the homepage.</h2></body></html>");
		
	?>
	  
	  
	  
	  
	  
	  
	  