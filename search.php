<?php
/**
 * The template for displaying search results pages
 *
 * Theme Name: kikoiro1
 * Author: Hironobu Kimura
 * Author URI: https://www.emotionale.jp/
 * Version: 1
 * kikoiro1 is based on Underscores twentynineteen by WordPress team.
 * twentynineteen is distributed under the terms of the GNU GPL v2 or later.
 * License: No License
 */

get_header();
?>
<div id="container">
	<main id="main">
	<section id="searchResult">
		<h1 class="page-title">
			"<?php echo get_search_query(); ?>" の検索結果
		</h1>
		<h2 class="searchResult">
		<?php 
		global $wp_query;
		$count = intval($wp_query->found_posts);
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$startItemNumber = 1 + 12 * ($paged - 1);
		$tillItemNumber = $startItemNumber + 11;
		if ($tillItemNumber > $count) $tillItemNumber = $count;
		if ($startItemNumber == $tillItemNumber) {
			echo "#" . $tillItemNumber . " / " . $count . '件の記事';
		}
		else {
			echo "#" . $startItemNumber . "-" . $tillItemNumber . " / " . $count . '件の記事';
		}
		echo "</h2>";
		if ( have_posts() ) {
			echo '<div class="items">';
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content/content', 'excerpt' );
			}
			echo "</div>";
		}
		else {
			get_template_part( 'template-parts/content/content', 'none' );
		}
		echoKikoiroPager($count > 12);
	?>
	</section><!-- #primary -->
	</main>
</div>
<?php
$categories = [];
echo '<div id="breadCrumb" class="archive"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths"><span class="path">検索結果</span></span></div>';
get_footer();
