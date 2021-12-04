<!doctype html>
<?php
    include "config.php";
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
  <body style="text-align: center;">
    <h2 class="text-center">Sports Rankings</h2>

    <div id="rankings" style="width: 900px; height: 500px;"></div>

    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['corechart'],
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRankings);

      function drawRankings() {
        var data = google.visualization.arrayToDataTable([
             ['Year', 'Sport', 'OARank'],
            <?php
                while($row = mysqli_fetch_assoc($chartQueryRecords)){
                    echo "['".$row['Year']."',".$row['Sport'].",".$row['OArank']."],";
                }
            ?>
        ]);

        var options = {
        };

        var chart = new google.visualization.LineChart(document.getElementById('rankings'));

        chart.draw(data, options);
      }
    </script>
  </head>
  </body>
</html>