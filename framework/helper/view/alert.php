<?php

function gen_alert($alert) {
    $msg = '<div class="alert alert-'.$alert['type'].'" role="alert">'.$alert['message'].'</div>';
    echo $msg;
}

?>