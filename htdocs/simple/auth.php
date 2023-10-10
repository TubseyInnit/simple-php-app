<?php 
error_reporting(E_ALL ^ E_WARNING);
session_start();

function createLog($bool, $email, $timeData, $screenres, $ip) {
    $date = date('d-m-Y H:i:s');
    $file = 'log.txt';
    $timeSpent = 'Days: ' . $timeData[0] . ' | Hours: ' . $timeData[1] . ' | Minutes: ' . $timeData[2] . ' | Seconds: ' . $timeData[3];

    try {
        $current = file_get_contents($file);
    } finally {}

    $response = file_get_contents('http://ipwho.is/'. $ip);
    $response = json_decode($response, true);

    $networkingInfo = 
     "\n" . 
    '-------------------------------------------------' . "\n" . 
    'SERVER NAME     : ' . $_SERVER["SERVER_NAME"] . "\n" . 
    'SERVER ADDRESS  : ' . $_SERVER["SERVER_ADDR"] . "\n" .
    'SERVER PORT     : ' . $_SERVER["SERVER_PORT"] . "\n" .
    'SERVER SOFTWARE : ' . $_SERVER["SERVER_SOFTWARE"] . "\n" .
    'SERVER PAGE_URI : ' . $_SERVER["DOCUMENT_ROOT"]. $_SERVER["REQUEST_URI"]. "\n" .
    '-------------------------------------------------' . "\n" .
    'REMOTE NAME     : ' . $_SERVER["HTTP_HOST"] . "\n" . 
    'REMOTE ADDRESS  : ' . $_SERVER["REMOTE_ADDR"] . "\n" .
    'REMOTE PORT     : ' . $_SERVER["REMOTE_PORT"] . "\n" .
    'REMOTE REFERER  : ' . $_SERVER["HTTP_REFERER"] . "\n" .
    'REMOTE PLATFORM : ' . $_SERVER["HTTP_USER_AGENT"] . "\n" .
    'REMOTE LOCATION : ' . $response["country"]. " " . $response["city"] . "\n" .
    '-------------------------------------------------' . "\n" .
    'REQUEST SCHEME  : ' . $_SERVER["REQUEST_SCHEME"] . "\n" . 
    'REQUEST METHOD  : ' . $_SERVER["REQUEST_METHOD"] . "\n" . 
    'REQUEST URI     : ' . $_SERVER["REQUEST_URI"] . "\n"  .
    '-------------------------------------------------' . "\n";

    switch ($bool) {
        case true:
            $newLine = "\n\n" . $date . ' | The IP: ' . $ip . ' has successfully logged in as ' . $email . ' | Screen Res: ' . $screenres . ' | Time Spent: ' . $timeSpent . "\r";
            break;
        case false:
            $newLine = "\n\n" . $date . ' | The IP: ' . $ip . ' has unsuccessfully logged in as ' . $email . ' | Screen Res: ' . $screenres . ' | Time Spent: ' . $timeSpent . "\r";
            break;
        default:
            break;
    }

    $newLine = $newLine . $networkingInfo;
    $current = $current . $newLine;

    file_put_contents($file, $current);
};

$ip 	   = $_POST['ip'];
$screenres = $_POST['screenres'];
$timeData  = explode(".",$_POST['timespent']);
$formName  = $_POST["formname"];
$email     = strtolower($_POST["email"]);
$password  = $_POST["password"];
$bool      = false;

function mySQLiConn() {
    # This function Initializes a mySQL connection
    $dbservername = "127.0.0.1";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "simple_fansite";

    $conn = new mysqli($dbservername,$dbusername,$dbpassword,$dbname);

    if ($conn->connect_error) {
        # Connection Failed
    } else {
        # Connected
        return $conn;
    }
}

function register($email,$password) {
    # Getting the connection object from mySQLiConn()
    $conn = mySQLiConn();
    # Checks if the email is a valid email before adding an account to the Database
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        # Hashing password
        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
            );

        # Prepares the SQL Command to be executed
        $sql = "INSERT INTO logins (email,password_hash) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email,$hashed_password);

        # Executes the SQL Command and checks if it was successful or not
        # if it is successful it returns true
        try {
            if ($stmt->execute()) {
                setcookie("loggedIn","true", time()+3*24*60*60,"/");
                header("location:home.php");
            } else {
                $_SESSION["err"] = "regfailed";
                header("location:index.php");
            }
        } catch(Exception $e) {
            $_SESSION["err"] = "dupe";
            header("location:index.php");
        }
    } else {
        $_SESSION["err"] = "regfailed";
        header("location:index.php");
    }
    # Close the connection
    $stmt->close();
    $conn->close();
};

function login($email,$password) {
    # Getting the connection object from mySQLiConn()
    $conn = mySQLiConn();

    # Checks if the email is a valid email before logging in
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        # Prepares the SQL Command to be executed
        $sql = "SELECT email,password_hash FROM logins WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($stored_email,$hashed_password);
        $stmt->fetch();

        # Using PHP built in function to check the hashed password is matching with the inputted password
        # returns true if it is valid
        if (password_verify($password, $hashed_password)) {
            header("location:home.php");
            setcookie("loggedIn","true", time()+60,"/");
        } else {
            $_SESSION["err"] = "loginfailed";
            header("location:index.php");
        }
    } else {
        $_SESSION["err"] = "loginfailed";
        header("location:index.php");
    }

    # Close the connection
    $stmt->close();
    $conn->close();
};

function logout() {

}

$_SESSION["type"] = $formName;
switch ($formName) {
    case "log":
        login($email,$password);
        break;
    
    case "reg":
        register($email,$password);
        break;

    case "logout":

        break;

    default:
        header("location:index.php");
}
#createLog($bool, $email, $timeData, $screenres, $ip);
exit;
?>