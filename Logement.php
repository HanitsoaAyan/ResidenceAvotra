<?php
    session_start();
    require 'config.php';

    $estConnecte = isset($_SESSION['user_id']);

    $stmt = $pdo->query("SELECT * FROM logement ORDER BY id_logement");
    $logements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Logement.css">
        <title>Nos Logements - Residence Avotra</title>
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

            <div class="logements-container">
                <h1 class="logements-title">Nos Logements</h1>
                
                <div class="filtres">
                    <button class="filtre-btn active" data-type="all">Tous</button>
                    <button class="filtre-btn" data-type="studio">Studios</button>
                    <button class="filtre-btn" data-type="T1">T1</button>
                    <button class="filtre-btn" data-type="T2">T2</button>
                    <button class="filtre-btn" data-type="T3">T3</button>
                    <button class="filtre-btn" data-type="T4">T4</button>
                    <button class="filtre-btn" data-type="villa">Villas</button>
                </div>
                
                <div class="logements-grid" id="logementsGrid">
                    <?php foreach($logements as $logement): ?>
                        <div class="logement-card" data-type="<?php echo $logement['type']; ?>">
                            <div class="logement-image">
                                <?php
                                $icons = [
                                    'studio' => 'ST',
                                    'T1' => 'T1',
                                    'T2' => 'T2',
                                    'T3' => 'T3',
                                    'T4' => 'T4',
                                    'villa' => 'VL'
                                ];
                                echo $icons[$logement['type']] ?? 'LO';
                                ?>
                            </div>
                            <div class="logement-info">
                                <div class="logement-numero">Logement <?php echo htmlspecialchars($logement['numero']); ?></div>
                                <div class="logement-type"><?php echo ucfirst($logement['type']); ?></div>
                                
                                <?php
                                $statutClass = '';
                                $statutText = '';
                                switch($logement['statut']) {
                                    case 'disponible':
                                        $statutClass = 'statut-disponible';
                                        $statutText = 'Disponible';
                                        break;
                                    case 'occupe':
                                        $statutClass = 'statut-occupe';
                                        $statutText = 'Occupe';
                                        break;
                                    case 'reserve':
                                        $statutClass = 'statut-reserve';
                                        $statutText = 'Reserve';
                                        break;
                                    case 'en_maintenance':
                                        $statutClass = 'statut-en_maintenance';
                                        $statutText = 'En maintenance';
                                        break;
                                }
                                ?>
                                <div class="logement-statut <?php echo $statutClass; ?>"><?php echo $statutText; ?></div>
                                
                                <div class="logement-details">
                                    <div class="detail-item">Surface: <?php echo $logement['superficie']; ?> m²</div>
                                    <div class="detail-item">Capacite: <?php echo $logement['capacite_max']; ?> personnes</div>
                                </div>
                                
                                <div class="logement-prix">
                                    <div class="prix-nuit">
                                        <span class="prix-label">Par nuit</span>
                                        <span class="prix-valeur"><?php echo number_format($logement['prix_nuit'], 0, ',', ' '); ?> Ar</span>
                                    </div>
                                    <div class="prix-mois">
                                        <span class="prix-label">Par mois</span>
                                        <span class="prix-valeur"><?php echo number_format($logement['prix_mois'], 0, ',', ' '); ?> Ar</span>
                                    </div>
                                </div>
                                
                                <div class="logement-description">
                                    <?php echo htmlspecialchars(substr($logement['description'], 0, 100)) . '...'; ?>
                                </div>
                                
                                <div class="duree-container">
                                    <label class="duree-label">Choisir la duree :</label>
                                    <div class="duree-options">
                                        <label class="duree-option">
                                            <input type="radio" name="duree_<?php echo $logement['id_logement']; ?>" value="nuit" class="duree-radio" data-prix="<?php echo $logement['prix_nuit']; ?>" data-id="<?php echo $logement['id_logement']; ?>" checked>
                                            <span>Par nuit</span>
                                        </label>
                                        <label class="duree-option">
                                            <input type="radio" name="duree_<?php echo $logement['id_logement']; ?>" value="mois" class="duree-radio" data-prix="<?php echo $logement['prix_mois']; ?>" data-id="<?php echo $logement['id_logement']; ?>">
                                            <span>Par mois</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="prix-affiche" id="prix_affiche_<?php echo $logement['id_logement']; ?>">
                                    <?php echo number_format($logement['prix_nuit'], 0, ',', ' '); ?> Ar
                                </div>
                                
                                <button class="btn-reserver" 
                                        onclick="reserver(<?php echo $logement['id_logement']; ?>)" 
                                        <?php echo ($logement['statut'] !== 'disponible') ? 'disabled' : ''; ?>>
                                    <?php echo ($logement['statut'] === 'disponible') ? 'Reserver maintenant' : 'Non disponible'; ?>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function() 
        {
            const filtres = document.querySelectorAll('.filtre-btn');
            const cartes = document.querySelectorAll('.logement-card');
            
            if (filtres.length > 0) 
            {
                filtres.forEach(filtre => 
                {
                    filtre.addEventListener('click', function() 
                    {
                        filtres.forEach(f => f.classList.remove('active'));
                        this.classList.add('active');
                        
                        const type = this.dataset.type;
                        
                        cartes.forEach(carte =>
                        {
                            if(type === 'all' || carte.dataset.type === type) 
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
            }
            
            const radios = document.querySelectorAll('.duree-radio');
            
            if (radios.length > 0) {
                radios.forEach(radio => {
                    radio.addEventListener('change', function() 
                    {
                        const prix = this.dataset.prix;
                        const id = this.dataset.id;
                        const prixAffiche = document.getElementById('prix_affiche_' + id);
                        
                        if(prixAffiche) 
                        {
                            if(this.value === 'nuit') 
                            {
                                prixAffiche.innerHTML = parseInt(prix).toLocaleString('fr-FR') + ' Ar (par nuit)';
                            } 
                            else 
                            {
                                prixAffiche.innerHTML = parseInt(prix).toLocaleString('fr-FR') + ' Ar (par mois)';
                            }
                        }
                    });
                });
            }
        });
        
        function reserver(idLogement) 
        {
            <?php if(!$estConnecte): ?>
                if(confirm('Veuillez vous connecter pour reserver un logement')) 
                {
                    window.location.href = 'Login.php';
                }
            <?php else: ?>
                const radio = document.querySelector('input[name="duree_' + idLogement + '"]:checked');
                const duree = radio ? radio.value : 'nuit';
                window.location.href = 'reservation.php?id=' + idLogement + '&duree=' + duree;
            <?php endif; ?>
        }
    </script>
</html>