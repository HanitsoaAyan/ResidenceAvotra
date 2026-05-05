<?php
    session_start();
    require 'config.php';

    $estConnecte = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="About.css">
        <title>A Propos - Residence Avotra</title>
    </head>
    <body>
        <section class="card">
            <header>
                <nav class="nav">
                    <div>
                        <img src="img/LogodeResidenceAvotra.png" alt="Residence Avotra">
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
                                <a href="mes_reservations.php">Mes reservations</a>
                                <a href="logout.php">Deconnexion</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="sign-in">
                            <a href="Login.php">Sign in</a>
                        </div>
                    <?php endif; ?>
                </nav>
            </header>

            <div class="about-container">
                <div class="about-hero">
                    <h1 class="about-title">A Propos de Residence Avotra</h1>
                    <p class="about-subtitle">Votre maison loin de chez vous</p>
                </div>

                <div class="about-content">
                    <div class="about-section">
                        <div class="about-text">
                            <h2>Notre Histoire</h2>
                            <p>Fondee en 2015, la Residence Avotra est nee d'une passion pour l'hotellerie et du desir d'offrir un lieu unique alliant confort moderne et authenticite malgache. Situee au coeur de la ville, notre residence est devenue une reference en matiere d'hebergement de qualite.</p>
                            <p>Le nom "Avotra" signifie "avenir" en malgache, symbolisant notre engagement a construire un avenir meilleur pour le tourisme local tout en preservant les valeurs traditionnelles de l'hospitalite malgache.</p>
                        </div>
                        <div class="about-image">
                            <img src="img/histoire.jpg" alt="Notre histoire" onerror="this.src='img/residence.jpg'">
                        </div>
                    </div>

                    <div class="about-section reverse">
                        <div class="about-image">
                            <img src="img/mission.jpg" alt="Notre mission" onerror="this.src='img/cuisine.jpg'">
                        </div>
                        <div class="about-text">
                            <h2>Notre Mission</h2>
                            <p>Offrir a chaque visiteur une experience unique et inoubliable a travers des services de qualite, des logements confortables et un accueil chaleureux. Nous nous engageons a faire de chaque sejour un moment de detente et de bien-être.</p>
                            <p>Notre equipe est dediee a votre satisfaction et travaille chaque jour pour ameliorer nos services et repondre a vos attentes les plus exigeantes.</p>
                        </div>
                    </div>

                    <div class="about-section">
                        <div class="about-text">
                            <h2>Nos Valeurs</h2>
                            <ul class="values-list">
                                <li>
                                    <strong>Hospitalite</strong>
                                    <p>Un accueil chaleureux et personnalise pour chaque client.</p>
                                </li>
                                <li>
                                    <strong>Qualite</strong>
                                    <p>Des services et equipements de haute qualite.</p>
                                </li>
                                <li>
                                    <strong>Authenticite</strong>
                                    <p>Une experience authentique aux couleurs de Madagascar.</p>
                                </li>
                                <li>
                                    <strong>Engagement</strong>
                                    <p>Un engagement fort pour le developpement local et l'environnement.</p>
                                </li>
                            </ul>
                        </div>
                        <div class="about-image">
                            <img src="img/valeurs.jpg" alt="Nos valeurs" onerror="this.src='img/residence.jpg'">
                        </div>
                    </div>

                    <div class="about-stats">
                        <h2>Chiffres Cles</h2>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-number">25+</div>
                                <div class="stat-label">Logements</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">15+</div>
                                <div class="stat-label">Services</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">1000+</div>
                                <div class="stat-label">Clients satisfaits</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">8 ans</div>
                                <div class="stat-label">D'experience</div>
                            </div>
                        </div>
                    </div>

                    <div class="about-team">
                        <h2>Notre Equipe</h2>
                        <div class="team-grid">
                            <div class="team-card">
                                <div class="team-avatar">R</div>
                                <div class="team-name">Rakoto Jean</div>
                                <div class="team-role">Directeur General</div>
                            </div>
                            <div class="team-card">
                                <div class="team-avatar">M</div>
                                <div class="team-name">Marie Claire</div>
                                <div class="team-role">Responsable Reservation</div>
                            </div>
                            <div class="team-card">
                                <div class="team-avatar">A</div>
                                <div class="team-name">Andry Rajaonar</div>
                                <div class="team-role">Chef de reception</div>
                            </div>
                            <div class="team-card">
                                <div class="team-avatar">L</div>
                                <div class="team-name">Lalao Rasoan</div>
                                <div class="team-role">Responsable Menage</div>
                            </div>
                        </div>
                    </div>

                    <div class="about-contact">
                        <h2>Contactez-nous</h2>
                        <div class="contact-info">
                            <div class="contact-item">
                                <span class="contact-label">Adresse :</span>
                                <span>Lot II M 68 Ter, Antananarivo, Madagascar</span>
                            </div>
                            <div class="contact-item">
                                <span class="contact-label">Telephone :</span>
                                <span>+261 34 12 345 67</span>
                            </div>
                            <div class="contact-item">
                                <span class="contact-label">Email :</span>
                                <span>contact@residenceavotra.mg</span>
                            </div>
                            <div class="contact-item">
                                <span class="contact-label">Horaires :</span>
                                <span>24h/24 - 7j/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>