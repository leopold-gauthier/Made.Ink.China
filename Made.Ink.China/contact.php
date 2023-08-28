<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("./include/link-include.php") ?>
    <title>Flash</title>
    <link href="./css/contact.css" rel="stylesheet">
    <meta name="description" content="Contacter moi directement grace a ce formulaire que je recevrai directement sur mon mail professionnelle">
</head>

<body>
    <header>
        <?php include_once("./include/header-include.php"); ?>
    </header>
    <main>
        <section>
            <h1>ꕥ Contact ꕥ</h1>
            <p><b>Projet personnel</b> ou <b>Flash</b> contacter moi</p>
        </section>
        <hr>
        <section>
            <h2>Formulaire de contact</h2>
            <form id="formulaire" action="./page/mail.php" method="post" enctype="multipart/form-data">
                <hr>
                <div class="d-flex-row">
                    <div id="divNom">
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom">
                    </div>
                    <div id="divPrenom">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom">
                    </div>
                </div>
                <div id="divEmail">
                    <label for="email">Une adresse mail sur laquelle poursuivre notre échange :</label>
                    <input type="email" id="email" name="email">
                </div>
                <div id="divInstagram">
                    <label for="instagram">Eventuellement un compte instagram au cas où :</label>
                    <input type="text" id="instagram" name="instagram">
                </div>
                <div id="divPlusInfo">
                    <label for="plusInfo">Informations supplémentaires (allergie, maladie) :</label>
                    <textarea id="plusInfo" name="plusinfo" rows="3"></textarea>
                </div>
                <hr style="width: 50%;">
                <div id="divProjet">
                    <label for="projet">Type du Projet :</label>
                    <select id="projet" name="projet">
                        <option></option>
                        <option value="flash">Flash</option>
                        <option value="projetPersonnel">Projet Personnel</option>
                    </select>
                </div>

                <div id="typeProjet">
                    <div id="flashOptions" style="display: none;">
                        <div class="image-container" id="imageContainer">
                            <!-- Les images généré ici -->
                        </div>
                        <input readonly type="text" id="selectedImage" name="selectedImage" value="<?php if (isset($_GET['flash'])) {
                                                                                                        echo $_GET['flash'];
                                                                                                    } ?>">
                    </div>

                    <div id="descProjetPersonnel" style="display: none;">
                        <label for="descriptionProjet">Une description brève mais précise du projet et sa signification si cela peut me guider. <br>(Vous pouvez ajouter une photo de références)
                            <br><br>Précisez si le projet est en couleurs ou noir et gris.</label>
                        <textarea id="descriptionProjet" name="descriptionProjet" rows="4"></textarea>
                        <input type="file" accept=".jpg, .jpeg, .png, .gif" id="photoReference" name="photoReference">
                    </div>
                </div>

                <div id="divEmplacement">
                    <label for="emplacement">L’emplacement précis du tatouage sur le corps :</label>
                    <input type="text" id="emplacement" name="emplacement">

                </div>
                <div class="d-flex-row">
                    <div id="divTaille">
                        <label for="taille">La taille en cm du projet (utilisez une règle si possible) :</label>
                        <input type="number" id="taille" name="taille">

                    </div>
                    <div id="divDate">
                        <label for="date">Quand souhaiterais-tu réaliser ce projet (préciser si jours de la semaine spécifiques ou dates précises) ?</label>
                        <input type="text" id="date" name="date">

                    </div>
                </div>
                <hr>

                <div id="submitBouton">
                    <div class="g-recaptcha" data-sitekey="6Leo_8snAAAAAIuEpjeLTxUlCXxB859OE0ELCOax"></div>
                    <button type="submit" onclick="onSubmitForm(event)">Envoyer</button>
                </div>
                <p>(♥ Je vous enverrez un mail au plus vite. Merci de votre compréhension et de votre confiance ♥)</p>
            </form>
        </section>
    </main>

    <script>

    </script>
    <!-- CHOIX DU PROJET -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let projetSelect = document.getElementById("projet");

            let DIVflashOptions = document.getElementById("flashOptions");
            let selectFlash = document.getElementById("selectedImage");
            var flashImage = document.getElementsByClassName("image-item");


            let DIVprojetPersonnel = document.getElementById("descProjetPersonnel");
            let descriptionProjet = document.getElementById("descriptionProjet");
            let photoReference = document.getElementById("photoReference");


            projetSelect.addEventListener("change", function() {
                var selectedOption = projetSelect.value;
                if (selectedOption === "flash") {
                    DIVflashOptions.style.display = "flex";
                    DIVprojetPersonnel.style.display = "none";
                    descriptionProjet.value = "";
                    photoReference.value = "";

                } else if (selectedOption === "projetPersonnel") {
                    DIVflashOptions.style.display = "none";
                    DIVprojetPersonnel.style.display = "flex";
                    for (let i = 0; i < flashImage.length; i++) {
                        flashImage[i].classList.remove('selected');
                    }
                    selectFlash.value = "";

                } else {
                    DIVflashOptions.style.display = "none";
                    DIVprojetPersonnel.style.display = "none";


                }

            });

            // récupére l'URL
            const urlParams = new URLSearchParams(window.location.search);

            // Parcourir et afficher les noms des paramètres
            for (const paramName of urlParams.keys()) {
                if (paramName == "flash") {
                    const selectElement = document.getElementById('projet');
                    selectElement.value = 'flash';

                    // Apparition
                    DIVflashOptions.style.display = "flex";
                    DIVprojetPersonnel.style.display = "none";
                    descriptionProjet.value = "";
                    photoReference.value = "";

                }
            }

        });
    </script>

    <!-- FUNCTION / FETCH IMAGE -->
    <script>
        function onSubmitForm(event) {
            event.preventDefault(); // Empêcher la soumission automatique

            // Vérifier si le captcha a été coché
            var response = grecaptcha.getResponse();

            if (response.length === 0) {
                alert("Veuillez cocher le captcha avant de soumettre le formulaire.");
                return; // Arrêter la soumission du formulaire
            }

            // Valider les autres champs
            let nom = document.getElementById("nom");
            let prenom = document.getElementById("prenom");
            let email = document.getElementById("email");
            let typeprojet = document.getElementById("projet").value;
            let divTypeProjet = document.getElementById("projet");
            let emplacement = document.getElementById("emplacement");
            let taille = document.getElementById("taille");
            let date = document.getElementById("date");
            if (typeprojet === "flash") {
                var projet = document.getElementById("selectedImage").value;
                let divProjet = document.getElementById("flashOptions");
                if (projet === "") {
                    divProjet.classList.add("error");
                } else {
                    divProjet.classList.remove("error");
                }
            }
            if (typeprojet === "projetPersonnel") {
                var projet = document.getElementById("descriptionProjet").value;
                let divProjet = document.getElementById("descriptionProjet");
                if (projet === "") {
                    divProjet.classList.add("error");
                } else {
                    divProjet.classList.remove("error");
                }
            }
            let formIsValid = true;



            if (!nom.value || !prenom.value || !email.value || !emplacement.value || !taille.value || !date.value || !typeprojet || !projet) {
                alert("Veuillez remplir tous les champs obligatoires.");
                formIsValid = false;
            }

            if (!formIsValid) {
                // Ajouter la classe 'error' aux champs en erreur
                if (!nom.value) {
                    nom.classList.add("error");
                } else {
                    nom.classList.remove("error");
                }

                if (!prenom.value) {
                    prenom.classList.add("error");
                } else {
                    prenom.classList.remove("error");
                }

                if (!email.value) {
                    email.classList.add("error");
                } else {
                    email.classList.remove("error");
                }

                if (!emplacement.value) {
                    emplacement.classList.add("error");

                } else {
                    emplacement.classList.remove("error");
                }

                if (!taille.value) {
                    taille.classList.add("error");

                } else {
                    taille.classList.remove("error");
                }

                if (!date.value) {
                    date.classList.add("error");

                } else {
                    date.classList.remove("error");
                }

                if (!typeprojet) {
                    divTypeProjet.classList.add("error");
                } else {
                    divTypeProjet.classList.remove("error");
                }


                grecaptcha.reset();

                return; // Arrêter la soumission du formulaire
            }

            // Si tout est valide, soumettre le formulaire
            document.getElementById("formulaire").submit();
        }

        const imageContainer = document.getElementById("imageContainer");
        const selectedImageInput = document.getElementById("selectedImage");

        function selectImage(imagePath, imageItem) {
            const selectedImage = document.querySelector(".selected");
            if (selectedImage) {
                selectedImage.classList.remove("selected");
            }
            selectedImageInput.value = imagePath;
            imageItem.classList.add("selected");
        }

        // if GET flash
        const urlParams = new URLSearchParams(window.location.search);
        const flashValueUrl = urlParams.get('flash');

        // Récupérer les images depuis le serveur (exemple : remplacez l'URL avec le chemin de votre script PHP)
        fetch('./json/flash_fetch_all.php')
            .then(response => response.json())
            .then(data => {
                const images = data.images;
                images.forEach(imagePath => {
                    const imageItem = document.createElement("div");
                    imageItem.className = "image-item";
                    const image = document.createElement("img");
                    image.src = imagePath.replace(/\./, '');

                    // Convertir les chemins d'image en objets URL
                    imageSrcUrl = image.src.replace(`${window.location.origin}/Made.Ink.China`, '..');
                    // Comparer les objets URL normalisés
                    if (flashValueUrl === imageSrcUrl) {
                        imageItem.classList.add('selected');
                    }

                    image.alt = "Image";
                    imageItem.appendChild(image);
                    imageContainer.appendChild(imageItem);


                    imageItem.addEventListener("click", () => {
                        selectImage(imagePath, imageItem);
                    });
                });
            });
    </script>


</body>

</html>