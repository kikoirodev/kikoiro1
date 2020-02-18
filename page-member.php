<?php
/**
 * Template Name: MemberPage  
 */
/*
 * The template for /about/members
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
	<main id="main" class="member">
        <section id="page">
        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        <div id="members">
            <?php the_post(); the_content(); ?>
        </div>
        <section id="recruiting">
            <h2>RECRUITING</h2>
            <p class="normalLink">きこいろは上記の有志プロジェクトメンバーにより運営されています。一緒に企画運営を担ってくださる方、ボランティアでご協力下さる方を随時募集しております。ご希望の方はこちらの<a href="https://docs.google.com/forms/d/e/1FAIpQLSdjrXp2-vWL0i8sqH6U1XTMixEzIsseorrC0sbFQZiy3pQZsw/viewform">お申し込みフォーム</a>よりご連絡ください。</p>
        </section>
        </section>
	</main>
</div>
<?php
echo '<div id="breadCrumb" class="page"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths"><a href="/about" class="path"><span>きこいろについて</span></a>';
the_title( '<span class="path">', '</span></span></div>' );
get_footer();
?>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script>
jQuery(function($){  
  $('#members').masonry({
    itemSelector: '.person',
    fitWidth: true,
    columnWidth: ".person",
    gutter: 16
  });  
});
</script>