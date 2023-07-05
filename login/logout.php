<?php

session_start();
session_destroy();

header("Location: ../"); // ending a session

?>
