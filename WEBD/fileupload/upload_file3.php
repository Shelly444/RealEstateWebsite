<?php
include ('./includes/upload.php');
echo $_FILES["form_file"]["type"]."<br/>";
echo "is_valid returns: " . is_valid_image_type($_FILES["form_file"]["type"])."<br/>";
if (is_valid_image_type($_FILES["form_file"]["type"])	
	&& ($_FILES["form_file"]["size"] < 2000000))
  {
  if ($_FILES["form_file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["form_file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["form_file"]["name"] . "<br />";
    echo "Type: " . $_FILES["form_file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["form_file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["form_file"]["tmp_name"] . "<br />";   
    
    if (file_exists("upload/" . $_FILES["form_file"]["name"]))
      {
        echo $_FILES["form_file"]["name"] . " already exists. ";
      }
    else
      {
	move_uploaded_file($_FILES["form_file"]["tmp_name"],
      		"upload/" . $_FILES["form_file"]["name"]);
	echo "Stored in: " . "upload/" . $_FILES["form_file"]["name"];
      //move_uploaded_file($_FILES["form_file"]["tmp_name"],"upload/123456_1.gif");
      //echo "Stored in: " . "/upload/123456_1.gif";
      }
    
    }
  }

else
  {
  echo "Invalid file";
  }

?>