<?php
session_start();


if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] === 1) {
echo 'Hi';

} else {
    if (isset($_POST['submit']) && $_POST['pass_admin'] == '12345') {
        $_SESSION["isLoggedIn"] = 1;
        echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"1;URL=\" >";
    } else {
        ?>
        <form action="" method="post">
            Парола: <input type="password" name="pass_admin" size="10">
            <input type="submit" name="submit" value="Влез">
        </form>
    <?php
    }
}
?>