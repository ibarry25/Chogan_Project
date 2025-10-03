<?php
global $pdo;
session_start();
require_once __DIR__ . "/../database/db.php";
require_once __DIR__ . "/User.php";

$user = new User($pdo);
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {

    // INSCRIPTION
    case "register":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = htmlspecialchars(trim($_POST['name']));
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $phone = htmlspecialchars(trim($_POST['phone']));
            $password = $_POST['password'];
            $sponsor_id = isset($_POST['sponsor_id']) ? $_POST['sponsor_id'] : null;
            $role = "client";

            if (!$email) {
                $_SESSION['error'] = "Email invalide.";
                header("Location: ../public/register.html");
                exit;
            }

            $result = $user->register($name, $email, $phone, $password, $sponsor_id, $role);

            if ($result === true) {
                $_SESSION['success'] = "Inscription réussie. Connectez-vous !";
                header("Location: ../public/login.html");
                exit;
            } else {
                $_SESSION['error'] = $result;
                header("Location: ../public/register.html");
                exit;
            }
        }
        break;

    // CONNEXION
    case "login":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];

            if (!$email) {
                $_SESSION['error'] = "Email invalide.";
                header("Location: ../public/login.html");
                exit;
            }

            $loggedUser = $user->login($email, $password);

            if ($loggedUser) {
                $_SESSION['user'] = [
                    "id" => $loggedUser['id'],
                    "name" => $loggedUser['name'],
                    "email" => $loggedUser['email'],
                    "role" => $loggedUser['role']
                ];
                $_SESSION['success'] = "Bienvenue, " . $loggedUser['name'] . " !";
                header("Location: ../public/index.php");
                exit;
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header("Location: ../public/login.html");
                exit;
            }
        }
        break;

    // DÉCONNEXION
    case "logout":
        session_destroy();
        header("Location: ../public/index.php");
        exit;
        break;

    // CAS PAR DÉFAUT
    default:
        header("Location: ../public/index.php");
        exit;
}
