<!DOCTYPE html>
<html>
<head>
    <title>XOMBO Skills Assessment</title>
</head>
<body>
<h1>XOMBO Skills Assessment</h1>

<?php

    $resourceUrl = 'http://jsonplaceholder.typicode.com/photos';
    $ch = curl_init();//Initialize cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//Set cURL to return the result of the HTTP request
    curl_setopt($ch, CURLOPT_URL, $resourceUrl);//Set the url for the HTTP request
    $output = curl_exec($ch);//Execute request
    curl_close($ch);//Close cURL request


    $imageArray = json_decode($output, true);//Decode JSON result in PHP array

    //echo $imageArray[0]["url"];



    for($i = 0; $i < count($imageArray); $i++)
    {
        echo '<img src="'.$imageArray[$i]["url"].'"alt=""/>';//Print images from image array
    }



?>

</body>
</html>
