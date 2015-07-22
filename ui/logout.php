<?php
session_start();
session_unset();
session_destroy();
echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=index.php\" >";
?>