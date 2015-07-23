<?php
require_once('../backEnd/database.php');
session_start();
$currentUser = $_SESSION["isLoggedIn"];
$currentDate = date("Y-m-d");
$currentID = DB::getDB()->getWebsite($currentUser)->id; 
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1.1", {packages:["bar"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Day', 'Unique visits', 'Impressions'],
    <?php
    for($i = 0; $i< 5; $i++) {
      $allClicks = DB::getDB()->query("SELECT * FROM visitors WHERE `date` = ? AND `site_id` = ?", array($currentDate, $currentID))->results();
      $allUniqueClicks = DB::getDB()->query("SELECT * FROM visitors WHERE `date` = ? AND `site_id` = ?", array($currentDate, $currentID))->count();
      $clicksToBeShown = 0;
      foreach ($allClicks as $click) {
        $clicksToBeShown += $click->clicks;
      }
      echo "['" . json_encode($currentDate) . "', " . json_encode($allUniqueClicks) . ", ". json_encode($clicksToBeShown) . "],";
      $currentDate = date("Y-m-d", strtotime($currentDate) - 60*60*24);
    }
    ?>
    ]);

  var options = {
    chart: {
      subtitle: 'Unique visits and Impressions',
    }
  };

  var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

  chart.draw(data, options);
}
</script>
<div id="columnchart_material" style="width: 100%; height: 100%;"></div>