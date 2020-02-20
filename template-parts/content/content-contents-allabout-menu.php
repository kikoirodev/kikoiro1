<?php
/**
 * Template part for all-about-uhl contents page parts
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
<?php 
	$title = get_the_title();
	if (get_post_status() === 'publish') {
		echo '<li><a href="' . get_the_permalink() . '"><span class="title">' . $title  . '</span></a></li>';
	}
	else {
		echo '<li><span class="underConstruction">' . $title . '<span class="comingSoon">coming soon!</span></span></li>';
	}
