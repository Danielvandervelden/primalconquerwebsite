<?php
/* Log out process, unsets and destroys session variables */
session_destroy();
header("location: index.php");