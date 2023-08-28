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
            <form action="./page/mail.php" method="post" enctype="multipart/form-data">
                <hr>
                <div class="d-flex-row">
                    <div>
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div>
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                </div>
                <div>
                    <label for="email">Une adresse mail sur laquelle poursuivre notre échange :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="instagram">Eventuellement un compte instagram au cas où :</label>
                    <input type="text" id="instagram" name="instagram">
                </div>
                <div>
                    <label for="plusInfo">Informations supplémentaires (allergie, maladie) :</label>
                    <textarea id="plusInfo" name="plusinfo" rows="3"></textarea>
                </div>
                <hr style="width: 50%;">
                <div>
                    <label for="projet">Type du Projet :</label>
                    <select id="projet" name="projet" required>
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
                        <input readonly type="text" id="selectedImage" name="selectedImage">
                    </div>

                    <div id="descProjetPersonnel" style="display: none;">
                        <label for="descriptionProjet">Une description brève mais précise du projet et sa signification si cela peut me guider. <br>(Vous pouvez ajouter des photos de références)
                            <br><br>Précisez si le projet est en couleurs ou noir et gris.</label>
                        <textarea id="descriptionProjet" name="descriptionProjet" rows="4"></textarea>
                        <input type="file" accept=".jpg, .jpeg, .png, .gif" id="photoReference" name="photoReference">
                    </div>
                </div>

                <div>
                    <label for="emplacement">L’emplacement précis du tatouage sur le corps :</label>
                    <input type="text" id="emplacement" name="emplacement" required>

                </div>
                <div class="d-flex-row">
                    <div>
                        <label for="taille">La taille en cm du projet (utilisez une règle si possible) :</label>
                        <input type="number" id="taille" name="taille" required>

                    </div>
                    <div>
                        <label for="date">Quand souhaiterais-tu réaliser ce projet (préciser si jours de la semaine spécifiques ou dates précises) ?</label>
                        <input type="text" id="date" name="date" required>

                    </div>
                </div>
                <hr>

                <div id="submitBouton">
                    <div class="g-recaptcha" data-sitekey="6Leo_8snAAAAAIuEpjeLTxUlCXxB859OE0ELCOax"></div>
                    <button type="submit">Envoyer</button>
                </div>
                <p>(♥ Je vous enverrez un mail au plus vite. Merci de votre compréhension et de votre confiance ♥)</p>
            </form>
        </section>
    </main>
    <!-- CHOIX DU PROJET -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {





            let projetSelect = document.getElementById("projet");

            let DIVflashOptions = document.getElementById("flashOptions");
            let selectFlash = document.getElementById("selectedImage");
            let flashImage = document.getElementsByClassName("image-item");


            let DIVprojetPersonnel = document.getElementById("descProjetPersonnel");
            let descriptionProjet = document.getElementById("descriptionProjet");
            let photoReference = document.getElementById("photoReference");




            projetSelect.addEventListener("change", function() {
                var selectedOption = projetSelect.value;
                if (selectedOption === "flash") {
                    DIVflashOptions.style.display = "flex";
                    DIVprojetPersonnel.style.display = "none";
                    selectFlash.setAttribute("required", "");
                    descriptionProjet.removeAttribute("required");
                    descriptionProjet.value = "";
                    photoReference.value = "";

                } else if (selectedOption === "projetPersonnel") {
                    DIVflashOptions.style.display = "none";
                    DIVprojetPersonnel.style.display = "flex";
                    descriptionProjet.setAttribute("required", "");
                    selectFlash.removeAttribute("required");
                    for (let i = 0; i < flashImage.length; i++) {
                        flashImage[i].classList.remove('selected');
                    }
                    selectFlash.value = "";

                } else {
                    DIVflashOptions.style.display = "none";
                    DIVprojetPersonnel.style.display = "none";
                    selectFlash.removeAttribute("required");
                    descriptionProjet.removeAttribute("required");


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
                    selectFlash.setAttribute("required", "");
                    descriptionProjet.removeAttribute("required");
                    descriptionProjet.value = "";
                    photoReference.value = "";

                    // Récupérer la valeur du paramètre "flash"
                    if (urlParams.has('flash')) {
                        const flashValue = urlParams.get('flash');
                        console.log(flashValue);
                        console.log(document.querySelectorAll(".image-item"));
                        // Parcourir les éléments image-item et comparer les valeurs de src
                        for (let i = 0; i < flashImage; i++) {
                            console.log("exsite")
                            const imageItem = flashImage[i];
                            console.log(flashImage[i]);
                            const imageSrc = imageItem.querySelector('img').src;
                            console.log(imageSrc);
                            if (imageSrc === flashValue) {
                                imageItem.classList.add('selected');
                            }
                        }
                    }
                }
            }

        });
    </script>

    <!-- FETCH IMAGE ET FUNCTION SELECT -->
    <script>
        const imageContainer = document.getElementById("imageContainer");
        const selectedImageInput = document.getElementById("selectedImage");

        // Récupérer les images depuis le serveur (exemple : remplacez l'URL avec le chemin de votre script PHP)
        fetch('./json/flash_fetch_all.php')
            .then(response => response.json())
            .then(data => {
                const images = data.images;
                images.forEach(imagePath => {
                    const imageItem = document.createElement("div");
                    imageItem.className = "image-item";
                    const image = document.createElement("img");
                    image.src = imagePath.replace(/\./, '');;
                    image.alt = "Image";
                    imageItem.appendChild(image);
                    imageContainer.appendChild(imageItem);


                    imageItem.addEventListener("click", () => {
                        selectImage(imagePath, imageItem);
                    });
                });
            });

        function selectImage(imagePath, imageItem) {
            const selectedImage = document.querySelector(".selected");
            if (selectedImage) {
                selectedImage.classList.remove("selected");
            }
            selectedImageInput.value = imagePath;
            imageItem.classList.add("selected");
        }
    </script>


</body>

</html>