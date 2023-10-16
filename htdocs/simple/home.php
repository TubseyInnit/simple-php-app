<?php
error_reporting(E_ALL ^ E_WARNING);
session_start();

if ($_SESSION["loggedIn"] == "false" or !$_SESSION["loggedIn"]) {
  if (!$_COOKIE["auth"] or $_COOKIE["auth"] != "true") {
    header("location:index.php");
  }
}

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
                window.location.replace("auth.php?p=logout");
            }
    </script>
</head>
<body>
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid" style="padding-right: 4px;">
      <a class="navbar-brand" href="">War Of The Worlds</a>
      <div class="collapse navbar-collapse" id="navbarsExample02">
        <div class="container-fluid">
            <span class="navbar-text">
              This is a site about War Of The Worlds
            </span>
          </div>
        <div class="d-flex container-fluid justify-content-end">
            <a class="btn btn-primary ms-2" href="">Home</a>
            <button class="btn btn-outline-secondary ms-2" onClick="logout()">Logout</button>
        </div>
      </div>
    </div>
  </nav>



  <!--
  <div class="container position-absolute bottom-0 start-50 translate-middle-x">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
    </ul>
  </footer>
</div>-->

</body>
</html>