<?php
include("includes/fonctions.php");
$ressources = lire();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediaBox Rap — Archives</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

    <!-- Décoration d'arrière-plan fixe et discrète -->
    <div class="fond-filigrane" aria-hidden="true">
        <span>MEDIABOX</span>
        <span>33 RPM</span>
    </div>

    <div class="deco-fond-gauche" aria-hidden="true">
        <svg viewBox="0 0 420 420" width="420" height="420">
            <circle cx="210" cy="210" r="200" fill="none" stroke="#1c1917" stroke-width="1.5"/>
            <circle cx="210" cy="210" r="172" fill="none" stroke="#57534e" stroke-width="1" stroke-dasharray="90 30"/>
            <circle cx="210" cy="210" r="144" fill="none" stroke="#1c1917" stroke-width="1"/>
            <circle cx="210" cy="210" r="116" fill="none" stroke="#7c3a21" stroke-width="1.5" stroke-dasharray="65 25"/>
            <circle cx="210" cy="210" r="88" fill="none" stroke="#1c1917" stroke-width="1"/>
            <circle cx="210" cy="210" r="58" fill="none" stroke="#5c2d16" stroke-width="2.5"/>
            <circle cx="210" cy="210" r="14" fill="none" stroke="#1c1917" stroke-width="1.5"/>
        </svg>
    </div>

    <div class="deco-fond-droite" aria-hidden="true">
        <svg viewBox="0 0 320 260" width="320" height="260">
            <!-- Repères techniques -->
            <line x1="20" y1="20" x2="40" y2="20" stroke="#1c1917" stroke-width="1.5"/>
            <line x1="30" y1="10" x2="30" y2="30" stroke="#1c1917" stroke-width="1.5"/>
            <line x1="280" y1="20" x2="300" y2="20" stroke="#1c1917" stroke-width="1.5"/>
            <line x1="290" y1="10" x2="290" y2="30" stroke="#1c1917" stroke-width="1.5"/>

            <!-- Onde sonore minimaliste -->
            <g stroke-linecap="round">
                <line x1="40" y1="130" x2="40" y2="130" stroke="#78716c" stroke-width="3"/>
                <line x1="56" y1="105" x2="56" y2="155" stroke="#1c1917" stroke-width="3"/>
                <line x1="72" y1="80" x2="72" y2="180" stroke="#3b1d14" stroke-width="3"/>
                <line x1="88" y1="60" x2="88" y2="200" stroke="#8c5230" stroke-width="3"/>
                <line x1="104" y1="90" x2="104" y2="170" stroke="#1c1917" stroke-width="3"/>
                <line x1="120" y1="110" x2="120" y2="150" stroke="#78716c" stroke-width="3"/>
                <line x1="136" y1="70" x2="136" y2="190" stroke="#a16236" stroke-width="3"/>
                <line x1="152" y1="50" x2="152" y2="210" stroke="#3b1d14" stroke-width="3"/>
                <line x1="168" y1="85" x2="168" y2="175" stroke="#1c1917" stroke-width="3"/>
                <line x1="184" y1="65" x2="184" y2="195" stroke="#8c5230" stroke-width="3"/>
                <line x1="200" y1="95" x2="200" y2="165" stroke="#57534e" stroke-width="3"/>
                <line x1="216" y1="75" x2="216" y2="185" stroke="#3b1d14" stroke-width="3"/>
                <line x1="232" y1="100" x2="232" y2="160" stroke="#a16236" stroke-width="3"/>
                <line x1="248" y1="115" x2="248" y2="145" stroke="#78716c" stroke-width="3"/>
                <line x1="264" y1="90" x2="264" y2="170" stroke="#1c1917" stroke-width="3"/>
                <line x1="280" y1="120" x2="280" y2="140" stroke="#78716c" stroke-width="3"/>
            </g>
            <line x1="20" y1="235" x2="300" y2="235" stroke="#57534e" stroke-width="1" stroke-dasharray="6 4"/>
        </svg>
    </div>

    <header class="entete">
        <div class="logo-embleme">
            <svg viewBox="0 0 80 80" width="76" height="76" role="img" aria-label="Logo MediaBox Rap">
                <defs>
                    <linearGradient id="vinyle-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#1c1917"/>
                        <stop offset="100%" stop-color="#3b261d"/>
                    </linearGradient>
                    <linearGradient id="macaron-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#a16236"/>
                        <stop offset="100%" stop-color="#5c2d16"/>
                    </linearGradient>
                </defs>

                <g class="disque-vinyle">
                    <circle cx="36" cy="42" r="32" fill="url(#vinyle-grad)"/>
                    <circle cx="36" cy="42" r="25" fill="none" stroke="#78716c" stroke-width="1" stroke-dasharray="42 18" opacity="0.55"/>
                    <circle cx="36" cy="42" r="19" fill="none" stroke="#a8a29e" stroke-width="1" stroke-dasharray="30 22" opacity="0.45"/>
                    <circle cx="36" cy="42" r="11" fill="url(#macaron-grad)"/>
                    <circle cx="36" cy="42" r="3" fill="#faf8f5"/>
                </g>

                <circle cx="66" cy="14" r="5" fill="#1c1917"/>
                <circle cx="66" cy="14" r="2" fill="#a16236"/>
                <path d="M 66 14 L 62 38 L 54 48" fill="none" stroke="#1c1917" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M 56 45 L 51 51" fill="none" stroke="#8c5230" stroke-width="4.5" stroke-linecap="round"/>
            </svg>
        </div>

        <h1 class="titre-page">MediaBox <span>Rap</span></h1>
        <p class="sous-titre">Archives musicales, textes, instrumentales et références</p>

        <div class="egaliseur" aria-hidden="true">
            <span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span>
        </div>

        <div class="zone-ajout">
            <a href="ajouter.php" class="btn-principal">+ Ajouter une ressource</a>
        </div>
    </header>

    <main class="grille-ressources">
        <?php foreach ($ressources as $res): ?>
            <?php
                $id = htmlspecialchars($res['id']);
                $type = htmlspecialchars($res['type']);
                $titre = htmlspecialchars($res['titre']);
                $description = htmlspecialchars($res['description']);
                $motsCles = htmlspecialchars($res['mots-cles']);
                $date = htmlspecialchars($res['date']);

                if ($res['type'] === 'document') {
                    $chemin = 'uploads/' . $res['fichier'];
                    $rel = '';
                    $libelleType = 'Document';
                } else {
                    $chemin = $res['url'];
                    $rel = ' rel="noopener noreferrer"';
                    $libelleType = 'Favori';
                }
            ?>
            <article class="carte type-<?= $type ?>">
                <div class="carte-meta">
                    <span class="badge-type"><?= $libelleType ?></span>
                    <span class="date"><?= $date ?></span>
                </div>

                <h2>
                    <img class="icone" src="images/<?= $type ?>.png" alt="">
                    <?= $titre ?>
                </h2>

                <p class="description"><?= $description ?></p>
                <p class="mots-cles"><?= $motsCles ?></p>

                <footer>
                    <a href="<?= htmlspecialchars($chemin) ?>" target="_blank"<?= $rel ?>>Voir</a>
                    <a href="modifier.php?id=<?= $id ?>">Modifier</a>
                    <a href="supprimer.php?id=<?= $id ?>">Supprimer</a>
                </footer>
            </article>
        <?php endforeach; ?>
    </main>

    <footer class="pied-page">
        <span>MEDIABOX RAP</span> • <span>ARCHIVES STUDIO &amp; CULTURE</span> • <span>33 RPM</span>
    </footer>

</body>
</html>