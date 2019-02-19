
<?php
    require "./php/init.php";

    session_destroy();
    header("Location: ./index.php");
?>