<?php
/* Template Name: Tidigare program */
get_header();
global $post;
$programYear = $post->post_name;
$title = $post->post_title;
$tags = get_the_tags($post->ID);
$category = get_category_by_slug($programYear);
?>
<div id="close" class="hide">
    <span id="close-btn">Stäng</span>
</div>
<?php if ($tags) : foreach ($tags as $tag) : ?>
<div id="modal-<?php echo $tag->slug; ?>" class="md-modal md-effect-1 program-previous">
    <div class="md-content">
        <div id="loading-<?php echo $tag->slug; ?>">Loading</div>
        <div id="content-<?php echo $tag->slug; ?>"></div>
    </div>
</div>
<?php endforeach; endif; ?>
<div class="md-overlay white"></div>
<h1 class="title"><?php echo $title; ?></h1>
<?php
$pdf = get_field('pdf', PAGE_PDF);
if ($pdf) : ?>
<div id="pdf">
    <a href="<?php echo home(); ?>/festivalprogram-pdf" target="_blank">
        <span>Hämta pdf</span>
        <img src="<?php bloginfo('template_url'); ?>/img/download.png" alt=""></a>
    </a>
</div>
<?php endif; ?>
<div class="tags">
<?php if ($tags) : foreach ($tags as $tag) :
$tagName = $tag->name;
if (strpos($tagName, '_') !== false) :
    $tagName = str_replace('_' . programYear(), '', $tagName);
endif; ?>
    <span class="tag" data-id="<?php echo $tag->slug; ?>"><?php echo $tagName; ?></span>
<?php endforeach; endif; ?>
</div>
<?php
$days = get_categories(array('parent' => $category->term_id, 'orderby' => 'name', 'order' => 'asc'));
foreach ($days as $day) : ?>
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
                $page_link = get_field('page_link', $id) . '#' . substr($anchor, 35, -1);
                $a = get_field('activity', $id); ?>
                <a href="<?php echo $page_link; ?>" class="tooltip" title="Läs mer" target="_blank"><?php echo $a; ?></a>
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
<?php endforeach; ?>
<?php get_footer(); ?>