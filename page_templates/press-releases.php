<?php

$category = get_category_by_slug('pressmeddelanden');
$releases = get_posts(array('cat' => $category->term_id, 'numberposts' => 0));

foreach ($releases as $release) :
    $id = $release->ID;
    $date = $release->post_date;
    $title = get_field('title_sv', $id);
    $content = get_field('body_sv', $id); ?>
    <div class="release">
        <hr />
        <span class="release-date"><?php echo ucfirst(date_i18n('j F, Y', strtotime($date))); ?></span>
        <br />
        <br />
        <span class="release-title"><?php echo $title; ?></span>
        <span class="release-message"><?php echo $content; ?></span>
    </div>
<?php endforeach;
