<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lessons Schedule</title>
    <link rel="stylesheet" href="./css/eventCalendar.css">
    <link rel="stylesheet" href="./css/eventCalendar_theme_responsive.css">
    <link rel="stylesheet" href="./css/register.css">
</head>
<body> <br>
    <h1>Lessons Schedule</h1>
    <p class='schedule-description'>Pick a date and click to book your lesson!</p>
   
<div id="eventCalendar" style="width: 500px; margin: 50px auto;"></div>
    
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="js/moment.js"></script>
<script src="js/jquery.eventCalendar.js"></script>
<script>
    $(function(){
       
        $('#eventCalendar').eventCalendar({
            // jsonData: data,
            eventsjson: 'data.json',
            jsonDateFormat: 'human'
        });
    });
    
 </script>
 
 <?php

 
ini_set('log_errors', 'On');
ini_set('error_log', '/var/log/php_errors.log');

    echo "PHP works! \n";    

   
   if ($error) {
       die ("Ouch crap! there's some mistake!"); //if there is no connection, script stops
   } else echo "Connected to the database successfully \n";

 
    ?>


<?php
if (count($_POST) > 0) {
            $msg  = 'You have been enrolled!';
            $showForm = false;
            
            $userName = trim($_POST['userName']);
            $userEmail = trim($_POST ['userEmail']);
            $userLessonName;
            $userLessonDate;
            $userLessonTime;


            mail ($userEmail, 'Your lesson', 
            "Dear $userName !\n
            You have just enrolled the lesson \n
            Lesson name: $userLessonName \n
            Date:  $userLessonDate \n
            Time:  $userLessonTime \n 
            Thank you and looking forward to meeting you at the lesson! \n
            Regards, \n
            Maria" );

            mail ('lenayork@tut.by', 'New student', " $userName has just enrolled $userLessonName lesson. \n
            Date: $userLessonDate \n
            Time: $userLessonTime \n
            Email mentioned: $userEmail");

            file_put_contents('app.txt', "$userName $userEmail $userLessonDate $userLessonTime \n"  , FILE_APPEND); 
            //создает файл в localhost, в который выводит значения переменных при каждом вводе
            
                        
            $date = date('Y-m-d H:i:s');
            


        } else { $msg = ' ';
            $showForm = true;
        }
            
        ?>

<?php if ($showForm) { ?>

    <form method="POST" class="user-info-form hidden" id="user-info-form">

<div class="user-info">
    <label for  = 'name'>Enter your name and surname</label>
    <div>
        <input type = 'text' id = 'userName' placeholder= "Britney Spears" name = 'userName' required="required"></input>
    </div>
</div>

<div class="user-info">
    <label for  = 'email'>Enter your email</label>
    <div>
        <input type = 'email' id = 'userEmail' placeholder= "name@example.com" name = 'userEmail' 
            required>
             <!-- pattern="#[0-9A-Za-z]{6}" -->
            
        </input>
    </div>
</div>

<div class="user-info">
    <label for  = 'phone'>Enter your phone number</label>
    <div>
        <input type = 'text' id = 'userPhone' placeholder= "+123456789" name = 'userPhone' required="required"></input>
    </div>
</div>


<div class="confirm-booking">
    <p id="hiddenForm">Please check your data:<br>
    You are <span id="enteredName" class="enteredUserInfo"></span><br>
    Your email is <span id="enteredEmail" class="enteredUserInfo"></span><br>
    Your phone number is <span id="enteredPhone" class="enteredUserInfo"></span><br>
    You are going to book the lesson:
        <span id="chosenLessonData">lessonName/date/time</span>
    </p>
    <button type="submit" class="confirm-button" text="Confirm and proceed" value="Confirm and proceed" id="confirm-registration-button" onsubmit="return false;">Confirm and proceed</button>
    <button class="cancel-button" id="cancel-registration-button">Cancel</button>
</div>
</form>

<?php } ?>
<?php 
    echo $msg;
?>

<script>

    // $('form').submit(function (e) {
    //   e.preventDefault();
    // });

   //переменные для хранения введенных юзером данных
   let userName =  "";
	let userEmail = "";
    let userPhone = ""; 
    
    //переменные для inner html
    let enteredUserName = document.querySelector("#enteredName");
    let enteredUserEmail = document.querySelector("#enteredEmail");
    let enteredUserPhone = document.querySelector("#enteredPhone");

    const confirmButton = document.querySelector('#confirm-registration-button');
    confirmButton.addEventListener('click', function(event) {
       
					
        // alert('confirm button click works!');
        userName =  document.querySelector('#userName').value;
	    userEmail = document.querySelector('#userEmail').value;
        userPhone = document.querySelector('#userPhone').value;
        // alert('this also works');

        enteredUserName.innerHTML = userName;
        enteredUserEmail.innerHTML = userEmail;
        enteredUserPhone.innerHTML = userPhone;
        // alert('and this');
        event.preventDefault();

    });
   
   
						
</script>
</body>
</html>