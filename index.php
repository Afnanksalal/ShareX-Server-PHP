<?php
$your_domain_url = 'https://share-x-server-php.vercel.app/'; //the Domain Url you want to use for the image server
$file_directory = "/"; //the file directory where the images should be saved or used from
$lenght_of_file_name = 12; //lenght of the file name
$secret_key = "secretkey"; //your secret key

function RandomString($length) {
    $keys = array_merge(range('A', 'Z'));
    $key = "";
    for ($i=0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}

if (isset($_POST['secret_key'])) {
    if ($_POST['secret_key'] == $secret_key) {
        $filename = RandomString($lenght_of_file_name);
        $target_file = $_FILES["images"]["name"];
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["images"]["tmp_name"], $file_directory.$filename.'.'.$fileType)) {
            echo $your_domain_url.$file_directory.$filename.'.'.$fileType;
        } else {
            echo 'The image failed to upload!';
        }
    } else {
        echo 'Secret key is missing or invalid!';
    }
} else {
    echo 'No POST data has been receved!';
}
?>
