<?php
session_start();
require 'bdd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = 'user';


    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        echo "Ce nom d'utilisateur est déjà pris. Veuillez en choisir un autre.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)");
        $stmt->execute([
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email,
            'role' => $role
        ]);
        header('Location: login.php');
        exit;
    }
}
?>
<form method="POST" action="register.php">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="email" name="email" placeholder="Email" required>
    <label for="role">Rôle :</label>
    <select name="role" id="role">
        <option value="user">Utilisateur</option>
        <option value="admin">Administrateur</option>
    </select>
    <button type="submit">Créer un compte</button>
</form>

<p>Déjà un compte ? <a href="login.php">Connecte-toi</a></p>
