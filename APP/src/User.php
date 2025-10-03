<?php
require_once __DIR__ . "/../database/db.php";



class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Inscription
    public function register($name, $email, $phone, $password, $sponsor_id = null, $role = "client") {
        // Vérifier si l'email existe déjà
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo "Un utilisateur avec cet email existe déjà.";
            return "Un utilisateur avec cet email existe déjà.";
        }

        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, phone, password, sponsor_id, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $hashedPassword, $sponsor_id, $role]);

        return true;
    }

    // Connexion
    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
