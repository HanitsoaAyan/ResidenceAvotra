<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Login.css">
        <title>Login Residence</title>
    </head>
    <body>
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <div class="cards-wrapper">
            <?php
            session_start();
            
            $reg_errors = $_SESSION['reg_errors'] ?? [];
            $reg_success = $_SESSION['reg_success'] ?? '';
            $login_error = $_SESSION['login_error'] ?? '';
            
            unset($_SESSION['reg_errors'], $_SESSION['reg_success'], $_SESSION['login_error']);
            ?>
            
            <div class="card card-register <?php echo isset($_GET['show_reg']) ? 'front' : ''; ?>" id="cardReg">
                <h2>Créer un compte</h2>
                
                <?php if(!empty($reg_errors)): ?>
                    <div class="error">
                        <strong>Erreurs :</strong>
                        <ul style="margin-top: 8px; margin-left: 20px;">
                            <?php foreach($reg_errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if($reg_success): ?>
                    <div class="success">
                        <?php echo htmlspecialchars($reg_success); ?>
                    </div>
                <?php endif; ?>
                
                <form action="traitement_inscription.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="nom" placeholder="Nom" value="<?php echo htmlspecialchars($_SESSION['reg_nom'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="prenom" placeholder="Prénom" value="<?php echo htmlspecialchars($_SESSION['reg_prenom'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_SESSION['reg_email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password1" placeholder="Confirmation du mot de passe" required>
                    </div>
                    <div class="form-group">
                        <select name="section" id="section" required>
                            <option value="">Type de compte</option>
                            <option value="client" <?php echo (isset($_SESSION['reg_section']) && $_SESSION['reg_section'] == 'client') ? 'selected' : ''; ?>>Client</option>
                            <option value="employe" <?php echo (isset($_SESSION['reg_section']) && $_SESSION['reg_section'] == 'employe') ? 'selected' : ''; ?>>Employé</option>
                        </select>
                    </div>
                    
                    <div class="client-fields" id="clientFields">
                        <h3>Informations Client</h3>
                        <div class="form-group">
                            <input type="text" name="cin_client" placeholder="CIN" value="<?php echo htmlspecialchars($_SESSION['reg_cin_client'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <input type="tel" name="numero" placeholder="Numéro de téléphone" value="<?php echo htmlspecialchars($_SESSION['reg_numero'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="adresse" placeholder="Adresse complète" value="<?php echo htmlspecialchars($_SESSION['reg_adresse'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="employe-fields" id="employeFields">
                        <h3>Informations Employé</h3>
                        <div class="form-group">
                            <input type="text" name="cin_employe" placeholder="CIN" value="<?php echo htmlspecialchars($_SESSION['reg_cin_employe'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <select name="poste" id="poste">
                                <option value="">Sélectionner un poste</option>
                                <option value="Receptionniste" <?php echo (isset($_SESSION['reg_poste']) && $_SESSION['reg_poste'] == 'Receptionniste') ? 'selected' : ''; ?>>Réceptionniste</option>
                                <option value="Femme de menage" <?php echo (isset($_SESSION['reg_poste']) && $_SESSION['reg_poste'] == 'Femme de menage') ? 'selected' : ''; ?>>Femme de ménage</option>
                                <option value="Gardien" <?php echo (isset($_SESSION['reg_poste']) && $_SESSION['reg_poste'] == 'Gardien') ? 'selected' : ''; ?>>Gardien</option>
                                <option value="Manager" <?php echo (isset($_SESSION['reg_poste']) && $_SESSION['reg_poste'] == 'Manager') ? 'selected' : ''; ?>>Manager</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" name="salaire" placeholder="Salaire (en Ar)" value="<?php echo htmlspecialchars($_SESSION['reg_salaire'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-register">
                        Créer <span class="arrow">&#8594;</span>
                    </button>
                </form>
            </div>

            <div class="card card-login <?php echo isset($_GET['show_reg']) ? 'behind' : ''; ?>" id="cardLogin">
                <h1>Bonjour</h1>
                <p class="sub">Connectez-vous à votre compte</p>
                
                <?php if($login_error): ?>
                    <div class="error">
                        <?php echo htmlspecialchars($login_error); ?>
                    </div>
                <?php endif; ?>
                
                <form action="traitement_connexion.php" method="POST">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_SESSION['login_email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group">
                        <select name="section" required>
                            <option value="">Type de compte</option>
                            <option value="client">Client</option>
                            <option value="employe">Employé</option>
                        </select>
                    </div>
                    <div class="forgot">
                        <a href="mot_de_passe_oublie.php">Mot de passe oublié ?</a>
                    </div>
                    <button type="submit" class="btn btn-login">
                        Se connecter <span class="arrow">&#8594;</span>
                    </button>
                </form>

                <div class="switch-link">
                    Pas de compte ? <span onclick="showRegister()">Créer un compte</span>
                </div>
            </div>
        </div>
        
        <?php
            unset($_SESSION['reg_nom'], $_SESSION['reg_prenom'], $_SESSION['reg_email'], $_SESSION['login_email']);
            unset($_SESSION['reg_section'], $_SESSION['reg_cin_client'], $_SESSION['reg_numero'], $_SESSION['reg_adresse']);
            unset($_SESSION['reg_cin_employe'], $_SESSION['reg_poste'], $_SESSION['reg_salaire']);
        ?>
    </body>
    <script>
            document.addEventListener('DOMContentLoaded', function() 
            {
                const sectionSelect = document.getElementById('section');
                const clientFields = document.getElementById('clientFields');
                const employeFields = document.getElementById('employeFields');
                
                function toggleFields() 
                {
                    clientFields.style.display = 'none';
                    employeFields.style.display = 'none';
                    
                    document.querySelectorAll('#clientFields input, #employeFields input, #employeFields select').forEach(input => 
                    {
                        input.required = false;
                    });
                    
                    if (sectionSelect.value === 'client') 
                    {
                        clientFields.style.display = 'block';
                        document.querySelectorAll('#clientFields input').forEach(input => 
                        {
                            input.required = true;
                        });
                    } 
                    else if (sectionSelect.value === 'employe') 
                    {
                        employeFields.style.display = 'block';
                        document.querySelectorAll('#employeFields input, #employeFields select').forEach(input => 
                        {
                            input.required = true;
                        });
                    }
                }
                
                sectionSelect.addEventListener('change', toggleFields);
                toggleFields();
            });
            
            <?php if (isset($_GET['show_reg']) || !empty($reg_errors) || $reg_success): ?>
                document.addEventListener('DOMContentLoaded', function() 
                {
                    showRegister();
                });
            <?php endif; ?>

            function showRegister() 
            {
                document.getElementById('cardLogin').classList.add('behind');
                document.getElementById('cardReg').classList.add('front');
            }

            function showLogin() 
            {
                document.getElementById('cardLogin').classList.remove('behind');
                document.getElementById('cardReg').classList.remove('front');
            }
    </script>
</html>