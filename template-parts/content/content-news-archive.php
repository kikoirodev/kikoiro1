<ul class="p-resultList mb-m">
  <?php
  $args = array(
    'posts_per_page' => 5, // 表示する投稿数
    'post_type' => 'news', // 取得する投稿タイプのスラッグ
    'orderby' => 'date', //日付で並び替え
    'order' => 'DESC' // 降順 or 昇順
  );
  $my_posts = get_posts($args);
  ?>
  <?php foreach ($my_posts as $post) : setup_postdata($post); ?>
    <li style="margin-bottom: 0.5em;" class="p-resultList--item">
      <a href="<?php echo get_permalink($post->ID); ?>" style="color: #333;" class="p-newsPanel">
        <?php
      //アイキャッチ画像を取得
      $thumbnail_id = get_post_thumbnail_id($post->ID);
      $thumb_url = wp_get_attachment_image_src($thumbnail_id, 'small');
      if (get_post_thumbnail_id($post->ID)) {
        echo '
        <div class="p-newsPanel--thumb c-thumb">

          <img class="c-thumb--image" src="' . $thumb_url[0] . '">

        </div>';
      }
        ?>
          
          <div class="p-newsPanel--txt">
                        <p class="c-date mb-xs"><?php the_time('Y年m月d日') ?>　</p>
                        <p class="c-title">
          <?php echo get_the_title($post->ID); ?></p>
                        <div class="p-oneline">
							<!-- <p class="c-tag"></p> -->

    </div>
</div>
      </a>
    </li>
  <?php endforeach; ?>
  <?php wp_reset_postdata(); ?>
</ul>
