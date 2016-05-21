<?php include ('script/script.php');  ?>
<script>

    function goEdit(elem) {
       var id = elem.id;
       var foto;
        $.ajax({
            url: url + '/user/detail/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            if(document.getElementById("idfile")) {
                document.getElementById("idfile").src='<?= base_url() ?>images/user/' + response.data[0].file;
            }
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
                url: url + '/user/delete/' + id,
                dataType: 'json',
                method: 'POST'
            }).success(function(response) {
                
            });
        }
    }
</script>