<?php include ('script/script.php');  ?>
<script>

    function goEdit(elem) {
        var id = elem.id;
        var idreq = id.split("_");

        $('#u_idprovinsi').val(idreq[3]).trigger('change');
        
        $.ajax({
            url: url + '/desa/detail/' + id,
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
                url: url + '/desa/delete/' + id,
                dataType: 'json',
                method: 'POST'
            }).success(function(response) {
                alert(response);
            });
        }
    }

    function goCek(elem) {
        var e = document.getElementById("i_idkecamatan");
        alert(e.options[e.selectedIndex].value);
    }

</script>