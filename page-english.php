<?php
/* Template Name: English */
get_header('english');
$translate = getTranslations();
?>
<div id="start-background">
    <div class="flexslider">
        <ul class="slides">
            <li data-place="1">
                <img src="<?php bloginfo('template_url'); ?>/img/slider/GoteborgsOperan.png" alt="">
            </li>
            <li data-place="2">
                <img src="<?php bloginfo('template_url'); ?>/img/slider/gbg_konserthus.jpg" alt="">
            </li>
            <li data-place="3">
                <img src="<?php bloginfo('template_url'); ?>/img/slider/Dicksonska.jpg" alt="">
            </li>
        </ul>
    </div>
    <div id="slider-title" class="title">
        <span><?=$translate['welcome']; ?></span>
        <br />
        <span><?php echo begins() . ' - ' . ends() . ' ' . $translate['august'] . ' ' . year(); ?></span>
        <div id="places">
            <span id="place-1">GöteborgsOperan</span>
            <span id="place-2">Göteborgs konserthus</span>
            <span id="place-3">Dicksonska palatset</span>
        </div>
        <?php get_template_part('page_templates/countdown', 'countdown'); ?>
        <div id="bouncing-arrow" class="arrow bounce"></div>
    </div>
</div>
<div id="festivalprogram_anchor">
    <div class="title">
        <h4><a href="<?php echo $home; ?>/program-2018" style="color: inherit;">Festivalprogram 2018</a>
            <br />
            <span><?php echo begins() . ' - ' . ends() . ' ' . $translate['august']; ?></span>
        </h4>
    </div>
</div>
<div id="footer">
    <h1 id="partners-title" class="title">Partners</h1>
    <div id="partners">
        <span class="partner">Världskulturmuseet</span>
        <span class="dot"></span>
        <span class="partner">Göteborgs konserthus</span>
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