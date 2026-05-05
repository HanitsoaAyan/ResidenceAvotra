<?php
    session_start();
    require 'config.php';

    $estConnecte = isset($_SESSION['user_id']);

    $stmt = $pdo->query("SELECT * FROM service ORDER BY id_service");
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Service.css">
        <title>Nos Services - Residence Avotra</title>
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

            <div class="services-container">
                <h1 class="services-title">Nos Services</h1>
                
                <div class="filtres">
                    <button class="filtre-btn active" data-filter="all">Tous</button>
                    <button class="filtre-btn" data-filter="disponible">Disponibles</button>
                    <button class="filtre-btn" data-filter="non_disponible">Non disponibles</button>
                </div>
                
                <div class="services-grid" id="servicesGrid">
                    <?php foreach($services as $service): ?>
                        <div class="service-card" data-statut="<?php echo $service['statut']; ?>">
                            <div class="service-icon">
                                <span class="service-icon-text">S</span>
                            </div>
                            <div class="service-info">
                                <div class="service-nom"><?php echo htmlspecialchars($service['nom']); ?></div>
                                <div class="service-description">
                                    <?php echo htmlspecialchars(substr($service['description'], 0, 80)) . '...'; ?>
                                </div>
                                <div class="service-prix">
                                    <?php echo number_format($service['prix'], 0, ',', ' '); ?> Ar
                                    <small>/jour</small>
                                </div>
                                <?php if($service['statut'] === 'disponible'): ?>
                                    <div class="service-statut statut-disponible">Disponible</div>
                                <?php else: ?>
                                    <div class="service-statut statut-non-disponible">Non disponible</div>
                                <?php endif; ?>
                                <button class="btn-reserver-service" 
                                        onclick="reserverService(<?php echo $service['id_service']; ?>)" 
                                        <?php echo ($service['statut'] !== 'disponible') ? 'disabled' : ''; ?>>
                                    <?php echo ($service['statut'] === 'disponible') ? 'Reserver ce service' : 'Indisponible'; ?>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        
    </body>
    <script>
        const filtres = document.querySelectorAll('.filtre-btn');
        const cartes = document.querySelectorAll('.service-card');
        
        filtres.forEach(filtre => 
        {
            filtre.addEventListener('click', function() 
            {
                filtres.forEach(f => f.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                
                cartes.forEach(carte => 
                {
                    if (filter === 'all' || carte.dataset.statut === filter) 
                    {
                        carte.style.display = 'flex';
                    } 
                    else 
                    {
                        carte.style.display = 'none';
                    }
                });
            });
        });
        
        function reserverService(idService) 
        {
            <?php if(!$estConnecte): ?>
                if(confirm('Veuillez vous connecter pour reserver un service')) 
                {
                    window.location.href = 'Login.php';
                }
            <?php else: ?>
                window.location.href = 'reservation_service.php?id=' + idService;
            <?php endif; ?>
        }
    </script>
</html>