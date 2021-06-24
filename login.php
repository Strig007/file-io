<?php
        define ("filePath","data.txt");
        $userName = $password = "";
        $userNameErr = $passwordErr = "";
        $loginFailed = "";
        $flag = true;
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (empty($_POST["uname"]))
            {
                $userNameErr = "User name cannot be empty!";
                $flag = false;
            }
            else
            {
                $userName = test_input($_POST["uname"]);
            }

            if (empty($_POST["password"]))
            {
                $passwordErr = "Password cannot be empty!";
                $flag = false;
            }
            else
            {
                $password = test_input($_POST["password"]);
            }


            if ($flag == true)
            {
                $user_data = read();
                $obj = json_decode($user_data);
                $f = false;
                for ($i = 0; $i < count($obj); $i++)
                {
                    if ($obj[$i]->UserName == $userName and $obj[$i]->Password == $password)
                    {
                        $f = true;
                        header("Location: welcome.php");
                        break;
                    }
                }
                if ($f == false)
                {
                    $loginFailed = "Login Failed! Please Try Again!";
                }
            }

        }

        function test_input($data)
        {
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = stripslashes($data);
            return $data;
        }

        function read()
        {
            $fo = fopen(filePath, "r");
            $fz = filesize(filePath);
            $fr = "";
            if ($fz > 0)
            {
                $fr = fread($fo,$fz);
            }
            fclose($fo);
            return $fr;
        }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <fieldset>
            <legend>Login Form:</legend>
            <br>
            <label for="uname">User Name: </label>
            <input type="text" id="uname" name="uname"> <span style="color: red;">* <?php echo $userNameErr;?></span>
            <br><br>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password"> <span style="color: red;">* <?php echo $passwordErr;?></span>
            <br><br>
            <input type="submit" name="submit" value="Login">
            <br><br>
            <span style="color: red;"><?php echo $loginFailed;?></span>
            <br><br>
            <span>New User? <a href="registration-form.php">Register Here!</a></span>
            <br>
        </fieldset>
    </form>
</body>
</html>