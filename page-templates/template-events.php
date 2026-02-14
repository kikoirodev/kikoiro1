<?php
/**
 * Template Name: events-archive
 */
get_header();

if (!class_exists('SCF')) : ?>
  <main class="wrap">
    <p>SCF が有効ではありません。</p>
  </main>
<?php
  get_footer();
  return;
endif;

// --- 設定（SCF） ---
$GROUP = 'イベント内容';

// 取得（フラット配列）
$rows = SCF::get($GROUP, get_the_ID());
$rows = is_array($rows) ? $rows : [];

// checkbox対策（必ず配列に）
$to_array = function($v){
  if (is_array($v)) return array_values(array_filter($v, 'strlen'));
  if ($v === null) return [];
  $v = trim((string)$v);
  return $v === '' ? [] : [$v];
};

// タグ配列を <span class="oc-tag"> で出力（単発文字列もOKに）
function oc_render_tags($vals) {
  if ($vals === null) return '';
  if (!is_array($vals)) $vals = [$vals];

  $vals = array_values(array_filter(array_map('trim', $vals), 'strlen'));
  if (empty($vals)) return '';

  $html = '';
  foreach ($vals as $v) {
    $html .= '<span class="oc-tag">' . esc_html($v) . '</span>';
  }
  return $html;
}

// 年別にまとめる＋カテゴリ集計（使用実績ベース）
$by_year = [];
$targets_used = [];
$themes_used  = [];
$types_used   = []; // ★追加：形式

foreach ($rows as $r) {
  $title = trim((string)($r['title'] ?? ''));
  $date  = trim((string)($r['date']  ?? '')); // YYYY-MM-DD 想定
  $link  = trim((string)($r['link']  ?? ''));


  // date から年・月（正規表現なし）
  $year  = ($date !== '' && strlen($date) >= 4) ? (int)substr($date, 0, 4) : 0;
  $month = ($date !== '' && strlen($date) >= 7) ? (int)substr($date, 5, 2) : 0;


  $type_vals = $to_array($r['type'] ?? []);
  $target_vals = $to_array($r['target'] ?? []);
  $theme_vals  = $to_array($r['theme']  ?? []);

  foreach ($target_vals as $tv) $targets_used[$tv] = true;
  foreach ($theme_vals  as $tv) $themes_used[$tv]  = true;
  foreach ($type_vals as $tv) $types_used[$tv] = true;


  $item = [
    'title'  => $title,
    'date'   => $date,
    'year'   => $year,
    'month'  => $month,
    'type'   => $type_vals,   // ★配列で持つ
    'target' => $target_vals,
    'theme'  => $theme_vals,
    'link'   => $link,
  ];

  if (!isset($by_year[$year])) $by_year[$year] = [];
  $by_year[$year][] = $item;
}

// 年：降順（0は最後）
$years = array_keys($by_year);
usort($years, function($a, $b){
  if ($a === 0) return 1;
  if ($b === 0) return -1;
  return $b <=> $a;
});

// 年内：月降順（同月はタイトルで安定化）
foreach ($by_year as $y => &$items) {
  usort($items, function($a, $b){
    $ma = (int)$a['month']; $mb = (int)$b['month'];
    if ($ma !== $mb) return $mb <=> $ma;
    return strcmp((string)$a['title'], (string)$b['title']);
  });
}
unset($items);

// カテゴリ一覧（使用実績ベース）
$target_list = array_keys($targets_used);
$theme_list  = array_keys($themes_used);
$type_list   = array_keys($types_used); // ★追加：形式

sort($target_list);
sort($theme_list);
sort($type_list);

?>
<style>
/* ===== 簡易CSS（必要最低限） ===== */
.oc-wrap { max-width: 980px; margin: 0 auto; padding: 24px 16px 48px; }
.oc-title { font-size: 1.5rem; margin: 0 0 8px; }
.oc-desc { margin: 0 0 14px; opacity: .85; line-height: 1.7; }

.oc-legend { padding: 10px 12px; border: 1px solid rgba(0,0,0,.08); border-radius: 12px; background: rgba(255,255,255,.55); }
.oc-legend-row { margin: 6px 0; line-height: 1.6; }
.oc-legend-label { font-weight: 600; }

.oc-filters { display: flex; flex-wrap: wrap; gap: 10px; align-items: end; margin: 12px 0 0; }
.oc-filter { display: grid; gap: 6px; font-size: .92rem; }
.oc-filter select { padding: 8px 10px; border-radius: 10px; border: 1px solid rgba(0,0,0,.15); background: #fff; }
.oc-reset { padding: 9px 12px; border-radius: 10px; border: 1px solid rgba(0,0,0,.15); background: #fff; cursor: pointer; }
.oc-count { font-size: .9rem; opacity: .8; margin-left: auto; }

.oc-year { margin: 24px 0 10px; font-size: 1.12rem; }
.oc-items { list-style: none; padding: 0; margin: 0; display: grid; gap: 10px; }

.oc-item { padding: 12px; border-radius: 14px; background: rgba(255,255,255,.6); border: 1px solid rgba(0,0,0,.08); }
.oc-line1 { display: flex; flex-wrap: wrap; align-items: baseline; gap: 8px; }
.oc-month { font-weight: 700; opacity: .85; }
.oc-item-title { font-weight: 650; }
.oc-report { text-decoration: none; border: 1px solid rgba(0,0,0,.18); padding: 2px 8px; border-radius: 999px; font-size: .85rem; background: #fff; color: #000; }
.oc-report{
  display: inline-flex;
  align-items: center;
  gap: 2px;
}

.oc-icon-external{
  width: 14px;
  height: 14px;
  fill: currentColor; /* テキスト色に合わせる */
  opacity: .75;
}
.oc-line2 { margin-top: 6px; font-size: .9rem; opacity: .9; line-height: 1.6; }

@media (max-width: 600px) {
  .oc-count { margin-left: 0; width: 100%; }
  .oc-item { padding: 11px 10px; }
}

.oc-year { display: flex; gap: 10px; align-items: baseline; }
.oc-year-count { font-size: .9em; opacity: .7; font-weight: 500; }

/* タグ見た目（クリックできなさそう寄せ） */
.oc-tags { display: inline-flex; flex-wrap: wrap; gap: 6px; vertical-align: middle; }
.oc-tag{
  border: 0;
  background: rgba(0,0,0,.04);
  border-radius: 6px;
  padding: 2px 7px;
  font-size: .83rem;
  cursor: default;
  user-select: none;
}

/* 2行目のラベル */
.oc-meta-block { display: inline-flex; align-items: center; gap: 6px; margin-right: 12px; }
.oc-meta-label { font-weight: 600; }

/* 2行目の行間（タグが増えても見やすい） */
.oc-line2 { display: flex; flex-wrap: wrap; gap: 8px 12px; }
</style>


<div id="container">
  <main id="main" class="oc-wrap">
    <section id="page" class="article">

      <header class="oc-head">
        <h1 class="oc-title"><?php the_title(); ?></h1>
        <?php the_content(); ?>

        <?php if (!empty($type_list) || !empty($target_list) || !empty($theme_list)) : ?>
          <div class="oc-legend">

            <?php if (!empty($type_list)) : ?>
              <div class="oc-legend-row">
                <span class="oc-legend-label">形式：</span>
                <span class="oc-tags"><?php echo oc_render_tags($type_list); ?></span>
              </div>
            <?php endif; ?>

            <?php if (!empty($target_list)) : ?>
              <div class="oc-legend-row">
                <span class="oc-legend-label">対象：</span>
                <span class="oc-tags"><?php echo oc_render_tags($target_list); ?></span>
              </div>
            <?php endif; ?>

            <?php if (!empty($theme_list)) : ?>
              <div class="oc-legend-row">
                <span class="oc-legend-label">テーマ：</span>
                <span class="oc-tags"><?php echo oc_render_tags($theme_list); ?></span>
              </div>
            <?php endif; ?>

          </div>
        <?php endif; ?>

        <div class="oc-filters" aria-label="絞り込み">
          <!-- ★追加：形式 -->
          <label class="oc-filter">
            <span>形式</span>
            <select id="ocFilterType">
              <option value="all">すべて</option>
              <?php foreach ($type_list as $t): ?>
                <option value="<?php echo esc_attr($t); ?>"><?php echo esc_html($t); ?></option>
              <?php endforeach; ?>
            </select>
          </label>

          <label class="oc-filter">
            <span>対象</span>
            <select id="ocFilterTarget">
              <option value="all">すべて</option>
              <?php foreach ($target_list as $t): ?>
                <option value="<?php echo esc_attr($t); ?>"><?php echo esc_html($t); ?></option>
              <?php endforeach; ?>
            </select>
          </label>

          <label class="oc-filter">
            <span>テーマ</span>
            <select id="ocFilterTheme">
              <option value="all">すべて</option>
              <?php foreach ($theme_list as $t): ?>
                <option value="<?php echo esc_attr($t); ?>"><?php echo esc_html($t); ?></option>
              <?php endforeach; ?>
            </select>
          </label>

          <button type="button" id="ocReset" class="oc-reset">リセット</button>
          <div id="ocCount" class="oc-count" aria-live="polite"></div>
        </div>
      </header>


      <section class="oc-list" id="ocList">
        <?php foreach ($years as $y): ?>
          <?php
            $items = $by_year[$y];
            $year_label = ($y === 0) ? '開催年月未設定' : $y . '年';
            $year_count = is_array($items) ? count($items) : 0;
          ?>

          <h2 class="oc-year" data-total="<?php echo esc_attr($year_count); ?>">
            <?php echo esc_html($year_label); ?>
            <span class="oc-year-count"><?php echo esc_html('（' . $year_count . '回）'); ?></span>
          </h2>

          <ul class="oc-items">
            <?php foreach ($items as $it): ?>
              <?php
                $month_txt = ($it['month'] > 0) ? ((int)$it['month'] . '月｜') : '';
                $title = $it['title'] !== '' ? $it['title'] : '（タイトル未設定）';

                $meta_html = '';

                // ★追加：形式
                if (!empty($it['type'])) {
                $meta_html .= '<span class="oc-meta-block"><span class="oc-meta-label">形式：</span>'
                            . '<span class="oc-tags">' . oc_render_tags($it['type']) . '</span></span>';
                }

                if (!empty($it['target'])) {
                  $meta_html .= '<span class="oc-meta-block"><span class="oc-meta-label">対象：</span>'
                             . '<span class="oc-tags">' . oc_render_tags($it['target']) . '</span></span>';
                }

                if (!empty($it['theme'])) {
                  $meta_html .= '<span class="oc-meta-block"><span class="oc-meta-label">テーマ：</span>'
                             . '<span class="oc-tags">' . oc_render_tags($it['theme']) . '</span></span>';
                }

                // data属性（JS絞り込み用）
                $data_type   = !empty($it['type']) ? implode(',', $it['type']) : '';
                $data_target = implode(',', $it['target']);
                $data_theme  = implode(',', $it['theme']);
              ?>

              <li class="oc-item"
                  data-type="<?php echo esc_attr($data_type); ?>"
                  data-target="<?php echo esc_attr($data_target); ?>"
                  data-theme="<?php echo esc_attr($data_theme); ?>">

                <div class="oc-line1">
                  <span class="oc-month"><?php echo esc_html($month_txt); ?></span>
                  <span class="oc-item-title"><?php echo esc_html($title); ?></span>
                  <?php if ($it['link'] !== ''): ?>
                    <a class="oc-report" href="<?php echo esc_url($it['link']); ?>" target="_blank" rel="noopener">レポート
                        <svg class="oc-icon-external" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"></path>
                            <path d="M5 5h7v2H7v12h12v-5h2v7H5V5z"></path>
                        </svg>
                    </a>
                  <?php endif; ?>
                </div>

                <?php if ($meta_html !== ''): ?>
                  <div class="oc-line2"><?php echo $meta_html; ?></div>
                <?php endif; ?>

              </li>

            <?php endforeach; ?>
          </ul>
        <?php endforeach; ?>
      </section>

    </section>
  </main>
</div>


<script>
(function(){
  const selType   = document.getElementById('ocFilterType');   // ★追加
  const selTarget = document.getElementById('ocFilterTarget');
  const selTheme  = document.getElementById('ocFilterTheme');
  const btnReset  = document.getElementById('ocReset');
  const countEl   = document.getElementById('ocCount');
  const listEl    = document.getElementById('ocList');
  if (!selType || !selTarget || !selTheme || !listEl) return;

  const items = Array.from(listEl.querySelectorAll('.oc-item'));

  function hashString(str){
    let h = 0;
    for (let i = 0; i < str.length; i++) {
      h = ((h << 5) - h) + str.charCodeAt(i);
      h |= 0;
    }
    return Math.abs(h);
  }

  function applyTagColors(){
    const hues = [18,28,38,48,58,68,78, 95,110,125,140, 200,215,230, 285,305,330,350];
    const saturation = 55;
    const lightness  = 92;

    const tags = Array.from(document.querySelectorAll('.oc-tag'));

    const uniqTexts = [];
    const seenText = new Set();
    tags.forEach(t => {
      const key = (t.textContent || '').trim();
      if (!key || seenText.has(key)) return;
      seenText.add(key);
      uniqTexts.push(key);
    });

    const usedIdx = new Set();
    const map = new Map();

    uniqTexts.forEach(key => {
      let idx = hashString(key) % hues.length;

      let guard = 0;
      while (usedIdx.has(idx) && guard < hues.length) {
        idx = (idx + 7) % hues.length;
        guard++;
      }

      usedIdx.add(idx);
      map.set(key, idx);
    });

    tags.forEach(tag => {
      const key = (tag.textContent || '').trim();
      if (!key) return;

      const idx = map.get(key) ?? (hashString(key) % hues.length);
      const hue = hues[idx];

      tag.style.background = `hsl(${hue} ${saturation}% ${lightness}%)`;
      tag.style.color = 'rgba(0,0,0,1)';
    });
  }

  function applyFilter(){
    const ty = selType.value;      // ★追加
    const t  = selTarget.value;
    const th = selTheme.value;

    let shown = 0;

    items.forEach(li => {
      const typeVals = (li.getAttribute('data-type') || '').split(',').filter(Boolean);
      const targets = (li.getAttribute('data-target') || '').split(',').filter(Boolean);
      const themes  = (li.getAttribute('data-theme')  || '').split(',').filter(Boolean);

      const okType = (ty === 'all') || typeVals.includes(ty);
      const okTarget = (t  === 'all') || targets.includes(t);
      const okTheme  = (th === 'all') || themes.includes(th);

      const ok = okType && okTarget && okTheme;

      li.style.display = ok ? '' : 'none';
      if (ok) shown++;
    });

    if (countEl) countEl.textContent = `表示：${shown}件`;

    // 年ブロック：表示中の回数を数えて、見出しの回数も更新
    const yearHeads = Array.from(listEl.querySelectorAll('.oc-year'));
    yearHeads.forEach(h2 => {
      const ul = h2.nextElementSibling;
      if (!ul || !ul.classList.contains('oc-items')) return;

      const visibleCount = Array.from(ul.querySelectorAll('.oc-item'))
        .filter(li => li.style.display !== 'none').length;

      const anyVisible = visibleCount > 0;
      h2.style.display = anyVisible ? '' : 'none';
      ul.style.display = anyVisible ? '' : 'none';

      const countSpan = h2.querySelector('.oc-year-count');
      if (countSpan) countSpan.textContent = `（${visibleCount}回）`;
    });
  }

  // URLパラメータから初期値（形式/対象/テーマ）
  function setInitialFromParams(){
    const params = new URLSearchParams(window.location.search);

    const MAX_LEN = 50;
    const norm = (s) => (s || '').trim().slice(0, MAX_LEN);

    const typeParam   = norm(params.get('type')   || params.get('oc_type'));
    const targetParam = norm(params.get('target') || params.get('oc_target'));
    const themeParam  = norm(params.get('theme')  || params.get('oc_theme'));

    const setIfExists = (selectEl, value) => {
      if (!value) return;
      if (value === 'all') { selectEl.value = 'all'; return; }
      const ok = Array.from(selectEl.options).some(opt => opt.value === value);
      if (ok) selectEl.value = value;
    };

    setIfExists(selType, typeParam);
    setIfExists(selTarget, targetParam);
    setIfExists(selTheme, themeParam);
  }

  selType.addEventListener('change', applyFilter);   // ★追加
  selTarget.addEventListener('change', applyFilter);
  selTheme.addEventListener('change', applyFilter);

  if (btnReset) {
    btnReset.addEventListener('click', () => {
      selType.value   = 'all';   // ★追加
      selTarget.value = 'all';
      selTheme.value  = 'all';
      applyFilter();
    });
  }

  setInitialFromParams();
  applyTagColors();
  applyFilter();
})();
</script>


<?php get_footer(); ?>
