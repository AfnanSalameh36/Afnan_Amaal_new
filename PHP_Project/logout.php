<?php
session_start();
session_unset();
session_destroy();

header("refresh:0;url=../HTML_Project/index.html");  // Redirect to homepage after 3 seconds
exit;
?>
