<?php include ('script/script.php');  ?>
<script>

     function results(elem, id) {
        $('#u_idprovinsi').val(elem.data[0].idprovinsi).trigger('change');
        $('#u_idkabupaten').val(elem.data[0].idkabupaten).trigger('change');
        $('#u_idkecamatan').val(elem.data[0].idkecamatan).trigger('change');
        $('#u_iddesa').val(elem.data[0].iddesa).trigger('change');

        $.ajax({
            url: url + '/keluarga/detail/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            $.each(response.data[0], function(index, el) {
                $('#formUpdate')
                    .find('[name="' + index + '"]').val(el).end();
            });
        });
    }

    function member(id) {
        return  $.ajax({
            url: url + '/keluarga/detail/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
           results(response, id);
        });
    }
    
    function goEdit(elem) {
        var id = elem.id;
        var idprovinsi, idkabupaten, idkecamatan, iddesa;
        document.getElementById("formUpdate").reset();

        member(id);
    }

</script>