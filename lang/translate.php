<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="//cdn.quilljs.com/1.2.4/quill.snow.css" rel="stylesheet">
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
<?php foreach ($translations as $t) : ?>
    <tr id="row-<?php echo $t->id; ?>" class="table-row">
        <td><button type="button" class="btn btn-info btn-outline" data-id="<?php echo $t->id; ?>">Ändra</button></td>
        <td><?php echo $t->name; ?></td>
        <td><?php echo $t->description; ?></td>
        <td><?php echo $t->sv; ?></td>
        <td><?php echo $t->en; ?></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
<script src="//cdn.quilljs.com/1.2.4/quill.min.js"></script>
<script>
    jQuery('.btn').click(function(e) {
        var current = e.target.getAttribute('data-id');
        var clickedRow = document.getElementById('row-' + current);
        if (clickedRow.className === 'table-row active') {
            jQuery('.table-row').removeClass('active not-active');
            return true;
        }
        jQuery('.table-row').removeClass('active not-active');
        clickedRow.className += ' active';
        jQuery('.table-row').not('#row-' + current).addClass('not-active');
    });
</script>
