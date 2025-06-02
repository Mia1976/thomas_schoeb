<?php
$bilder = [];
$verzeichnis = 'bilder/';

// Alle JPG-Dateien holen (kannst du auf PNG, GIF, etc. anpassen)
$dateien = glob($verzeichnis . '*.jpg');

if (count($dateien) === 0) {
    echo "Keine Bilder im Ordner '$verzeichnis' gefunden.";
    exit;
}

// Bilder-Array mit Pfad und Zeit (Änderungszeit der Datei)
foreach ($dateien as $datei) {
   $basename = basename($datei, '.jpg');

    // Aus Dateinamen z. B. IMG_20240601_142540.jpg → 01.06.2024, 14:25
    if (preg_match('/(\d{8})_(\d{6})/', $basename, $matches)) {
        $datum = $matches[1]; // 20240601
        $zeit = $matches[2];  // 142540

        $datum_formatiert = substr($datum, 6, 2) . '.' . substr($datum, 4, 2) . '.' . substr($datum, 0, 4);
        $zeit_formatiert = substr($zeit, 0, 2) . ':' . substr($zeit, 2, 2) . ' Uhr';

        $anzeige = "$datum_formatiert, $zeit_formatiert";
    } else {
        $anzeige = "Unbekannt";
    }

    $bilder[] = [
        'pfad' => $datei,
        'zeit' => $anzeige,
    ];
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>😊 Thomas Schöb</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
   
<?php
$bilder = [];
$verzeichnis = 'bilder/';  // Passe ggf. an

// Alle JPG-Dateien sammeln
$dateien = glob($verzeichnis . '*.jpg');

if (count($dateien) === 0) {
    echo "Keine Bilder im Ordner '$verzeichnis' gefunden.";
    exit;
}

foreach ($dateien as $datei) {
    $basename = basename($datei, '.jpg');

    // Aus Dateinamen z. B. IMG_20240601_142540.jpg → 01.06.2024, 14:25
    if (preg_match('/(\d{8})_(\d{6})/', $basename, $matches)) {
        $datum = $matches[1]; // 20240601
        $zeit = $matches[2];  // 142540

        $datum_formatiert = substr($datum, 6, 2) . '.' . substr($datum, 4, 2) . '.' . substr($datum, 0, 4);
        $zeit_formatiert = substr($zeit, 0, 2) . ':' . substr($zeit, 2, 2) . ' Uhr';

        $anzeige = "$datum_formatiert, $zeit_formatiert";
    } else {
        $anzeige = "Unbekannt";
    }

    $bilder[] = [
        'pfad' => $datei,
        'zeit' => $anzeige,
    ];
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>😊 Thomas Schöb</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="bild-crop-wrapper">
    <div class="bild-crop-container">
        <img id="slideshow-img-1" class="slideshow-img active" src="<?= htmlspecialchars($bilder[0]['pfad']) ?>">
        <img id="slideshow-img-2" class="slideshow-img" src="">
    </div>

    <div class="bild-text" id="bild-info">
        <div id="bild-titel">Gams, </div>
        <div id="zeit-anzeige"><?= htmlspecialchars($bilder[0]['zeit']) ?></div>
    </div>
</div>

<script>
    const bilder = [
        <?php foreach ($bilder as $index => $bild): ?>
        {
            pfad: "<?= htmlspecialchars($bild['pfad']) ?>",
            zeit: "<?= htmlspecialchars($bild['zeit']) ?>"
        }<?= $index < count($bilder) - 1 ? ',' : '' ?>
        <?php endforeach; ?>
    ];

    let index = 0;
    const img1 = document.getElementById("slideshow-img-1");
    const img2 = document.getElementById("slideshow-img-2");
    const zeitDiv = document.getElementById("zeit-anzeige");

    setInterval(() => {
        const nächstes = (index + 1) % bilder.length;

        const aktivesImg = img1.classList.contains("active") ? img1 : img2;
        const neuesImg = aktivesImg === img1 ? img2 : img1;

        neuesImg.src = bilder[nächstes].pfad;
        zeitDiv.textContent = bilder[nächstes].zeit;

        neuesImg.classList.add("active");
        aktivesImg.classList.remove("active");

        index = nächstes;
    }, 3000);
</script>

</body>
</html>

<script>
    const bilder = [
        <?php foreach ($bilder as $index => $bild): ?>
            {
                pfad: "static/<?= htmlspecialchars($bild['pfad']) ?>",
                zeit: "<?= htmlspecialchars($bild['zeit']) ?>"
            }<?= $index < count($bilder) - 1 ? ',' : '' ?>
        <?php endforeach; ?>
    ];

    let index = 0;
    const img1 = document.getElementById("slideshow-img-1");
    const img2 = document.getElementById("slideshow-img-2");
    const zeitDiv = document.getElementById("zeit-anzeige");

      if (bilder.length < 2) {
    console.warn("Es gibt nur ein Bild – keine Slideshow möglich.");
} else {
    setInterval(() => {
        const nächstes = (index + 1) % bilder.length;
        const aktivesImg = img1.classList.contains("active") ? img1 : img2;
        const neuesImg = aktivesImg === img1 ? img2 : img1;

        neuesImg.src = bilder[nächstes].pfad;
        zeitDiv.textContent = bilder[nächstes].zeit;

        neuesImg.classList.add("active");
        aktivesImg.classList.remove("active");

        index = nächstes;
    }, 3000); // etwas langsamer für besseres Testen
}
</script>



    <!-- Werdegang -->
    <div class="statisches-bild-Werdegang-wrapper">
        <div class="festes-bild-container">
            <img src="fotos/werdegang.jpg" alt="werdegang">
        </div>
        <div class="text-rechts">
            <h2>Mein Werdegang und die Gründung der Firma</h2>
            <p>Ich, Thomas Schöb, habe im Februar 2018 die Firma gegründet.</p>
            <p>Hier ist ein Überblick über meinen Werdegang:</p>
            <p><em>Primarschule:</em> Bergschulhaus Wolfsacker, Gamserberg<br>
               <em>Sekundarschule:</em> in Gams<br>
               <em>Berufsausbildung:</em> Banklehre bei der St. Galler Kantonalbank<br>
               <em>Weiterbildung:</em> Buchhalter mit eidg. Fachausweis. Tätig bei Rieter, Dividella und Ortlinghaus</p>
            <p>Mit dieser Erfahrung habe ich die Grundlage für meine Unternehmensgründung gelegt.</p>
        </div>
    </div>

   <!-- Schulungen -->
    <div class="statisches-bild-Schulungen-wrapper">
      <div class="text-links">
        <h2>Schulungen</h2>
        <p>Ich unterrichte im Finanzwesen an mehreren Institutionen: BzB Buchs, BWZ Rapperswil, Business School Zürich und Akademie St. Gallen. 
        Die Bereiche umfassen: Sachbearbeiter Rechnungswesen/Treuhand, Finanzfachleute und Controller. Ich biete Unterstützung bei Prüfungsvorbereitungen 
        und Nachhilfe in kleinen Gruppen an.</p>
      </div>
      <div class="festes-bild-container">
        <img src="fotos/schulung.jpg" alt="schulung">
      </div>
    </div>

    <!-- Immobilien -->
    <div class="statisches-bild-Immobilien-wrapper">
      <div class="festes-bild-container">
        <img src="fotos/immobilien.jpg" alt="immobilien">
      </div>
      <div class="text-rechts">
        <h2>Immobilienverwaltung</h2>
        <p>
          - Verwaltung und Bewirtschaftung von Liegenschaften<br>
          - Finanzbuchhaltung inkl. Inkasso<br>
          - Führung von Versammlungen und Protokollen
        </p>
      </div>
    </div>


    <!-- Treuhand -->
    <div class="statisches-bild-Treuhand-wrapper">
      <div class="text-links">
        <h2>Treuhand</h2>
        <p>Ich unterstütze Sie gerne bei Ihren Buchhaltungsaufgaben, ob teilweise oder vollständig:</p>
        <p>
          <em>
            Finanzbuchhaltung<br>
            Jahresabschlüsse<br>
            Debitoren/Kreditoren<br>
            Mehrwertsteuer<br>
            Steuererklärungen<br>
            Lohnbuchhaltung<br>
            Planung und Analysen
          </em>
        </p>
      </div>
      <div class="festes-bild-container">
        <img src="fotos/treuhand.jpg" alt="treuhand">
      </div>
    </div>

  </div>

<!-- Kontakt -->
<div class="kontakt-footer-wrapper">
    <div class="kontakt-inhalt">
        <h3>Kontakt</h3>
        <p>Thomas Schöb<br>
        Schöb Consulting GmbH<br>
        Chrezibach 2261, CH-9473 Gams</p>
        <p>📞 +41 78 717 19 93<br>
        ✉️ <a href="mailto:schoeb-consulting@outlook.com">schoeb-consulting@outlook.com</a></p>
    </div>
</div>

<footer class="footer">
  &copy; 2025 Schöb Consulting GmbH - Alle Rechte vorbehalten | Datenschutz | Impressum | Chrezibach 2261, CH-9473 Gams | +41787171993 | schoeb-consulting@outlook.com
</footer>

</body>
</html>

