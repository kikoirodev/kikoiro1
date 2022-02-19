<?php
/**
 * The template for displaying the footer
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
<footer>
      <div id="footerContainer">
      	<ul id="footerNavigation">
			<li class="menu brandOrange"><a href="/about">きこいろについて</a></li
			><li class="menu brandGreen"><a href="/join">入会のご案内</a></li
			><li class="menu brandGreen"><a href="https://congrant.com/project/kikoiro/3650" target="_blank" rel="noopener noreferrer">寄付で応援</a></li
      ><li class="menu brandYellow"><a href="/terms">利用規約</a></li
			><li class="menu brandYellow"><a href="/policy">プライバシーポリシー</a></li
			><li class="menu brandBlue"><a href="/link">聞こえのリンク集</a></li
      ><li class="menu brandBlue"><a href="/contact">お問い合わせ</a></li
			><li class="menu brandBlue"><a href="/sitemap">サイトマップ</a></li
      ><li class="twitter">
        <?php 
        if(is_front_page()): ?>
          <a href="https://twitter.com/kikoiro" target="_blank" rel="noopener noreferrer" id="sns-footer-twitter">
        <?php else: ?>
          <a href="https://twitter.com/share?url=https://kikoiro.com/&text=きこいろ - 片耳難聴の情報・コミュニティサイト" onclick="window.open(this.href, 'TWwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;" id="sns-footer-twitter">
        <?php endif; ?>
          <span class="footerSnsButton"><?php echoTwitterSvg("footerShareTwitter") ?></span></a></li
			><li class="facebook">
        <?php if(is_front_page()): ?>
          <a href="https://www.facebook.com/%E3%81%8D%E3%81%93%E3%81%84%E3%82%8D-%E7%89%87%E8%80%B3%E9%9B%A3%E8%81%B4%E3%81%AE%E3%82%B3%E3%83%9F%E3%83%A5%E3%83%8B%E3%83%86%E3%82%A3-108227954644384/" target="_blank" rel="noopener noreferrer" id="sns-footer-facebook">
        <?php else: ?>
          <a href="https://www.facebook.com/share.php?u=https://kikoiro.com/" onclick="window.open(this.href, 'FBwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"  id="sns-footer-facebook">
        <?php endif; ?>
          <span class="footerSnsButton"><?php echoFacebookSvg("footerShareFacebook") ?></span></a></li>

        <?php if(is_front_page()): ?>
          <li class="instagram">
          <a href="https://www.instagram.com/kikoiro/" target="_blank" rel="noopener noreferrer" id="sns-footer-instagram">
          <span class="footerSnsButton"><?php echoInstagramSvg("footerShareInstagram") ?></span></a></li>
        <?php endif; ?>
      	</ul>
      	<p id="copy">&copy;きこいろ <?php echo date("Y"); ?></p>
      </div>
</footer>
<?php wp_footer(); ?>
<?php if( is_page( 'about/cafe' ) )://片耳難聴カフェ クリッカブルマップ レスポンシブ用script ?>
<script src="/wp-content/themes/kikoiro1/assets/js/jquery.rwdImageMaps.min.js"></script>
<script>
  jQuery(document).ready(function(e) {
    jQuery('img[usemap]').rwdImageMaps();
  });
</script>
<?php endif; ?>
</body>
</html>
