<?php

if ($_FILES["form_file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["form_file"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["form_file"]["name"] . "<br />";
  echo "Type: " . $_FILES["form_file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["form_file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["form_file"]["tmp_name"];
  }

?>