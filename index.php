<?php
$insert = false;
if(isset($_POST['name'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "student";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password, $database);

    // Check for connection success
    if(!$con){
        die("Connection to the database failed due to: " . mysqli_connect_error());
    }

    // Collect post variables
    $name = $_POST['name'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc'];

    // Escape special characters in the variables to prevent SQL injection
    $name = mysqli_real_escape_string($con, $name);
    $gender = mysqli_real_escape_string($con, $gender);
    $age = mysqli_real_escape_string($con, $age);
    $email = mysqli_real_escape_string($con, $email);
    $phone = mysqli_real_escape_string($con, $phone);
    $desc = mysqli_real_escape_string($con, $desc);

    // Create the SQL query
    $sql = "INSERT INTO record (name, age, gender, email, phone, other, dt) VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', current_timestamp())";

    // Execute query
    if(mysqli_query($con, $sql)){
        $insert = true; // Flag for successful insertion
    }
    else{
        echo "ERROR: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="bg" src="image/bits.jpg" alt="">
    <div class="container">
        <h3>Welcome to University Registration form</h3>
        <p>Enter your details below and submit this form to the university and know about you.</p>
        <marquee class="maq" direction="left">Admissions are open!</marquee>
        <?php
        if($insert == true){
            echo "<p class='para'>Thanks for submitting your form. We are happy to see you coming</p>";
        }
        ?>

        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name">
            <input type="text" name="age" id="age" placeholder="Enter your age">
            <input type="text" name="gender" id="gender" placeholder="Enter your gender">
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="text" name="phone" id="phone" placeholder="Enter your phone">
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information"></textarea>
            <button class="btn">Submit</button>
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>
