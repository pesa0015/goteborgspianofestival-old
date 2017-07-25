<?php

$category = get_category_by_slug('sponsorer');
$sponsors = get_posts(array('cat' => $category->term_id, 'numberposts' => 0));

foreach ($sponsors as $sponsor) : $id = $sponsor->ID;
    $link = get_field('link', $id);
    $img = get_field('bild', $id);
    $onlyText = (!$link && !$img) ? true : false;
    $onlyImage = (!$link && $img) ? true : false;
    $linkAndNotImage = ($link && !$img) ? true : false;
    $linkAndImage = ($link && $img) ? true : false;

    if ($onlyText) : ?>
        <div id="<?php echo $sponsor->post_name; ?>" class="sponsor only-text">
            <span><?php the_field('text', $id); ?></span>
        </div>
    <?php endif; ?>
    <?php if ($onlyImage) : ?>
        <div id="<?php echo $sponsor->post_name; ?>" class="sponsor">
            <img src="<?php echo $img; ?>" alt="">
        </div>
    <?php endif; ?>
    <?php if ($linkAndNotImage) : ?>
        <div id="<?php echo $sponsor->post_name; ?>" class="sponsor only-text">
            <a href="<?php echo $link; ?>" target="_blank"><span><?php the_field('text', $id); ?></span></a>
        </div>
    <?php endif; ?>
    <?php if ($linkAndImage) : ?>
        <div id="<?php echo $sponsor->post_name; ?>" class="sponsor">
            <a href="<?php echo $link; ?>" target="_blank">
                <img src="<?php echo $img; ?>" alt="">
            </a>
        </div>
    <?php endif; ?>
    <?php if (get_field('new_row', $id)) : ?>
        <br />
    <?php endif; ?>
<?php endforeach; ?>
            