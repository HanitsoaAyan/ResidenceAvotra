<?php
    session_start();
    $estConnecte = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Home.css">
        <title>Résidence Avotra — Accueil</title>
    </head>
    <body>
        <section class="card">

            <header>
                <nav class="nav">
                    <div>
                        <img src="img/LogodeResidenceAvotra.png" alt="Résidence Avotra">
                    </div>

                    <div class="nav-links">
                        <a href="Home.php">Home</a>
                        <a href="Logement.php">Logement</a>
                        <a href="Service.php">Services</a>
                        <a href="About.php">About</a>
                    </div>

                    <?php if($estConnecte): ?>
                        <div class="user-menu">
                            <div class="user-avatar">
                                <?php echo substr($_SESSION['prenom'], 0, 1); ?>
                            </div>
                            <div class="user-dropdown">
                                <span><?php echo htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']); ?></span>
                                <a href="mon_profil.php">Mon profil</a>
                                <a href="mes_reservations.php">Mes réservations</a>
                                <a href="Logout.php">Déconnexion</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="sign-in">
                            <a href="Login.php">Sign in</a>
                        </div>
                    <?php endif; ?>
                </nav>
            </header>

            <main>
                <aside class="image">
                    <img src="img/residence.jpg" alt="La Résidence Avotra">
                </aside>

                <aside class="texte">
                    <h1>
                        The Avotra
                        <span>Residence</span>
                    </h1>

                    <div class="divider"></div>

                    <p>
                        Nichée au cœur d'un cadre exceptionnel, la Résidence Avotra vous offre
                        une expérience unique alliant confort, élégance et chaleur humaine.
                        Chaque espace a été pensé pour vous faire vivre des moments inoubliables,
                        dans une atmosphère raffinée où chaque détail compte.
                    </p>

                    <p>
                        Que vous séjourniez pour affaires ou pour le plaisir, notre équipe
                        dévouée est à votre disposition pour rendre votre séjour parfait.
                        Bienvenue dans votre résidence.
                    </p>

                    <div>
                        <button>Réserver maintenant</button>
                    </div>
                </aside>
            </main>

        </section>
    </body>
</html>