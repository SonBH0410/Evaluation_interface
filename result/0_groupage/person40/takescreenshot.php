<?php
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $image = $_POST["image"];
    $image = explode(";", $image)[1];
    $image = explode(",", $image)[1];
    $image = str_replace(" ", "+", $image);
    $imgnew = base64_decode($image);
    file_put_contents("screenshot_" . date("ymd") . "_". date("His") . ".jpeg", $imgnew);
    echo "Done";
?>