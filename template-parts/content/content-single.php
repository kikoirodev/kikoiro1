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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if (has_tag("coverImage") && isFirstPage()) {
			get_template_part( 'template-parts/content/content', 'single-titlepart-rich' );
		}
		else {
			get_template_part( 'template-parts/content/content', 'single-titlepart' );
		}
	?>
	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentynineteen' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">ページ: ',
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->



</article><!-- #post-<?php the_ID(); ?> -->
