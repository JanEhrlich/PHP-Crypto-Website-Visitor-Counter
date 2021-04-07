<?php
/**
 * MIT License
 * Copyright(c) 2021 Jan Ehrlich
 * 
 * This is a simple counter which saves the counter values on encrypted files on your server.
 * Just specify the path to the file and the key and the script will do the rest.
 * Empty files are the initial condition. So just create an empty file and start counting from 0.
 * 
 * Why?
 * -If you have a simple website and don't want to create a database at all.
 * -If you have certain things you want to count but not everybody else should be able to see the current count.
 * -Perfect Privacy as no user data will be requested. So it can be a very simple website visitor counter
 */
require_once "crypto.php";

//Specify the path to the counting file
$counter_path = "counter/counter1.txt";

//Specify the key which is used for the encryption. The key doesn't need to be extremely long because it will be hashed anyways.
$key = "KeyOfArbitraryLength";

function saveValueToFile($dir, $value){
    global $key;

    $file = fopen($dir,"w");
    $initialContent = encrypt(strval($value),$key);
    fwrite($file, $initialContent);
    fclose($file);
    return $initialContent;
}

function initializeFile($dir){
    return saveValueToFile($dir,0);
}

function getFileContent($dir){
    $encryptedText = "";

    if (file_exists($dir)) {
        $file = fopen($dir,"r");

        if (filesize($dir) == 0){
            $encryptedText = initializeFile($dir);
        }

        if (filesize($dir) > 0){
            $encryptedText = fread($file, filesize($dir));
        }
      
        fclose($file);

        return $encryptedText;
    }
}

function getCurrentCounterValue($dir){
    global $key;
    $counterValue = 0;

    $encryptedText = getFileContent($dir);
    $pltxt = decrypt($encryptedText,$key);
    $counterValue = intval($pltxt);

    return $counterValue;
}

function incrementCounterValue($dir){
    $counterValue = getCurrentCounterValue($dir);

    $newValue = $counterValue+1;
    saveValueToFile($dir, $newValue);
}

incrementCounterValue($counter_path);
echo getCurrentCounterValue($counter_path);

?>