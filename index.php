<?php

include 'src/api-endpoint.php';

echo json_encode(rsp($UserIp, $UserCity, $greet));

?>