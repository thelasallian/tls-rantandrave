<!-- 
    This files contains functions that are used in all subpages,
    namely movie.php, television.php, music.php, miscellaneous.php, AND search-results.php
 -->

 <?php
 
 // Function to render page links
function render_page_links($page_count, $current_url)
{
    for ($i = 1; $i <= $page_count; $i++) {
        $page_url = $current_url."?page=".$i;
        echo <<<PAGE_LINK
            <a href="{$page_url}">{$i}</a>
        PAGE_LINK;
    }
}
 
 ?>