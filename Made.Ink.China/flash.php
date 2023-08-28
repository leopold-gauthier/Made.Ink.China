<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("./include/link-include.php") ?>
    <title>Flash</title>
    <link href="./css/flash.css" rel="stylesheet">
    <meta name="description" content="Mes Flashs a disposition">
</head>

<body>
    <header>
        <?php include_once("./include/header-include.php"); ?>
    </header>
    <main>
        <section>
            <h1>ꕥ Flash ꕥ</h1>
            <p>Chaque flash est unique</p>
        </section>
        <hr>

        <section>
            <div id="flashImage">
                <!-- Les images seront affichées ici -->
            </div>
            <div id="pagination">
                <!-- Les pages seront affichées ici -->
            </div>

        </section>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            let currentPage = params.get('page');

            function fetchImages(page) {
                fetch('./json/flash_fetch_page.php?page=' + page)
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        let totalPages = data.totalPages;
                        let images = data.images;

                        let imageContainer = document.getElementById('flashImage');

                        images.forEach(imagePath => {
                            const image = new Image();
                            image.src = imagePath.replace(/\./, '');
                            const anchor = document.createElement('a');
                            anchor.href = `./contact.php?flash=${encodeURIComponent(imagePath)}#divProjet`;
                            anchor.target = '_blank';
                            anchor.appendChild(image);

                            imageContainer.appendChild(anchor);
                        });

                        let paginationContainer = document.getElementById('pagination');

                        paginationContainer.innerHTML = ''; // Clear previous pagination

                        for (let i = 1; i <= totalPages; i++) {
                            let page = document.createElement('a');
                            page.textContent = i;
                            page.href = "./flash.php?page=" + i + "#flashImage"
                            paginationContainer.appendChild(page);
                            if (parseInt(currentPage) === i) {
                                page.classList.add('current-page');
                            }
                        }



                    })
                    .catch(function(error) {
                        console.error('Error fetching images:', error);
                    });


            }

            fetchImages(currentPage);

        });
    </script>

</body>

</html>