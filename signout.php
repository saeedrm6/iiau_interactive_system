<?php
function redirect_to($new_location){
    header("Location: ".$new_location);
    exit;
}
session_start();
session_unset();
session_destroy();
redirect_to('login.php');
