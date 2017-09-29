<?php include ('script/script.php');  ?>
<script>

    function goEdit(elem) {
       var id = elem.id;
        $.ajax({
            url: url + '/daerah/detail/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            $.each(response.data, function(index, el) {
                $('#formUpdate')
                    .find('[name="' + index + '"]').val(el).end();
            });
        });
    }

    function goDelete(elem) {
       var id = elem.id;
       if (confirm("Apakah anda ingin menghapus data ini?") == true) {
            $.ajax({
                url: url + '/daerah/delete/' + id,
                dataType: 'json',
                method: 'POST'
            }).success(function(response) {
                alert(response);
            });
        }
    }

</script>