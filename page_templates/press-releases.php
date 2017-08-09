<?php

$category = get_category_by_slug('pressmeddelanden');
$releases = get_posts(array('cat' => $category->term_id, 'numberposts' => 0));

foreach ($releases as $release) :
    $id = $release->ID;
    $title = get_field('title_sv', $id);
    $content = get_field('body_sv', $id); ?>
    <div class="release">
        <span class="release-date"><?php echo get_the_date(); ?></span>
        <br />
        <br />
        <span class="release-title"><?php echo $title; ?></span>
        <span class="release-message"><?php echo $content; ?></span>
    </div>
<?php endforeach;
