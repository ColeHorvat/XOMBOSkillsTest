<!DOCTYPE html>
<html>
<head>
    <title>XOMBO Skills Assessment</title>

    <style>
        img
        {
            vertical-align: middle;
            padding-right: 50px;
        }
    </style>
</head>
<body>
<h1>XOMBO Skills Assessment</h1>

<?php
    //Initialize url variables
    $imageUrl = 'http://jsonplaceholder.typicode.com/photos';
    $userUrl = 'http://jsonplaceholder.typicode.com/users';


    //Get images from API
    $chIm = curl_init(); //Initialize curl for images
    curl_setopt($chIm, CURLOPT_RETURNTRANSFER, true);//Set image curl to return the result of the HTTP request
    curl_setopt($chIm, CURLOPT_URL, $imageUrl);//Set the url for the HTTP request
    $outputImg = curl_exec($chIm);//Execute image request
    curl_close($chIm);//Close Image curl

    //Get user data from API
    $chUs = curl_init(); //Initialize curl for user data
    curl_setopt($chUs, CURLOPT_RETURNTRANSFER, true);//Set user curl to return the result of the HTTP request
    curl_setopt($chUs, CURLOPT_URL, $userUrl);//Set the url for the HTTP request
    $outputUs = curl_exec($chUs);//Execute image request
    curl_close($chUs);//Close Image curl

    //Decode JSON data into PHP array
    $imageArray = json_decode($outputImg, true);
    $userArray = json_decode($outputUs, true);


    for($i = 0; $i < count($userArray); $i++) {
        //Google Geocode API url
        $mapUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $userArray[$i]["address"]["geo"]["lat"] . "," . $userArray[$i]["address"]["geo"]["lng"] . "&key=AIzaSyCunoownIosjZzWw_AFr8HkVrOWjSnpeAs";

        $chMap = curl_init();//Initialize curl for map
        curl_setopt($chMap, CURLOPT_RETURNTRANSFER, true);//Set map curl to return the result of the HTTP request
        curl_setopt($chMap, CURLOPT_SSL_VERIFYPEER, false);//Stops curl from verifying the peer's certificate
        curl_setopt($chMap, CURLOPT_URL, $mapUrl);//Set the url for the HTTP request
        $outputLocation = curl_exec($chMap);//Execute maps request
        curl_close($chMap);//Close map curl

        $locationArray = json_decode($outputLocation, true);//Decode maps JSON into PHP array

        echo '<img src="' . $imageArray[$i]["url"] . '"alt=""/>';//Print image

        echo '<div class="userInfo" style="padding-left: 50px; display: inline-block">';//Create text div

        //User Variables
        $userName = $userArray[$i]["name"];
        $userId = $userArray[$i]["id"];
        $userUsername = $userArray[$i]["username"];
        $userEmail = $userArray[$i]["email"];
        $userSuite = $userArray[$i]["address"]["suite"];
        $userStreet = $userArray[$i]["address"]["street"];
        $userCity = $userArray[$i]["address"]["city"];
        $userZip = $userArray[$i]["address"]["zipcode"];
        $userLocation = $locationArray["results"][0]["formatted_address"];

        //Print user info
        echo "Name: " . $userName;//Name of user
        echo "<br>User Id: " . $userId;//Id of user
        echo "<br>Username: " . $userUsername;//Username of user
        echo "<br>Email: " . $userEmail;//Email of user
        echo "<br>Address: " . $userSuite . " " . $userStreet . ", " . $userCity . " " . $userZip;//Full address of user
        if (!empty($userLocation)) {
            echo "<br>Current Location: " . $userLocation;//Get name of location if coordinates are valid
        } else {
            echo "<br>Current Location: No location found";//If coordinates are not valid
        }

        echo '</div>';//end div
        echo "<br>";//new line
    }
?>

</body>
</html>