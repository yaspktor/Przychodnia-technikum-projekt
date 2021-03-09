 <!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
    <div id="container">
        <a href="./index.php">Wyloguj się</a><br>
        <a href="./visits.php">Zobacz zaplanowane wizyty</a><br>
        <a href="./apply.php">Zapisz się już dziś!</a><br>
    </div>
    <?php
        session_start();
        $login = $_SESSION['login'];
        echo "Witaj $login";
        $query = 'SELECT users.name, users.surname, wizyty.data, doctors.imie, doctors.nazwisko FROM (users INNER JOIN wizyty ON users.id = wizyty.id_user) INNER JOIN doctors ON wizyty.id_doctor = doctors.id WHERE users.Login LIKE "'.$login.'";';
        #SELECT users.name, users.surname, wizyty.data, doctors.imie, doctors.nazwisko FROM (users INNER JOIN wizyty ON users.id = wizyty.id_user) INNER JOIN doctors ON wizyty.id_doctor = doctors.id;
        $result = mysqli_query($connect, $query);
        $len = mysqli_num_rows($result);
        echo $len;
        if ($len > 0){
            echo "Twoja wizyta jest następująca: <br>";
            while ($r = mysqli_fetch_assoc($result)) {
                echo 'Dane osobowe: '.$r['name']. ' '. $r["surname"]. '<br>';
                echo 'Data: '. $r["data"]. '<br>';
                echo 'Dane lekarza: '.$r["imie"]. ' '. $r["nazwisko"]. '<br>';
            }
        }
        else {
            $query = 'SELECT wizyty.data FROM (users INNER JOIN wizyty ON users.id = wizyty.id_user) INNER JOIN doctors ON wizyty.id_doctor = doctors.id;';
            $result = mysqli_query($connect, $query);
            echo "Nie jesteś zapisany na wizytę? Zrób to już teraz. Poniżej znajduje się formularz. Wypełnij go i zapisz się już dziś.<br><br>";
            echo '<form action="./user.php" method="POST">';
            echo '<label for="time">Wybierz godzinę, która Cię interesuje i zatwierdź: </label><br>';
            echo '<select name="time" id="time">';
            echo '<option disabled selected>--WYBIERZ--</option>';
            $i = 0;
            while ($r = mysqli_fetch_assoc($result)) {

                echo '<option value="'.$i.'">'.$r['data'].'</option>';
                $i += 1;
            }
            echo '</select>';
            echo '<input type="submit" value="Zatwierdź">';
            echo '</form>';
            if (isset($_POST['time'])) {
                
            }
        }


        mysqli_close($connect);
    ?>
    
</body>
</html>