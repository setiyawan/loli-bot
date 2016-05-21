<?php include ('script/script.php');  ?>
<script>
    
    function goEdit(elem) {
       var id = elem.id;
        $.ajax({
            url: url + '/gaji/detail/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            $.each(response.data[0], function(index, el) {
                $('#formUpdate')
                    .find('[name="' + index + '"]').val(el).end();
            });
        });
    }
</script>