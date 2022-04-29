<?php
/**
 * Template Name: AboutPage  
 */
/*
 * The template for displaying /about
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
	<main id="main" class="about">
        <section id="page">
        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		<section id="aboutUs">
            <p>「きこいろ」は、日本で初めての片耳難聴を持つ人の当事者組織です。</p>
            <p>片耳が聞こえない・聞こえにくい人たちのための<br/>コミュニティやプロジェクト運営を行います。</p>
            <p>2019年1月より活動を始め、2019年夏、<br/>当事者コミュニティとして任意団体化しました。</p>
            <p>聞こえの多様性に優しく、<br/>人の多様性に寛容な社会であることを願って。</p>
		</section>
		<section>
            <h2>VISION</h2>
            <p>片耳難聴者の困り感は、人それぞれ・その時々。</p>
            <p>近年「片耳難聴だからこそ」の悩みがあることが分かってきましたが、これまでは片耳難聴者へのサポートはほとんどなく、多くの片耳難聴者はそれぞれに難聴に関連する悩みや問題に対応してきました。</p>
            <p>そこで、片耳難聴を持つ人がふと困ったときに立ち寄る場となり、より豊かな暮らしを送れるよう、きこいろは発足しました。</p>
            <p>また、当事者のニーズと専門的エビデンスに基づく活動により、一般社会と難聴者をつなぐハブとしての役割を果たしたいと考えています。</p>
            <p>例えば「聞こえにくいな」と思ったとき、自分でどうするのが良いのかが分かり、最適な行動ができたら。</p>
            <p>例えば「聞こえにくいから、席を変えたいな」そう思ったとき、周りの人が協力してくれたら…。</p>
            <p>そこには、片耳難聴のある人も周りの人も、もっと豊かなコミュニケーションのある暮らしが待っているかも知れません。</p>
            <p>きこいろは、片耳難聴を持つ人を中心としたコミュニティとして、片耳難聴者の暮らしを応援し、聞こえと人の多様性に優しい社会つくりに貢献します。</p>
		</section>
        <section>
            <h2>ACTIVITIES</h2>
            <div class="activities">
                <div class="principle">片耳難聴者のQOL（quality of life：生活・人生の質）の向上のための活動を行う。</div>
                <div class="list">
                    <ul>
                        <li>片耳難聴に関する情報発信</li>
                        <li><a href="/about/cafe">片耳難聴Cafe（交流会）</a>の実施</li>
                        <li><a href="/about/lecture">片耳難聴レクチャー（勉強会）</a>の実施</li>
                        <li>片耳難聴についての<a href="/about/cooperation">一般/専門職への研修</a></li>
                    </ul>
                    各年度の活動計画・実績については<a href="/about/plan">こちら</a>
                </div>
                <article>
                    <a href="/about/cafe"><img src="https://kikoiro.com/wp-content/uploads/2019/12/cafe.jpg" alt="片耳難聴Cafe" /></a>
                    <h3>片耳難聴Cafe</h3>
                </article>
                <article>
                    <a href="/about/lecture"><img src="https://kikoiro.com/wp-content/uploads/2019/12/lecture_s.jpg" alt="片耳難聴レクチャー" /></a>
                    <h3>片耳難聴レクチャー</h3>
                </article> 
            </div>
            <article>
                <a href="/about/origin">
                    <picture>
                    <source media="(min-width: 641px)" srcset="/wp-content/themes/kikoiro1/assets/images/mainImage.jpg, /wp-content/themes/kikoiro1/assets/images/mainImage.jpg 1x, /wp-content/themes/kikoiro1/assets/images/mainImage@2x.jpg 2x" />
                    <img srcset="/wp-content/themes/kikoiro1/assets/images/mainImageSp.jpg, /wp-content/themes/kikoiro1/assets/images/mainImageSp.jpg 1x, /wp-content/themes/kikoiro1/assets/images/mainImageSp@2x.jpg 2x" alt="聞こえ方は、いろいろ。" />
                    </picture>
                </a>
                <h3>きこいろ（kikoiro.com）</h3>
                <p>このサイト（kikoiro.com）は、きこいろが運営する片耳難聴者のための情報が見つかるポータルサイトです。</p>
                <p>生まれつき片方の耳に難聴のある人、成長過程や大人になってから突然（もしくは徐々に）聞こえにくくなった人、いろんな人がいらっしゃるでしょう。日本には少なくとも約30万人以上いるのではないかと推定されていますが、正確な人数は分かっていません。こんなにたくさんの片耳難聴者がいるのに、「自分以外の片耳難聴の人に出会ったことがない」という人も多いと思います。病院に行っても「片耳聞こえているから問題ない」「特に何もすることはない」と言われ、正しい情報が得られなかったという人もいるかと思います。</p>
                <p>このウェブサイトは、そんな片耳難聴のある人やご家族・周りの方、皆さんの情報源になればと思い、作成しました。</p>
                <p>正しい情報を聞こえや福祉の専門家を中心にお届けします。</p>
                <p class="origin">→<a href="/about/origin">「きこいろ」の由来</a></p>
            </article>
        </section>
        <section id="aboutMembers">
            <h2>MEMBERS</h2>
            <div id="memberImages">
            <?php
                $items = array('<img src="https://kikoiro.com/wp-content/uploads/2019/10/okano-1.png" alt="岡野 由実" class="lazyload" />',
                    '<img src="https://kikoiro.com/wp-content/uploads/2019/10/asano.png" alt="麻野 美和" class="lazyload" />',
                    '<img src="https://kikoiro.com/wp-content/uploads/2019/11/tsuji.png" alt="辻 慎也" class="lazyload" />',
                    '<img src="https://kikoiro.com/wp-content/uploads/2019/12/takaki.jpg" alt="高木 健" class="lazyload" />',
                    '<img src="https://kikoiro.com/wp-content/uploads/2019/12/mizuna.png" alt="みずな" class="lazyload" />');
                shuffle($items);
                foreach ($items as $item) {
                    echo $item;
                }
            ?>

            </div>
            <div class="showMore"><a href="/about/members"><span class="showMore">プロジェクトメンバー一覧</span></a></div>
        </section>
        <section id="cooperation">
            <h2>協力・協賛</h2>
            <?php
                //Smart Custom Fieldsで設定 https://2inc.org/blog/2014/10/09/4426/
                $cooperation_text = SCF::get( 'cooperation_text', 1201 );
                echo $cooperation_text;
            ?>
        </section>
        <section id="media">
            <h2>メディア掲載情報</h2>
            <?php
                $media_text = SCF::get( 'media_text', 1201 );
                echo $media_text;
            ?>
            <ul>
            <?php
    $media_items = SCF::get_option_meta('media-options', 'media_items');
    foreach ($media_items as $media_item) { 

        if($media_item['media_link_url']  && ( $media_item['media_menu_text'] || $media_item['media_link_text'] ) ){
            $media_name = $media_item['media_menu_text'];
            if( $media_item['media_link_text'] ){
                $media_name = $media_item['media_link_text'];
            }
?>
        <li>
            <a href="<?php echo $media_item['media_link_url']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $media_item['media_publish_date']; ?>　<?php echo $media_name; ?></a>                        
        </li>
<?php
        }
    }                            
?> 
        </ul>    
        </section>
        <section id="news">
            <h2>プレスリリース</h2>
            <?php get_template_part( 'template-parts/content/content','news-list');   ?>
        </section>
    </section>
	</main>
</div>
<?php
echo '<div id="breadCrumb" class="single"><a href="/" class="home">' . getHomeSvg() . '</a><span class="paths">';
the_title( '<span class="path">', '</span></span></div>' );
get_footer();
