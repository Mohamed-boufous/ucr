<?php
// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données du formulaire d'inscription
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Connexion à la base de données
  $servername = "localhost";
  $username = "root";
  $password_db = "";
  $dbname = "ucr";

  $conn = new mysqli($servername, $username, $password_db, $dbname);

  // Vérifier la connexion à la base de données
  if ($conn->connect_error) {
      die("Erreur de connexion à la base de données : " . $conn->connect_error);
  }

  // Requête SQL pour vérifier si l'email existe déjà dans la table 'login'
  $check_query = "SELECT email FROM login WHERE email = '$email'";
  $result = $conn->query($check_query);

  if ($result->num_rows > 0) {
      // L'email existe déjà, afficher un message d'erreur
      echo "<script>alert('Cet email est déjà inscrit. Veuillez utiliser un autre email.');</script>";
  } else {
      // L'email n'existe pas, procéder à l'inscription
      // Requête SQL pour insérer les informations d'inscription dans la table 'login'
      $query = "INSERT INTO login (email, password) VALUES ('$email', '$password')";

      if ($conn->query($query) === TRUE) {
          // L'inscription est réussie, afficher une alerte avant de passer à la page de connexion
          echo "<script>alert('Inscription réussie !');</script>";
          // Attendre quelques secondes avant de rediriger vers la page de connexion
          echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 1000);</script>";
      } else {
          echo "Erreur lors de l'inscription : " . $conn->error;
      }
  }

  // Fermer la connexion à la base de données
  $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <h2>Formulaire d'inscription</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
