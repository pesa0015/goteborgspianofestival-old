<?php
/* Template Name: Pianisternas CV */
$translate = getTranslations();
$fromModal = (isset($id)) ? true : false;
if (!$fromModal) {
    get_header();
}
?>
<div id="cv-page"></div>
<div id="thumbnails">
<?php
$p_id = ($fromModal) ? $id : get_queried_object_id();
$posts = get_posts(array('category_name' => get_field('kategori', $p_id), 'orderby' => 'date', 'order' => 'asc', 'posts_per_page' => 10));
if ($posts): foreach ($posts as $post): ?>
<div id="thumbnail-<?php echo $post->post_name; ?>" class="thumbnail">
	<img src="<?php the_field('bild', $post->ID); ?>" alt="">
	<div><?php the_field('namn', $post->ID); ?></div>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
<div id="top">
	<h1><?php the_field('rubrik_' . $_SESSION['lang'], $p_id); ?></h1>
	<?php if (get_field('day', $p_id)): ?>
	<p id="time-place"><?php the_field('day', $p_id); ?> <?php echo $translate['august']; ?>, <?php the_field('begins', $p_id); ?> - <?php the_field('ends', $p_id); ?>, <?php the_field('place', $p_id); ?></p>
	<?php endif; ?>
	<p id="p"><?php the_field('text_' . $_SESSION['lang'], $p_id); ?></p>
</div>
<?php if ($posts): $reversed_posts = array_reverse($posts); foreach($reversed_posts as $post): ?>
<div id="<?php echo $post->post_name; ?>" class="pedagog">
	<img src="<?php the_field('bild', $post->ID); ?>" alt="">
	<h1 class="name"><?php the_field('namn', $post->ID); ?></h1>
	<p id="<?php echo $post->post_name; ?>" class="cv-text"><?php the_field('cv_' . $_SESSION['lang'], $post->ID); ?></p>
</div>
<?php endforeach;endif; ?>
<?php if (!$fromModal) {
    get_footer();
}
?>
