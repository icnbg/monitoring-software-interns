<?php
require_once('database.php');

//Hello world in PDO :)
DB::getDB();


//Get simple data with query
$selectRowFromDB = DB::getDB()->query("SELECT * FROM websites WHERE host = ?", array('google.bg'));
if($selectRowFromDB->error()){
    echo 'Selecting row from db failed';
}else{
    echo 'Selecting row from db is ok!';
}
echo '<br>';

//Get simple data with simple query
$selectRowFromDB = DB::getDB()->get('websites',array('name', '=', 'Google'));
echo $selectRowFromDB->count();
echo '<br>';

//Insert simple data
if(DB::getDB()->insert('websites', array('host' => 'blabla.bg', 'name' => 'blabla'))){
    echo "Data add is OK! :)";
}else{
    echo "Data add is NOT OK! :(";
}
echo '<br>';

//Edit simple data
if(DB::getDB()->update('websites','id',3, array('host' => 'bdsadsadsa', 'name' => 'dsadsaadssda'))){
    echo "Data update is OK! :)";
}else{
    echo "Data update is NOT OK! :(";
}
echo '<br>';

//Insert data in visitors
$ip = $_SERVER['REMOTE_ADDR'];
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");
if(DB::getDB()->insert('visitors', array('ip' => $ip, 'date' => $date, 'date_update' => $datetime, 'clicks' => 1))){
    echo "Data add is OK! :)";
}else{
    echo "Data add is NOT OK! :(";
}
echo '<br>';