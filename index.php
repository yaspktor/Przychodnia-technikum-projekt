<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przychodnia</title>
</head>
<body>
    <?php #połączenie z bazą danych
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'przychodnia';
        $connect = mysqli_connect($host, $user, $password, $database);
    ?>
    <form action="./index.php" method="POST">
        <label for="name">Podaj imię: </label><input type="text" name="name" id="name" required><br>
        <label for="surname">Podaj nazwisko: </label><input type="text" name="surname" id="surname" required><br>
        <label for="email">Podaj e-mail: </label><input type="email" name="email" id="email" required><br>
        <label for="password">Podaj nowe hasło: </label><input type="password" name="password" id="password" required><br>
        <input type="submit" value="Zatwierdź">
    </form>
    <?php #działanie na bazie danych
        if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['password'])) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = "INSERT INTO users(`name`, `surname`, `email`, `password`) VALUES(\"$name\", \"$surname\", \"$email\", \"$password\");";
            $result = mysqli_query($connect, $query);
            echo 'Utworzono nowe konto.'; # ja bym zrobił podstronę dla tej informacji
        }
    ?>
    <?php #zamykanie połączenia
        mysqli_close($connect);
    ?>
</body>
</html>