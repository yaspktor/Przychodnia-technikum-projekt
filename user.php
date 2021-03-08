 <!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona pacjenta</title>
</head>
<body>
    <?php #połączenie z bazą danych
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'przychodnia';
        $connect = mysqli_connect($host, $user, $password, $database);
    ?>

    <a href="./index.php">Wyloguj się</a><br>
    <a href="./visits.php">Zobacz zaplanowane wizyty</a><br>
    <a href="./apply.php">Zapisz się już dziś!</a><br>

    <?php
        session_start();
        $login = $_SESSION['login'];
        echo "Witaj $login";

        mysqli_close($connect);
    ?>

</body>
</html>