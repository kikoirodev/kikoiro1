<?php
/**
 * The header for our theme
 *
 * Theme Name: kikoiro1
 * Author: Hironobu Kimura
 * Author URI: https://www.emotionale.jp/
 * Version: 1
 * kikoiro1 is based on Underscores twentynineteen by WordPress team.
 * twentynineteen is distributed under the terms of the GNU GPL v2 or later.
 * License: No License
 */
?><!doctype html>
<html lang='ja' dir='ltr'>
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154223458-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154223458-1');
</script>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="/wp-content/themes/kikoiro1/assets/js/kikoiro1.js?date=<?php fileUpdatedTime("/wp-content/themes/kikoiro1/assets/js/kikoiro1.js") ?>" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.2.3/ofi.js"></script>
	<?php wp_head(); ?>
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1608487,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</head>
<body class="drawer drawer--right">
<?php wp_body_open(); ?>
<header id="header">
  <div id="logoContainer">
      <h1 id="siteLogo"><a href="/"><img src="/wp-content/themes/kikoiro1/assets/images/logo.png" srcset="/wp-content/themes/kikoiro1/assets/images/logo.png 1x, /wp-content/themes/kikoiro1/assets/images/logo@2x.png 2x" alt="きこいろ" id="logo" /></a><br/>片耳難聴の情報・コミュニティサイト</h1>
  </div>
  <div id="headerNavigation">
    <a href="/" id="smallLogoContainer" class="initialHide"><img src="/wp-content/themes/kikoiro1/assets/images/logo.png" srcset="/wp-content/themes/kikoiro1/assets/images/logo.png 1x, /wp-content/themes/kikoiro1/assets/images/logo@2x.png 2x" alt="きこいろ" id="smallLogo" /></a>
      <ul>
        <li><a href="/about">きこいろについて</a></li>
        <li><a href="/category/all-about-uhl">片耳難聴のすべて</a></li>
        <li><a href="/category/news-and-column">ニュース &amp; コラム</a></li>
        <li><a href="/join">入会のご案内</a></li>
    </ul>
    <div id="searchButton">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" aria-labelledby="openSearchBarButton" role="img">
        <title id="openSearchBarButton">検索する</title>
        <g fill="none" fill-rule="evenodd">
        <g transform="translate(-973 -134)" fill="#000">
        <g transform="translate(972 133)">
        <path d="m18.876 17.484-4.2678-4.2678c-0.080855-0.080855-0.18632-0.12304-0.29881-0.12304h-0.46404c1.1074-1.2831 1.7788-2.953 1.7788-4.781 0-4.0393-3.2729-7.3121-7.3121-7.3121-4.0393 0-7.3121 3.2729-7.3121 7.3121 0 4.0393 3.2729 7.3121 7.3121 7.3121 1.828 0 3.4979-0.67145 4.781-1.7788v0.46404c0 0.11249 0.045701 0.21796 0.12304 0.29881l4.2678 4.2678c0.16523 0.16523 0.4324 0.16523 0.59763 0l0.79449-0.79449c0.16523-0.16523 0.16523-0.4324 0-0.59763zm-10.564-3.5471c-3.1077 0-5.6247-2.5171-5.6247-5.6247 0-3.1077 2.5171-5.6247 5.6247-5.6247 3.1077 0 5.6247 2.5171 5.6247 5.6247 0 3.1077-2.5171 5.6247-5.6247 5.6247z"/>
        </g>
        </g>
        </g>
      </svg>
    </div>
  </div>
  <?php get_search_form(); ?>
</header>
<button type="button" id="drawerButton" class="drawer-toggle drawer-hamburger">
  <span class="sr-only">メニューの開閉</span>
  <span class="drawer-hamburger-icon"></span>
</button>
<nav id="drawer" class="drawer-nav" role="navigation">
  <div class="drawer-menu">
    <?php searchFieldForDrawer(); ?>
    <h2>CONTENTS</h2>
    <ul>
      <li><a href="/">サイトトップ</a></li>
      <li><a href="/about">きこいろについて</a></li>
      <li><a href="/category/all-about-uhl">片耳難聴のすべて</a></li>
      <li class="hasChildList"><a href="/category/news-and-column">ニュース &amp; コラム</a>
        <ul>
          <?php 
            $catNewsAndColumn = get_category_by_slug('news-and-column');
            $catAllAbout = get_category_by_slug('all-about-uhl');
            $catLeaflet = get_category_by_slug('tool');
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
            'exclude'            => "" . $catUncategorized->term_id . "," . $catAllAbout->term_id . "," . $catLeaflet->term_id,
            'title_li'           => __( '' ),
            'show_option_none'   => __( '' ),
            'echo'               => 1,
            'depth'              => 1
            );
            wp_list_categories( $args ); 
          ?>
        </ul>
      </li>
      <li><a href="/leaflet-kikoiro">リーフレット</a></li>
      <li><a href="/join">入会のご案内</a></li>
      <li><a href="/contact">お問い合わせ</a></li>
    </ul>
  </div>
</nav>