<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="//cdn.quilljs.com/1.2.4/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/vendor/niftymodal/css/component.min.css">
<style>
    .btn-info.btn-outline {
    outline: 0;
    }
    .btn-info.btn-outline:hover {
        outline: 0;
    }
    .active {
        opacity: 1;
        transition: .5s;
    }
    .not-active {
        opacity: .3;
    }
    .content {
        display: none;
    }
    #translate-modal {
        width: 700px;
    }
    .md-content {
        background: #FFFFFF;
        color: #000000;
        padding: 20px;
    }
    .md-content .btn {
        display: inline-block;
        margin: 30px 0 10px 0;
    }
    .text-label {
        font-weight: 600;
        margin: 30px 0 10px 0;
    }
    .text {

    }
</style>
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
<script src="//cdn.quilljs.com/1.2.4/quill.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/vendor/niftymodal/js/classie.js"></script>
<script src="<?php bloginfo('template_url'); ?>/vendor/niftymodal/js/modalEffects.js"></script>
<script>
    function showModal() {
        document.getElementById('translate-modal').className += ' md-show';
    }
    function closeModal() {
        document.getElementById('translate-modal').className = 'md-modal md-effect-1';
    }
    jQuery('.btn-info').click(function(e) {
        var current = e.target.getAttribute('data-id');
        var clickedRow = document.getElementById('row-' + current);
        if (clickedRow.className === 'table-row active') {
            jQuery('.table-row').removeClass('active not-active');
            return true;
        }
        jQuery('.table-row').removeClass('active not-active');
        clickedRow.className += ' active';
        jQuery('.table-row').not('#row-' + current).addClass('not-active');
        jQuery('input#name').val(jQuery('span#name-' + current).text());
        jQuery('input#description').val(jQuery('span#description-' + current).text());
        jQuery('.ql-toolbar').remove();
        jQuery('#sv').html(jQuery('#sv-' + current).html());
        jQuery('#en').html(jQuery('#en-' + current).html());
        document.getElementById('translation_id').value = current;
        var sv = new Quill('#sv', {theme: 'snow'});
        var en = new Quill('#en', {theme: 'snow'});
        showModal();
    });
    jQuery('#translate-modal .btn-success').click(function() {
        var name = document.getElementById('name');
        var description = document.getElementById('description');
        var sv = jQuery('#sv .ql-editor').html();
        var en = jQuery('#en .ql-editor').html();
        var data = {
            'action': 'custom_translate',
            'id': document.getElementById('translation_id').value,
            'name': name.value,
            'description': description.value,
            'sv': sv,
            'en': en
        };

        jQuery.post(ajaxurl, data, function(response) {
            if (response.success) {
                var id = response.data.id;
                document.getElementById('sv-' + id).innerHTML = sv;
                document.getElementById('en-' + id).innerHTML = en;
                document.getElementById('preview-sv-' + id).innerHTML = sv.replace(
                    /<h1>|<h2>|<h3>|<h4>|<h5>|<h6>/g,
                    '<span>'
                    )
                .replace(
                    /<\/h1>|<\/h2>|<\/h3>|<\/h4>|<\/h5>|<\/h6>/g,
                    '</span>'
                )
                .substr(0, 30);
                document.getElementById('preview-en-' + id).innerHTML = en.replace(
                    /<h1>|<h2>|<h3>|<h4>|<h5>|<h6>/g,
                    '<span>')
                .replace(
                    /<\/h1>|<\/h2>|<\/h3>|<\/h4>|<\/h5>|<\/h6>/g,
                    '</span>'
                )
                .substr(0, 30);

                if (sv.length > 30) {
                    document.getElementById('preview-sv-' + id).firstChild.innerHTML += ' ...';
                }
                if (en.length > 30) {
                    document.getElementById('preview-en-' + id).firstChild.innerHTML += ' ...';
                }

                closeModal();
            }
            else {
                console.log(response);
            }
        });
    });
    document.getElementsByClassName('md-overlay')[0].onclick = function() {
        closeModal();
    };
</script>
