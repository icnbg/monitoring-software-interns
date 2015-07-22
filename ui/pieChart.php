<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      google.load('visualization', '1.0', {'packages':['corechart']});

      google.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'SiteName');
        data.addColumn('number', 'Slices');
        data.addRows([

          <?php
          require_once('../backEnd/database.php');
          $db = DB::getDB();

          $info = $db->query('SELECT websites.name, visitors.clicks FROM websites, visitors WHERE websites.id = visitors.site_id');
          foreach ($info->results() as $value) {
            echo "['$value->name', $value->clicks],";
          }
          ?>
        ]);

        var options = {
                       'width':390,
                       'height':290,
                       'fontName': 'Calibri',
                       'fontSize':13,
                        is3D: true};

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            
        chart.draw(data, options);
      }

    </script>
  </head>
  <body>
    <div id="chart_div" style="width:100%; height:100%"></div>  
  </body>
</html>