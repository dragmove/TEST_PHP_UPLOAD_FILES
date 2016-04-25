<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>File upload sample</title>
  <style type="text/css">
    body {
      font-weight: normal;
      font-style: normal;
    }
    a {text-decoration:none;}
    
    .drag-container {
      position:relative;
      height:200px;
    }

    #drag-obj {
      position: absolute;
      top: 0;
      left: 0;
      width: 100px;
      height: 100px;
      background: #f00;

      user-select: none;
      -ms-user-select: none;
      -moz-user-select: none;
      -webkit-user-select: none;
    }

    #drop-zone {
      width: 100px;
      height: 100px;
      border: 1px solid #f00;
    }
    
    /* TEST */
    .drag-container {
      display: none;
    }
  </style>

</head>

<body>
  <div id="container">
    <?php
      ini_set("display_errors", 1);

      $title = "File upload sample.";
      echo "<h1>this is {$title}</h1>";
    ?>

    <h3>multiple file upload - use a number of inputs</h3>
    <form action="upload_files.php" method="post" enctype="multipart/form-data">
      <input name="userfile[]" type="file" /><br />
      <input name="userfile[]" type="file" /><br />
      <input name="userfile[]" type="file" /><br />

      <input type="submit" value="upload files" />
    </form>
    
    <h3>multiple file upload - use one input attributed multiple</h3>
    <form action="upload_files.php" method="post" enctype="multipart/form-data">
      <input name="userfile[]" type="file" multiple /><br />
      <input type="submit" value="upload files" />
    </form>


    <h3>file upload by drag and drop - upload by ajax</h3>
    <div class="drag-container">
      <div id="drag-obj" draggable="true"></div>
    </div>

    <div class="drop-container">
      <div id="drop-zone">
        drag file into this drop zone.
      </div>

      <button id="btn-upload">upload files</button>
    </div>
    <div id="desc-file">
    </div>
  </div>

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script>
    (function($) {
      "use strict";

      function isSupportDraggable() {
        var div = document.createElement('div');
        return ('draggable' in div);
      }

      function isSupportDragAndDrop() {
        var div = document.createElement('div');
        return ('ondragstart' in div && 'ondrop' in div);
      }

      function isSupportFileApi() {
        return !!(window.File && window.FileReader && window.FileList && window.Blob);
      }

      $(document).ready(function() {
        if( !isSupportDraggable() ) {
          window.alert( 'this browser does not support draggable attribute' );
        }

        if( !isSupportDragAndDrop() ) {
          window.alert( 'this browser does not support methods related drag.' );
        }

        if( !isSupportFileApi() ) {
          window.alert( 'this browser does not support File API.' );
        }

        var files = [];

        var dragObj = $('#drag-obj').get(0);
        dragObj.ondragstart = function() {
        };
        dragObj.ondrag = function() {
        };
        dragObj.ondragend = function() {
          window.alert( 'dragend div.' );
        };

        $('#drop-zone').on({
          'dragenter': function(event) {
            // enter
          },
          'dragleave': function(event) {
            // leave
          },
          'dragover': function(event) {
            event.preventDefault();
          },
          'drop' : function(event) {
            event.preventDefault();
            window.alert('drop file in drop-zone.');

            files = event.originalEvent.dataTransfer.files;
            if(files && files.length) {
              var output = '';

              for(var i=0, max=files.length; i<max; i++) {
                var file = files[i];
                output += '<p>name : ' + file.name + '</p>';
                output += '<p>type : ' + file.type + '</p>';
                output += '<p>size : ' + file.size + '</p>';
                output += '<p>lastModifiedDate : ' + file.lastModifiedDate + '</p>';
                output += '<br>';
              }
              $('#desc-file').html(output);

            }else{
              window.alert( 'no file' );
            }
          }
        });

        $('#btn-upload').on('click', function(event) {
          event.preventDefault();
          if(files.length <= 0) {
            window.alert( 'no file is selected.' );
          }else{
            sendFiles(files);
          }
        });

        function sendFiles(files) {
          for(var i=0; i<files.length; ++i) {
            sendFile(files[i]);
          }
        }

        function sendFile(file) {
          var formData = new FormData();
          formData.append('userfile', file);

          $.ajax({
            type: 'POST',
            url: 'upload_dropzone_files.php',
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
            },
            success: function(data, textStatus, jqXHR) {
              console.log('success data :', data);
            },
            error: function(jqXHR, textStatus, error) {
              console.log('error :'. jqXHR);
            }
          });
        }

      });
    }(jQuery));
  </script>
</body>

</html>
