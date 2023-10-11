<!DOCTYPE html>
<html>
<head>
<title>Fanpage</title>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="assets/js/bootstrap.bundle.min.js" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="modal modal-sheet d-block pt-5 py-md-5 align-middle"  style="background-image: linear-gradient(35deg,cyan,purple)" tabindex="-1" role="dialog" id="modalSignin">
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
            <input type="email" name="email" class="form-control rounded-3" placeholder="name@example.com" style="padding-top: 5px;padding-bottom: 5px;" required>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control rounded-3"placeholder="Password" style="padding-top: 5px;padding-bottom: 5px;" required>
          </div>
          <div>
          <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberme">
          <label class="form-check-label" for="rememberme">
    		Remember Me
  		  </label>
          </div>
          <button class="w-100 mb-2 mt-3 btn btn-lg rounded-3 btn-primary" type="submit" name="submit" formaction="auth.php">Log in</button>
          </form>
          <button class="w-100 mb-2 mt-3 btn rounded-3 btn-outline-primary" type="submit" onclick="tap()">Don't have an account?</button>   
      </div>
    </div>
  </div>
</div>

</body>

