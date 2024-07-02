<?php

include 'src/api.php';

echo json_encode(rsp($UserIp, $UserCity, $greet));

?>