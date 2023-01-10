<!-- 
    This files contains functions that are used in all subpages,
    namely movie.php, television.php, music.php, miscellaneous.php, AND search-results.php
 -->

 <?php
 
 /**
  * Renders the subpage header based on parameters
  * 
  * @param $sh_bgimg            the background image of the header, visual of most recent article under subcategory
  * @param $sh_gradientclass    the CSS class name that will style the subcategory's gradient
  * @param $sh_heading          the subcategory name to be displayed in the header
  * @param $sh_iconpath         the icon representing the subcategory to be displayed in the header
  */
function render_subpage_header(
    $sh_bgimg,
    $sh_gradientclass,
    $sh_heading,
    $sh_iconpath
) {
    echo <<<SUBPAGE_HEADER
    <header class="subpage-header {$sh_gradientclass}" style="background-image: url({$sh_bgimg}});">
        <img class="sh-icon" src="{$sh_iconpath}" alt="Movie Icon">
        <h1 class="sh-heading">{$sh_heading}</h1>
    </header>
    SUBPAGE_HEADER;
}

 /**
  * Renders the HTML for the pagination links.
  * 
  * @param $page_count  the total number of pages
  * @param $current_url the url that will be appended with "?page=". value passed is usually "basename(__FILE__)"
  */
function render_page_links($page_count, $current_url) {
    echo '<nav aria-label="Page navigation" data-bs-theme="dark">';
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $page_count; $i++) {
        $page_url = $current_url."?page=".$i;
        echo <<<PAGE_LINK
            <li class="page-item"><a class="page-link" href="{$page_url}">{$i}</a></li>
        PAGE_LINK;
    }
    echo '</ul>';
    echo '</nav>';
}

/**
 * This function assigns the article information to individual variables
 * 
 * @param $article      an array containing the article's information
 * @param &$visual_url  the reference to the variable which will be assigned the article visual url
 * @param &$title       the reference to the variable which will be assigned the article title
 * @param &$date        the reference to the variable which will be assigned the article date
 * @param &$authors     the reference to the variable which will be assigned the article authors
 * @param &$article_url the reference to the variable which will be assigned the article url
 */
function init_article_info_subpage(
    $article,
    &$visual_url,
    &$title,
    &$date,
    &$authors,
    &$article_url
) {
    $visual_url = $article["jetpack_featured_media_url"];
    $title = del_kicker($article["title"]["rendered"]);
    $date = date('F j, Y', strtotime($article["date"]));
    $authors = get_authors($article["authors"]);
    $article_url = $article["link"];
}

/**
 * This function renders the HTML for each article card
 * and styles in based on the category
 * 
 * @param $articles  the array containing the list of articles   
 * @param $ac_class  the CSS class name for styling the article card
 */
function render_subpage_article_cards($articles, $ac_class) {
    foreach ($articles as $article) {
        init_article_info_subpage(
            $article,
            $visual_url,
            $title,
            $date,
            $authors,
            $article_url
        );

        echo <<<ARTICLE_CARD
            <div class="col">
                <div class="sp-article-card {$ac_class}">
                    <img class="sp-ac-visual" src="{$visual_url}" alt="">
                    <div class="sp-ac-wrapper">
                        <h2 class="sp-ac-title">{$title}</h2>
                        <p class="sp-ac-date">{$date}</p>
                        <p class="sp-ac-authors">{$authors}</p>
                    </div>
                    <a class="stretched-link" href="{$article_url}" target="_blank"></a>
                </div>
            </div>
        ARTICLE_CARD;
    }
}
 
 ?>