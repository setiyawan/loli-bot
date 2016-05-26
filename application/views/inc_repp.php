<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <?php $this->load->view('top_navbar'); ?>            
            <!-- /.navbar-top-links -->

            <?php $this->load->view('left_navbar'); ?>
            <!-- /.navbar-left-links -->

        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> <?=$label ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <form id="formRepp" action="cetak" target="_blank" method="post" class="form" style="align:center">
                            <?php 
                                foreach ($input as $key) { 
                                if(!empty($key['add'])) $add = $key['add'];
                                else $add = '';
                            ?>
                                <div class="form-group">
                                    <label><?= $key['label'] ?></label>
                                    <select class="form-control" name="<?= $key['key'] ?>" id="i_<?= $key['key'] ?>" <?=$add ?> required>
                                        <?php foreach ($key['option'] as $keys => $value) { 
                                            $val = array_search ($value, $key['option']);
                                        ?>
                                           <option value="<?=$val ?>"> <?=$value ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                            <button class="btn btn-primary" type="submit">
                                <span class="fa fa-search"></span> Tampilkan
                            </button>
                            <!-- <a href="cetak" target="_blank" onclick="">
                                <div class="btn btn-success btn-xs">
                                    <span class="fa fa-map-marker"></span> Cetak
                                </div>
                            </a> -->
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        <?php $this->load->view('pop_password'); ?>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>css/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= base_url() ?>css/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url() ?>css/dist/js/sb-admin-2.js"></script>

    <?php  
        if(!empty($script)){
            include ('script/script_'.$script.'.php');
        } 
    ?>

</body>

</html>
