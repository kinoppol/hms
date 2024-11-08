<?php

function is_validated_email($email){
    return preg_match("/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/",$email);
}

?>