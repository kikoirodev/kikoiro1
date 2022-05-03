<table class="release-list">
  <?php
  $args = array(
    'posts_per_page' => -1, // 表示する投稿数
    'post_type' => 'news', // 取得する投稿タイプのスラッグ
    'orderby' => 'date', //日付で並び替え
    'order' => 'DESC' // 降順 or 昇順
  );
  $my_posts = get_posts($args);
  ?>
  <?php foreach ($my_posts as $post) : setup_postdata($post); ?>
    <tr>
    <td>
          <span class="date"><?php the_time('Y年m月d日') ?>　</span>
    </td>
    <td>
      <a href="<?php echo get_permalink($post->ID); ?>">
          <?php echo get_the_title($post->ID); ?>
      </a>
    </td>
</tr>
  <?php endforeach; ?>
  <?php wp_reset_postdata(); ?>
</table>
