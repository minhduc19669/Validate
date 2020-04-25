<?php
declare(strict_types=1);
session_start();
$nameErr = $password_error = $email_error = $alert= "";
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['pass']) || empty($_POST['name'])) {
        $email_error = "Email is required ! ";
        $password_error = "Password is required !";
        $nameErr = "Email is required ! ";
    } else {
        $email = $_POST['email'];
        $username = $_POST['name'];
        $password = $_POST['pass'];
        $phone = $_POST['phone'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        }
        $uppercase = preg_match('/[A-Z]/', $password);
        $lowercase = preg_match('/[a-z]/', $password);
        $number = preg_match('/\d/', $password);
        $specialChars = preg_match('/[\W]/', $password);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $password_error = 'Mật khẩu phải có ít nhất 8 ký tự và phải bao gồm ít nhất một chữ cái viết hoa,
             một số và một ký tự đặc biệt!';
        } else {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;
            $dataJson = file_get_contents('./data.json');
            $data = json_decode($dataJson);
            for ($i = 0; $i < count($data); $i++) {
                if ($_SESSION['username'] == $data[$i]->name && $_SESSION['password'] == $data[$i]->password && $_SESSION['email']==$data[$i]->email) {
                    header('location: Home.php');
                }else{
                    $alert="Sai tên tài khoản hoặc mật khẩu!";
                }
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Title</title>
    <style>
        /
        import
        url

        (
        https:

        /
        /
        fonts.googleapis.com

        /
        css? family

        =
        Open + Sans:

        400
        italic,

        400
        ,
        300
        ,
        600
        )
        ;

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
            -moz-font-smoothing: antialiased;
            -o-font-smoothing: antialiased;
            font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        body {
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
            font-weight: 300;
            font-size: 12px;
            line-height: 30px;
            color: #777;
            background: #0CF;
        }

        .container {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            position: relative;
        }

        #contact input[type="text"], #contact input[type="email"], #contact input[type="tel"], #contact input[type="url"], #contact textarea, #contact button[type="submit"] {
            font: 400 12px/16px "Open Sans", Helvetica, Arial, sans-serif;
        }

        #contact {
            background: #F9F9F9;
            padding: 25px;
            margin: 50px 0;
        }

        #contact h3 {
            color: #F96;
            display: block;
            font-size: 30px;
            font-weight: 400;
        }

        #contact h4 {
            margin: 5px 0 15px;
            display: block;
            font-size: 13px;
        }

        fieldset {
            border: medium none !important;
            margin: 0 0 10px 55px;
            padding: 0;
            width: 70%;
        }

        fieldset span {
            width: 30px;
            height: 20px;
        }

        #contact input[type="text"], #contact input[type="email"], #contact input[type="password"], #contact input[type="tel"], #contact input[type="url"], #contact textarea {
            width: 100%;
            border: 1px solid #CCC;
            background: #FFF;
            margin: 0 0 5px;
            padding: 10px;
        }

        #contact input[type="text"]:hover, #contact input[type="email"]:hover, #contact input[type="password"]:hover, #contact input[type="tel"]:hover, #contact input[type="url"]:hover, #contact textarea:hover {
            -webkit-transition: border-color 0.3s ease-in-out;
            -moz-transition: border-color 0.3s ease-in-out;
            transition: border-color 0.3s ease-in-out;
            border: 1px solid #AAA;
        }

        #contact textarea {
            height: 100px;
            max-width: 100%;
            resize: none;
        }

        #contact button[type="submit"] {
            cursor: pointer;
            width: 100%;
            border: none;
            background: #0CF;
            color: #FFF;
            margin: 0 0 5px;
            padding: 10px;
            font-size: 15px;
        }

        #contact button[type="submit"]:hover {
            background: #09C;
            -webkit-transition: background 0.3s ease-in-out;
            -moz-transition: background 0.3s ease-in-out;
            transition: background-color 0.3s ease-in-out;
        }

        #contact button[type="submit"]:active {
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
        }

        #contact input:focus, #contact textarea:focus {
            outline: 0;
            border: 1px solid #999;
        }

        ::-webkit-input-placeholder {
            color: #888;
        }

        :-moz-placeholder {
            color: #888;
        }

        ::-moz-placeholder {
            color: #888;
        }

        :-ms-input-placeholder {
            color: #888;
        }

    </style>
</head>
<body>
<div class = "container">
    <form id = "contact" action = "Login.php" method = "POST">
        <h3 style = "text-align: center;">LOGIN</h3>
        <h4 style = "text-align: center;">Welcome !</h4>
        <fieldset>
            <input placeholder = "Your User name" type = "text" tabindex = "1" name = "name" value="<?php if (isset($_SESSION['username'])){
                echo $_SESSION['username'];
            }  ?>">
            <span><?php echo $nameErr; ?></span>
        </fieldset>
        <fieldset>
            <input placeholder = "Your Password" type = "password" tabindex = "1" name = "pass" value="<?php if (isset($_SESSION['password'])){
                echo $_SESSION['username'];
            }  ?>">
            <span style = "color: rgb(255,0,0);font-size: 14px;font-weight: bold;"> <?php echo $password_error; ?></span>
        </fieldset>
        <fieldset>
            <input placeholder = "Your Email Address" type = "email" tabindex = "2" name = "email" value="<?php if (isset($_SESSION['email'])){
                echo $_SESSION['username'];
            }  ?>">
            <span style = "color: rgb(255,0,0);font-size: 14px;font-weight: bold;"><?php echo $email_error; ?></span>
        </fieldset>
        <fieldset>
            <input placeholder = "Your Phone Number" type = "tel" tabindex = "3" name = "phone" value="<?php if (isset($phone)){
                echo $phone;
            }  ?>">
            <span></span>
        </fieldset>
        <fieldset>
            <button name = "submit" type = "submit" id = "contact-submit" data-submit = "...Sending" style = "margin-left: 120px;width: 100px;">LOGIN</button><br>
            <span style = "color: rgb(255,0,0);font-size: 14px;font-weight: bold;margin-left: 65px"><?php echo $alert ?></span>
        </fieldset>
    </form>
</div>
</body>
</html>