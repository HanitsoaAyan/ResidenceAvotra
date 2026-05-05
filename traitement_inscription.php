<?php
    session_start();
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
    {
        header('Location: Login.php');
        exit;
    }

    $nom     = trim($_POST['nom'] ?? '');
    $prenom  = trim($_POST['prenom'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password1 = $_POST['password1'] ?? '';
    $section = $_POST['section'] ?? '';

    $_SESSION['reg_nom'] = $nom;
    $_SESSION['reg_prenom'] = $prenom;
    $_SESSION['reg_email'] = $email;
    $_SESSION['reg_section'] = $section;

    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($password1) || empty($section)) 
    {
        $_SESSION['reg_errors'] = ["Tous les champs sont obligatoires"];
        header('Location: Login.php?show_reg=1');
        exit;
    }

    if ($password !== $password1) 
    {
        $_SESSION['reg_errors'] = ["Les mots de passe ne correspondent pas"];
        header('Location: Login.php?show_reg=1');
        exit;
    }

    if (strlen($password) < 8) 
    {
        $_SESSION['reg_errors'] = ["Le mot de passe doit contenir au moins 8 caractères"];
        header('Location: Login.php?show_reg=1');
        exit;
    }

    if (!preg_match('/[A-Z]/', $password)) 
    {
        $_SESSION['reg_errors'] = ["Le mot de passe doit contenir une majuscule"];
        header('Location: Login.php?show_reg=1');
        exit;
    }

    if (!preg_match('/[a-z]/', $password)) 
    {
        $_SESSION['reg_errors'] = ["Le mot de passe doit contenir une minuscule"];
        header('Location: Login.php?show_reg=1');
        exit;
    }

    if (!preg_match('/[0-9]/', $password)) 
    {
        $_SESSION['reg_errors'] = ["Le mot de passe doit contenir un chiffre"];
        header('Location: Login.php?show_reg=1');
        exit;
    }

    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) 
    {
        $_SESSION['reg_errors'] = ["Le mot de passe doit contenir un caractère spécial"];
        header('Location: Login.php?show_reg=1');
        exit;
    }

    $stmt = $pdo->prepare("SELECT id_user FROM user WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) 
    {
        $_SESSION['reg_errors'] = ["Cet email est déjà utilisé"];
        header('Location: Login.php?show_reg=1');
        exit;
    }

    if ($section === 'client') 
    {
        $cin = trim($_POST['cin_client'] ?? '');
        $numero = trim($_POST['numero'] ?? '');
        $adresse = trim($_POST['adresse'] ?? '');
        
        $_SESSION['reg_cin_client'] = $cin;
        $_SESSION['reg_numero'] = $numero;
        $_SESSION['reg_adresse'] = $adresse;
        
        if (empty($cin)) 
        {
            $_SESSION['reg_errors'] = ["CIN obligatoire pour les clients"];
            header('Location: Login.php?show_reg=1');
            exit;
        }
        if (empty($numero)) 
        {
            $_SESSION['reg_errors'] = ["Numéro de téléphone obligatoire"];
            header('Location: Login.php?show_reg=1');
            exit;
        }
        if (empty($adresse)) 
        {
            $_SESSION['reg_errors'] = ["Adresse obligatoire"];
            header('Location: Login.php?show_reg=1');
            exit;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $pdo->beginTransaction();
        
        try 
        {
            $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, email, password, section) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $email, $hashedPassword, $section]);
            $id_user = $pdo->lastInsertId();
            
            $stmt = $pdo->prepare("INSERT INTO client (cin, id_user, numero, adresse) VALUES (?, ?, ?, ?)");
            $stmt->execute([$cin, $id_user, $numero, $adresse]);
            
            $pdo->commit();
            
            $_SESSION['reg_success'] = "Inscription réussie ! Veuillez vous connecter.";
            header('Location: Login.php');
            exit;
            
        } 
        catch (Exception $e) 
        {
            $pdo->rollBack();
            $_SESSION['reg_errors'] = ["Erreur lors de l'inscription: " . $e->getMessage()];
            header('Location: Login.php?show_reg=1');
            exit;
        }
        
    } 
    elseif ($section === 'employe') 
    {
        $cin = trim($_POST['cin_employe'] ?? '');
        $poste = trim($_POST['poste'] ?? '');
        $salaire = trim($_POST['salaire'] ?? '');
        
        $_SESSION['reg_cin_employe'] = $cin;
        $_SESSION['reg_poste'] = $poste;
        $_SESSION['reg_salaire'] = $salaire;
        
        if (empty($cin)) 
        {
            $_SESSION['reg_errors'] = ["CIN obligatoire pour les employés"];
            header('Location: Login.php?show_reg=1');
            exit;
        }
        if (empty($poste)) 
        {
            $_SESSION['reg_errors'] = ["Poste obligatoire"];
            header('Location: Login.php?show_reg=1');
            exit;
        }
        if (empty($salaire)) 
        {
            $_SESSION['reg_errors'] = ["Salaire obligatoire"];
            header('Location: Login.php?show_reg=1');
            exit;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $pdo->beginTransaction();
        
        try 
        {
            $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, email, password, section) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $email, $hashedPassword, $section]);
            $id_user = $pdo->lastInsertId();
            
            $stmt = $pdo->prepare("INSERT INTO employe (cin, id_user, poste, salaire) VALUES (?, ?, ?, ?)");
            $stmt->execute([$cin, $id_user, $poste, $salaire]);
            
            $pdo->commit();
            
            $_SESSION['reg_success'] = "Inscription réussie ! Veuillez vous connecter.";
            header('Location: Login.php');
            exit;
            
        } 
        catch (Exception $e) 
        {
            $pdo->rollBack();
            $_SESSION['reg_errors'] = ["Erreur lors de l'inscription: " . $e->getMessage()];
            header('Location: Login.php?show_reg=1');
            exit;
        }
    }
?>