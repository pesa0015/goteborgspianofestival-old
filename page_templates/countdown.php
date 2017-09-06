<?php

global $translate;

$today = new DateTime(date('Y-m-d'));
$start = new DateTime(year() . '-08-' . begins());
$days = $today->diff($start);
?>
<div id="count-down">
    <?php if ($days->invert == 1) : ?>
        <div id="days-left">0</div>
    <?php else : ?>
        <div id="days-left"><?php echo $days->format('%a'); ?></div>
    <?php endif; ?>
    <div><?=$translate['days_left']; ?></div>
</div>