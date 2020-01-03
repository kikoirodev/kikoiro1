<?php
/**
 * Template part for displaying posts
 *
 * Theme Name: kikoiro1
 * Author: Hironobu Kimura
 * Author URI: https://www.emotionale.jp/
 * Version: 1
 * kikoiro1 is based on Underscores twentynineteen by WordPress team.
 * twentynineteen is distributed under the terms of the GNU GPL v2 or later.
 * License: No License
 */

?>
<div class="richTitlePart">
	<?php echoPostThumbnail('large', false, "articleTopImage"); ?>
	<div class="articleInfo">
		<div class="categoryPath">
		<?php
			$isNewsAndColumnCagetory = isNewsAndColumnCagetory();
			$categories = get_the_category();
			$categoryPathSource = "";
			$paths = "";
			if ($categories) {
				foreach ($categories as $cat0) {
					if ($cat0->parent == 0) {
						$paths = '<span><a href="' . get_category_link($cat0->term_id) . '" class="categoryPath coverImage">' . $cat0->cat_name . '</a></span>' . $paths;
					}
					else {
						$paths .= '<span><a href="' . get_category_link($cat0->term_id) . '" class="categoryPath coverImage">' . $cat0->cat_name . '</a></span>';
					}
				}
			}
			echo $paths;
		echo '</div>';
		the_title( '<h1 class="entry-title coverImage">', '</h1>' );
		echo '<div class="author coverImage">';
			if ($isNewsAndColumnCagetory) {
				echo get_the_date() . " − ";
			}
			?>
			Written by <a href="#aboutAuthor"><?php echo get_the_author(); ?></a>
		</div>
	</div>
</div>
