<?php // Script 8.9 - register.php
/* This page lets people register for the site (in theory). */

// Print some introductory text:
print '<h2>Login Form</h2>
	<p>Register so that you can take advantage of certain features like this, that, and the other thing.</p>';

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $problem = false; // No problems so far.

    // Check for each value...
    if (empty($_POST['username'])) {
        $problem = true;
        print '<p class="text--error">Please enter a Username!</p>';
    }

    if (empty($_POST['password'])) {
        $problem = true;
        print '<p class="text--error">Please enter a password!</p>';
    }
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        checkLogin();
    }
    function checkLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $loginInfo = loadLoginInfo();
        $length = count($loginInfo);
        for ($i = 0; $i < $length; $i++)
        {
            $infoArray = explode(" ", $loginInfo[i]);
            if ($username == $infoArray[0] && $password == $infoArray[1])
            {
                return true;
            }
        }
        echo "<script>alert('Invalid Username or Password.');</script>";
        return false;
    }
    function loadLoginInfo()
    {
        $file = fopen("loginInfo.txt","r");
        $loginInfo = array();
        while(! feof($file))
        {
            $line = fgets($file);
            $loginInfo.push($line);
        }
        fclose($file);
        return $loginInfo;
    }

    if (!$problem) { // If there weren't any problems...

        // Print a message:
        print '<p class="text--success">Successfully Logged in.</p>';

        // Clear the posted values:
        $_POST = [];

    } else { // Forgot a field.

        print '<p class="text--error">Please try again!</p>';

    }

} // End of handle form IF.

// Create the form:
?>
<form action="process_registration.php" method="post" class="form--inline">

    <p><label for="username">Username:</label><input type="text" name="username" size="20" value="<?php if (isset($_POST['username'])) { print htmlspecialchars($_POST['username']); } ?>"></p>

    <p><label for="password">Password:</label><input type="password" name="password" size="20" value="<?php if (isset($_POST['password'])) { print htmlspecialchars($_POST['password']); } ?>"></p>

    <p><input type="submit" name="submit" value="Login" class="button--pill"></p>

</form>

