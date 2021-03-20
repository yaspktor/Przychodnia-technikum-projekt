 <!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Strona pacjenta</title>
</head>
<body>
<header class="header">

<div class="text-box">
    <h1 class="heading-primary">
        <span class="heading-primary-main"> 
            <?php

                function toTwo($value) {
                    if (strlen(strval($value))==1) {
                        return '0'.strval($value);
                    }
                    return strval($value);
                }

                function addTime($hour, $minutes, $times, $count) {
                    array_push($times, toTwo($hour).":".toTwo($minutes).":00");
                    for ($i=0; $i<=$count-1; $i++) {
                        $minutes += 20;
                        if ($minutes == 60) {
                            $minutes = 0;
                            $hour ++;
                        }
                        array_push($times, toTwo($hour).":".toTwo($minutes).":00");
                    }
                    return $times;
                }

                $host = 'localhost';
                $user = 'root';
                $password = '';
                $database = 'przychodnia';
                $connect = mysqli_connect($host, $user, $password, $database);

                session_start();
                $login = $_SESSION['login'];
                $query = 'SELECT users.name, users.surname, visits.data, doctors.name, doctors.surname FROM (users INNER JOIN visits ON users.id = visits.id_user) INNER JOIN doctors ON visits.id_doctor = doctors.id WHERE users.login LIKE "'.$login.'";';
                $result = mysqli_query($connect, $query);
                $len = mysqli_num_rows($result);
                $times = addTime(8, 0, [], 17);
                $times = addTime(14, 20, $times, 16);

                echo "Witaj $login. ";
                
                if ($len > 0) {
                    sleep(0.1);
                    echo "Twoja wizyta jest następująca: <br>";
                    while ($r = mysqli_fetch_array($result)) {
                        echo 'Dane osobowe: '.$r[0]. ' '. $r[1]. '<br>';
                        echo 'Godzina: '. $r[2]. '<br>';
                        echo 'Imię i nazwisko lekarza: '.$r[3]. ' '. $r[4]. '<br>';
                    }
                }
                else {
                    sleep(0.1);
                    $query = 'SELECT users.name, users.surname, visits.data, doctors.name, doctors.surname FROM (users INNER JOIN visits ON users.id = visits.id_user) INNER JOIN doctors ON visits.id_doctor = doctors.id;';
                    $result = mysqli_query($connect, $query);
                    echo 'Nie jesteś zapisany na wizytę? Zrób to już teraz.<br><br>';

                    echo '<form action="./user.php" method="POST">';
                        
                        echo '<label for="doctor">Wybierz lekarza: </label><br>';
                        
                        echo '<select name="doctor" id="doctor" onchange="having(doctor.value)">';
                            echo '<option disabled selected>--WYBIERZ--</option>';
                            echo '<option value="1">Jan Jankowski</option>';
                            echo '<option value="2">Bernardyn Brzechwa</option>';
                        echo '</select><br>';

                        echo '<label for="time">Wybierz godzinę: </label><br>';
                        echo '<select name="time" id="time">';
                        
                            echo '<option id="defaultVal" disabled selected>--WYBIERZ--</option>';
                            
                            while ($r = mysqli_fetch_assoc($result)) {
                                for($i=0; $i<=count($times)-1; $i++) {
                                    if ($r["data"] == $times[$i]) array_splice($times, $i, 1);
                                }
                            }
                            for($i=0; $i<=count($times)-1; $i++) {
                                echo '<option class="'.substr($times[$i],0,2).'" value="'.$times[$i].'">'.substr($times[$i],0,5).'</option>';
                            }
                        echo '</select><br>';
                        echo '<input type="submit" value="Zatwierdź">';
                    echo '</form>';

                    if (isset($_POST['time']) && isset($_POST['doctor'])) {
                        $query = 'SELECT id FROM users WHERE `login` Like "'.$login.'";';
                        $result = mysqli_query($connect, $query);
                        $userID = mysqli_fetch_array($result)[0];
                        $time = $_POST['time'];
                        if (intval(substr($time, 0, 2))>=14) $doctorID = 2;
                        else $doctorID = 1;
                        $query = 'INSERT INTO `visits` VALUES('.intval($userID).',"'.$time.'",'.intval($doctorID).');';
                        $result = mysqli_query($connect, $query);
                        header("Refresh: 0;");
                    }
                }

                mysqli_close($connect);
            ?>
        </span>
        
    </h1>
    <a href="index.php" class="btn btn-white btn-animated">Wyloguj się</a>
    
</div>
</header>

<script type="text/javascript">

    function toTwo(value) {
        if ((value.toString()).length==1) {
            return '0'+value.toString();
        }
        return value.toString();
    }

    function having(doctorID) {
        if (doctorID == "1") {
            for (var i=8; i<14; i++) {
                var x = document.getElementsByClassName(toTwo(i))
                for (k = 0; k < x.length; k++) {
                    x[k].disabled = false;
                }
            }
            for (var i=14; i<=19; i++) {
                var x = document.getElementsByClassName(toTwo(i))
                for (k = 0; k < x.length; k++) {
                    x[k].disabled = true;
                }
            }
        }
        else {
            for (var i=8; i<14; i++) {
                var x = document.getElementsByClassName(toTwo(i))
                for (k = 0; k < x.length; k++) {
                    x[k].disabled = true;
                }
            }
            for (var i=14; i<=19; i++) {
                var x = document.getElementsByClassName(toTwo(i))
                for (k = 0; k < x.length; k++) {
                    x[k].disabled = false;
                }
            }
        }
        document.getElementById("defaultVal").selected = true;
    }
</script>
    
</body>
</html>