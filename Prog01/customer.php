<?php

require "database.php";
require "customers.class.php";
$cust = new Customers();

if(isset($_POST["name"])) $cust->name = $_POST["name"];
if(isset($_POST["email"])) $cust->email = $_POST["email"];
if(isset($_POST["mobile"])) $cust->mobile = $_POST["mobile"];

if(isset($_GET["fun"])) $fun = $_GET["fun"];
else $fun = 0;

switch ($fun) {
    case 1: // create
        $cust->create_record();
        break;
    case 2: // read
        $cust->read_record();
		break;
    case 3: // update
        $cust->update_record();
        break;
    case 4: // delete
        $cust->delete_record();
        break;
    case 11: // insert database record from create_record()
        $cust->insert_record();
        break;
    case 33: // update database record from update_record()
        $cust->update_data();
        break;
    case 44: // delete database record from delete_record()
		$cust->delete_data();
        break;
    case 0: // list
    default: // list
        $cust->list_records();
}