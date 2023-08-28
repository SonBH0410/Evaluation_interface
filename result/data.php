<?php 
    $true = 0; $false = 0; $none = 0;
    $numofPicture = $_POST['nop'];
    $numofFolder = $_POST['nof'];
    $account = $_POST['account'];
    $type = $_POST['type'];

    $checkfolder = $type . '_' . $account . '/person' . $numofFolder;
    $o1 = fopen($checkfolder . '/data'. $numofFolder . '.txt', 'a');
    for ( $i = 0; $i < $numofPicture ; $i ++ ){
        $result = 'danhgia' . $i;
        $user= trim($_POST[$result]);
        if ( $user == 'agree') {
            $true ++; $a = $i + 1;
            fwrite($o1, $a . "\t" );
        } elseif ( $user == 'disagree' ) {
            $false ++;
        } else {
            $none ++;
        }
    }
    $precision = round($true / $numofPicture, 5);
    fwrite($o1, "\n" . 'Độ chính xác = ' . $precision . "\n");
    fclose($o1);
    echo $numofFolder;
?>
