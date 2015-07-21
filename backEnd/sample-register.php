<?php
/**
 * Created by PhpStorm.
 * User: PavelPC
 * Date: 21-Jul-15
 * Time: 10:42
 */
require_once('database.php');

$db = DB::getDB();

if(isset($_POST['submit'])) {
    $status = $db->insert('websites', array('host' => $_POST['username'], 'pole' => $stoinost));
    echo $status;
}else {
    ?>
    <form action="" method="post">
        <input type="text" name="username" id="username">
        <button type="submit" name="submit">go</button>
    </form>
<?php
}
?>