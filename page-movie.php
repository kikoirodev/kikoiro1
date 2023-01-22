<?php
/**
 * The template for displaying static pages
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
		<section id="page" class="article">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

        <div class="entry-content">
        <?php the_content(); ?>
        	<div class="movie-area">
                <?php 
                    $movies = SCF::get( '動画一覧', 7377 );
                    foreach ($movies as $movie):
                ?>
                    <div class="movie-wrap">
                        <div class="movie-item">
                            <?php echo $movie['movie_embed']; ?>
                        </div>
                        <div class="movie-item">
                            <?php echo $movie['movie_description']; ?>
                            <span class="showMore"><a href="<?php echo $movie['movie_btn_url']; ?>"><?php echo $movie['movie_btn_text']; ?></a></span>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>

            </article>
		</section>
	</main>
</div>
<?php
echo '<div id="breadCrumb" class="single"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths">';
the_title( '<span class="path">', '</span></span></div>' );
get_footer();