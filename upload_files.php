<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Bitnami: Open Source. Simplified</title>
</head>

<body>
  <div id="container">
    <?php
      ini_set("display_errors", 1);

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

      if($_FILES['userfile']) {
        $file_arr = arragneFiles( $_FILES['userfile'] );

        foreach($file_arr as $file) {
          echo nl2br("name : " . $file['name'] . "\n");
          echo nl2br("type : " . $file['type'] . "\n");
          echo nl2br("size : " . $file['size'] . "\n");
        }
      }else{
        echo 'no files';
      }
    ?>
  </div>
</body>

</html>
