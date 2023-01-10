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
    for ($i = 1; $i <= $page_count; $i++) {
        $page_url = $current_url."?page=".$i;
        echo <<<PAGE_LINK
            <a href="{$page_url}">{$i}</a>
        PAGE_LINK;
    }
}
 
 ?>