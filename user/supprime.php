<?php
//An open session is destroyed using three functions
session_start ();

session_unset ();

session_destroy ();

//We create a redirect to go back to the main page
header ('location: ../public/index.php');