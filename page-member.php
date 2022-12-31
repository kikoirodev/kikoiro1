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
          <?php 
            $members = SCF::get( 'メンバー設定', 1490 );
            foreach ($members as $member):
                  $name = '';
                  $job_title = '';
                  $img_id = '';
                  $description = '';
                  $comment = '';
                  $twitter = '';
                  $facebook = '';
                  $web = '';
                  $archive_url = '';
                  $slug = $member['user_slug'];
                  $u_id = get_user_by( 'slug', $slug )->ID; 

              if( $u_id ){
                  $name = mb_convert_kana( get_the_author_meta( 'display_name', $u_id ), 's');//全角を半角に変換
                  $job_title = SCF::get_user_meta($u_id,'job_title');
                  $img_id = SCF::get_user_meta($u_id,'profile_image');
                  $description = SCF::get_user_meta($u_id,'profile_description');
                  $comment = SCF::get_user_meta($u_id,'profile_comment');;
                  $twitter = SCF::get_user_meta($u_id,'profile_twitter_url');
                  $facebook = SCF::get_user_meta($u_id,'profile_facebook_url');
                  $web = SCF::get_user_meta($u_id,'profile_web');
                  $archive_url = get_author_posts_url( $u_id );

              } else{
                $name = $member['user_name'];
                $job_title = $member['job_title'];
                $img_id = $member['profile_image'];
                $description = $member['profile_description'];
                $comment = $member['profile_comment'];
                $twitter = $member['profile_twitter_url'];
                $facebook = $member['profile_facebook_url'];
                $web = $member['profile_web'];
              }
              $img_url = wp_get_attachment_url($img_id);

?>
            <div class="person">
              <div class="avatar">
                <img src="<?php echo $img_url; ?>" alt="<?php echo $name; ?>">
              </div>
              <h2 class="name">

                  <?php if( $archive_url ): ?>
                    <a href="<?php echo $archive_url; ?>">
                  <?php endif; ?>
                      <?php echo $name; ?>
                  <?php if( $archive_url ): ?>
                    </a>
                  <?php endif; ?>
                <div class="role"><?php echo $job_title; ?></div>
              </h2>
              <div class="description">
                <?php echo $description; ?>
                <?php if( $comment ): ?>
                  <hr>
                  <p class="message"><?php echo $comment; ?></p>
                <?php endif; ?>
              </div>
              <?php if( $web ): ?>
                <div class="web">
                  <?php echo $web; ?>
                </div>
              <?php endif; ?>
              <?php if( $facebook || $twitter ): ?>
                <div class="social">
                  <?php if( $facebook ): ?>
                  <a href="<?php echo $facebook; ?>" rel="nofollow" class="saboxplugin-icon-grey" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" viewBox="0 0 512 512" role="img">
                      <title>Facebook</title>
                       <path d="m375.1 288 14.2-92.7h-88.9v-60.1c0-25.3 12.4-50.1 52.2-50.1h40.4v-78.8s-36.7-6.3-71.7-6.3c-73.2 0-121.1 44.4-121.1 124.7v70.6h-81.4v92.7h81.4v224h100.2v-224h74.7z"></path>
                    </svg>
                  </a>
                  <?php endif; ?>
                  <?php if( $twitter ): ?>
                  <a href="<?php echo $twitter; ?>" rel="nofollow" class="saboxplugin-icon-grey" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 250 250" viewBox="0 0 250 250" role="img">
                      <title>Twitter</title>
                      <rect width="400" height="400" fill="none"></rect>
                      <path d="m78.62 226.57c94.34 0 145.94-78.16 145.94-145.94 0-2.22 0-4.43-0.15-6.63 10.038-7.261 18.704-16.251 25.59-26.55-9.361 4.148-19.292 6.868-29.46 8.07 10.707-6.41 18.721-16.492 22.55-28.37-10.068 5.975-21.084 10.185-32.57 12.45-19.425-20.655-51.916-21.652-72.572-2.227-13.321 12.528-18.973 31.195-14.838 49.007-41.241-2.067-79.665-21.547-105.71-53.59-13.614 23.436-6.66 53.419 15.88 68.47-8.163-0.242-16.147-2.444-23.28-6.42v0.65c7e-3 24.416 17.218 45.445 41.15 50.28-7.551 2.059-15.474 2.36-23.16 0.88 6.719 20.894 25.976 35.208 47.92 35.62-18.163 14.274-40.599 22.023-63.7 22-4.081-8e-3 -8.158-0.255-12.21-0.74 23.456 15.053 50.749 23.037 78.62 23"></path>
                      </svg>
                  </a>
                <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
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