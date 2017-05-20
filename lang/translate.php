<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style-translate.min.css">
<h1>Översätt</h1>
<br />
<table class="table table-hover">
    <thead>
        <tr>
            <th></th>
            <th>Namn</th>
            <th>Beskrivning</th>
            <th>Svenska</th>
            <th>Engelska</th>
        </tr>
    </thead>
    <tbody>
<?php
$find = array('<h1>', '</h1>', '<h2>', '</h2>', '<h3>', '</h3>', '<h4>', '</h4>', '<h5>', '</h5>', '<h6>', '</h6>');
$replace = array('<span>', '</span>');
function shorten($string, $find, $replace) {
    $text = str_replace($find, $replace, $string);
    if (strlen($text) > 30) {
        $text = substr($text, 0, 30);
        $text .= ' ...';
    }
    return $text;
}
?>
<?php foreach ($translations as $t) : ?>
    <tr id="row-<?php echo $t->id; ?>" class="table-row">
        <td><button type="button" class="btn btn-info btn-outline" data-id="<?php echo $t->id; ?>">Ändra</button></td>
        <td>
            <div id="preview-<?php echo $t->id; ?>" class="preview">
                <span id="preview-name-<?php echo $t->id; ?>"><?php echo $t->name; ?></span>
            </div>
            <div id="content-<?php echo $t->id; ?>" class="content">
                <span id="name-<?php echo $t->id; ?>"><?php echo $t->name; ?></span>
            </div>
        </td>
        <td>
            <div id="preview-<?php echo $t->id; ?>" class="preview">
                <span id="preview-description-<?php echo $t->id; ?>"><?php echo $t->description; ?></span>
            </div>
            <div id="content-<?php echo $t->id; ?>" class="content">
                <span id="description-<?php echo $t->id; ?>"><?php echo $t->description; ?></span>
            </div>
        </td>
        <td>
            <div id="preview-<?php echo $t->id; ?>" class="preview">
                <span id="preview-sv-<?php echo $t->id; ?>"><?php echo shorten($t->sv, $find, $replace); ?></span>
            </div>
            <div id="content-<?php echo $t->id; ?>" class="content">
                <span id="sv-<?php echo $t->id; ?>"><?php echo $t->sv; ?></span>
            </div>
        </td>
        <td>
            <div id="preview-<?php echo $t->id; ?>" class="preview">
                <span id="preview-en-<?php echo $t->id; ?>"><?php echo shorten($t->en, $find, $replace); ?></span>
            </div>
            <div id="content-<?php echo $t->id; ?>" class="content">
                <span id="en-<?php echo $t->id; ?>"><?php echo $t->en; ?></span>
            </div>
        </td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
<div id="translate-modal" class="md-modal md-effect-1">
    <div class="md-content">
        <form>
            <input type="hidden" id="translation_id">
            <div class="form-group">
                <label for="name">Namn</label>
                <input type="email" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="description">Beskrivning</label>
                <input type="email" class="form-control" id="description">
            </div>
            <div class="text-label">Svenska</div>
            <div id="sv" class="text"></div>
            <div class="text-label">Engelska</div>
            <div id="en" class="text"></div>
            <div class="btn btn-success">Spara</div>
        </form>
    </div>
</div>
<div class="md-overlay"></div>
<script src="<?php bloginfo('template_url'); ?>/js/script-translate.min.js"></script>
