<!DOCTYPE html>
<html>
<head>
    <title>XOMBO Skills Assessment</title>
</head>
<body>
<h1>XOMBO Skills Assessment</h1>

<?php

    $resourceUrl = 'http://jsonplaceholder.typicode.com/photos';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $resourceUrl);
    $output = curl_exec($ch);
    curl_close($ch);


    $imageArray = json_decode($output, true);

    //echo $imageArray[0]["url"];



    for($i = 0; $i < count($imageArray); $i++)
    {
        echo '<img src="'.$imageArray[$i]["url"].'"alt=""/>';
        "\r\n";
    }



?>

</body>
</html>