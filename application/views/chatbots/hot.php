<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);
      function drawStuff() {

        var data = new google.visualization.arrayToDataTable([
          ['', ''],
        <?php foreach ($likes as $like): ?>
          ["<?= $like['title'] ?>", <?= $like['total'] ?>],
        <?php endforeach; ?>
        ]);

        var options = {
          title: 'Analyze data opening moves',
          width: 700,
          legend: { position: 'none' },
          chart: { title: '文章排行',},
          bars: 'horizontal', 
          axes: {
            x: {
              0: { side: 'top', label: '以讚數計算'} // Top x-axis.
            }
          },          
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
  </head>
  
  <body>
    <div id="top_x_div" style="width: 750px; height: 300px;margin: 0 auto ;margin-top: 70px;"></div>
  </body>
</html>