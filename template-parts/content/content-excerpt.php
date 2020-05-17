<?php
/**
 * Template part for displaying post archives and search results
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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<figure class="post-thumbnail">
			<?php echoPostThumbnail('post-thumbnail', true); ?>
		</figure>
		<?php
			$categories = get_the_category();
			$output = '<div class="postCategories">';
			if ( $categories ) {
				foreach ( $categories as $category ) {
					$output .= '<span class="categoryTag">' . $category->cat_name . '</span>';
				}
			}
			$output .= '</div>';
			echo $output;
			the_title( '<h3 class="entry-title"><span>', '</span></h3>' );
		?>
		<?php echo wp_trim_excerpt(); ?>
		<div class="postDate"><?php echo get_the_date(); ?></div>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
