<?php require_once 'php/functions/functions-global.php' ?>
<?php require_once 'php/session/session-home.php' ?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once 'php/components/head.php' ?>
    <link rel="stylesheet" href="css/homepage.css">

    <!-- Title -->
    <title>The LaSallian: Rant and Rave</title>
</head>

<body>
    <!-- Navbar -->
    <?php require_once 'php/components/navbar.php' ?>

    <!-- Header -->
    <header>
        <h1>Header</h1>
    </header>

    <!-- Quick Ratings (2nd-5th Most Recent Articles) -->
    <section>
        <h1>Quick Ratings (2nd-5th Most Recent Articles)</h1>
    </section>

    <!-- Tags (Movie, Television, Music, Miscellaneous) -->
    <?php initialize_sections($sections); // Initialize list of RNR tags and their respective articles ?>
    <?php foreach ($sections as $section): // Create a section for each RNR tag ?>
        <section id="<?php echo $section["tag_name"]; ?>" class="category-section mb-5">
            <div class="container">
                <!-- Heading -->
                <div class="d-flex justify-content-between mb-5">
                    <!-- Tag Name and Icon -->
                    <div class="tag-section-heading d-flex align-items-center">
                        <img class="tag-section-icon me-4" src="<?php echo $section["icon_url"] ?>" alt="" />
                        <h1 class="fs-2 mb-0"><?php echo ucwords($section["tag_name"]); ?></h1>
                    </div>
                    <!-- View All Link -->
                    <div class="d-flex align-items-center position-relative">
                        <a class="cs-view-all text-reset text-decoration-none stretched-link" href="<?php echo $section["view_all_url"]; ?>">View All</a>
                        <span class="material-icons">chevron_right</span>
                    </div>
                </div>
                <!-- Articles -->
                <div class="row row-cols-2 row-cols-lg-4">
                    <?php render_article_cards($section["articles"], $section["article_rating_class"], $section["article_title_class"]); ?>
                </div>
            </div>
        </section>
    <?php endforeach; ?>

    <!-- Footer -->
    <?php require_once 'php/components/footer.php' ?>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>

