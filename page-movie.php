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
                if ( class_exists('SCF') ):
                    $movies = SCF::get( '動画一覧', 10990 );
                        foreach ($movies as $movie):
                ?>
                        <div class="movie-wrap">
                            <div class="movie-item">
                                <figure class="wp-block-embed aligncenter is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
                                    <div class="wp-block-embed__wrapper">
                                        <span class="embed-youtube" style="text-align: center; display: block;">
                                            <iframe title="YouTube video player" src="<?php echo esc_html($movie['movie_embed_url']); ?>" width="640" height="360" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                                        </span>
                                    </div>
                                    <figcaption class="wp-element-caption">※字幕が必要な方は、設定ONにしてご覧ください。</figcaption>
                                </figure>
                            </div>
                            <div class="movie-item">
                                <?php echo $movie['movie_description']; ?>
                                <span class="showMore"><a href="<?php echo $movie['movie_btn_url']; ?>" target="_blank"><?php echo $movie['movie_btn_text']; ?></a></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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