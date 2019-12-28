<?php
/**
 * kikoiro1 functions and definitions
 *
 * Theme Name: kikoiro1
 * Author: Hironobu Kimura
 * Author URI: https://www.emotionale.jp/
 * Version: 1.10
 * kikoiro1 is based on Underscores twentynineteen by WordPress team.
 * twentynineteen is distributed under the terms of the GNU GPL v2 or later.
 * License: No License
 */


 wp_enqueue_script('clipboard');

function my_plugin_block_categories( $categories, $post ) {
    return array_merge(
        array(
            array(
                'slug' => 'kikoiro1',
                'title' => 'kikoiro.com'
            ),
		), 
		$categories
    );
}
add_filter( 'block_categories', 'my_plugin_block_categories', 10, 2 );

function kikoiro1RegisterBlocks() {

	//can't use absolute path for include
    $asset_file = include('../wp-content/themes/kikoiro1/gutenberg/build/index.asset.php');
	$versionNum = "" . time();
	$nameSpace = "kikoiro1";
	//to avoid js cache, append timestapm (build version ($asset_file['version']) seems not working...)
	$scriptPath = get_template_directory_uri() . '/gutenberg/build/index.js?v=' . $versionNum;

    wp_register_script(
        $nameSpace,
        $scriptPath, 
        $asset_file['dependencies'],
        $versionNum
    );
	registerBlockTypes(
		$nameSpace, 
		array(
			'sub-info', 
			'references', 
			'point-list', 
			'interview-q', 
			'interview-a', 
			'interviewee-profile', 
			'interviewee-profile-f', 
			'nextpage', 
			'medical-desc',
			'medical-desc-disease',
			'medical-desc-point',
			'main-ul',
			'h3-underline',
			'faq-item',
			'separator',

		));
}

add_action('enqueue_block_editor_assets', 'kikoiro1RegisterBlocks');

function registerBlockTypes($nameSpace, $blockNames) {
	foreach($blockNames as $blockName){
		register_block_type(
			"$nameSpace/$blockName",
			array('editor_script' => $nameSpace)
		);
	}
}

function kikoiro1EnqueueCss() {
	add_theme_support( 'editor-styles' );
	add_editor_style(get_template_directory_uri() . '/gutenberg/editor-style.css');
}
add_action('after_setup_theme', 'kikoiro1EnqueueCss');

add_filter( 'auto_update_plugin', '__return_false' );

function isFirstPage() {
	global $multipage;
	if ($multipage !== 0) {
		global $page;
		if ($page == 1) {
			return true;
		}
		else {
			return false;
		}
	}
	return true;
}

 // to add svg to media library
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

// add lazyload class to media image
function add_image_class($class){
    $class .= ' lazyload';
    return $class;
}
add_filter('get_image_tag_class','add_image_class');

// exclude pages from search
function wpb_search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
		$catUncategorized = get_category_by_slug('uncategorized')->term_id;
		$query->set('cat', '' . $catUncategorized * -1);
	}
	return $query;
}
add_filter('pre_get_posts','wpb_search_filter');

// ajax request
function load_next_6posts_for_home() {
	$message_id = $_REQUEST['message_id'];
	if ($message_id != "12345") {
    	wp_send_json_error("NG");
	}
	else {
		query_posts('cat=' . getNotNewsAndColumnCategoryIDsString(true) . '&tag__not_in=' . getTagIdWithSlug('new') . '&posts_per_page=6&paged=2');
		$source = "";
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				ob_start();
				get_template_part('template-parts/content/content-excerpt');
				$return = ob_get_contents();
				ob_end_clean();
				$source .= $return;
			}
		}
    	wp_send_json_success($source);
	}
}
add_action('wp_ajax_mark_message_as_read', 'load_next_6posts_for_home');
add_action('wp_ajax_nopriv_mark_message_as_read', 'load_next_6posts_for_home');

// get category ids string in News & Column
function getNotNewsAndColumnCategoryIDsString($isNegative) {
	$catUncategorized = get_category_by_slug('uncategorized')->term_id;
	$catAllAbout = get_category_by_slug('all-about-uhl')->term_id;
	$catBasic = get_category_by_slug('basic')->term_id;
	$catUhl = get_category_by_slug('uhl')->term_id;
	$catHint = get_category_by_slug('hint')->term_id;
	if ($isNegative) {
		$catUncategorized *= -1;
		$catAllAbout *= -1;
		$catBasic *= -1;
		$catUhl *= -1;
		$catHint *= -1;
	}
	$arr = [];
	array_push($arr, $catUncategorized);
	array_push($arr, $catAllAbout);
	array_push($arr, $catBasic);
	array_push($arr, $catUhl);
	array_push($arr, $catHint);
	return join(",", $arr);
}

function getTagIdWithSlug($slug) {
	$tag = get_term_by('slug', $slug, 'post_tag');
	return $tag->term_id;
}

function excerptByLength($length) {
	global $post;
	$content = mb_substr(strip_tags($post->post_excerpt), 0, $length);
	if (!$content){
		$content = $post->post_content;
		$content = strip_shortcodes($content);
		$content = strip_tags($content);
		$content = str_replace("&nbsp;", "", $content); 
		$content = html_entity_decode($content,ENT_QUOTES, "UTF-8");
		$content = mb_substr($content, 0, $length);
	}
	return $content;
}

function isNewsAndColumnCagetory() {
	$currentCategory = get_category(the_category_ID(false), false);
	if ($currentCategory->parent == 0) { return false; }
	$parentCategory = get_category($currentCategory->parent, false);
	return $parentCategory->slug == "news-and-column";
}

function countPostsInNewsAndColumn($excludePostsWithNewTag = false) {
	$categories = get_categories(array('exclude' => getNotNewsAndColumnCategoryIDsString(false)));
	$count = 0;

	$countWithNewTag = 0;
	if ($excludePostsWithNewTag) {
		$taxonomy = 'post_tag';
		$term_slug = 'new';
		$term = get_term_by('slug', $term_slug, $taxonomy);
		$countWithNewTag = $term->count;
	}
	foreach( $categories as $category ){
		$count += $category->category_count;
	}
	return $count - $countWithNewTag;
}

function echoKikoiroPager($pagerRequired, $needKeepVerticalSpace = false) {
	if ($pagerRequired) {
		$s = get_the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => getChevronLSvg(), 
				'next_text' => getChevronRSvg()
			)
		);
		$s2 = preg_replace('/<h2[^<]+<\/h2>/', '', $s);
		echo $s2;
	}
	else if ($needKeepVerticalSpace) {
		echo "<nav class='pagination'><div class='nav-links'></div></nav>";
	}
}

function fileUpdatedTime($path) {
	$path = $_SERVER['DOCUMENT_ROOT'] . $path;

	if (file_exists($path)) {
  		echo date('YmdHis', filemtime($path));
	}
	else {
  		echo '12345';
	}
}

function getCurrentURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
 	$pageURL .= "://";
	$pageURL .= $_SERVER["SERVER_NAME"] . strtok($_SERVER["REQUEST_URI"], '?');
	return $pageURL;
}

function echoMailSvg($idBaesString) {
	$titleId = $idBaseString . "Title";
	echo '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" viewBox="0 0 512 512" aria-labelledby="' . $titleId . '"role="img">
	<title id="' . $titleId . '">メール</title>
	<path d="M464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h416c8.8 0 16 7.2 16 16v41.4c-21.9 18.5-53.2 44-150.6 121.3-16.9 13.4-50.2 45.7-73.4 45.3-23.2.4-56.6-31.9-73.4-45.3C85.2 197.4 53.9 171.9 32 153.4V112c0-8.8 7.2-16 16-16zm416 320H48c-8.8 0-16-7.2-16-16V195c22.8 18.7 58.8 47.6 130.7 104.7 20.5 16.4 56.7 52.5 93.3 52.3 36.4.3 72.3-35.5 93.3-52.3 71.9-57.1 107.9-86 130.7-104.7v205c0 8.8-7.2 16-16 16z"></path></svg>';
}

function echoTwitterSvg($idBaseString) {
	$titleId = $idBaseString . "Title";
	echo '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 250 250" viewBox="0 0 250 250" aria-labelledby="' . $titleId . '" role="img">
	<title id="' . $titleId . '">Twitter</title>
	<rect width="400" height="400" fill="none"/>
	<path d="m78.62 226.57c94.34 0 145.94-78.16 145.94-145.94 0-2.22 0-4.43-0.15-6.63 10.038-7.261 18.704-16.251 25.59-26.55-9.361 4.148-19.292 6.868-29.46 8.07 10.707-6.41 18.721-16.492 22.55-28.37-10.068 5.975-21.084 10.185-32.57 12.45-19.425-20.655-51.916-21.652-72.572-2.227-13.321 12.528-18.973 31.195-14.838 49.007-41.241-2.067-79.665-21.547-105.71-53.59-13.614 23.436-6.66 53.419 15.88 68.47-8.163-0.242-16.147-2.444-23.28-6.42v0.65c7e-3 24.416 17.218 45.445 41.15 50.28-7.551 2.059-15.474 2.36-23.16 0.88 6.719 20.894 25.976 35.208 47.92 35.62-18.163 14.274-40.599 22.023-63.7 22-4.081-8e-3 -8.158-0.255-12.21-0.74 23.456 15.053 50.749 23.037 78.62 23"/>
	</svg>';
}

function echoFacebookSvg($idBaseString) {
	$titleId = $idBaseString . "Title";
	echo '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" viewBox="0 0 512 512" aria-labelledby="' . $titleId . '" role="img">
	<title id="' . $titleId . '">Facebook</title>
	<path d="m375.1 288 14.2-92.7h-88.9v-60.1c0-25.3 12.4-50.1 52.2-50.1h40.4v-78.8s-36.7-6.3-71.7-6.3c-73.2 0-121.1 44.4-121.1 124.7v70.6h-81.4v92.7h81.4v224h100.2v-224h74.7z"/>
	</svg>';
}

function getChevronRSvg() {
	return '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" viewBox="0 0 512 512" aria-labelledby="pageNext" role="img">
	<title id="pageNext">次へ</title>
	<path d="m381.5 273-194.4 194.3c-9.4 9.4-24.6 9.4-33.9 0l-22.7-22.7c-9.4-9.4-9.4-24.5 0-33.9l154-154.7-154-154.7c-9.3-9.4-9.3-24.5 0-33.9l22.7-22.7c9.4-9.4 24.6-9.4 33.9 0l194.4 194.3c9.3 9.4 9.3 24.6 0 34z"/>
	</svg>';
}

function getChevronLSvg() {
	return '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" viewBox="0 0 512 512" aria-labelledby="pageBack" role="img">
	<title id="pageBack">前へ</title>
	<path d="m130.4 239 194.4-194.3c9.3-9.4 24.5-9.4 33.9 0l22.7 22.7c9.3 9.4 9.3 24.5 0 33.9l-154 154.7 154 154.7c9.4 9.4 9.4 24.5 0 33.9l-22.7 22.7c-9.3 9.4-24.5 9.4-33.9 0l-194.4-194.3c-9.3-9.4-9.3-24.6 0-34z"/>
	</svg>';
}

function getHomeSvg() {
	return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 13" aria-labelledby="home" role="img">
	<title id="home">トップ</title>
	<g fill="none" fill-rule="evenodd">
	<g transform="translate(-279 -2424)" fill="#000000" fill-rule="nonzero">
	<g transform="translate(279 2424)">
	<path d="m7.7888 3.2183-5.1037 4.2035v4.5367c0 0.24461 0.1983 0.44291 0.44291 0.44291l3.102-0.0080277c0.24375-0.0012187 0.4407-0.19916 0.44069-0.44291v-2.6494c0-0.24461 0.1983-0.44291 0.44291-0.44291h1.7716c0.24461 0 0.44291 0.1983 0.44291 0.44291v2.6475c-3.6783e-4 0.11771 0.046133 0.23072 0.12923 0.31408 0.083101 0.083361 0.19597 0.13021 0.31367 0.13021l3.1009 0.0085813c0.24461 0 0.44291-0.1983 0.44291-0.44291v-4.5398l-5.1026-4.2004c-0.1236-0.099628-0.29993-0.099628-0.42353 0zm8.0617 2.857-7.0071-5.7708c-0.4905-0.40363-1.1981-0.40363-1.6886 0l-7.0071 5.7708c-0.067933 0.056149-0.11077 0.13699-0.11907 0.22473s0.018595 0.17519 0.074784 0.24309l0.70588 0.85813c0.056037 0.068138 0.13688 0.11119 0.22469 0.11965 0.087813 0.0084646 0.17539-0.01835 0.24341-0.07453l6.5113-5.363c0.1236-0.099628 0.29993-0.099628 0.42353 0l6.5116 5.363c0.0679 0.056189 0.15535 0.083091 0.24309 0.074784 0.087741-0.0083069 0.16858-0.051142 0.22473-0.11907l0.70588-0.85813c0.056132-0.068295 0.082725-0.15615 0.073892-0.24411-0.0088324-0.08796-0.052362-0.16877-0.12095-0.22454z"/>
	</g>
	</g>
	</g>
	</svg>';
}

function searchFieldWithProperClass() {
	$currentSearchText = get_search_query();
	$classNames = "";
	$style = "";
	$url = esc_url( home_url( '/' ));
	if (strlen($currentSearchText) != 0 && is_search()) {
		$classNames .= "show";
		$style = "style='visibility: visible'";
	}
	else {
		$classNames .= "hide";
	}
	$source = "<div id='searchFormBar' class='$classNames' $style> 
				<div id='searchFormContainer'>
				<img src='/wp-content/themes/kikoiro1/assets/images/search_gray.svg' id='searchIcon' alt='検索' />
				<form id='searchForm' role='search' method='get' class='search-form' action='$url'>
				<input type='search' id='searchField' placeholder='サイト内を検索' name='s' class='search-field' value='$currentSearchText' required />
				</form>
				<span>&nbsp;</span>
				<div id='searchCloseButton'>
				<svg xmlns='http://www.w3.org/2000/svg' enable-background='new 0 0 320 320' viewBox='0 0 320 320' aria-labelledby='closeSearchBarButton' role='img'>
				<title id='closeSearchBarButton'>検索バーを閉じる</title>
				<style type='text/css'>
					.st0{ fill: #cccccc; }
				</style>
				<path class='st0' d='m193.9 160 123.7-123.7c3.1-3.1 3.1-8.2 0-11.3l-22.6-22.6c-3.1-3.1-8.2-3.1-11.3 0l-123.7 123.7-123.7-123.8c-3.1-3.1-8.2-3.1-11.3 0l-22.7 22.7c-3.1 3.1-3.1 8.2 0 11.3l123.8 123.7-123.8 123.7c-3.1 3.1-3.1 8.2 0 11.3l22.7 22.6c3.1 3.1 8.2 3.1 11.3 0l123.7-123.7 123.7 123.7c3.1 3.1 8.2 3.1 11.3 0l22.6-22.6c3.1-3.1 3.1-8.2 0-11.3l-123.7-123.7z' />
				</svg>
				</div>
				</div>
				</div>";
	echo $source;
}

function searchFieldForDrawer() {
	$currentSearchText = get_search_query();
	$url = esc_url( home_url( '/' ));
	$source = "<div id='searchBarSp'>
				<img src='/wp-content/themes/kikoiro1/assets/images/search_gray.svg' id='searchIconSp' alt='検索' />
				<form id='searchFormSp' role='search' method='get' class='search-form' action='$url'>
				<input type='search' id='searchFieldSp' placeholder='サイト内を検索' name='s' class='search-field' value='$currentSearchText' required />
				</form>
				</div>";
	echo $source;
}

function custom_excerpt_length( $length ) {
	return 40;	
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
	return '…';
}
add_filter('excerpt_more', 'new_excerpt_more');


/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'twentynineteen' ),
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'twentynineteen' ),
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'SideBar', 'kikoiro1' ),
			'id'            => 'widget-area',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'kikoiro1' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		)
	);

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
