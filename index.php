<?php
get_header();
$translate = getTranslations();
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
        $today = new DateTime(date('Y-m-d'));
        $start = new DateTime(year() . '-08-' . begins());
        $days = $today->diff($start);
        ?>
        <div id="count-down">
            <div id="days-left"><?php echo $days->format('%a'); ?></div>
            <div><?=$translate['days_left']; ?></div>
        </div>
        <div id="bouncing-arrow" class="arrow bounce"></div>
    </div>
</div>
<div id="festivalprogram_anchor">
    <div class="title">
        <h4><?php echo $translate['comes_soon']; ?></h4>
    </div>
</div>
<div id="footer">
    <h1 id="sponsors-title" class="title">Sponsorer</h1>
    <div id="sponsors">
        <div class="sponsors">
            <div class="sponsor only-text" style="margin: 0 0 50px 30px;">
                <span>Odd Fellow logen nr. 69 Lennart Torstenson</span>
            </div>
            <br />
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