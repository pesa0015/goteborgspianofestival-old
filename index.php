<?php
get_header();
?>
<div id="start-background">
    <div class="flexslider">
        <ul class="slides">
            <li data-place="1">
                <img src="<?php bloginfo('template_url'); ?>/img/slider/GoteborgsOperan.png" alt="">
            </li>
            <li data-place="2">
                <img src="<?php bloginfo('template_url'); ?>/img/slider/artisten.png" alt="">
            </li>
            <li data-place="3">
                <img src="<?php bloginfo('template_url'); ?>/img/slider/varldskulturmuseet.png" alt="">
            </li>
        </ul>
    </div>
    <div id="slider-title" class="title">
        <span><?=$translate['welcome']; ?></span>
        <br />
        <span><?php echo begins() . ' - ' . ends() . ' ' . $translate['august'] . ' ' . year(); ?></span>
        <div id="places">
            <span id="place-1">Göteborgsoperan</span>
            <span id="place-2">Artisten</span>
            <span id="place-3">Världskulturmuseet</span>
        </div>
        <?php
        $date = array('year' => year(), 'month' => 8, 'day' => begins());
        $difference = mktime(0, 0, 0, $date['month'], $date['day'], $date['year'], 0) - time();
        ?>
        <div id="count-down">
            <div id="days-left"><?php echo floor($difference/60/60/24)+1; ?></div>
            <div><?=$translate['days_left']; ?></div>
        </div>
        <div id="bouncing-arrow" class="arrow bounce"></div>
    </div>
</div>
<div id="festivalprogram_anchor">
    <div class="title">
        <a href="<?php echo $download; ?>" id="pdf" target="_blank"><?php echo $translate['pdf']; ?></a>
    </div>
<?php
$days = get_categories(array('parent_of' => 'Spelprogram', 'orderby' => 'name', 'order' => 'asc'));
$c = array(
    'Pressmeddelanden',
    'Spelprogram',
    'Pedagoger',
    'Sagornas Musik',
    'Finalkonsert',
    'Unga och lovande pianister del 1',
    'Unga och lovande pianister del 2',
    'Unga och lovande pianister del 3',
    'Konsert med Göteborgs Pianosällskap'
);
foreach ($days as $day) :
    if (!in_array($day->name, $c)) : ?>
<div class="day">
    <div class="date">
        <span class="day-number"><?php echo $day->name; ?></span><span class="month">Augusti</span></h3>
    </div>
<?php
$activities = get_posts(array('cat' => $day->cat_ID, 'numberposts' => 0, 'orderby' => 'menu_order', 'order' => 'desc'));
foreach ($activities as $activity) :
    $id = $activity->ID; ?>
<div id="activity-<?php echo $id; ?>" class="activity-card">
    <div class="left">
        <span class="begins"><?php the_field('begins', $id); ?> - </span>
        <span class="ends"><?php the_field('ends', $id); ?></span>
    </div>
    <div class="right">
        <?php if (get_field('page_link', $id)) : ?>
        <div class="activity">
            <?php if (get_field('anchor', $id)) :
                $anchor = get_field('anchor', $id);
                $page_link = get_field('page_link', $id) . '#' . substr($anchor, 34, -1);
                $a = get_field('activity', $id); ?>
                <a href="<?php echo $page_link; ?>" class="tooltip" title="Läs mer" target="_blank"><?php $a; ?></a>
            <?php else :
                $link = get_field('page_link', $id);
                $a = get_field('activity', $id); ?>
                <a href="<?php echo $link; ?>" class="tooltip" title="Läs mer" target="_blank"><?php echo $a; ?></a>
            <?php endif; ?>
            <div class="underline-dotted"></div>
        </div>
        <?php else : ?>
        <div class="activity"><?php the_field('activity', $id); ?></div>
        <?php endif; ?>
        <?php if (get_field('description_' . $_SESSION['lang'], $id)) : ?>
        <div class="description"><?php the_field('description_' . $_SESSION['lang'], $id); ?></div>
        <?php endif; ?>
        <div class="place"><?php the_field('place', $id); ?></div>
    </div>
</div>
<?php endforeach; ?>
</div>
<?php
    endif;
    endforeach;
?>
</div>
<div id="footer">
    <h1 id="sponsors-title" class="title">Sponsorer</h1>
    <div id="sponsors">
        <div class="sponsors">
            <div class="sponsor">
                <a href="http://goteborgco.se/" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/sponsors/gbgco.png" alt="">
                </a>
            </div>
            <div class="sponsor">
                <a href="http://steinway.com/" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/sponsors/Steinway_black.jpg" alt="">
                </a>
            </div>
            <div class="sponsor">
                <?php
                $file = '/text/kulturskolan_sponsor.txt';
                $kulturskolan = file_get_contents(get_bloginfo('template_url') . $file); ?>
                <a href="<?php echo $kulturskolan; ?>" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/sponsors/kulturskolan.png" alt="">
                </a>
            </div>
            <br />
            <div class="sponsor">
                <a href="http://www.svanstrom.se/" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/sponsors/Svanstrom-logo.png" alt="">
                </a>
            </div>
            <div class="sponsor only-text">
                <a href="http://haxsonj.se/www/" target="_blank"><span>Helga Ax:son Johnsons Stiftelse</span></a>
            </div>
            <div class="sponsor only-text">
                <a href="http://www.wikandersstiftelse.se/" target="_blank"><span>Wikanders Stiftelse</span></a>
            </div>
            <br />
            <div class="sponsor">
                <img src="<?php bloginfo('template_url'); ?>/img/sponsors/casio.png" id="casio" alt="">
            </div>
            <div class="sponsor">
                <a href="http://www.mcv.se/" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/sponsors/mcv.png" id="mcv-logo" alt="">
                </a>
            </div>
            <div class="sponsor">
                <img src="<?php bloginfo('template_url'); ?>/img/sponsors/tornrosa.png" alt="">
            </div>
        </div>
    </div>
    <h1 id="partners-title" class="title">Samarbetspartners</h1>
    <div id="partners">
        <span class="partner">Världskulturmuseet</span>
        <span class="dot"></span>
        <span class="partner">Högskolan för scen och musik</span>
        <span class="dot"></span>
        <span class="partner">GöteborgsOperan</span>
    </div>
    <div id="created-by">
        <span>
            <span id="created-by-title">Sidan skapades av</span>
            <br />
            <a href="http://goteborgspianofestival.com/" target="_blank">Göteborgs Pianofestival</a>
            <span class="dot"></span>
            <a href="http://petersall.se/" target="_blank">petersall.se</a>
            <span class="dot"></span>
            <a href="https://www.facebook.com/erickton.se" target="_blank">Erickton</a>
        </span>
    </div>
</div>
<?php get_footer(); ?>