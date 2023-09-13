<!DOCTYPE html>
<html>
<head>
<title>Assignment 5 Chat Application NRE3</title>
<link rel="stylesheet" href="Assignment5Styling.css" media="all" />
<script src="Assignment5Script.js"></script> <!-- Linked the JavaScript code to a separate file -->
</head>
<body>
    <div id="mainField">
        <div id="messagePanel">
            <?php
            $servername = "sql1.njit.edu";
            $username = "nre3";
            $password = "Mo30Del-zx3";
            $dbname = "nre3";
            $con = mysqli_connect($servername, $username, $password, $dbname); //Connecting to database
            // This gets the message and is done by ID so that goes in order correctly (autoincremented so that it automatically keeps track)
            $query = "SELECT * FROM chatMessageLogs ORDER BY messageIDNumber";
            $result = $con->query($query);
    
            // Used a while loop to display each row
            while($row = $result->fetch_array()) :
            ?>
                <div id="chatLogs">
                        <span class="name"> <?php echo $row['name'], ' - '; ?> </span> <!-- This puts out the name and a - so that it separates it better -->
                        <span class="message"><?php echo $row['userMessage']; ?></span> <!-- This puts out the message -->
                </div>
    
            <?php endwhile; // This ends the while loop since we start the loop and then exit php 
            ?>
        </div>
    
        <form method="POST" action="chatRoom.php"> <!-- creating a form for the inputs -->
        <input type="text" name="name" placeholder="Name: " /> <!-- this is just name input -->
        <input type="password" name="password" placeholder="Password: " /> <!-- password input, made sure to classify it as password so that it blocks out when user is typing -->
        <textarea name="userMessage" placeholder="Message: "></textarea> <!-- this is the user's message -->
        <input type="submit" name="submit" value="Send" /> <!-- By using a submit button it allows the button to be clicked as well as enter to be hit -->
        </form>
        
        <?php
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $message = $_POST['userMessage'];
            
            // Check if the username and password match in the database
            $query = "SELECT * FROM verifiedUsers WHERE name = '$name' AND password = '$password'";
            $result = $con->query($query);
            
            if ($result->num_rows > 0) {
                // If there's a match, insert the message into the chat table for everyone to see
                $query = "INSERT INTO chatMessageLogs (name, userMessage) VALUES ('$name', '$message')";
                $result = $con->query($query);
            } else {
                // If there's no match, the alert will show and will make them try again
                echo "<script>alert('Invalid username or password. Please try again!')</script>"; //Made sure to make it alert instead of just echo on the page.
            }
        }
        ?>
    </div>
    </body>
</html>    