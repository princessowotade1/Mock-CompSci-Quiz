<html>
  <head>
    <title> CS Quiz </title>
    <link rel="stylesheet" href="./Quiz.css">
  </head>
  <body>
    <?php
      
      session_start();
      
      # results.txt keeps track of a user's points for the quiz
      $rf = fopen("results.txt", "a");
      
      include "Login.php";
      
    
      $name = $_SESSION["name"];
      
      $questions = array('"URL" stands for "Universal Reference Link"','An Apple MacBook is an example of a Linux system','Which of these do NOT contribute to packet delay in a packet switching network?', 'This Internet layer is responsible for creating the packets that move across the network', ' is a networking protocol that runs over TCP/IP, and governs communication between web browsers and web servers', 'A small icon displayed in a browser tab that identifies a website is called a ');
      
      $answers = array('False', 'True', 'CPU workload on a client', 'Network', 'HTTP', 'favicon');
    
      
      if (!isset($_SESSION["number"]))
      {
          $_SESSION["number"] = 0;
          $_SESSION["answer"] = "";
          $_SESSION["correct"] = 0;
	        $_SESSION["question"] = "";
	        $_SESSION["index"] = 0;
	  
         
      }
      
      $num_questions = 6;
      
      
      print <<<HOME
      <html>
      <head>
      <title> CS Quiz </title>
      </head>
      <body>
      <h3> CS Quiz </h3>

HOME;
      
      $number = $_SESSION["number"];
      $answer = $_SESSION["answer"];
      $correct = $_SESSION["correct"];
      $question = $_SESSION["question"];
      $index = $_SESSION["index"];
      
      if ($number == 0)
      { 
        print <<<FIRST
        <p> You will be given $num_questions questions in this quiz. <br /><br/>
        Here is your first question: <br /><br />
        </p>
FIRST;

      }

      if ($number > 0)
      { 
          if ($_POST["answer"] == $answer)
          {
              $correct+=10;
              $_SESSION["correct"] = $correct;
              fwrite ($rf, $name.":".$correct."\n");
          }
          else{
            
             
              fwrite ($rf, $name.":".$correct."\n");
          }
      }

      if (isset($_SESSION["time"]) && (time() - $_SESSION["time"] > 900))
      {
	      $total_score = 60;
	      $final_score = $correct;
	      print <<<FINAL_T
          Time is out. Your final score is $final_score out of $total_score. <br /><br />
          Thank you for taking this quiz. <br /><br />
FINAL_T;
	  fclose($rf);
	  session_unset();
	  session_destroy();
	  exit();
      }
      $_SESSION["time"] = time();
      
      if ($number >= $num_questions)
      {
	  $total_score = 60;
	  $final_score = $correct;
          print <<<FINAL_SCORE
          Your final score is $final_score out of $total_score. <br /><br />
          Thank you for taking this quiz. <br /><br />
FINAL_SCORE;
	  fclose($rf);
          session_destroy();
      }
      
      
      else
      {
          $number++;
	  $_SESSION["number"] = $number;
          $question = $questions[$index];
	  $answer = $answers[$index];
	  $index++;
	  $_SESSION["index"] = $index;
          $_SESSION["question"] = $question;
          $_SESSION["answer"] = $answer;
          $script = $_SERVER['PHP_SELF'];
          
          if ($number == 1)
	  {  
	       
              print <<<Q1
                <br>
                <br>
		<form method="POST" action="$script">
		    1. $question.
			<br>
			<br>
                    <label><input id="q1-1" name = "answer" type = "radio" value = "True">True</label><br>
                    <label><input id="q1-2" name = "answer" type = "radio" value = "False">False</label><br>
                    <input type="submit" value="Next Question">
                </form>
Q1;
          }
          
          if ($number == 2)
	  {
	      
              print <<<Q2
               
                <br>
                <br>
	  <form method="POST" action="$script">
		    2. $question.
		     <br>
		    <br>
                    <label><input id="q1-1" name = "answer" type = "radio" value = "True">True</label><br>
                    <label><input id="q1-2" name = "answer" type = "radio" value = "False">False</label><br>
                    <input type="submit" value="Next Question">
                </form>
Q2;
          }
          if ($number == 3)
	  {	
	     
              print <<<Q3
             
              <br>
                <br>
		<form method="POST" action="$script">
		     3. $question
			<br>
			<br>  
                    <label><input id="q3-a" type="checkbox" name="answer" value="Process-delay"> Processing delay at a router</label><br>
                    <label><input id="q3-b" type="checkbox" name="answer" value="CPU workload on a client"> CPU workload on a client</label><br>
                    <label><input id="q3-c" type="checkbox" name="answer" value="Trans-delay"> Transmission delay along a communications link</label><br> 
                    <label><input id="q3-d" type="checkbox" name="answer" value="Prop-delay"> Propagation delay</label><br>
                    <input type="submit" value="Next Question">
                </form>
Q3;
          }
          if ($number == 4)
	  {
	      
              print <<<Q4
              
                <br>
                <br>
		<form method="POST" action="$script">
		     4. $question.
			<br>
			<br>  
                    <label><input id="q4-a" type="checkbox" name="answer" value="Physical"> Physical</label><br>
                    <label><input id="q4-b" type="checkbox" name="answer" value="Data-Link"> Data Link</label><br>
                    <label><input id="q4-c" type="checkbox" name="answer" value="Network"> Network</label><br>
                    <label><input id="q4-d" type="checkbox" name="answer" value="Transport"> Transport</label><br>
                    <input type="submit" value="Next Question">
                </form>
Q4;
          }
          if ($number == 5)
          {
              print <<<Q5
              <br>
              <br>
                <form method="POST" action="$script">  
                    5. <input type="text" name="answer" id="fill-1"> $question.
                    <input type="submit" value="Next Question">
                </form>
Q5;
          }
          if ($number == 6)
          {
              print <<<Q6
              <br>
              <br>
                <form method="POST" action="$script">  
                    6. $question <input name="answer" type="text" id="fill-2">.
                    <br>
                    <input type="submit" value="Complete">
                </form>
Q6;
          }
        
      }
      
      print <<<BOTTOM
      </body>
      </html>
BOTTOM;
?>
