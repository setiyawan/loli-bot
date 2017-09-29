<script>
	var url = "http://localhost/loli-bot/index.php";

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

</script>

