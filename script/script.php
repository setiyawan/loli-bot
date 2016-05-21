<script>
	var url = "http://localhost/ta/web/index.php";

	$(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });

        $('#i_idprovinsi').trigger('change');
        $('#i_iddesa').trigger('change');
    });
    
	$(function () {
        $('.datetimepicker').datetimepicker({
                language:  'id',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                format: 'yyyy-mm-dd'
            });
        });

	$(function () {
        $('#u_datetimepicker').datetimepicker({
                language:  'id',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0,
                format: 'yyyy-mm-dd'
            });
        });

    function changekabupaten(elem) {
        var id = elem.value;
        var res = $(elem).attr("id").split("_");
        res = res[0];
        var dataparsing = new Object();

        $.ajax({
            url: url + '/kabupaten/member/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            $('#' + res + '_idkabupaten').empty();
            if(response.data) {
                var i = 0;
                $.each(response.data, function(index, value) {
                    $('#'+ res +'_idkabupaten').append($('<option>').text(value.namakabupaten).attr('value', value.idkabupaten));
                    if(i == 0) dataparsing.value = value.idkabupaten;
                    i++;
                });
            //$('#' + res +'_idkabupaten').trigger('change');
            }
            //dataparsing.value = '21_36';
            //changekecamatan(dataparsing, res);
        });
    }

    function changekecamatan (elem, res='') {
        var id = elem.value;

        if(!res) { 
            res = $(elem).attr("id").split("_");
            res = res[0];
        }
        var dataparsing = new Object();

        //var e = document.getElementById(res + "_idkabupaten");
        //if(e) id = e.options[e.selectedIndex].value;

        $.ajax({
            url: url + '/kecamatan/member/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            $('#' + res + '_idkecamatan').empty();
            if(response.data) {
                var i = 0;
                $.each(response.data, function(index, value) {
                    $('#' + res + '_idkecamatan').append($('<option>').text(value.namakecamatan).attr('value', value.idkecamatan));
                    if(i == 0) dataparsing.value = value.idkecamatan;
                    i++;
                });
            //$('#' + res +'_idkecamatan').trigger('change');
            }
        });
    }

    function changedesa (elem, res='') {
        var id = elem.value;
        if(!res) { 
            res = $(elem).attr("id").split("_");
            res = res[0];
        }
        
        //var e = document.getElementById(res + "_idkecamatan");
        //if(e) id = e.options[e.selectedIndex].value;
        
        $.ajax({
            url: url + '/desa/member/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            $('#' + res + '_iddesa').empty();
            if(response.data) {
                $.each(response.data, function(index, value) {
                    $('#' + res + '_iddesa').append($('<option>').text(value.namadesa).attr('value', value.iddesa));
                });
            //$('#' + res +'_iddesa').trigger('change');
            }
        });
    }

    function changekeluarga(elem, res='') {
        var id = elem.value;
        if(!res) { 
            res = $(elem).attr("id").split("_");
            res = res[0];
        }
        
        //var e = document.getElementById(res + "_idkecamatan");
        //if(e) id = e.options[e.selectedIndex].value;
        
        $.ajax({
            url: url + '/keluarga/member/' + id,
            dataType: 'json',
            method: 'POST'
        }).success(function(response) {
            $('#' + res + '_idkeluarga').empty();
            if(response.data) {
                $.each(response.data, function(index, value) {
                    $('#' + res + '_idkeluarga').append($('<option>').text(value.nama).attr('value', value.idkeluarga));
                });
            }
        });
    }

</script>

