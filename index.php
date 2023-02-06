<?php require_once 'php/functions/functions-global.php' ?>
<?php require_once 'php/functions/functions-home.php' ?>
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
    <?php 
        $nav_bg_class = 'nav-darkbg';
        require_once 'php/components/navbar.php'
    ?>

    <!-- Header -->
    <?php
        # Fetch Article Info
        $first_article = $_SESSION["ARTICLE_INFO_ALL"][0];
        initialize_article_info(
            $first_article,
            $visual_url,
            $title,
            $date,
            $authors,
            $rating,
            $article_url
        );
        $excerpt = $first_article["excerpt"]["rendered"];
        $excerpt = str_replace("<p>", "", $excerpt);
        $excerpt = str_replace("Variety", "", $excerpt);
        $article_tag = $first_article["tags"];

        # Conditional Header Styles
        if(in_array(2147, $article_tag)) // Movie
        {
            $header_style = 'linear-gradient(180deg, rgba(18, 193, 249, 0.5) 0%, rgba(0, 0, 0, 0) 74.48%), linear-gradient(0deg, rgba(57, 57, 57, 0.9), rgba(57, 57, 57, 0.9))';
            $rating_style = 'style="background-color:var(--movie-bg-85-darker);"';
            $title_style = 'style="color:#94E0F6"';
            $excerpt_style = 'background: rgba(15, 151, 191, 0.15);';
            $visual_style = 'border: 1px solid #072832; filter: drop-shadow(0px 4px 4px rgba(31, 54, 61, 0.85));';
        }
        else if(in_array(2107, $article_tag)) // Music
        {
            $header_style = 'linear-gradient(180deg, rgba(145, 176, 47, 0.5) 0%, rgba(0, 0, 0, 0) 74.48%), linear-gradient(0deg, rgba(57, 57, 57, 0.9), rgba(57, 57, 57, 0.9))';
            $rating_style = 'style="background-color:#718829"';
            $title_style = 'style="color:#CCDF90;"';
            $excerpt_style = 'background: rgba(145, 176, 47, 0.15);';
            $visual_style = 'border: 1px solid #2F3321; filter: drop-shadow(0px 4px 4px rgba(70, 76, 49, 0.85));';
        }
        else if(in_array(2225, $article_tag)) // Television
        {
            $header_style = 'linear-gradient(180deg, rgba(201, 89, 163, 0.5) 17.49%, rgba(0, 0, 0, 0) 78.94%), linear-gradient(0deg, rgba(57, 57, 57, 0.9), rgba(57, 57, 57, 0.9))';
            $rating_style = 'style="background-color:#9D4980"';
            $title_style = 'style="color:#F2A7D9;"';
            $excerpt_style = 'background: rgba(201, 89, 163, 0.15);';
            $visual_style = 'border: 1px solid #33232E; filter: drop-shadow(0px 4px 4px rgba(76, 53, 69, 0.85));';
        }
        else if(in_array(2226, $article_tag)) // Miscellaneous
        {
            $header_style = 'linear-gradient(180deg, rgba(254, 175, 48, 0.5) 0%, rgba(0, 0, 0, 0) 74.48%), linear-gradient(0deg, rgba(57, 57, 57, 0.9), rgba(57, 57, 57, 0.9))';
            $rating_style = 'style="background-color:#B98229"';
            $title_style = 'style="color: #EFCF9A;"';
            $excerpt_style = 'background: rgba(254, 175, 48, 0.15);';
            $visual_style = 'border: 1px solid #332C21; filter: drop-shadow(0px 4px 4px rgba(77, 66, 49, 0.85));';
        }
        else // No tag
        {
            $header_style = 'linear-gradient(180deg, rgba(255, 128, 83, 0.5) 0%, rgba(0, 0, 0, 0) 74.48%), linear-gradient(0deg, rgba(57, 57, 57, 0.9), rgba(57, 57, 57, 0.9))';
            $rating_style = 'style="background-color:#DF734D"';
            $title_style = 'style="color:#F2AE95;"';
            $excerpt_style = 'background: rgba(250, 138, 98, 0.15);';
            $visual_style = 'border: 1px solid #735247; filter: drop-shadow(0px 4px 4px rgba(117, 90, 68, 0.85));';
        }
    ?>

    <header>
        <div class="header-bg" style="background-image: <?=$header_style?>, url(<?php echo $visual_url; ?>);">
        <a href="<?php echo $article_url; ?>" style="text-decoration:none">
        <div class="container py-5">
            <div class="row">    
                <!-- Header Article Text -->
                <div class="header-article pb-6 px-auto mx-auto col-md-12 col-lg-6 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-lg-start text-center">
                
                    <!-- Rating -->
                    <p class="article-rating ac-rating mb-3 d-inline-block rounded-pill" <?=$rating_style?> ><strong><?php echo $rating; ?></strong></p>
                    
                    <!-- Title -->
                    <h4 class="article-title mb-3"> <strong><?php echo $title; ?></strong></h4>
                
                    <!-- Article Date & Author/s -->
                    <p class="article-date mb-0"><strong><?php echo $date; ?></strong></p> 
                    <p class="article-author mb-3"><?php echo $authors; ?></p>

                    <!-- Article Excerpt -->
                    <p class="article-excerpt d-inline-block rounded p-4" style="border-radius:0.8em; <?=$excerpt_style?>" ><?php echo $excerpt; ?></p>
                </div>

                <!-- Header Article Image -->
                <div class="header-article-image mx-auto col-md-12 col-lg-5 d-flex justify-content-center align-items-center align-items-lg-start">
                    <img class="card-img w-100 h-100 rounded overflow-hidden border-0" style="object-fit:cover; border-radius: 1.1em; <?=$visual_style?>" src="<?php echo $visual_url; ?>" alt="">
                </div>
            </div>
        </div></a></div>
    </header>

    <!-- Quick Ratings (2nd-5th Most Recent Articles) -->
    <section class="quick-ratings">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                <!-- Fetch articles -->
                <?php $all_articles = $_SESSION["ARTICLE_INFO_ALL"]; ?>
                <!-- Fetch info and render cards per article beginning from 2nd article (index 1) -->
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <!-- Fetch Info -->
                    <?php
                        initialize_article_info_quickratings(
                            $all_articles[$i],
                            $visual_url,
                            $title,
                            $date,
                            $tags,
                            $rating,
                            $article_url
                        );
                    ?>
                    <!-- Render card -->
                    
                        <div class="col">
                            <a href="<?php echo $article_url; ?>" class="qr-url my-0">
                                <div class="qr-card <?php echo get_qr_bg_class($tags); ?>" style="background-image: url(<?php echo $visual_url; ?>);">
                                    <div>
                                        <p class="qr-title"><strong><?php echo $title; ?></strong></p>
                                        <p class="qr-date"><?php echo $date; ?></p>
                                    </div>
                                    <div class="qr-subtitle d-flex align-items-center">
                                        <img class="qr-icon me-2" src="<?php echo get_qr_icon($tags); ?>" alt=""></img>
                                        <p class="qr-rating my-auto ms-2"><strong><?php echo $rating; ?></strong></p>
                                    </div> 
                                </div>
                            </a>
                        </div>
                    
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Tags (Movie, Television, Music, Miscellaneous) -->
    <?php initialize_sections($sections); // Initialize list of RNR tags and their respective articles ?>
    <?php foreach ($sections as $section): // Create a section for each RNR tag ?>
        <section id="<?php echo $section["tag_name"]; ?>" class="category-section mb-4">
            <div class="container">
                <!-- Heading -->
                <div class="d-flex justify-content-between mb-4">
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
    <?php
        $first_article = $_SESSION["ARTICLE_INFO_ALL"][0];
        $footer_bg = $first_article["jetpack_featured_media_url"];
        require_once 'php/components/footer.php';
    ?>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Navbar Scripts -->
    <script src="js/navbar-home.js"></script>
</body>

</html>
