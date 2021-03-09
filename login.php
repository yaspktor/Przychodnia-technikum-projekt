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
    <div id="container">
    
    <div id="form-css">
    <!--  
    <form action="./login.php" method="POST">
        <label for="login">Podaj login: </label><input type="text" name="login" id="login" required><br>
        <label for="password">Podaj hasło: </label><input type="password" name="password" id="password" required><br>
        <input type="submit" value="Zatwierdź" id="but1" class="btn btn-primary btn-ghost">

        </form>
-->

        <div class="signupSection">
  <div class="info">
    <h2>Zadbaj o swoją przyszłość</h2>
    <i class="icon ion-ios-ionic-outline" aria-hidden="true"></i>
    <p>Zbadaj się już teraz</p>
   <a   href="./index.php"><img  id="hospital" src="hospital.png" alt="hospital"></a>
  </div>
  <form action="./login.php" method="POST" class="signupForm" name="signupform">
    <h2>Zaloguj się</h2>
    <ul class="noBullet">
      <li>
        <label for="username"></label>
        <input type="text" class="inputFields" id="username" name="login" placeholder="Username" value="" required/>
      </li>
      <li>
        <label for="password"></label>
        <input type="password" class="inputFields" id="password" name="password" placeholder="Password" value=""  required/>
      </li>
      
      <li id="center-btn">
        <input type="submit" id="but1" name="zaloguj" alt="Zaloguj" value="Zaloguj">
      </li>
      <li id="links">
        <a  class="linki" href="./register.php">Rejestracja</a><br><a  class="linki" href="./index.php">Strona startowa</a>
      </li>
    </ul>
  </form>
</div>



   
    </div>
    </div>
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
                    header("Location: ./user.php");
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