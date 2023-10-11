<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Title</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script type="text/javascript">
            function logout() {
                document.cookie = "loggedIn=true; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                window.location.replace("index.php");
            }
    </script>
</head>
<body>
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid" style="padding-right: 4px;">
      <a class="navbar-brand" href="#">Fansite</a>
      <div class="collapse navbar-collapse" id="navbarsExample02">
        <div class="container-fluid">
            <span class="navbar-text">
              This is a site about my topic
            </span>
          </div>
        <div class="d-flex container-fluid justify-content-end">
            <a class="btn btn-primary ms-2" href="">Home</a>
            <button class="btn btn-outline-secondary ms-2" onClick="logout()">Logout</button>
        </div>
      </div>
    </div>
  </nav>

<!--<button class="btn btn-secondary" onClick="logout()">Logout</button>-->

</body>
</html>