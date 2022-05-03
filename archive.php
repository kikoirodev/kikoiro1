<?php
/**
 * The template for displaying archive pages
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
	<?php
		$classForWidth = "archive";
		$obj = get_queried_object();
		$isAuthor = is_author();

		if ($obj->slug == "all-about-uhl") {
			$classForWidth = "single";
			get_template_part( 'template-parts/content/content', 'contents' );
		}
		else {
			echo '<section id="searchResult" class="category">';
			echo '<h1 class="page-title">';
			if ($isAuthor) {
				echo get_the_author() . " の記事一覧";
			} else {
				single_cat_title();
			}
			echo '</h1>';
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
			$count = countPostsInNewsAndColumn(false);
			echoKikoiroPager($count > 12);
		}
		echo "</section>";
	?>
	</main>
</div>

<?php
$categories = [];
$categoryPathSource = '<div id="breadCrumb" class="' . $classForWidth . '"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths">';
if ($isAuthor) {
	$categoryPathSource .= '<span class="path">' . get_the_author() . '</span>';
}
else {
	$currentCategory = $obj;
	$parentCategoryId = $currentCategory->parent;
	if ($parentCategoryId != 0) {
		array_push($categories, get_category($parentCategoryId));
	}
	array_push($categories, $currentCategory);
	if ($categories) {
		foreach ($categories as $category) {
			$categoryPathSource .= '<a href="' . get_category_link( $category->term_id ) . '" class="path"><span>' . $category->cat_name . '</span></a>';
		}
	}
}
echo $categoryPathSource . "</span></div>";
get_footer();
