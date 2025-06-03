from flask import Flask, render_template, url_for
import os
import re
from datetime import datetime
print(__name__)
app = Flask(__name__)

# Bilder-Verzeichnis relativ zu "static"

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
BILDER_ORDNER = os.path.join(BASE_DIR, "static", "bilder")

def lade_bilder():
    bilder = []
    dateien = sorted(os.listdir(BILDER_ORDNER))
    
    for dateiname in dateien:
        if dateiname.lower().endswith((".jpg", ".jpeg", ".png", ".webp")):
            zeit = extrahiere_zeit_aus_dateiname(dateiname)
            bilder.append({
                "pfad": f"bilder/{dateiname}",
                "zeit": zeit
            })
    return bilder

def extrahiere_zeit_aus_dateiname(name):
    """
    Erwartet Dateinamen wie IMG_20250513_162548.jpg
    """
    match = re.search(r"(\d{8})_(\d{6})", name)
    if match:
        datum_str = match.group(1)  # z. B. 20250513
        uhrzeit_str = match.group(2)  # z. B. 162548
        try:
            dt = datetime.strptime(datum_str + uhrzeit_str, "%Y%m%d%H%M%S")
            return dt.strftime("%d.%m.%Y – %H:%M")
        except ValueError:
            return "Unbekannt"
    return "Unbekannt"

@app.route("/")
def index():
    bilder = lade_bilder()
    return render_template("index.html", bilder=bilder)

if __name__ == "__main__":
    app.run(debug=True)
