var close = document.getElementById('close');
$('.tag').click(function(e) {
    var name = e.target.getAttribute('data-id');
    document.getElementById('modal-' + name).className += ' md-show';
    close.className = '';
    document.documentElement.style.overflowY = 'hidden';
});
$(close).click(function() {
    $('.program-previous').removeClass('md-show');
    close.className = 'hide';
    document.documentElement.style.overflowY = 'scroll';
});
$('.tag').each(function() {
    var name = this.getAttribute('data-id');

    var data = {
        'action': 'get_template_page',
        'name': name
    };

    jQuery.post(ajaxurl, data, function(response) {
        if (response.success) {
            // console.log(response.data.html);
        }
        else {
            // console.log(response);
        }
        $('#loading-' + name).remove();
        $('#content-' + name).html(response);
    });
});
