<?php
session_start();
/**
 * Created by PhpStorm.
 * User: PavelPC
 * Date: 21-Jul-15
 * Time: 10:42
 */
require_once('../backEnd/database.php');

$db = DB::getDB();
if (isset($_SESSION["isLoggedIn"])) {
echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=index.php\" >";
} else {
    ?>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ICN Monitoring Login</title>

        <!-- Bootstrap core CSS -->

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/icheck/flat/green.css" rel="stylesheet">


        <script src="js/jquery.min.js"></script>

    </head>

    <body style="background:#F7F7F7;">


    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <?php
                if (isset($_POST['login'])) {
                    $user = $_POST['username2'];
                    $pass = $_POST['password2'];
                    $websiteFromHost = DB::getDB()->getWebsite($user);
                    if($websiteFromHost->password == $pass){
                        $_SESSION["isLoggedIn"] = $user;
                        echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=index.php\" >";
                    } else {
                        die("SELECT * FROM websites WHERE host = $user AND password = $pass");
                    }
                } else {
                    ?>
                    <section class="login_content">
                        <form action='' method='post'>

                            <h1>Login Form</h1>

                            <div>
                                <input name="username2" type="text" class="form-control" placeholder="Username"
                                       required=""/>
                            </div>
                            <div>
                                <input name="password2" type="password" class="form-control" placeholder="Password"
                                       required=""/>
                            </div>

                            <div>
                                <button type="submit" name="login" class="btn btn-default submit">Log in</button>
                                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">

                                <p class="change_link">New to site?
                                    <a href="#toregister" class="to_register"> Create Account </a>
                                </p>

                            </div>
                        </form>
                        <!-- form -->
                    </section>
                <?php
                }
                ?>
                <!-- content -->
            </div>
            <div id="register" class="animate form">

                <?php
                if (isset($_POST['submit'])) {

                    $username = $_POST['username1'];
                    $password = $_POST['password1'];
                    $website = $_POST['website1'];
                    $datetime = date("Y-m-d H:i:s");
                    $status = $db->insert('websites', array('name' => $username, 'password' => $password, 'host' => $website, 'date' => $datetime ));
					?>
					<section class="login_content">
					<p>Registration was successfull!</p>
					<a href="#tologin" class="to_register"> Log in </a>
					</section>
					<?php
                } else {
                    ?>
                    <section class="login_content">
                        <form action='' method='post'>
                            <h1>Create Account</h1>

                            <div>
                                <input name="username1" type="text" class="form-control" placeholder="Username"
                                       required=""/>
                            </div>
                            <div>
                                <input name="password1" type="password" class="form-control" placeholder="Password"
                                       required=""/>
                            </div>
                            <div>
                                <input name="website1" type="website" class="form-control" placeholder="Website"
                                       required=""/>
                            </div>
                            <div>
                                <button type="submit" name="submit" class="btn btn-default submit">Submit</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">

                                <p class="change_link">Already a member ?
                                    <a href="#tologin" class="to_register"> Log in </a>
                                </p>

                            </div>
                        </form>
                        <!-- form -->
                    </section>
                <?php
                }
                ?>
                <!-- content -->
            </div>
        </div>
    </div>

    </body>
    </html>
<?php
}
?>
