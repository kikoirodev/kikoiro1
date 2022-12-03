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
	global $post;
	$user_id = $post->post_author;
	$profile_img = SCF::get_user_meta($user_id,'profile_image');
	if(!$profile_img){
		$profile_img = '3633';//デフォルトのアイコン
	}
	$img = wp_get_attachment_image_url($profile_img, 'thumbnail');
	$profile_description = SCF::get_user_meta($user_id,'profile_description');
	$author_name = get_the_author_meta('display_name');
	$archive_url = get_author_posts_url( $user_id );
	$twitter_url = SCF::get_user_meta($user_id,'profile_twitter_url');
	$profile_web = SCF::get_user_meta($user_id,'profile_web');
?>
<div class="saboxplugin-wrap" itemtype="http://schema.org/Person" itemscope="" itemprop="author">
	<div class="saboxplugin-tab">
		<div class="saboxplugin-gravatar">
			<img src="<?php echo $img; ?>" width="100" height="100" alt="<?php echo $author_name; ?>" itemprop="image">
		</div>
		<div class="saboxplugin-authorname">
			<a href="<?php echo $archive_url; ?>" class="vcard author">
			<span class="fn"><?php echo $author_name; ?></span>
		</a>
	</div>
	<div class="saboxplugin-desc">
		<div itemprop="description">
			<?php echo $profile_description; ?>
		</div>
	</div>
	<?php if( $profile_web ): ?>
		<div class="saboxplugin-web">
			<?php echo $profile_web; ?>
		</div>
	<?php endif; ?>
	<div class="clearfix"></div>
	<?php if( $twitter_url ): ?>
		<div class="saboxplugin-socials ">
			<a target="_blank" rel="noopener noreferrer" href="<?php echo $twitter_url; ?>" class="saboxplugin-icon-grey">
				<svg aria-hidden="true" class="sab-twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>
			</a>
		</div>
	<?php endif; ?>
</div>
</div>

