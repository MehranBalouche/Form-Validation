<?php
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";
if (isset($_POST['btn'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['name'])) {
            $nameErr = "نام ضروری هست";
        } else {
            $name = test_input($_POST["name"]);
        }
        if (empty($_POST['email'])) {
            $emailErr = "ایمیل ضروری هست";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "فرمت ایمیل درست نیست";
            }
        }
        if (empty($_POST['gender'])) {
            $genderErr = "جنسیت ضروری هست";
        } else {
            $gender = test_input($_POST["gender"]);
        }
        $website = test_input($_POST["website"]);
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            $websiteErr = "فرمت آدرس اشتباه است";
        }
        $comment = test_input($_POST["comment"]);

    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <br><p><span style="color: red;">* <?php echo "فیلد های ضروری";?></span></p>
        Name: <input type="text" name="name"><span style="color: red;">* <?php echo $nameErr;?></span><br>
        E-mail: <input type="text" name="email"><span style="color: red;">* <?php echo $emailErr;?></span><br>
        Website: <input type="text" name="website"><span style="color: red;"><?php echo $websiteErr;?></span><br>
        Comment: <textarea name="comment" rows="5" cols="40"></textarea><br>
        <span style="color: red;">* <?php echo $nameErr;?></span>
        Gender:
        <input type="radio" name="gender" value="unknown" checked>unknown
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="other">Other
        <span style="color: red;">* <?php echo $nameErr;?></span><br>
    <br>
        <input type="submit" name="btn" value="ارسال">
    </form>
    <br>
    <br>
    <h2>Your Input:</h2>
    <?php
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

