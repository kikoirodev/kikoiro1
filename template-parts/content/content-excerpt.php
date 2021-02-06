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
	<figure class="post-thumbnail">
		<a class="post-thumbnail-inner" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php echoPostThumbnail('post-thumbnail', true); ?>
		</a>
	</figure>
	<?php
		$categories = get_the_category();
		$output = '<div class="postCategories">';
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$output .= '<a href="' . get_category_link( $category->term_id ) . '" class="categoryTag <?php echo $category->slug; ?>">' . $category->cat_name . '</a>';
			}
		}
		$output .= '</div>';
		echo $output;
	?>
	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<?php the_title( '<h3 class="entry-title"><span>', '</span></h3>' ); ?>
		<?php echo wp_trim_excerpt(); ?>
		<div class="postDate"><?php echo get_the_date(); ?></div>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
