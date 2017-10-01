<script>
    var curr_url = window.location.href;
    var main_url = curr_url.split("/loli-bot");
	var url = main_url[0] + "/loli-bot/index.php";

	$(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
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

