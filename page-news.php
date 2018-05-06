<?php
/* Template Name: Nyheter */
get_header();
$translate = getTranslations();
?>
<div id="releases">
    <h1><?php echo $translate['news']; ?></h1>
    <?php get_template_part('page_templates/press-releases', 'press-releases'); ?>
</div>
<?php get_footer(); ?>
