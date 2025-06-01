<?php
/**
 * 関数をまとめて置きます
 */


/*
  レスポンシブ用の関数
  WPデフォルト関数（wp_is_mobile）だとmobileにタブレットを含んでしまうので、
  スマホだけ判別できるように用意
--------------------------------------------------------------------*/
function is_mobile() {
	$useragents = array(
	'iPhone', // iPhone
	'iPod', // iPod touch
	'^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
	'dream', // Pre 1.5 Android
	'CUPCAKE', // 1.5+ Android
	'blackberry9500', // Storm
	'blackberry9530', // Storm
	'blackberry9520', // Storm v2
	'blackberry9550', // Storm v2
	'blackberry9800', // Torch
	'webOS', // Palm Pre Experimental
	'incognito', // Other iPhone browser
	'webmate' // Other iPhone browser
	);
	$pattern = '/'.implode('|', $useragents).'/i';
	return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

add_shortcode( 'cafe_map', 'show_cafe_map' );

/*
  片耳難聴Cafeページにクリッカブルマップを表示
  https://kikoiro.com/about/cafe/
-----------------------------------------*/
function show_cafe_map() {
		$output = <<<EOF
 <figure class="cafe_map_pc">
<img src="https://kikoiro.com/wp-content/themes/kikoiro1/assets/images/about-cafe/cafe_map_pc.png" usemap="#CafeMapPc" alt="片耳難聴カフェの開催場所" width="800" height="800" />
<map name="CafeMapPc">
  <area shape="rect" coords="633,260,773,314" href="https://kikoiro.com/cafe10/" alt="岩手" target="_new" />
  <area shape="rect" coords="267,358,409,415" href="https://kikoiro.com/cafe1/" alt="大宮" target="_new" />
  <area shape="rect" coords="411,648,580,704" href="https://kikoiro.com/lecture2/" alt="神奈川" target="_new" />
  <area shape="rect" coords="269,663,410,718" href="https://kikoiro.com/cafe7/" alt="大阪" target="_new" />
</map></figure>
EOF;

	return $output;
}

/** Smart Custom fieldでオプションページを使うことになったらコメントアウト外す
 * @param string $page_title ページのtitle属性値
 * @param string $menu_title 管理画面のメニューに表示するタイトル
 * @param string $capability メニューを操作できる権限（manage_options とか）
 * @param string $menu_slug オプションページのスラッグ。ユニークな値にすること。
 * @param string|null $icon_url メニューに表示するアイコンの URL
 * @param int $position メニューの位置
 */
// add_action( 'init', function() {
// 	SCF::add_options_page( 
// 		'カスタム設定',
// 		'カスタム設定',
// 		'manage_options',
// 		'my-options',
// 		'dashicons-admin-settings',
// 		80
// 	);
// } );


function kikoiro_show_google_calendar() {
	echo <<< EOF
<script>
document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'dayGridMonth',
		googleCalendarApiKey: 'AIzaSyA8wSdmCk4CWxJpUGp5IlNYOXADCpP7fcY',
		events: {
			googleCalendarId: 'kikoiro.com@gmail.com'
		},
		dayCellContent: function(e) {
		  e.dayNumberText = e.dayNumberText.replace('日', '');
		},
		locale: 'ja',
		schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source'
	});
	calendar.render();
});

</script>
EOF;
}
add_action( 'wp_head', 'kikoiro_show_google_calendar', 10 );


//カスタム設定ページを追加します 参考：https://2inc.org/blog/2016/06/06/5280/
//権限参考 https://ja.wordpress.org/support/article/roles-and-capabilities/#manage_options
 /**
 * @param string $page_title ページのtitle属性値
 * @param string $menu_title 管理画面のメニューに表示するタイトル
 * @param string $capability メニューを操作できる権限（maange_options とか）
 * @param string $menu_slug オプションページのスラッグ。ユニークな値にすること。
 * @param string|null $icon_url メニューに表示するアイコンの URL
 * @param int $position メニューの位置
 */
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('smart-custom-fields/smart-custom-fields.php')) {
	if ( class_exists('SCF') ) {
		//SCF::add_options_page( 'メディア掲載情報', 'メディア掲載情報', 'edit_posts', 'media-options' );
		SCF::add_options_page( 'トップページ設定', 'トップページ設定', 'edit_posts', 'top-options' );
	}
}

function register_my_menus() { 
	register_nav_menus( array( //複数のナビゲーションメニューを登録する関数
	//'「メニューの位置」の識別子' => 'メニューの説明の文字列',
	  'main-menu' => 'PCヘッダーメニュー',
	  'sp-menu'  => 'SPメニュー',
	) );
  }
  add_action( 'after_setup_theme', 'register_my_menus' );