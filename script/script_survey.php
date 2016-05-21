<?php include ('script/script.php');  ?>
<script>

    function results(elem, id) {
        $('#u_idprovinsi').val(elem.data[0].idprovinsi).trigger('change');
        $('#u_idkabupaten').val(elem.data[0].idkabupaten).trigger('change');
        $('#u_idkecamatan').val(elem.data[0].idkecamatan).trigger('change');
        $('#u_iddesa').val(elem.data[0].iddesa).trigger('change');
        $('#u_idkeluarga').val(elem.data[0].iddesa).trigger('change');

        // $('#formUpdate').find('[name="idkecamatan"]').val(elem.data[0].idkecamatan).end();
        // $('#formUpdate').find('[name="iddesa"]').val(elem.data[0].iddesa).end();

        $.ajax({
            url: url + '/survey/detail/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            $.each(response.data[0], function(index, el) {
                $('#formUpdate')
                    .find('[name="' + index + '"]').val(el).end();
            });
            $('#formUpdate').find('[name="idkecamatan"]').val(elem.data[0].idkecamatan).end();
            $('#formUpdate').find('[name="iddesa"]').val(elem.data[0].iddesa).end();
            $('#formUpdate').find('[name="idkeluarga"]').val(elem.data[0].idkeluarga).end();
        });
    }

    function member(elem, id) {
        return  $.ajax({
            url: url + '/keluarga/detail/' + elem,
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
        
        $.ajax({
            url: url + '/survey/detail/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            member(response.data[0].idkeluarga, id);
        });
    }


    function goSync(elem) {
        var id = elem.id;
        
    }

</script>