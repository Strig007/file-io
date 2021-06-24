<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h1>Registration Form</h1>
    <br>
    <?php
        define ("filePath","data.txt");
        $firstName = $lastName = $gender = $dob = $religion = $email = $userName = $password = "";
        $presentAddress = $permanentAddress = $phone = $personalLink = "";
        $firstNameErr = $lastNameErr = $genderErr = $dobErr = $religionErr = $emailErr = $userNameErr = $passwordErr = "";
        $flag = true;
        $sMessage = "";
        $rMessage = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (empty($_POST["fname"]))
            {
                $firstNameErr = "First name cannot be empty!";
                $flag = false;
            }
            else
            {
                $firstName = test_input($_POST["fname"]);
            }

            if (empty($_POST["lname"]))
            {
                $lastNameErr = "Last name cannot be empty!";
                $flag = false;
            }
            else
            {
                $lastName = test_input($_POST["lname"]);
            }

            if (empty($_POST["gender"]))
            {
                $genderErr = "Gender cannot be empty!";
                $flag = false;
            }
            else
            {
                $gender = test_input($_POST["gender"]);
            }

            if (empty($_POST["dob"]))
            {
                $dobErr = "Date of birth cannot be empty!";
                $flag = false;
            }
            else
            {
                $dob = test_input($_POST["dob"]);
            }

            if (empty($_POST["religion"]))
            {
                $religionErr = "Religion cannot be empty!";
                $flag = false;
            }
            else
            {
                $religion = test_input($_POST["religion"]);
            }

            if (empty($_POST["email"]))
            {
                $emailErr = "E-mail cannot be empty!";
                $flag = false;
            }
            else
            {
                $email = test_input($_POST["email"]);
            }

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

            if (empty($_POST["presentAddress"]))
            {
                $presentAddress = "";
            }
            else
            {
                $presentAddress = test_input($_POST["presentAddress"]);
            }

            if (empty($_POST["permanentAddress"]))
            {
                $permanentAddress = "";
            }
            else
            {
                $permanentAddress = test_input($_POST["permanentAddress"]);
            }

            if (empty($_POST["phone"]))
            {
                $phone = "";
            }
            else
            {
                $phone = test_input($_POST["phone"]);
            }
            
            if (empty($_POST["pwl"]))
            {
                $personalLink = "";
            }
            else
            {
                $personalLink = test_input($_POST["pwl"]);
            }

            if ($flag == true)
            {
                $firstName = test_input($_POST["fname"]);
                $lastName = test_input($_POST["lname"]);
                $gender = test_input($_POST["gender"]);
                $dob = test_input($_POST["dob"]);
                $religion = test_input($_POST["religion"]);
                $email = test_input($_POST["email"]);
                $presentAddress = test_input($_POST["presentAddress"]);
                $permanentAddress = test_input($_POST["permanentAddress"]);
                $phone = test_input($_POST["phone"]);
                $personalLink = test_input($_POST["pwl"]);
                $userName = test_input($_POST["uname"]);
                $password = test_input($_POST["password"]);

                $fileData = read();
                if (empty($fileData))
                {
                    $data[] = array("FirstName"=>$firstName, "LastName"=>$lastName, "Gender"=>$gender,
                    "DOB"=>$dob, "Religion"=>$religion, "Email"=>$email, "PresentAddress"=>$presentAddress,
                    "PermanentAddress"=>$permanentAddress, "Phone"=>$phone, "PersonalLink"=>$personalLink,
                    "UserName"=>$userName, "Password"=>$password);
                }
                else
                {
                    $data = json_decode($fileData);
                    array_push($data, array("FirstName"=>$firstName, "LastName"=>$lastName, "Gender"=>$gender,
                    "DOB"=>$dob, "Religion"=>$religion, "Email"=>$email, "PresentAddress"=>$presentAddress,
                    "PermanentAddress"=>$permanentAddress, "Phone"=>$phone, "PersonalLink"=>$personalLink,
                    "UserName"=>$userName, "Password"=>$password));
                }
                $data_encode = json_encode($data, true);
                write("");
                $result = write($data_encode);
                if ($result)
                {
                    $sMessage = "Successfully Saved!";
                }
                else
                {
                    $rMessage = "Error While Saving!";
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

        function write($content)
        {
            $resource = fopen(filePath, "w");
            $fw = fwrite($resource,$content . "\n");
            fclose($resource);
            return $fw;
        }

        function read()
        {
            $resource = fopen(filePath, "r");
            $fz = filesize(filePath);
            $fr = "";
            if ($fz > 0)
            {
                $fr = fread($resource,$fz);
            }
            fclose($resource);
            return $fr;
        }

    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset>
            <legend>Basic Information:</legend>
            <br>
            <label for="fname">First Name: </label>
            <input type="text" id="fname" name="fname"> <span style="color: red;">* <?php echo $firstNameErr;?></span>
            <br><br>
            <label for="lname">Last Name: </label>
            <input type="text" id="lname" name="lname"> <span style="color: red;">* <?php echo $lastNameErr;?></span>
            <br><br>
            
            <label for="gender">Gender: </label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="gender">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="gender">Female</label> <span style="color: red;">* <?php echo $genderErr;?></span>
            <br><br>

            <label for="dob">Date of Birth: </label>
            <input type="date" id="dob" name="dob"> <span style="color: red;">* <?php echo $dobErr;?></span>
            <br><br>

            <label for="religion">Religion: </label>
            <select name="religion" id="religion">
                <option value="muslim">Muslim</option>
                <option value="christian">Christian</option>
                <option value="hindu">Hindu</option>
                <option value="buddhist">Buddhist</option>
            </select>
            <span style="color: red;">* <?php echo $religionErr;?></span>
            <br>
        </fieldset>
        <br>
        
        <fieldset>
            <legend>Contact Information:</legend>
            <br>
            <label for="preaddress">Present Address: </label>
            <br>
            <textarea name="presentAddress" id="preaddress" cols="30" rows="10" placeholder="Enter Present Address"></textarea> 
            <br><br>
            <label for="peraddress">Permanent Address: </label>
            <br>
            <textarea name="permanentAddress" id="peraddress" cols="30" rows="10" placeholder="Enter Permanent Address"></textarea>
            <br><br>

            <label for="phone">Phone: </label>
            <input type="tel" id="phone" name="phone" placeholder="222-11-333" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"> <br> <br>

            <label for="email">Email: </label>
            <input type="email" id="email" name="email"> <span style="color: red;">* <?php echo $emailErr;?></span>
            <br><br>

            <label for="pwl">Personal Website Link: </label>
            <input type="url" id="pwl" name="pwl"> <br>

        </fieldset>
        <br>

        <fieldset>
            <legend>Account Information:</legend>
            <br>
            <label for="uname">User Name: </label>
            <input type="text" id="uname" name="uname"> <span style="color: red;">* <?php echo $userNameErr;?></span>
            <br><br>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password"> <span style="color: red;">* <?php echo $passwordErr;?></span>
        </fieldset>
        <br>
        <input type="submit" name="submit" value="Submit"> <span><a href="login.php">Back To Login</a></span>
    </form>
    <span style="color: green;"><?php echo $sMessage;?></span>
    <span style="color: red;"><?php echo $rMessage;?></span>


</body>
</html>