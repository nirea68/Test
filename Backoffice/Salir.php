<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */

session_start();
session_destroy();

header("Location: index.php");

?>