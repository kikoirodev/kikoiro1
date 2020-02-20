<?php
/**
 * Template part for all-about-uhl contents page
 * 
 * Theme Name: kikoiro1
 * Author: the Hironobu Kimura
 * Author URI: https://www.emotionale.jp/
 * Version: 1
 * kikoiro1 is based on Underscores twentynineteen by WordPress team.
 * twentynineteen is distributed under the terms of the GNU GPL v2 or later.
 * License: No License
 */
?>
<section id="academicContents">
<h1 class="page-title"><?php single_cat_title() ?><span><span>片耳難聴の専門家による</span><wbr/><span>専門的なガイダンスと</span><wbr/><span>アドバイス</span></span></h1>
<div>
	<h2>CONTENTS</h2>
	<article class="first">
		<h3><a href="/category/all-about-uhl/basic">聞こえの基本</a></h3>
		<div>
			<img src="/wp-content/themes/kikoiro1/assets/images/allAbout1d.jpg" data-srcset="/wp-content/themes/kikoiro1/assets/images/allAbout1d.jpg 1x, /wp-content/themes/kikoiro1/assets/images/allAbout1d@2x.jpg 2x" class="lazyload" alt="聞こえの基本" />
			<ol>
			<?php 
				$cat = get_category_by_slug('basic')->term_id;
				$exclude = get_category_by_slug('allabout-subpage')->term_id;
				query_posts('order=ASC&cat=' . $cat . ',-' . $exclude);
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content/content', 'contents-allabout-menu' );
				}
			?>
			</ol>
		</div>
	</article>
	<article class="second">
		<h3><a href="/category/all-about-uhl/uhl">片耳難聴について</a></h3>
		<div>
			<img src="/wp-content/themes/kikoiro1/assets/images/allAbout2d.jpg" data-srcset="/wp-content/themes/kikoiro1/assets/images/allAbout2d.jpg 1x, /wp-content/themes/kikoiro1/assets/images/allAbout2d@2x.jpg 2x" class="lazyload" alt="片耳難聴について" />
			<ol>
			<?php 
				$cat = get_category_by_slug('uhl')->term_id;
				$exclude = get_category_by_slug('allabout-subpage')->term_id;
				query_posts('order=ASC&cat=' . $cat . ',-' . $exclude);
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content/content', 'contents-allabout-menu' );
				}
			?>
			</ol>
		</div>
	</article>
	<article class="third">
		<h3><a href="/category/all-about-uhl/hint">対応や対策</a></h3>
		<div>
			<img src="/wp-content/themes/kikoiro1/assets/images/allAbout3d.jpg" data-srcset="/wp-content/themes/kikoiro1/assets/images/allAbout3d.jpg 1x, /wp-content/themes/kikoiro1/assets/images/allAbout3d@2x.jpg 2x" class="lazyload" alt="対応や対策" />
			<ol>
			<?php 
				$cat = get_category_by_slug('hint')->term_id;
				$exclude = get_category_by_slug('allabout-subpage')->term_id;
				query_posts('order=ASC&cat=' . $cat . ',-' . $exclude);
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content/content', 'contents-allabout-menu' );
				}
			?>
			</ol>
		</div>
	</article>
</div>
