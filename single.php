<?php
/**
 * The template for displaying all single posts
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
	<main id="main" class="single">
		<section class="article">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'single' );
				echo do_shortcode('[Sassy_Social_Share]');

				echo '<h3 id="aboutAuthor">著者紹介</h3>';
				if ( function_exists( 'wpsabox_author_box' ) ) {
					echo wpsabox_author_box();
				}

				if ( is_singular( 'attachment' ) ) {
					// Parent post navigation.
					the_post_navigation(
						array(
							/* translators: %s: parent post link */
							'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentynineteen' ), '%title' ),
						)
					);
				}
				elseif ( is_singular( 'post' ) ) {
					// Previous/next post navigation.
					$source = get_the_post_navigation(
						array(
							'in_same_term' => true,
							'next_text' => '<span class="meta-nav" aria-hidden="true">次の記事</span> ' . 
								'<span class="post-title">%title</span>',
							'prev_text' => '<span class="meta-nav" aria-hidden="true">前の記事</span> ' .
								'<span class="post-title">%title</span>',
						)
					);
					$source = preg_replace('/\<h2\s.*<\/h2>/', '', $source);
					echo $source;
				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile;
			?>
		</section>
	</main>
</div>
<?php
$categories = get_the_category();
$categoryPathSource = '<div id="breadCrumb" class="single"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths">';
$paths = "";
if ($categories) {
	foreach ($categories as $cat0) {
		if ($cat0->parent == 0) {
			$paths = '<a href="' . get_category_link($cat0->term_id) . '" class="path"><span>' . $cat0->cat_name . '</span></a>' . $paths;
		}
		else {
			$paths .= '<a href="' . get_category_link($cat0->term_id) . '" class="path"><span>' . $cat0->cat_name . '</span></a>';
		}
	}
}
echo $categoryPathSource . $paths;
the_title( '<span class="path">', '</span></span></div>' );
get_footer();
