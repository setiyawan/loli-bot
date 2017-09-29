<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <?php $this->load->view('top_navbar'); ?>            
            <!-- /.navbar-top-links -->

            <?php $this->load->view('left_navbar'); ?>
            <!-- /.navbar-left-links -->

        </nav>
        <?php if($this->session->userdata('jabatan') == 'superadmin') { ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Selamat Datang di Halaman SUPER ADMIN!</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <?php } else { ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-th-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= number_format($total_daerah,0,",",".") ?></div>
                                    <div>Jumlah Daerah</div>
                                </div>
                            </div>
                        </div>
                        <a href="keluarga/getall" target="blank">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-pencil-square-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= number_format($wisata_kuliner,0,",",".") ?></div>
                                    <div>Wisata Kuliner</div>
                                </div>
                            </div>
                        </div>
                       <a href="survey/getall" target="blank">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= number_format($wisata_alam,0,",",".") ?></div>
                                    <div>Wisata Alam</div>
                                </div>
                            </div>
                        </div>
                        <a href="survey/getall" target="blank">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-times fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= number_format($jumlah_produk,0,",",".") ?></div>
                                    <div>Total Produk</div>
                                </div>
                            </div>
                        </div>
                        <a href="survey/getall" target="blank">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- /#page-wrapper -->

        <form id="changePassword" class="modal fade" action="<?= base_url() ?>index.php/user/changePassword" method="post" style="display: none; align:center">
            <div class="modal-dialog modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title"> Ganti Password </h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0">
                            <tr>
                                <td>
                                    password Lama
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="password">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    password Baru
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="password1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ulangi Password
                                </td>
                                <td>
                                    <div class="col-xs-12">
                                        <input class="form-control" type="password" required="" name="password2">
                                    </div>
                                </td>
                            </tr>
                            </table>
                            <div class="col-xs-6 col-xs-offset-3">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>css/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= base_url() ?>css/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="<?= base_url() ?>css/bower_components/raphael/raphael-min.js"></script>
    <script src="<?= base_url() ?>css/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?= base_url() ?>css/js/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url() ?>css/dist/js/sb-admin-2.js"></script>


    <!--   plugins   -->
    <script src="<?= base_url() ?>assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
    
    <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
    <script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
    
    <!--  methods for manipulating the wizard and the validation -->
    <script src="<?= base_url() ?>assets/js/wizard.js"></script>

</body>

</html>
