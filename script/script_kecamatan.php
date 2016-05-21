<?php include ('script/script.php');  ?>
<script>

    function goEdit(elem) {
        var id = elem.id;
        var idreq = id.split("_");
        
        $('#u_idprovinsi').val(idreq[2]).trigger('change');

        $.ajax({
            url: url + '/kecamatan/detail/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            $.each(response.data[0], function(index, el) {
                $('#formUpdate')
                    .find('[name="' + index + '"]').val(el).end();
            });
        });
    }

    function goDelete(elem) {
       var id = elem.id;
       if (confirm("Apakah anda ingin menghapus data ini?") == true) {
            $.ajax({
                url: url + '/kecamatan/delete/' + id,
                dataType: 'json',
                method: 'POST'
            }).success(function(response) {
                alert(response);
            });
        }
    }

</script>