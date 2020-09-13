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
	if( is_mobile() ){
		$output = <<<EOF
<figure class="cafe_map_sp">
<img src="https://kikoiro.com/wp-content/themes/kikoiro1/assets/images/about-cafe/cafe_map_sp.png" usemap="#CafeMapSp" alt="片耳難聴カフェの開催場所" width="600" height="800" />
<map name="CafeMapSp">
  <area shape="rect" coords="143,283,289,344" href="https://kikoiro.com/cafe1/" alt="岩手" target="_new" />
  <area shape="rect" coords="438,216,584,274" href="https://kikoiro.com/cafe10/" alt="大宮" target="_new" />
  <area shape="rect" coords="252,518,426,576" href="https://kikoiro.com/lecture2/" alt="神奈川" target="_new" />
  <area shape="rect" coords="152,573,292,632" href="https://kikoiro.com/cafe7/" alt="大阪" target="_new" />
</map></figure>
EOF;
	} else {
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
	}

	return $output;
}