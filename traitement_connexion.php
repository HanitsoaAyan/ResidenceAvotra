<?php
    session_start();
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
    {
        header('Location: Login.php');
        exit;
    }

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $section  = $_POST['section'] ?? '';

    if (empty($email) || empty($password) || empty($section)) 
    {
        $_SESSION['login_error'] = "Tous les champs sont obligatoires";
        header('Location: Login.php');
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) 
    {
        $_SESSION['login_error'] = "Email incorrect";
        header('Location: Login.php');
        exit;
    }

    if (!password_verify($password, $user['password'])) 
    {
        $_SESSION['login_error'] = "Mot de passe incorrect";
        header('Location: Login.php');
        exit;
    }

    if ($user['section'] !== $section) 
    {
        $_SESSION['login_error'] = "Type de compte incorrect";
        header('Location: Login.php');
        exit;
    }

    $_SESSION['user_id'] = $user['id_user'];
    $_SESSION['nom']     = $user['nom'];
    $_SESSION['prenom']  = $user['prenom'];
    $_SESSION['email']   = $user['email'];
    $_SESSION['section'] = $user['section'];

    if ($section === 'client') 
    {
        $stmt = $pdo->prepare("SELECT * FROM client WHERE id_user = ?");
        $stmt->execute([$user['id_user']]);
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($client) 
        {
            $_SESSION['cin'] = $client['cin'];
            $_SESSION['numero'] = $client['numero'];
            $_SESSION['adresse'] = $client['adresse'];
        }
    } 
    elseif ($section === 'employe') 
    {
        $stmt = $pdo->prepare("SELECT * FROM employe WHERE id_user = ?");
        $stmt->execute([$user['id_user']]);
        $employe = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($employe) 
        {
            $_SESSION['cin'] = $employe['cin'];
            $_SESSION['poste'] = $employe['poste'];
            $_SESSION['salaire'] = $employe['salaire'];
        }
    }

    header('Location: Home.php');
    exit;
?>