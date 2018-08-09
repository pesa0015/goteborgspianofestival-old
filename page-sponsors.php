<?php
/* Template Name: Sponsorer */
get_header();
?>
<h1 id="sponsors-title" class="title">Sponsorer</h1>
<div id="sponsors">
    <div class="sponsors">
        <?php get_template_part('page_templates/sponsors', 'sponsors'); ?>
    </div>
</div>
<h1 id="partners-title" class="title">Samarbetspartners</h1>
<div id="partners">
    <span class="partner">Göteborgs konserthus</span>
    <span class="dot"></span>
    <span class="partner">GöteborgsOperan</span>
    <span class="dot"></span>
    <span class="partner">Svenska Balettskolan</span>
    <span class="dot"></span>
    <span class="partner">Dicksonska palatset</span>
</div>
<img src="<?php bloginfo('template_url'); ?>/img/svenska_balettskolan.png" alt="" style="height: 200px; display: block; margin: 70px auto;">
<?php get_footer(); ?>
