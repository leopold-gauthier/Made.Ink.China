<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoi</title>
</head>

<body>
    <!-- SOUMISSION DE L'EMAIL -->
    <?php
    $recaptcha_secret = "6Leo_8snAAAAAI_b0UmrfpfPkWhCA_QZOzrncZmQ";
    $recaptcha_response = $_POST["g-recaptcha-response"];

    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
    $recaptcha_data = array(
        "secret" => $recaptcha_secret,
        "response" => $recaptcha_response
    );

    $recaptcha_options = array(
        "http" => array(
            "method" => "POST",
            "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
            "content" => http_build_query($recaptcha_data)
        )
    );

    $recaptcha_context = stream_context_create($recaptcha_options);
    $recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
    $recaptcha_result = json_decode($recaptcha_result);


    if ($recaptcha_result->success == true) {
        // Le captcha est valide, traitez le formulaire
        if (isset($_POST['projet'])) {

            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $instagram = htmlspecialchars($_POST['instagram']);
            $emplacement = htmlspecialchars($_POST['emplacement']);
            $date = htmlspecialchars($_POST['date']);
            $taille = htmlspecialchars($_POST['taille']);
            $projet = htmlspecialchars($_POST['projet']);
            $plusInfo = htmlspecialchars($_POST['plusinfo']);
            $flash = htmlspecialchars($_POST['selectedImage']);
            $description = htmlspecialchars($_POST['descriptionProjet']);



            // Générer un boundary aléatoire
            $boundary = md5(uniqid(rand(), true));

            // Informations de l'e-mail
            $to = 'lo-pat@live.fr';

            // En-têtes MIME
            $headers = 'From: Made.Ink.China' . "\r\n";
            $headers .= 'Mime-Version: 1.0' . "\r\n";
            $headers .= 'Content-Type: multipart/mixed; boundary=' . $boundary . "\r\n";
            $headers .= "\r\n";


            // FLASH
            if ($projet == "flash") {
                // Objet/Sujet
                $subject = 'Formulaire de ' . $nom . ' ' . $prenom . ' [ FLASH ]';

                // Message HTML
                $msg = '--' . $boundary . "\r\n";
                $msg .= 'Content-type: text/html; charset=utf-8' . "\r\n\r\n";
                $msg .= '<html><body>';
                $msg .= '<p>Nom : ' . $nom . '</p>';
                $msg .= '<p>Prenom : ' . $prenom . '</p>';
                $msg .= '<p>Email : ' . $email . '</p>';
                $msg .= '<p>Instagram : ' . $instagram . '</p>';
                $msg .= '<p>Plus d\'infos : ' . $plusInfo . '</p><br><hr><br>';
                $msg .= '<p>Projet : Flash</p>';
                $msg .= '<p>Emplacement : ' . $emplacement . '</p>';
                $msg .= '<p>Taille : ' . $taille . '</p>';
                $msg .= '<p>Date souhaiter : ' . $date . '</p><br>';
                $msg .= '<p>Fait le ' . date('l jS \of F Y h:i:s A') . '</p>';



                $msg .= '</body></html>' . "\r\n";
                // Pièce jointe
                $file_name = $flash;

                if (file_exists($file_name)) {
                    $file_type = mime_content_type($file_name);
                    $file_size = filesize($file_name);


                    $handle = fopen($file_name, 'r') or die('File ' . $file_name . ' can\'t be open');
                    $content = fread($handle, $file_size);
                    $content = chunk_split(base64_encode($content));
                    fclose($handle);

                    $msg .= '--' . $boundary . "\r\n";
                    $msg .= 'Content-Type: ' . $file_type . '; name="' . $file_name . '"' . "\r\n";
                    $msg .= 'Content-Transfer-Encoding: base64' . "\r\n";
                    $msg .= 'Content-Disposition: attachment; filename="' . $file_name . '"' . "\r\n\r\n";
                    $msg .= $content . "\r\n";
                }

                // PROJET PERSONNEL
            } else if ($projet == "projetPersonnel") {
                // Objet/Sujet
                $subject = 'Formulaire de ' . $nom . ' ' . $prenom . ' [ PROJET PERSONNEL ]';

                // Message HTML
                $msg = '--' . $boundary . "\r\n";
                $msg .= 'Content-type: text/html; charset=utf-8' . "\r\n\r\n";
                $msg .= '<html><body>';
                $msg .= '<p>Nom : ' . $nom . '</p>';
                $msg .= '<p>Prenom : ' . $prenom . '</p>';
                $msg .= '<p>Email : ' . $email . '</p>';
                $msg .= '<p>Instagram : ' . $instagram . '</p>';
                $msg .= '<p>Plus d\'infos : ' . $plusInfo . '</p><br><hr><br>';
                $msg .= '<p>Projet : Projet Personnel</p>';
                $msg .= '<p>Description du Projet : ' . $description . '</p>';
                $msg .= '<p>Emplacement : ' . $emplacement . '</p>';
                $msg .= '<p>Taille : ' . $taille . '</p>';
                $msg .= '<p>Date souhaiter : ' . $date . '</p><br>';
                $msg .= '<p>Fait le ' . date('l jS \of F Y h:i:s A') . '</p>';



                $msg .= '</body></html>' . "\r\n";

                $uploaded_file = $_FILES["photoReference"]["tmp_name"];

                if (file_exists($uploaded_file)) {
                    $file_name = $_FILES["photoReference"]["name"];
                    $file_type = mime_content_type($uploaded_file);
                    $file_size = filesize($uploaded_file);

                    $handle = fopen($uploaded_file, 'r');
                    $content = fread($handle, $file_size);
                    fclose($handle);

                    $content = chunk_split(base64_encode($content));

                    $msg .= '--' . $boundary . "\r\n";
                    $msg .= 'Content-Type: ' . $file_type . '; name="' . $file_name . '"' . "\r\n";
                    $msg .= 'Content-Transfer-Encoding: base64' . "\r\n";
                    $msg .= 'Content-Disposition: attachment; filename="' . $file_name . '"' . "\r\n\r\n";
                    $msg .= $content . "\r\n";

                    // Maintenant, vous pouvez utiliser $msg pour envoyer un e-mail ou le traiter comme nécessaire.
                }
            }





            // Terminer le message
            $msg .= '--' . $boundary . '--' . "\r\n";

            if (mail($to, $subject, $msg, $headers)) {
                echo "<h1 style='text-align:center;'>♥ Votre message a bien été posté. Merci de votre confiance vous allez etre rédirégé vers l'accueil ♥</h1>";
                unset($_POST);
            } else {
                header("Location: ./error.html");
            }
        } else {
            header("Location: ../index.php");
        }
    } else {
        header("Location: ../contact.php");
    }


    ?>
    <script>
        setTimeout(function() {
            window.location.href = "../index.php"; // Remplacez "nouvelle_page.html" par l'URL vers laquelle vous souhaitez rediriger
        }, 5000);
    </script>
</body>

</html>