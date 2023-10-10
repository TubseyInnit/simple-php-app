<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><style>.xpdopen { display: none; }</style><style>div[jsaction*=lightbox] { display: none; }</style>
<title>Page Title</title>
 <script type="text/javascript">
            function logout() {
                document.cookie = "loggedIn=true; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                window.location.replace("index.php");
            }
        </script>
</head>
<body>

<h1>This is a Heading</h1>
<p>This is a paragraph.</p>
<button onClick="logout()">Logout</button>

</body>
</html>