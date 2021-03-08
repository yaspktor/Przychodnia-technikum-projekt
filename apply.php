<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zapisz się!</title>
    
</head>
<body>
    <?php #połączenie z bazą danych testtest
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'przychodnia';
        $connect = mysqli_connect($host, $user, $password, $database);
    ?>
    <div id="container">
    <a href="./index.php">Wyloguj się</a><br>
    <a href="./user.php">Wróć do strony pacjenta!</a>

    <form action="morning.php" method="POST">
        <input type="submit" value="Przed 14:00">
    </form>
    <form action="evening.php" method="POST">
        <input type="submit" value="Po 14:20">
    </form>
    </div>
    <?php

        function toTwo($value) {
            if (strlen(strval($value))==1) {
                return '0'.strval($value);
            }
            return strval($value);
        }

        $hour = 8;
        $minute = 0;
        $counter = 0;
        echo '<select>';
        while ($hour < 14) {
            echo '<option>'.toTwo($hour).':'.toTwo($minute).'</option>';
            $counter += 1;
            if ($counter%3==0) $hour += 1;
            $minute += 20;
            if ($minute == 60) $minute = 0;
            
        } 
        echo '</select>';
    ?>
</body>
</html>