<html>
 <head>
  <title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 </head>
 <body>

   <div id="load_checkbp"></div>

 </body>
</html>
<script>
$(document).ready(function(){
 setInterval(function(){
  $('#load_checkbp').load("di.php").fadeIn("slow");
 }, 3000);
});
</script>