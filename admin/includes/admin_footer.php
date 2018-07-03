
    </div>
    <!-- /#wrapper -->
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script src="js/dropzone.js"></script>
<script src="js/scripts.js"></script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Options', 'Count'],
      ['Photos',     <?php echo Photo::count_all(); ?>],
      ['Views', <?php echo $session->count; ?>],
      ['Users',  <?php echo User::count_all(); ?>],
      ['Comments',      <?php echo Comment::count_all(); ?>]

    ]);

    var options = {
      title: 'Dashboard Status'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>

</body>

</html>
