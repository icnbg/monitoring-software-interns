<?php

//TODO: add site conretization

require_once('database.php');
header("Content-type: image/png");
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");
$db = DB::getDB();


$platform = $_GET['platform'];
$codename = $_GET['codename'];
$browserVersion = $_GET['browservs'];
$cookies = $_GET['cookies'];
$language = $_GET['language'];
$screenWidth = $_GET['width'];
$screenHeight = $_GET['height'];
$website = $_GET['website'];
$ip = $_SERVER['REMOTE_ADDR'];

$queryVisitedPage = $db->query("SELECT * FROM visitors WHERE `ip` = ? AND `date` = ?", array($ip, $date));

if ($queryVisitedPage->count() >= 1) {
    $impressionClick = $queryVisitedPage->results()[0];
    $impressionClicks = $impressionClick->clicks;
    $id = $impressionClick->id;
    $newClicks = $impressionClicks + 1;

    if ($impressionClick->date_update != $datetime) {
        $db->update('visitors', 'id', $id, array('clicks' => $newClicks, 'date_update' => $datetime));
    }
} else {
    $db->insert('visitors', array('ip' => $ip, 'date' => $date, 'date_update' => $datetime, 'clicks' => 1));
}

$allClicks = $db->get('visitors', array('date', '=', $date))->results();
$allUniqueClicks = $db->query("SELECT * FROM visitors WHERE `date` = ?", array($date))->count();
$clicksToBeShown = 0;
$onlineToBeShown = 0;
foreach ($allClicks as $click) {
    if ((strtotime($datetime) - strtotime($click->date_update)) < 600) {
        $onlineToBeShown += 1;
    }
    $clicksToBeShown += $click->clicks;
}


$im = imagecreatetruecolor(88, 31);
imagealphablending($im, false);
imagesavealpha($im, true);
$source = imagecreatefrompng("bg.png");
imagealphablending($source, true);
imagecopyresampled($im, $source, 0, 0, 0, 0, 88, 31, 88, 31);

$orange = imagecolorallocate($im, 220, 150, 60);
$px = (imagesx($im) - 7.5 * 3) / 2 + 5;
imagestring($im, 2, $px, 0, 'I:' . $clicksToBeShown, $orange);
imagestring($im, 2, $px, 9, 'U:' . $allUniqueClicks, $orange);
imagestring($im, 2, $px, 18, 'O:' . $onlineToBeShown, $orange);
imagepng($im);
imagedestroy($im);
/*
?platform=ds&codename=qw&browservs=gf&cookies=1&language=en&width=131&height=3131&website=blabla
*/
?>
