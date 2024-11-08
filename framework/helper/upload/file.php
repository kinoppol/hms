<?php

function upload_file($upload_files,$target_paths,$files_name=array()) {

    # Convert input to array
    [$upload_files,$target_paths,$files_name] = var2arr($upload_files,$target_paths,$files_name);

    # Upload operation
    
    $upload_name = var2arr($upload_files['name']);
    $tmp_name = var2arr($upload_files['tmp_name']);
    $file_count = count($upload_name);

    $uploaded_files = array();
    for($i=0;$i<$file_count;$i++) {

        # If no directory, create one
        if (!is_dir($target_paths[$i])) {
            mkdir($target_paths[$i], 0777, true);
        }

        $target_file = $target_paths[$i].'/'.$files_name[$i];

        # If custom name name have no extension, put extension from original name
        if(!preg_match("/./",$files_name[$i]))
        {
            $target_file .= strtolower(pathinfo($upload_name[$i], PATHINFO_EXTENSION));
        }

        # Upload file
        if(move_uploaded_file($tmp_name[$i],$target_file)){
            $uploaded_files[]=$target_file;
        }
    }

    if(count($uploaded_files)==1){
        return $uploaded_files[0];
    }
    return $uploaded_files;

}

?>