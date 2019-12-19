<?php
/**
 * The main template file
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
<div id="topImage">
<picture>
  <source media="(min-width: 641px)" srcset="/wp-content/themes/kikoiro1/assets/images/mainImage.jpg, /wp-content/themes/kikoiro1/assets/images/mainImage.jpg 1x, /wp-content/themes/kikoiro1/assets/images/mainImage@2x.jpg 2x" />
  <img srcset="/wp-content/themes/kikoiro1/assets/images/mainImageSp.jpg, /wp-content/themes/kikoiro1/assets/images/mainImageSp.jpg 1x, /wp-content/themes/kikoiro1/assets/images/mainImageSp@2x.jpg 2x" alt="聞こえ方は、いろいろ。" />
</picture>
</div>
	<main id="main">
	<section id="featured">
		<?php 
			/*
	query_posts('cat=' . getNotNewsAndColumnCategoryIDsString(true));
	if (have_posts()) {
		the_post();
		the_title( sprintf( '<div class="headline"><span class="new">NEW!</span><a href="%s" rel="bookmark"><span class="date">' . get_the_date() . "</span><", esc_url( get_permalink() ) ), '</a></div>' );
	}
	*/
	echo '<h2>FEATURED</h2>';
	query_posts('tag=new');
	if (have_posts()) {
		the_post();
		get_template_part( 'template-parts/content/content-excerpt-more');
	}
	?>
		</section>
		<section id="allAbout">
			<h2 class="topSection"><a href="/category/all-about-uhl">片耳難聴のすべて</a><br/><span>片耳難聴の専門家による専門的なガイダンスとアドバイス</span></h2>
			<div class="allAboutItems">
				<article class="allAboutCategory">
					<a href="/category/all-about-uhl/basic" class="thumb"><img src="/wp-content/themes/kikoiro1/assets/images/allAbout1d.jpg" data-srcset="/wp-content/themes/kikoiro1/assets/images/allAbout1d.jpg 1x, /wp-content/themes/kikoiro1/assets/images/allAbout1d@2x.jpg 2x" class="lazyload" alt="聞こえの基本" /></a>
					<h3><a href="/category/all-about-uhl/basic">聞こえの基本</a></h3>
					<ul>
						<li><a href="/hearing-mechanism">耳・聞こえの仕組み</a></li>
						<li><a href="/audiogram">オージオグラムの読み方</a></li>
						<li><a href="/symptom">難聴に伴う症状</a></li>
					</ul>
				</article>
				<article class="allAboutCategory">
					<a href="/category/all-about-uhl/uhl" class="thumb"><img src="/wp-content/themes/kikoiro1/assets/images/allAbout2d.jpg" data-srcset="/wp-content/themes/kikoiro1/assets/images/allAbout2d.jpg 1x, /wp-content/themes/kikoiro1/assets/images/allAbout2d@2x.jpg 2x" class="lazyload" alt="片耳難聴について" /></a>
					<h3><a href="/category/all-about-uhl/uhl">片耳難聴について</a></h3>
					<ul>
						<li><a href="/difficulty-reason">片耳難聴が聞こえにくい理由（両耳聴効果について）</a></li>
						<li><a href="/questionnaire-results">片耳難聴だと困る場面</a></li>
						<li><a href="/language-development">ことばの発達や学業への影響</a></li>
					</ul>
					<!--<div class="listBottom"><span class="showMore">Show More</span></div>-->
				</article>
				<article class="allAboutCategory">
					<a href="/category/all-about-uhl/hint" class="thumb"><img src="/wp-content/themes/kikoiro1/assets/images/allAbout3d.jpg" data-srcset="/wp-content/themes/kikoiro1/assets/images/allAbout3d.jpg 1x, /wp-content/themes/kikoiro1/assets/images/allAbout3d@2x.jpg 2x" class="lazyload" alt="対応や対策" /></a>
					<h3><a href="/category/all-about-uhl/hint">対応や対策</a></h3>
					<ul>
						<li><a href="/hint-for-family">家族が生活の中での工夫できること</a></li>
						<li><a href="/hint-in-school">周りの人が学校生活で工夫できること</a></li>
						<li><a href="/welfare">片耳難聴者が利用できる福祉制度</a></li>
						<li><a href="/not-applicable">片耳難聴者が利用できない福祉制度</a></li>
						<li><a href="/devices">片耳難聴に使える補聴機器</a></li>
						<li><a href="/uhl-and-music">片耳難聴と音楽</a></li>						
					</ul>
					<div class="listBottom"><span class="showMore">Show More</span></div>
				</article>
			</div>
		</section>
		<section id="newsAndColumn">
			<h2 class="topSection"><a href="/category/news-and-column">ニュース &amp; コラム</a><br/><span>きこいろからのお知らせ、ニュース、読み物などをお届けします</span></h2>
			<div id="itemsContainer">
				<div class="items">
					<?php
						query_posts('cat=' . getNotNewsAndColumnCategoryIDsString(true) . '&tag__not_in=' . getTagIdWithSlug('new') . 
									'&posts_per_page=6');
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'template-parts/content/content-excerpt' );
							}
						}
						else {
							get_template_part( 'template-parts/content/content', 'none' );
						}
					?>
				</div>
				<div id="itemsFooter">
					<?php
						$count = countPostsInNewsAndColumn();
						if ($count > 6) {
							echo '<span class="showMore" id="showMoreNews">Show More</span>';
						}
						echoKikoiroPager($count > 12, true);
					?>
				</div>
			</div>
			<div id="sideBar">
				<section>
					<h4>CATEGORIES</h4>
					<ul class="categoryList">
					<?php 
						$catNewsAndColumn = get_category_by_slug('news-and-column');
						$catAllAbout = get_category_by_slug('all-about-uhl');
						$catUncategorized = get_category_by_slug('uncategorized');
						$args = array(
						'show_option_all'    => '',
						'orderby'            => 'ID',
						'order'              => 'ASC',
						'style'              => 'list',
						'show_count'         => 0,
						'hide_empty'         => 1,
						'use_desc_for_title' => 0,
						'child_of'           => $catNewsAndColumn->term_id,
						'exclude'            => "" . $catUncategorized->term_id . "," . $catAllAbout->term_id,
						'title_li'           => __( '' ),
						'show_option_none'   => __( '' ),
						'echo'               => 1,
						'depth'              => 1
						);
						wp_list_categories( $args ); 
					?>
					</ul>
				</section>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area') ) : endif; ?>
				<section>
					<h4>MEDIA</h4>
					<ul class="mediaList">
						<li><a href="https://www.yomiuri.co.jp/local/kansai/news/20190914-OYO1T50024/"><img src="/wp-content/themes/kikoiro1/assets/images/media_yomiuri.png" class="lazyload" alt="読売新聞" /></a></li>
						<li><a href="/cafe10"><img src="/wp-content/themes/kikoiro1/assets/images/media_iwatenp.jpg" class="lazyload" alt="岩手日報" /></a></li>
						<li><a href="https://www.iwanichi.co.jp/2019/12/16/467354/"><img src="/wp-content/themes/kikoiro1/assets/images/media_iwatenn.png" class="lazyload" alt="岩手日日" /></a></li>
					</ul>
				</section>
			</div>
		</section>
	</main>
</div>
<?php
get_footer();
