<?php
$domainUrl = 'https://yourdomain.com/'; //the you want to use for the image server
$fileDir = "u/"; //the file directory where the images should be saved or used from
$fileNameLength = 7; //lenght of the file name
$secretKey = "secretkey"; //your private secret key

function RandomString($length) {
    $keys = array_merge(range(0,9), range('a', 'z'));
    $key = "";
    
    for ($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }

    return $key;
}

if (isset($_POST['secret_key'])) {
    if ($_POST['secret_key'] == $secretKey) {
        $filename = RandomString($fileNameLength);
        $target_file = $_FILES["share_x"]["name"];
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["share_x"]["tmp_name"], $fileDir.$filename.'.'.$fileType)) {
            echo $domainUrl.$fileDir.$filename.'.'.$fileType;
        } else {
            echo 'The image failed to upload';
        }
    } else {
        echo 'Secret key is missing or invalid';
    }
} else {
    echo '>No POST data has been receved';
}
