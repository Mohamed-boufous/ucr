<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Connexion à la base de données (remplacez les valeurs par celles de votre configuration)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "ucr";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparer et exécuter la requête SQL pour insérer le message dans la table
    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message envoyé correctement.');</script>";
    } else {
        echo "<script>alert('Erreur lors de l\'envoi du message. Veuillez réessayer plus tard.');</script>";
    }

    // Fermer la connexion
    $conn->close();

    // Rediriger vers index.html après un court délai (par exemple, 3 secondes)
    echo "<meta http-equiv='refresh' content='1;url=index.html'>";
}
?>
