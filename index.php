<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script>declare(strict_types=1);</script> -->
    <title>PHP study</title>
</head>
<body>

<?php
$isRequired =  "";
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

//the 'if' works to get the information of the html form
//the preg_match check if only contains letters, dashes, apostropehes and whitespaces, if it contains another characters stores an error message.
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
            $nameErr = "Only letters and white space allowed";
        }
    }
}

//validate E-email
//filter_var checks an email address.
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
}

//check the url address
// preg_match() checks if the url is valid.
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["website"])) {
        $website = "";
    } else {
        $website = test_input($_POST["website"]);
        if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
            $websiteErr = "Invalid URL";
        }
    }
}

if (empty($_POST["comment"])) {
    $comment = "";
    } else {
    $comment = test_input($_POST["comment"]);
}

if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
    } else {
    $gender = test_input($_POST["gender"]);
}



//function to retrive the value and return it.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

NAME:
<input type="text" name="name">
<span class="error">*<?php echo $nameErr;?></span>
<br><br>

Email:
<input type="text" name="email">
<span class="error">* <?php echo $emailErr;?></span>
<br><br>

Website: <input type="text" name="website">
<span class="error"><?php echo $websiteErr;?></span>
<br><br>

Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
<br><br>

<!-- int the inputs we add php to check each option   -->
<!-- isset() check if a variable is define and is not null -->
gender:
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
<input type="radio" name="gender" <?php if(isset($gender) && $gender=="male") echo "checked"?> value="male">Male
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked;"?> value="other">Other
<span class="error">* <?php echo $genderErr;?></span>
<br><br>

<input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>




</body>
</html>