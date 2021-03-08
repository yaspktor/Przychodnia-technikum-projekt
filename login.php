<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php #połączenie z bazą danych
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'przychodnia';
        $connect = mysqli_connect($host, $user, $password, $database);
    ?>

    <a href="./index.php">Strona startowa</a><br>
    <a href="./register.php">Rejestracja</a>

    <form action="./login.php" method="POST">
        <label for="login">Podaj login: </label><input type="text" name="login" id="login" required><br>
        <label for="password">Podaj hasło: </label><input type="password" name="password" id="password" required><br>
        <input type="submit" value="Zatwierdź">
    </form>

    <?php
        function correctLogin($connect, $login) {
            $query = "SELECT `login` from users;";
            $result = mysqli_query($connect, $query);
            while ($r = mysqli_fetch_assoc($result)) {
                if ($r['login'] == $login) return true;
            }
            return false;
        }

        function correctPassword($connect, $login, $password) {
            $query = "SELECT `password` from users WHERE `login` like \"$login\";";
            $result = mysqli_query($connect, $query);
            while ($r = mysqli_fetch_assoc($result)) {
                if ($r['password'] == $password) return true;
            }
            return false;
        }

        if (isset($_POST['login']) && isset($_POST['password'])) {
            global $login;
            $login = $_POST['login'];
            $password = $_POST['password'];
            
            if (correctLogin($connect, $login)) {
                if (correctPassword($connect, $login, $password)) {
                    session_start();
                    $_SESSION['login'] = $login;
                    mysqli_close($connect);
                    header("Location: http://localhost:8080/PyrzchodniaPAI/AAPrzychodnia/user.php");
                }
                else echo "Podano niepoprawne dane.";
            }
            else echo "Podano niepoprawne dane.";
        }
      
    ?>

    <?php #zamknięcie
        mysqli_close($connect);
    ?>
</body>
</html>