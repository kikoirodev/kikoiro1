<?php
/**
 * Template Name: AboutPage  
 */
/*
 * The template for displaying /about
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
	<main id="main" class="about">
        <section id="page">
        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		
        <section id="media">
            <?php
                $media_text = SCF::get( 'media_text', 1201 );
                echo $media_text;
            ?>
            <ul>
            <?php
    $media_items = SCF::get_option_meta('media-options', 'media_items');
    foreach ($media_items as $media_item) { 

        if($media_item['media_link_url']  && ( $media_item['media_menu_text'] || $media_item['media_link_text'] ) ){
            $media_name = $media_item['media_menu_text'];
            if( $media_item['media_link_text'] ){
                $media_name = $media_item['media_link_text'];
            }
?>
        <li>
            <a href="<?php echo $media_item['media_link_url']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $media_item['media_publish_date']; ?>　<?php echo $media_name; ?></a>                        
        </li>
<?php
        }
    }                            
?> 
        </ul>    
        </section>
    </section>
	</main>
</div>
<?php
echo '<div id="breadCrumb" class="single"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths">';
the_title( '<span class="path">', '</span></span></div>' );
get_footer();
