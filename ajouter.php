<?php
include("includes/fonctions.php");

$erreurs = [];

$type =$_POST['type'] ?? 'document';
$titre =$_POST['titre'] ?? '';
$motsCles =$_POST['mots-cles'] ?? '';
$description =$_POST['description'] ?? '';
$url =$_POST['url'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($type !== 'document' && $type !== 'favori') {$erreurs[] = "Le type de ressource sélectionné est invalide.";
    }

    if (trim($titre) === '') {$erreurs[] = "Le titre est obligatoire.";
    }

    if (
        strpos($titre, '"') !== false ||
        strpos($motsCles, '"') !== false ||
        strpos($description, '"') !== false ||
        strpos($url, '"') !== false
    ) {
        $erreurs[] = 'Le caractère guillemet droit (") est interdit dans les champs.';
    }

    $extensionsAutorisees = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'txt', 'docx', 'odt'];$extension = '';

    if ($type === 'document') {
        if (!isset($_FILES['fichier']) || $_FILES['fichier']['error'] === UPLOAD_ERR_NO_FILE) {$erreurs[] = "Veuillez sélectionner un fichier pour ajouter un document.";
        } elseif ($_FILES['fichier']['error'] !== UPLOAD_ERR_OK) {$erreurs[] = "Une erreur est survenue lors du téléversement du fichier.";
        } else {
            $extension = strtolower(pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, $extensionsAutorisees)) {$erreurs[] = "Extension refusée. Extensions autorisées : " . implode(', ', $extensionsAutorisees) . ".";
            }
        }
    } elseif ($type === 'favori') {
        if (trim($url) === '') {$erreurs[] = "L'URL est obligatoire pour ajouter un favori.";
        } elseif (!filter_var(trim($url), FILTER_VALIDATE_URL)) {$erreurs[] = "L'URL saisie n'est pas valide (elle doit commencer par http:// ou https://).";
        }
    }

    if (empty($erreurs)) {$nouvelleRessource = [
            'type' => $type,
            'titre' => trim($titre),
            'mots-cles' => trim($motsCles),
            'description' => trim($description),
            'date' => date('Y-m-d')
        ];

        if ($type === 'document') {
            $nomFichierGenere = uniqid('res_') . '.' .$extension;
            $destination = 'uploads/' .$nomFichierGenere;

            if (move_uploaded_file($_FILES['fichier']['tmp_name'],$destination)) {
                $nouvelleRessource['fichier'] =$nomFichierGenere;
            } else {
                $erreurs[] = "Impossible d'enregistrer le fichier dans le dossier uploads/.";
            }
        } else {
            $nouvelleRessource['url'] = trim($url);
        }

        if (empty($erreurs)) {
            ajouter($nouvelleRessource);
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une ressource — MediaBox Rap</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

    <div class="fond-filigrane" aria-hidden="true">
        <span>STUDIO</span>
        <span>ARCHIVE</span>
    </div>

    <header class="entete">
        <a href="index.php" class="logo-embleme" title="Retour à l'accueil">
            <svg viewBox="0 0 80 80" width="76" height="76" role="img" aria-label="Logo MediaBox Rap">
                <defs>
                    <linearGradient id="vinyle-grad-ajout" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#1c1917"/>
                        <stop offset="100%" stop-color="#3b261d"/>
                    </linearGradient>
                    <linearGradient id="macaron-grad-ajout" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#a16236"/>
                        <stop offset="100%" stop-color="#5c2d16"/>
                    </linearGradient>
                </defs>

                <g class="disque-vinyle">
                    <circle cx="36" cy="42" r="32" fill="url(#vinyle-grad-ajout)"/>
                    <circle cx="36" cy="42" r="25" fill="none" stroke="#78716c" stroke-width="1" stroke-dasharray="42 18" opacity="0.55"/>
                    <circle cx="36" cy="42" r="19" fill="none" stroke="#a8a29e" stroke-width="1" stroke-dasharray="30 22" opacity="0.45"/>
                    <circle cx="36" cy="42" r="11" fill="url(#macaron-grad-ajout)"/>
                    <circle cx="36" cy="42" r="3" fill="#faf8f5"/>
                </g>

                <circle cx="66" cy="14" r="5" fill="#1c1917"/>
                <circle cx="66" cy="14" r="2" fill="#a16236"/>
                <path d="M 66 14 L 62 38 L 54 48" fill="none" stroke="#1c1917" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M 56 45 L 51 51" fill="none" stroke="#8c5230" stroke-width="4.5" stroke-linecap="round"/>
            </svg>
        </a>

        <h1 class="titre-page">Ajouter une <span>ressource</span></h1>
        <p class="sous-titre">Enregistrer un nouveau document ou un lien favori dans la collection</p>

        <div class="badge-rec" aria-hidden="true">
            <span class="point-rec"></span> REC // SESSION STUDIO
        </div>

        <div class="zone-retour">
            <a href="index.php" class="encadre-retour">
                <span class="fleche-retour" aria-hidden="true">←</span>
                <span class="texte-retour">
                    <strong>Retour aux archives</strong>
                    <small>INDEX // MEDIABOX RAP</small>
                </span>
            </a>
        </div>
    </header>

    <aside class="studio-racks" aria-label="Console et équipements studio">
        <div class="rack-colonne gauche">
            <div class="rack-module">
                <div class="rack-header">
                    <span>DECK A // TAPE</span>
                    <span class="rack-led"></span>
                </div>
                <svg viewBox="0 0 180 110" width="180" height="110" role="img" aria-label="Cassette Mixtape animée">
                    <defs>
                        <linearGradient id="k7-metal" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#1c1917"/>
                            <stop offset="100%" stop-color="#3b261d"/>
                        </linearGradient>
                    </defs>
                    <rect x="10" y="10" width="160" height="90" rx="8" fill="url(#k7-metal)"/>
                    <rect x="22" y="20" width="136" height="48" rx="4" fill="#faf8f5"/>
                    <rect x="22" y="20" width="136" height="11" rx="2" fill="#8c5230"/>
                    <text x="28" y="28" fill="#faf8f5" font-family="monospace" font-size="7" font-weight="700" letter-spacing="1">MASTER TAPE // SIDE A</text>
                    <rect x="44" y="37" width="92" height="24" rx="12" fill="#292524"/>
                    <line x1="68" y1="49" x2="112" y2="49" stroke="#a16236" stroke-width="2.5"/>
                    <g class="bobine-k7 gauche">
                        <circle cx="62" cy="49" r="9" fill="#faf8f5"/>
                        <circle cx="62" cy="49" r="3.5" fill="#1c1917"/>
                        <line x1="62" y1="40" x2="62" y2="44" stroke="#1c1917" stroke-width="1.5"/>
                        <line x1="62" y1="54" x2="62" y2="58" stroke="#1c1917" stroke-width="1.5"/>
                        <line x1="53" y1="49" x2="57" y2="49" stroke="#1c1917" stroke-width="1.5"/>
                        <line x1="67" y1="49" x2="71" y2="49" stroke="#1c1917" stroke-width="1.5"/>
                    </g>
                    <g class="bobine-k7 droite">
                        <circle cx="118" cy="49" r="9" fill="#faf8f5"/>
                        <circle cx="118" cy="49" r="3.5" fill="#1c1917"/>
                        <line x1="118" y1="40" x2="118" y2="44" stroke="#1c1917" stroke-width="1.5"/>
                        <line x1="118" y1="54" x2="118" y2="58" stroke="#1c1917" stroke-width="1.5"/>
                        <line x1="109" y1="49" x2="113" y2="49" stroke="#1c1917" stroke-width="1.5"/>
                        <line x1="123" y1="49" x2="127" y2="49" stroke="#1c1917" stroke-width="1.5"/>
                    </g>
                    <polygon points="36,100 46,78 134,78 144,100" fill="#292524"/>
                    <circle cx="56" cy="89" r="3" fill="#d6d0c4"/>
                    <circle cx="124" cy="89" r="3" fill="#d6d0c4"/>
                </svg>
                <div class="rack-footer">
                    <span>90 MIN CHROME</span>
                    <span class="compteur-digital">01:24:08</span>
                </div>
            </div>

            <div class="rack-module">
                <div class="rack-header">
                    <span>LYRIC SHEET // 16 BARS</span>
                    <span>BPM 92</span>
                </div>
                <svg viewBox="0 0 180 96" width="180" height="96" role="img" aria-label="Onde sonore">
                    <g stroke-linecap="round">
                        <line x1="18" y1="48" x2="18" y2="48" stroke="#78716c" stroke-width="3"/>
                        <line x1="26" y1="36" x2="26" y2="60" stroke="#1c1917" stroke-width="3"/>
                        <line x1="34" y1="24" x2="34" y2="72" stroke="#3b1d14" stroke-width="3"/>
                        <line x1="42" y1="16" x2="42" y2="80" stroke="#8c5230" stroke-width="3"/>
                        <line x1="50" y1="28" x2="50" y2="68" stroke="#1c1917" stroke-width="3"/>
                        <line x1="58" y1="38" x2="58" y2="58" stroke="#78716c" stroke-width="3"/>
                        <line x1="66" y1="20" x2="66" y2="76" stroke="#a16236" stroke-width="3"/>
                        <line x1="74" y1="14" x2="74" y2="82" stroke="#3b1d14" stroke-width="3"/>
                        <line x1="82" y1="30" x2="82" y2="66" stroke="#1c1917" stroke-width="3"/>
                        <line x1="90" y1="22" x2="90" y2="74" stroke="#8c5230" stroke-width="3"/>
                        <line x1="98" y1="34" x2="98" y2="62" stroke="#57534e" stroke-width="3"/>
                        <line x1="106" y1="18" x2="106" y2="78" stroke="#3b1d14" stroke-width="3"/>
                        <line x1="114" y1="26" x2="114" y2="70" stroke="#a16236" stroke-width="3"/>
                        <line x1="122" y1="40" x2="122" y2="56" stroke="#78716c" stroke-width="3"/>
                        <line x1="130" y1="22" x2="130" y2="74" stroke="#1c1917" stroke-width="3"/>
                        <line x1="138" y1="32" x2="138" y2="64" stroke="#8c5230" stroke-width="3"/>
                        <line x1="146" y1="42" x2="146" y2="54" stroke="#57534e" stroke-width="3"/>
                        <line x1="154" y1="36" x2="154" y2="60" stroke="#1c1917" stroke-width="3"/>
                        <line x1="162" y1="45" x2="162" y2="51" stroke="#78716c" stroke-width="3"/>
                    </g>
                    <line x1="74" y1="8" x2="74" y2="88" stroke="#991b1b" stroke-width="1.5" stroke-dasharray="3 2"/>
                </svg>
                <div class="rack-footer">
                    <span>VOCAL TRACK</span>
                    <span>24-BIT WAV</span>
                </div>
            </div>
        </div>

        <div class="rack-colonne droite">
            <div class="rack-module">
                <div class="rack-header">
                    <span>MPC-3000 // PADS</span>
                    <span class="rack-led actif"></span>
                </div>
                <div class="grille-pads" aria-hidden="true">
                    <span class="pad">A1</span>
                    <span class="pad actif">A2</span>
                    <span class="pad">A3</span>
                    <span class="pad actif">B1</span>
                    <span class="pad">B2</span>
                    <span class="pad">B3</span>
                    <span class="pad">C1</span>
                    <span class="pad">C2</span>
                    <span class="pad actif">C3</span>
                </div>
                <div class="rack-footer">
                    <span>BANK A // DRUMS</span>
                    <span>16 LEVELS</span>
                </div>
            </div>

            <div class="rack-module">
                <div class="rack-header">
                    <span>MASTER OUT // VU</span>
                    <span>-3.2 dB</span>
                </div>
                <div class="vu-metre" aria-hidden="true">
                    <div class="canal-vu">
                        <span class="label-canal">L</span>
                        <div class="barre-fond"><div class="barre-niveau gauche"></div></div>
                    </div>
                    <div class="canal-vu">
                        <span class="label-canal">R</span>
                        <div class="barre-fond"><div class="barre-niveau droite"></div></div>
                    </div>
                </div>
                <div class="rack-footer">
                    <span>MONITORING</span>
                    <span>44.1 KHZ</span>
                </div>
            </div>
        </div>
    </aside>

    <main class="form-container">
        <div class="form-rack-barre" aria-hidden="true">
            <div class="vis-rack"></div>
            <span>INPUT 01 // FICHE RESSOURCE</span>
            <div class="vis-rack"></div>
        </div>

        <?php if (!empty($erreurs)): ?>
            <div class="erreurs">
                <ul>
                    <?php foreach ($erreurs as$erreur): ?>
                        <li><?= htmlspecialchars($erreur) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="ajouter.php" method="post" enctype="multipart/form-data" novalidate>
            <div class="champ">
                <label for="type">Type de ressource *</label>
                <select name="type" id="type">
                    <option value="document" <?= $type === 'document' ? 'selected' : '' ?>>Document (fichier)</option>
                    <option value="favori" <?= $type === 'favori' ? 'selected' : '' ?>>Favori (lien web)</option>
                </select>
            </div>

            <div class="champ">
                <label for="titre">Titre *</label>
                <input type="text" name="titre" id="titre" placeholder="ex: Paroles - Illmatic, Instru Boom Bap..." value="<?= htmlspecialchars($titre) ?>">
            </div>

            <div class="champ" id="champ-fichier">
                <label for="fichier">Fichier * (pdf, jpg, jpeg, png, gif, mp3, mp4, txt, docx, odt)</label>
                <input type="file" name="fichier" id="fichier">
            </div>

            <div class="champ" id="champ-url">
                <label for="url">URL *</label>
                <input type="url" name="url" id="url" placeholder="https://..." value="<?= htmlspecialchars($url) ?>">
            </div>

            <div class="champ">
                <label for="mots-cles">Mots-clés (séparés par des virgules)</label>
                <input type="text" name="mots-cles" id="mots-cles" placeholder="ex: rap fr, album, instrumental, 90s" value="<?= htmlspecialchars($motsCles) ?>">
            </div>

            <div class="champ">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Notes sur le morceau, l'artiste ou le fichier..."><?= htmlspecialchars($description) ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-principal">Enregistrer</button>
                <a href="index.php" class="btn-annuler">Annuler</a>
            </div>
        </form>
    </main>

    <footer class="pied-page">
        <span>MEDIABOX RAP</span> • <span>SESSION D'ENREGISTREMENT</span> • <span>ARCHIVE STUDIO</span>
    </footer>

    <script>
        const selectType = document.getElementById('type');
        const champFichier = document.getElementById('champ-fichier');
        const champUrl = document.getElementById('champ-url');

        function basculerChamps() {
            if (selectType.value === 'document') {
                champFichier.style.display = 'block';
                champUrl.style.display = 'none';
            } else {
                champFichier.style.display = 'none';
                champUrl.style.display = 'block';
            }
        }

        selectType.addEventListener('change', basculerChamps);
        basculerChamps();
    </script>

</body>
</html>