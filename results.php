<!DOCTYPE html>
<html>
<head>
  <title>Publish Results</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#publishBtn").click(function() {
        $.ajax({
          url: "publish.php",
          type: "POST",
          success: function(response) {
            $("#result").html(response);
          }
        });
      });
    });
  </script>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="head">
    
      <header><h2><img src="images/unnamed.png" alt=""  width="50" height="50" >Smart Voting</h2></header>
      </div>
      <div id="home" class="home">
    <div class="form" id='form'>
  <h1>Publish Results</h1>
  <button id="publishBtn">Publish</button>
  <div id="result"></div>
  </div>
</body>
</html>
