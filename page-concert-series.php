<?php
/* Template Name: Konsertserie */
get_header();
$id = get_queried_object_id();
?>
<div id="page-header">
	<img src="<?php the_field('bild', $id); ?>" alt="">
</div>
<div class="title"><?php the_field('title_' . $_SESSION['lang'], $id); ?></div>
<div id="content"><?php the_field('description_' . $_SESSION['lang'], $id); ?></div>
<?php get_footer(); ?>