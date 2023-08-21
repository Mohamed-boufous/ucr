<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "ucr";

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    $query = "SELECT r.* FROM reservations r
    JOIN login l ON r.email = l.email
    WHERE l.email = '$email' AND l.password = '$password'";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // If login is successful, store user information in the session
        $_SESSION['user'] = $result->fetch_assoc();
        header("Location: user.php");
        exit();
    } else {
        // Invalid login, display an alert message
        echo "<script>alert('Identifiants incorrects, Veuillez réessayer. Ou vous n\'avez pas encore effectué de réservation sur notre site.');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2>Formulaire de connexion</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Se connecter" name="user">
    </form>

    <!-- Link to signup page -->
    <p class="create-account">Vous n'avez pas de compte ? <a href="signin.php">Créer un compte</a></p>
 
</body>
</html>
