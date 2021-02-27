$host = 'localhost';
$user = 'root';
$password = '';
$database = 'przychodnia';


$connect = mysqli_connect($host, $user, $password, $database);

echo 'połączono';

mysqli_close($connect);