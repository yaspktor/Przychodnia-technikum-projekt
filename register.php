<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Rejestracja</title>
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
    <a href="./login.php">Logowanie</a>
   

    <form action="./register.php" method="POST">
        <label for="login">Podaj login: </label><input type="text" name="login" id="login" required><br>
        <label for="name">Podaj imię: </label><input type="text" name="name" id="name" required><br>
        <label for="surname">Podaj nazwisko: </label><input type="text" name="surname" id="surname" required><br>
        <label for="email">Podaj e-mail: </label><input type="email" name="email" id="email" required><br>
        <label for="password">Podaj hasło: </label><input type="password" name="password" id="password" required><br>
        <input type="submit" value="Zatwierdź">
    </form>

    <?php #rejestracja konta
        function repeatableNicks($connect, $login) {
            $checkNick = "SELECT `login` FROM `users`;";
            $nicks = mysqli_query($connect, $checkNick);
            while ($r = mysqli_fetch_assoc($nicks)) {
                #echo '<script>alert("'. $r["login"] .')</script>';
                if ($r["login"] == $login) return true;
                
            }
            #echo "<script>alert(\"$login\")</script>";
            return false;
        }

        function addClient($connect, $login, $name, $surname, $email, $password) {
            $query = "INSERT INTO users(`login`, `name`, `surname`, `email`, `password`) VALUES(\"$login\", \"$name\", \"$surname\", \"$email\", \"$password\");";
            $result = mysqli_query($connect, $query);
            mysqli_close($connect);
            header("Location: http://localhost:8080/PyrzchodniaPAI/AAPrzychodnia/success.php");
        }

        if (isset($_POST['login']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['password'])) {
            
            $login = $_POST['login'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!repeatableNicks($connect, $login)) {
                addClient($connect, $login, $name, $surname, $email, $password);
            }
            echo 'Nie można utworzyć konta! Podany Nick został już użyty.';
        }
    ?>

    <?php #zamykanie połączenia
        mysqli_close($connect);
    ?>
</body>
</html>