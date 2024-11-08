<?php

http_response_code($status);
header('Content-Type: application/json');
print(json_encode($payload));

?>