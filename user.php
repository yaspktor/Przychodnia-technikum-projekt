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
        #echo "Witaj $login";
        $query = 'SELECT users.name, users.surname, wizyty.data, doctors.imie, doctors.nazwisko FROM (users INNER JOIN wizyty ON users.id = wizyty.id_user) INNER JOIN doctors ON wizyty.id_doctor = doctors.id WHERE user.Login LIKE "'.$login.'";';
        #SELECT users.name, users.surname, wizyty.data, doctors.imie, doctors.nazwisko FROM (users INNER JOIN wizyty ON users.id = wizyty.id_user) INNER JOIN doctors ON wizyty.id_doctor = doctors.id;
        $result = mysqli_query($connect, $query);
        if ($result){
            echo "Twoja wizyta jest następująca: \n";
            while ($r = mysqli_fetch_assoc($result)) {
                echo 'Dane osobowe: '.$r['users.name']. ' '. $r["users.surname"]. '\n';
                echo 'Data: '. $r["wizyty.data"]. '\n';
                echo 'Dane lekarza: '.$r["doctors.imie"]. ' '. $r["doctors.nazwisko"]. '\n';
            }
        }
        else {
            echo "Nie jesteś zapisany na wizytę? Zrób to już teraz.";
        }


        mysqli_close($connect);
    ?>

</body>
</html>