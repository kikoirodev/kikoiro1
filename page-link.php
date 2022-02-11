<?php
/**
 * The template for displaying static pages
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
	<main id="main">
		<section id="page" class="article">
			<?php
			while ( have_posts() ) :
				the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

	<div class="entry-content">
		<?php
		the_content(); ?>

			<div id="link" class="section-link">
				<?php
				$pid = get_page_by_path('link');
				$pid = $get_page_id->ID;
				$cats = ['学会・関係者組織など','支援窓口など','当事者の組織など', '海外の情報'];
				$i = 0;
				foreach ($cats as $cat) {
					$items = 'リンク集：'. $cat;
					$name = 'リンク項目名：'. $cat;
					$url = 'リンクURL：'. $cat;
					$detail = 'リンク詳細：'. $cat;
					$description = 'カテゴリ説明文：'. $cat;
					$wysiwig = 'エディタで編集：'. $cat;
					$link_detail = $link_item[ $detail];
					$link_description = SCF::get($description, $pid);
					$link_wysiwig = SCF::get($wysiwig, $pid);

				$link_items = SCF::get($items , $pid);
						?>
						<input id="acd-check<?php echo $i ?>" class="acd-check" type="checkbox">
						<label class="acd-label" for="acd-check<?php echo $i ?>">
							<span class="heading"><?php echo $cat ?></span>
							<?php if($link_description){ 
								echo '<div class="description">' . $link_description . '</div>';
							} ?>
						</label>                        
						<div class="acd-content">
							<?php if( $link_wysiwig  ){ echo $link_wysiwig; } ?>
				<?php if( $link_items ){ ?>
					<table><tr>
				<?php foreach ($link_items as $link_item) {
						$link_name = $link_item[$name];
						$link_url = $link_item[$url];
						$link_detail = $link_item[ $detail]; ?>


<td><a href="<?php echo $link_url; ?>" rel="noopener" target="_blank"><?php echo $link_name; ?></a></td>
<td><?php echo $link_detail; ?></td>
</tr>
						

				<?php } //link_itemのループ ?>
				</table>
						<?php
				}//$link_itemsあるかどうか ?>
						</div><!-- .acd-content -->
			<?php
				$i++;
			} //catのループ

				?>   
			</div><!-- .section-link -->

		<?php	if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		endwhile;
		?>
		</section>

<?php		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'twentynineteen' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>

	</main>
</div>
<?php
echo '<div id="breadCrumb" class="single"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths">';
the_title( '<span class="path">', '</span></span></div>' );
get_footer();
