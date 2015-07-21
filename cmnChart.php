<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      google.load("visualization", "1.1", {packages:["bar"]});

      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Unique visits');
        data.addColumn('number', 'Impressions');
        data.addRows([

          <?php
          require_once('backEnd/database.php');
          $db = DB::getDB();

          $info = $db->query('SELECT websites.id, visitors.clicks, visitors.date FROM websites, visitors WHERE websites.id = visitors.site_id');
          foreach ($info->results() as $value) {
            echo "['$value->date', $value->id, $value->clicks],";
          }
          ?>
        ]);

        var options = {
          chart: {
            title: 'Last 5 days',
            subtitle: 'Unique visits and Impressions',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 900px; height: 500px;"></div>
  </body>
</html>