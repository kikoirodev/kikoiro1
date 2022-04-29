<ul>
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
    <li style="margin-bottom: 0.5em;">
      <a href="<?php echo get_permalink($post->ID); ?>" style="color: #333;">
        <?php
        // アイキャッチ画像を取得
        // $thumbnail_id = get_post_thumbnail_id($post->ID);
        // $thumb_url = wp_get_attachment_image_src($thumbnail_id, 'small');
        // if (get_post_thumbnail_id($post->ID)) {
        //   echo '<figure><img src="' . $thumb_url[0] . '" alt="" width="100"></figure>';
        // }
        ?>
          <span class="date"><?php the_time('Y年m月d日') ?>　</span>
          <?php echo get_the_title($post->ID); ?>
      </a>
    </li>
  <?php endforeach; ?>
  <?php wp_reset_postdata(); ?>
</ul>
