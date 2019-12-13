<?php
/**
 * Template Name: page-in-about
 */
/*
 * The template for displaying pages in /about
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
    <main id="main" class="in-about">
		<section id="page" class="article">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'page' );
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			?>
		</section>
	</main>
</div>
<?php
/*
echo '<div id="breadCrumb" class="single"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths"><a href="/about" class="path"><span>きこいろについて</span></a>';
the_title( '<span class="path">', '</span></span></div>' );
*/

$pathSource = '<div id="breadCrumb" class="single"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths">';
$paths = "";
$parentId = $post->post_parent;
while ($parentId) {
    $parent = get_post($parentId);
    $paths = '<a href="' . get_post_permalink($parentId) . '" class="path"><span>' . get_the_title($parentId) . '</span></a>' . $paths;
    $parentId = $parent->post_parent;
}
echo $pathSource . $paths;
the_title( '<span class="path">', '</span></span></div>' );
get_footer();
