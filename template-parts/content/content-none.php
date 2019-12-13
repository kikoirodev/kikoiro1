<?php
/**
 * Template part for displaying a message that posts cannot be found
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
<section class="no-results not-found">
	<!-- <h2>Article Not Found</h2> -->
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'twentynineteen' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p>検索キーワードに該当する記事がありませんでした。</p>
			<p class="backToHome"><a href="/">トップページに戻る</a></p>
			<?php
			/* get_search_form(); */

		else :
			?>
			<p>記事がまだありません。</p>
			<?php
			/* get_search_form(); */

		endif;
		?>
	</div>
</section>
