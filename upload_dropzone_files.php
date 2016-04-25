<?php
  ini_set("display_errors", 1);

  if ( 0 < $_FILES['userfile']['error'] ) {
    echo json_encode( array('result' => false, 'status' => 405, 'description' => 'file error') );
  } else {

    if( !empty($_FILES['userfile']) ) {
      if( move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/' . $_FILES['userfile']['name']) ) {
        echo json_encode( array('result' => true, 'status' => 200, 'filename' => $_FILES['userfile']['name'], 'description' => 'file upload is success.') );
      }else{
        echo json_encode( array('result' => false, 'status' => 500, 'filename' => $_FILES['userfile']['name'], 'description' => 'file upload is failed.') ); 
      }
    }else{
      echo json_encode( array('result' => false, 'status' => 405, 'description' => 'no upload file.') );
    }
  }

  

  // echo json_encode( array('success' => 'Form was submitted', 'formData' => $_FILES) );


  /*
  define('FILE_UPLOAD_PATH', getcwd() . '/uploads/');

  $file = $_FILES['userfile']['name'];

  if( !empty($file) ) {
    $target = FILE_UPLOAD_PATH . $file;

    if( move_uploaded_file($_FILES['userfile']['tmp_name'], $target) ) {
      echo 'success';
    }else{
      echo 'fail';
    }
    
    // $file_arr = arragneFiles( $_FILES['userfile'] );
    // $file_keys = array_keys($_FILES['userfile']);


    // echo $_FILES['userfile']['name'];


    // echo 'yes';

    exit;

    
    $file_arr = arragneFiles( $_FILES['userfile'] );

    foreach($file_arr as $file) {
      echo nl2br("name : " . $file['name'] . "\n");
      echo nl2br("type : " . $file['type'] . "\n");
      echo nl2br("size : " . $file['size'] . "\n");
    }
    
  }else{
    echo 'no';
  }

  function arragneFiles(&$files) {
    $file_arr = array();
    $file_count = count($files['name']);
    $file_keys = array_keys($files);

    for($i=0; $i<$file_count; $i++) {
      foreach ($file_keys as $key) {
        $file_arr[$i][$key] = $files[$key][$i];
      }
    }

    return $file_arr;
  }
  */

  /*
  

  if($_FILES['userfile']) {
    $file_arr = arragneFiles( $_FILES['userfile'] );

    foreach($file_arr as $file) {
      echo nl2br("name : " . $file['name'] . "\n");
      echo nl2br("type : " . $file['type'] . "\n");
      echo nl2br("size : " . $file['size'] . "\n");
    }
  }else{
    echo 'no';
  }


  <?php
    ini_set("display_errors", 1);

    if( isset($_FILES['userfile']) ) {
      move_uploaded_file($_FILES['userfile']['tmp_name'], "uploads/" . $_FILES['userfile']['NAME']);
      exit;
    }
  ?>
  */
?>
