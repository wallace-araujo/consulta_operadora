<?php
session_start();

session_unset(); 
session_destroy(); 

$redirect = $_SERVER['HOST'] . ".";
header("location:$redirect");