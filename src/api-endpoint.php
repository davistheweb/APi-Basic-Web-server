<?php

header('Content-Type: application/json');

function getUserIp(){
    if (getenv('HTTP_CLIENT_IP')){
        return getenv('HTTP_CLIENT_IP');
    }
    else if (getenv('HTTP_X_FORWARDED_FOR')) {
        return getenv('HTTP_X_FORWARDED_FOR');
    }
    else if (getenv('HTTP_X_FORWARDED')){
        return getenv('HTTP_X_FORWARDED');
    }
    else if (getenv('HTTP_FORWARDED_FOR')){
        return ('HTTP_FORWARDED_FOR');   
    }
    else if (getenv('HTTP_FORWARDED')) {
        return getenv('HTTP_FORWARDED');
    }
    else if (getenv('REMOTE_ADDR')){
    return getenv('REMOTE_ADDR');
    }
    else {
        return 'UNKNOWN IP';
    }
}

$UserIp = getUserIp();

if ($UserIp == '::1'){
    $UserIp = '8.8.8.8'; // default dns server used for testing
}

$userName = isset($_GET['visitor_name']) ? htmlspecialchars($_GET['visitor_name']) : 'User';

//Integration if IpInfo Api to get location infomation

$IpApiTokenKey = 'd4c4083a42fd48';

$IpApiUrl = "https://ipinfo.io/{$UserIp}?token={$IpApiTokenKey}";

$UserLocationData = json_decode(file_get_contents($IpApiUrl), true);

$UserCity = isset($UserLocationData['city']) ? $UserLocationData['city'] : 'UNKNOWN LOACTION';


// If city is unknown, Set to a default city for weather info

if($UserCity == 'Unknown Location'){
    $UserCity = 'New York';
}

$WeatherApiKey = '3dfb9919a4259f4cc65c6db7a0a6b35b';
$WeatherApiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$UserCity}&appid={$WeatherApiKey}&units=metric";
$WeatherData = json_decode(file_get_contents($WeatherApiUrl), true);

$UserLocationTemp = isset($WeatherData['main']['temp']) ? $WeatherData['main']['temp'] : 'Unknown';


$greet = "Hey, $userName !, the temperature is $UserLocationTemp degrees Celsius in $UserCity";


//$greet = greetUser();

function rsp($UserIpAdress, $UserLocation, $GreetUser){
    return
$response = array (
    "client_ip" => $UserIpAdress,
    "location" => $UserLocation,
    "greeting" => $GreetUser
);

};



?>