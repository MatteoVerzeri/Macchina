<?php
session_start();
include('connessione.php');

// Gestione del login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM utente WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: macchina.php");
        exit();
    } else {
        header("Location: index.html");
        exit();
    }
}

// Gestione della registrazione
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO utente (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        
        header("Location: index.html");
        print_r("Utente registrato con successo!");
    } else {
        
        header("Location: index.html");
        echo "Errore durante la registrazione dell'utente: " . $conn->error;
    }
}
?>

