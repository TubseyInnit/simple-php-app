<?php 
error_reporting(E_ALL ^ E_WARNING);
session_start();

echo var_dump($_SESSION);

$errorMSGlogin = "";
$errorMSGregi = "";

switch ($_SESSION["type"]) {
	case "log":
		$type = "login";
		if ($_SESSION["err"]) {
			$errorMSGlogin = "<p style='color: red'>Email or Password is Incorrect, Try again.</p>";
		}
		break;
	case "reg":
		$type = "register";
		if ($_SESSION["err"] == "dupe") {
			$errorMSGregi  = "<p style='color: red'>An account with this email already exists.</p>";
		} else if ($_SESSION["err"] == "regfailed") {
			$errorMSGregi  = "<p style='color: red'>Account registration has encountered an Error, please make sure you are entering a valid email.</p>";
		}
		break;
	default:
		$type = "login";
}

$_SESSION["err"] = "";

if ($_COOKIE["loggedIn"] == "true") {
	header("location:home.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Fanpage</title>
</head>
<body onload="getDetails('start')">

<div id="divToChange"></div>

<script>
var loginHTML = `<h1>Login</h1> `+ "<?php print $errorMSGlogin ?>" +`
			<form name="login" id="loginform" method="post" onsubmit="getDetails('buttonPress')">
			<input type="hidden" name="formname" value="log">
			<input type="hidden" name="timespent" value="NULL">
			<input type="hidden" name="ip" value="NULL">
			<input type="hidden" name="screenres" value="NULL">
			Email Address: <input type="text" name="email" required><br><br>
			Password: <input type="password" name="password" required><br><br>
			<input type="submit" name="submit" value="Login" formaction="auth.php"><br><br>
			</form>
			<input type="submit" name="register" value="Don't have an account?" onClick="tap()">`;

var registerHTML = `<h1>Register an account</h1> `+ "<?php print $errorMSGregi ?>" +`
			<form name="register" id="registerform" method="post" onsubmit="getDetails('buttonPress')">
			<input type="hidden" name="formname" value="reg">
			<input type="hidden" name="timespent" value="NULL">
			<input type="hidden" name="ip" value="NULL">
			<input type="hidden" name="screenres" value="NULL">
			Email Address: <input type="email" name="email" required><br><br>
			Password: <input type="password" name="password" required><br><br>
			<input type="submit" name="submit" value="Register" formaction="auth.php"><br><br>
			</form>
			<input type="submit" name="register" value="Already have an account?" onClick="tap()">`;

const searchParams = new URLSearchParams(window.location.search);
let divToChange = document.getElementById("divToChange");
var type = "<?php print $type ?>"
	
divToChange.innerHTML = <?php print $type."HTML"?>;

function tap() {
	if (type == "login") {
		type = "register";
		divToChange.innerHTML = registerHTML;
	} else {
		type = "login";
		divToChange.innerHTML = loginHTML;
	}


}

	function getDetails(param) {
		fetch("https://api.ipify.org?format=json")
			.then(response => response.json())
			.then(data => 
				document.forms[type]["ip"].value = (data.ip)
			);
		document.forms[type]["screenres"].value = screen.width+"x"+screen.height;
		
	function formatDate(difference) {
	
		//Arrange the difference of date in days, hours, minutes, and seconds format
		let days = Math.floor(difference / (1000 * 60 * 60 * 24));
		let hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		let minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
		let seconds = Math.floor((difference % (1000 * 60)) / 1000);

		let data = days+"."+hours+"."+minutes+"."+seconds;
		document.forms[type]["timespent"].value = data;
	}

	switch(param) {
		case "buttonPress":
		console.log("buttonPress");
		endDate = new Date();
		timeElapsed = endDate - startDate;
		formatDate(timeElapsed)
		break;
		case "start":
		console.log("start"); 
		startDate = new Date();
		break;
		default:
		console.log("Default")
	}
	}
	</script>
</body>
</html>