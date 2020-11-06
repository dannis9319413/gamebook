<?php

if(!isset($_SESSION['admin']) && $_SESSION['admin'] == null) {
    header("location: ../login.php?Msg=loginfirst");
}

?>