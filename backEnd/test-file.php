<script type="text/javascript">
    d = document;
    d.write('<a href="http://interns.north.icnhost.net/" title="ICN Interns monitoring">' +
    '<img  border="0" alt="ICN Interns monitoring" src="http://interns.north.icnhost.net/test.php?platform=' + navigator.platform +
    '&codename=' + navigator.appCodeName +
    '&browservs=' + navigator.appVersion +
    '&cookies=' + navigator.cookieEnabled +
    '&language=' + navigator.language +
    '&width=' + screen.width +
    '&height=' + screen.height +
    '"</a>');
</script>
<?php
require_once('database.php');
$datetime = date("Y-m-d H:i:s");
$date = date("Y-m-d");
$db = DB::getDB();
$ip = $_SERVER['REMOTE_ADDR'];


$countOfTimes = $db->query("SELECT * FROM visitors WHERE `ip` = ? AND `date` = ?", array($ip, $date))->count();
echo "<br ><br >";
if ($countOfTimes >= 1) {
    $thatTime = $db->get('visitors', array('ip', '=', $ip))->results()[0];
    $oldClicks1 = $thatTime->clicks;
    $id= $thatTime->id;
    $oldClicks2 = $oldClicks1 + 1;
    $res = $db->query("UPDATE visitors SET `clicks` = $oldClicks2 WHERE `ip` = '$ip' AND `date` = $date");
    $status = $db->update('visitors', 'id', $id, array('clicks' => $oldClicks2, 'date_update' => $datetime));
}else{
    $res = $db->insert('visitors', array('ip' => $ip, 'date' => $date, 'date_update' => $datetime, 'clicks' => 1));
}
$allClicks = $db->get('visitors', array('date', '=', $date))->results();
$allUniqueClicks = $db->query("SELECT * FROM visitors WHERE `date` = ?", array($date))->count();
$clicksToBeShown = 0;
foreach($allClicks as $click){
    $clicksToBeShown += $click->clicks;
}

$newdate = strtotime ( '-10 minute' , strtotime ( $datetime ) ) ;
$newdate = date("Y-m-d H:i:s" , $newdate );

echo '<br >' . (strtotime($datetime) - strtotime($newdate));




?>