<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var shownIds = new Array();
      setInterval(function() {
        $.get("config/realtime_visitperday.php", function(data) {
          data = $.parseJSON(data);
          $("#realtime_visitperday").html("" + data + "");
        });
      }, 1000);
    });
  </script>
</head>

<body>
  <div style="overflow-x:auto;" id="realtime_visitperday">
</body>
</html>