<?php
/* Template Name: Styrelsen */
get_header();
?>
<div id="board-page"></div>
<div id="content-board">
<h1><?php the_field('title'); ?></h1>
<div class="board-left">
	<span class="underline"><?php the_field('title_leader'); ?></span>
	<br />
	<span><?php the_field('leader'); ?></span>
	<br />
	<br />
	<span class="underline"><?php the_field('title_members'); ?></span>
	<br />
	<?php the_field('members'); ?>
	<br />
    <br />
	<span class="underline"><?php the_field('title_suppleants'); ?></span>
    <br />
    <?php the_field('suppleants'); ?>
</div>
<div class="board-right">
    <img src="<?php the_field('bild'); ?>">
</div>
</div>
<?php get_footer(); ?>