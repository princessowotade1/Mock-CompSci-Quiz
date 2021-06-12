<!DOCTYPE html>
<html>
<head>
<title> User Login </title>
<link rel="stylesheet" href="./Quiz.css">
</head>
<body>

<?php
	
    
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		session_start();


	

     $name = $_POST["username"];
		 $password = $_POST["password"];
		 $string = $name.":".$password;
	   $_SESSION["name"] = $name;
   		 
     #my passwd.txt holds user login information 
		 $fh = fopen("passwd.txt","a");
	 	 $fr = fopen("passwd.txt","r");	 
		 $path = "passwd.txt";
		 $string = $name.":".$password."\n";
       		
  	 while (! feof($fr)) {
			
                   $line = fgets($fr);
                   
                   if($string == $line){

				              echo "You have already taken this quiz";
				              header("Location: login.php");
				              fclose($fr);
				              exit();
			          }
                
			              $line = fgets($fr);
		      }

	   fclose($fr);

		 if (0 == filesize($path) and file_exists($path)){

                    fwrite($fh, $name.":".$password."\n");
                    fclose($fh);
                    header("Location: Quiz.php");
                    exit();
                }

       		  
		 else {

    			
      	 	          fwrite ($fh, "$name:$password \n");
       	 	          fclose ($fh);
       	 	          header("Location: Quiz.php");
         	          exit();
		            }	
	
	
		
   }
	
?>

    
    <h2>Login for CS Quiz</h2>

            <form method="POST" action="./HW15_login.php">

                <label id="headings">Enter a Username<input name="username" type="text" id="user"></label>
                <br>
                <label id="headings">Enter a Password<input name="password" type="password" id="pass"></label>
                <br>
                <br>
                <input type ="submit" name = "Enter" value = "Enter">

             </form>

    
</body>
</html>
