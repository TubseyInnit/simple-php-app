<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><style>.xpdopen { display: none; }</style><style>div[jsaction*=lightbox] { display: none; }</style>
<title>Page Title</title>
 <script type="text/javascript">
            function logout() {
                document.cookie = "loggedIn=false;";
                window.location.replace("index.php");
            }
        </script>
</head>
<body>

<h1>This is a Heading</h1>
<p>This is a paragraph.</p>

</body>
</html>