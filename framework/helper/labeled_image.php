<?php
function upload_labeled_image($picture=array()){
  
  helper('upload/file');
  helper("image");

  $target_dir = "writable/labeled_images/";
  $imageFileType = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));
  $file_name = basename(microtime()) . '.' . $imageFileType;
  $uploadOk = 1;
  
  $check = getimagesize($picture["tmp_name"]);
  if($check !== false) {
      $uploadOk = 1;
  } else {
      $uploadOk = 0;
  }

  // Check file size
  if ($picture["size"] > 1000000) {
      //$this->error = "ไฟล์รูปมีขนาดเกิน 1 MB กรุณาเปลี่ยนรูปภาพแล้วลองใหม่อีกครั้ง";
      return false;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif") {
      //$this->error = "ผิดรูปแบบประเภทไฟล์ที่อนุญาต กรุณาตรวจสอบแล้วลองใหม่อีกครั้ง";
      return false;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      //$this->error = "ไฟล์รูปภาพมีปัญหา กรุณาเปลี่ยนรูปภาพแล้วลองใหม่อีกครั้ง";
      return false;

  // if everything is ok, try to upload file
  }

  $uploaded_file = upload_file($picture, $target_dir, $file_name);

  return array(
            'location'=>$target_dir.$file_name,
            'file_name'=>$file_name,
        );
}