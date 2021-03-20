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
  <div class="signinSection">   
    <div class="info">
      <h2>Zadbaj o swoją przyszłość</h2>
      <i class="icon ion-ios-ionic-outline" aria-hidden="true"></i>
      <p>Zbadaj się już teraz</p>
      <a href="./index.php"><img  id="hospital" src="./other/hospital.png" alt="hospital"></a>
      <a class="linki" href="./login.php">Logowanie</a><br><a  class="linki" href="./index.php">Strona startowa</a>
    </div>
    <form action="./register.php" method="POST" class="signinForm" name="signinform">
      <ul class="noBullet">
        <li>
          <label for="username"></label>
          <input type="text" class="inputFields" id="username" name="login" placeholder="Nazwa użytkownika" pattern="[A-ZĄŻŹŚĘĆŃÓŁ][a-zążźćęśńół]* *" required/>
        </li>
        <li>
          <label for="name"></label>
          <input type="text" class="inputFields" id="name" name="name" placeholder="Imię" pattern="[A-ZĄŻŹŚĘĆŃÓŁ][a-zążźćęśńół]+ *" required/>
        </li>
        <li>
          <label for="surname"></label>
          <input  class="inputFields" placeholder="Nazwisko" type="text" name="surname" id="surname" pattern="[A-ZĄŻŹŚĘĆŃÓŁ][a-zążźćęśńół]* *" required/>
        </li>
        <li>
          <label for="email"></label>
          <input  class="inputFields" placeholder="Email" type="email" name="email" id="email" required/>
        </li>
        <li>
          <label for="password"></label>
          <input placeholder="Hasło" class="inputFields" type="password" name="password" id="password" required/>
        </li>
        <li id="center-btn">
          <input type="submit" id="but2" name="zarejestruj" alt="Zarejestruj" value="Zarejestruj">
        </li>
      </ul>
    </form>
  </div>
  <div id="errors">
  <?php #rejestracja konta
      function repeatableNicks($connect, $login) {
          $checkNick = "SELECT `login` FROM `users`;";
          $nicks = mysqli_query($connect, $checkNick);
          while ($r = mysqli_fetch_assoc($nicks)) {
              if ($r["login"] == $login) return true;
              
          }
          return false;
      }

      function addClient($connect, $login, $name, $surname, $email, $password) {
          $query = "INSERT INTO users(`login`, `name`, `surname`, `email`, `password`) VALUES(\"$login\", \"$name\", \"$surname\", \"$email\", \"$password\");";
          $result = mysqli_query($connect, $query);
          mysqli_close($connect);
          header("Location: ./success.php");
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
      mysqli_close($connect);
  ?>

  </div>

</body>
</html>