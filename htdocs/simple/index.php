<?php 
error_reporting(E_ALL ^ E_WARNING);
session_start();

setcookie("auth","",-1,"/");
$errorMSGlogin = "";
$errorMSGregi = "";

switch ($_SESSION["type"]) {
	case "log":
		$type = "login";
		if ($_SESSION["err"]) {
			$errorMSGlogin = 
			"<div class='fw-bold' id='error' style='color: red; padding-top: 7px;'>Email or Password is Incorrect, Try again.
			  		  </div>";
		}
		break;
	case "reg":
		$type = "register";
		if ($_SESSION["err"] == "dupe") {
			$errorMSGregi  = 
			'
			<div class="fw-bold" id="error" style="color: red; padding-top: 7px;">An account with this email already exists.
  		  </div>';
		} else if ($_SESSION["err"] == "regfailed") {
			$errorMSGregi  = 
			'
			<div class="fw-bold" id="error" style="color: red; padding-top: 7px;">Account registration has encountered an Error, please make sure you are entering a valid email.
  		  </div>';

		} else {
			$type = "login";
		}
		break;
	default:
		$type = "login";
}

$_SESSION["err"] = "";

if ($_SESSION["loggedIn"] == "true") {
	header("location:home.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Fanpage</title>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary" onload="getDetails('start')">


<div id="divToChange"></div>

<script>
var loginHTML = `<div class="modal modal-sheet d-block pt-5 py-md-5 align-middle"  style="background-image: linear-gradient(35deg,cyan,purple)" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document" style="
    padding-top: 7%;">
    <div class="modal-content rounded-4" style="background-color: #ffffffb3;">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Log in</h1>
      </div>
      <div class="modal-body p-5 pt-0">
	  <form name="login" id="loginform" method="post" onsubmit="getDetails('buttonPress')">
          <div class="form-floating mb-3">
          	<input type="hidden" name="formname" value="log">
			<input type="hidden" name="timespent" value="NULL">
			<input type="hidden" name="ip" value="NULL">
			<input type="hidden" name="screenres" value="NULL">
      <div class="form-floating mb-3">
            <input id="floatingInput" type="email" name="email" class="form-control rounded-3" placeholder="name@example.com" style="" required>
            <label style="color: rgba(var(--bs-body-color-rgb),.80);" for="floatingInput">Email address</label>
          </div>
          <div class="form-floating">
            <input id="floatingPassword" type="password" name="password" class="form-control rounded-3" placeholder="Password" style="" required>
            <label style="color: rgba(var(--bs-body-color-rgb),.80);" for="floatingPassword">Password</label>
          </div>
          <div class="pt-3">
          <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberme">
          <label class="form-check-label" for="rememberme">
    		Remember Me
  		  </label> 
		`+ `<?php print $errorMSGlogin ?>` +` 
          </div>
          <input class="w-100 mb-2 mt-3 btn btn-lg rounded-3 btn-primary" type="submit" name="submit" value="Log in" formaction="auth.php"></input>
          </form>
          <button class="w-100 mb-2 mt-3 btn rounded-3 btn-outline-primary" type="button" onclick="tap()">Don't have an account?</button>   
      </div>
    </div>
  </div>
</div>`;

var registerHTML = `<div class="modal modal-sheet d-block pt-5 py-md-5 align-middle"  style="background-image: linear-gradient(35deg,cyan,purple)" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document" style="
    padding-top: 7%;">
    <div class="modal-content rounded-4" style="background-color: #ffffffb3;">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Sign up</h1>
      </div>
      <div class="modal-body p-5 pt-0">
        <form name="register" id="loginform" method="post" onsubmit="getDetails('buttonPress')">
		<div class="form-floating mb-3">
          	<input type="hidden" name="formname" value="reg">
			<input type="hidden" name="timespent" value="NULL">
			<input type="hidden" name="ip" value="NULL">
			<input type="hidden" name="screenres" value="NULL">
      <div class="form-floating mb-3">
            <input id="floatingInput" type="email" name="email" class="form-control rounded-3" placeholder="name@example.com" style="" required>
            <label style="color: rgba(var(--bs-body-color-rgb),.80);" for="floatingInput">Email address</label>
          </div>
          <div class="form-floating">
            <input id="floatingPassword" type="password" name="password" class="form-control rounded-3" placeholder="Password" style="" required>
            <label style="color: rgba(var(--bs-body-color-rgb),.80);" for="floatingPassword">Password</label>
          </div>
          <div class="pt-3">
          <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberme">
          <label class="form-check-label" for="rememberme">
    		Remember Me
  		  </label> `+ `<?php print $errorMSGregi ?>` +` 
          </div>
          <input class="w-100 mb-2 mt-3 btn btn-lg rounded-3 btn-primary" type="submit" name="submit" value="Sign up" formaction="auth.php"></input>
          </form>
          <button class="w-100 mb-2 mt-3 btn rounded-3 btn-outline-primary" type="button" onclick="tap()">Already have an account?</button>   
      </div>
    </div>
  </div>
</div>`;

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