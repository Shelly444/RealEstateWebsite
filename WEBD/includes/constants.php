<?php
/*
Hector Mariscal, Bo Zheng, Michelle Kirkwood
2018-04-18
WEBD3201
*/

//User Type Constant Declarations
define("ADMIN","s");
define("AGENT","a");
define("CLIENT","c");
define("PENDING","p");
define("DISABLED","d");
define("INCOMPLETE", "i");

//Database Constants
define("DB_HOST","127.0.0.1");
define("DB_NAME","group09_db");
define("DB_PORT","5432");
define("DB_PASSWORD","password");
define("DB_USER","group09_admin");
//State Maintenance Constants
define("HASH_ALGO","md5");
define("COOKIE_LIFESPAN", "2592000");

//user generation constants
define("RECORDS", "1500");
define("USER_RECORDS", "1000");
define("MAX_LOGIN_LENGTH", "20");

//preferred contact method
define("EMAIL", "e");
define("PHONE", "p");
define("LETTER", "l");
define("FAX", "f");

define ("LISTINGS_TO_DISPLAY", 200);
define ("LISTINGS_PER_PAGE", 10);

//area/postal code validation
define("MAX_ID_LENGTH", "20");
define("MIN_AREA_CODE", "200");
define("MAX_AREA_CODE", "999");
define("POSTAL_CODE_LETTERS", "ABCEFGHJKLMNPRSTVXY");
define("POSTAL_CODE_LENGTH", "6");
define("MAX_NAME", "128");
define("MAX_CITY", "64");
define("MAX_PHONE_LENGTH", "15");
define("MIN_PASS", "8");

define("MINIMUM_CHARACTER_LENGTH", "10");

//Listing status
define("OPEN", "o");
define("SOLD", "s");
define("CLOSED", "c");
define("HIDDEN", "h");

?>
