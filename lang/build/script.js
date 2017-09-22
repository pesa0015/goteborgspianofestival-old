function showModal() {
    document.getElementById('translate-modal').className += ' md-show';
}
function closeModal() {
    document.getElementById('translate-modal').className = 'md-modal md-effect-1';
}
jQuery('.btn-info').click(function(e) {
    var current = e.target.getAttribute('data-id');
    if (current == 0) {
        document.getElementById('translation_id').value = current;
        jQuery('.ql-toolbar').remove();
        jQuery('#sv').html();
        jQuery('#en').html();
        var sv = new Quill('#sv', {theme: 'snow'});
        var en = new Quill('#en', {theme: 'snow'});
        showModal();
        return true;
    }
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
            if (response.data.newRow) {
                window.location.reload();
                return true;
            }
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
