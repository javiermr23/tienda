
<?php
    require "./class/init.php";

    session_destroy();
    header("Location: ./index.php");
?>