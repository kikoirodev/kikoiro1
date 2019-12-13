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
			><li class="menu brandYellow"><a href="/terms">利用規約</a></li
			><li class="menu brandYellow"><a href="/policy">プライバシーポリシー</a></li
			><li class="menu brandBlue"><a href="/contact">お問い合わせ</a></li
			><li class="twitter"><a href="https://twitter.com/share?url=https://kikoiro.com/&text=きこいろ - 片耳難聴の情報・コミュニティサイト" onclick="window.open(this.href, 'TWwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><span class="footerSnsButton"><?php echoTwitterSvg("footerShareTwitter") ?></span></a></li
			><li class="facebook"><a href="https://www.facebook.com/share.php?u=https://kikoiro.com/" onclick="window.open(this.href, 'FBwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;" ><span class="footerSnsButton"><?php echoFacebookSvg("footerShareFacebook") ?></span></a></li>
      	</ul>
      	<p id="copy">&copy;きこいろ <?php echo date("Y"); ?></p>
      </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
