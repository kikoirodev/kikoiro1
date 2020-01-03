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
	<figure class="post-thumbnail"><a class="post-thumbnail-inner" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"><?php echoPostThumbnail('post-thumbnail-large', true); ?></a></figure>
    <?php
        $url = get_permalink();
		$categories = get_the_category();
		$output = '<div class="postCategories"><span class="newTag">NEW</span>';
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$output .= '<a href="' . get_category_link( $category->term_id ) . '" class="categoryTag">' . $category->cat_name . '</a>';
			}
		}
		$output .= '</div>';
		echo $output;
		the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url($url) ), '</a></h3>' );
	?>
	<?php the_excerpt(); ?>
    <div class="postDate"><?php echo get_the_date(); ?></div>
    <div class="readMore"><a href="<?php echo $url ?>"><span>Read More</span></a></div>
</article><!-- #post-<?php the_ID(); ?> -->
