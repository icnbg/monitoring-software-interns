<?php
error_reporting(0);
require_once('../backEnd/database.php');
session_start();
   $currentUser = $_SESSION["isLoggedIn"];
   $currentDate = date("Y-m-d");
   $currentDate = date("Y-m-d", strtotime($currentDate) - 60*60*24);
    ?>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      google.load('visualization', '1.0', {'packages':['corechart']});

      google.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Operating System');
        data.addColumn('number', 'Slices');
        data.addRows([

          <?php
          
          
          $currentID = DB::getDB()->getWebsite($currentUser)->id;
          $arrayWithOS = array();
          $query = DB::getDB()->query("SELECT * FROM visitors WHERE `date` = ? AND `site_id` = ?", array($currentDate, $currentID));
          foreach($query->results() as $singleVisitor){
              $arrayWithOS[$singleVisitor->platform] += 1;
          }

          $blabla = array_keys($arrayWithOS);
          for($i = 0; $i < count($blabla); $i++){
          echo "[" . json_encode($blabla[$i]) . ", " . json_encode($arrayWithOS[$blabla[$i]]) ."],";

          }          
       //   echo "['$value->name', $value->clicks],";
          
          ?>
        ]);

        var options = {
                       'width':390,
                       'height':290,
                       'fontName': 'Calibri',
                       'fontSize':14,
                        is3D: true};

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            
        chart.draw(data, options);
      }

    </script>
    <div id="chart_div" style="width:100%; height:100%"></div>  
  