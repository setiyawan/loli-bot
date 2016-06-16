<body  onload="blink()">

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

            <div> 
                <?php if(!empty($data)) { ?>
                <div class="card wizard-card ct-wizard-green" id="wizardProfile">
                    <form action="" method="">
                <!--        You can switch "ct-wizard-orange"  with one of the next bright colors: "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"             -->
            
                        <div class="wizard-header">
                            <h3>
                               <b> Pemberitahuan! 
                                    <font color="red" size="+5" id="aF"> <blink> <?=count($data) ?> </blink> 
                                    </font> 
                                </b> Data Baru <br>
                               <small>Silakan Lakukan Validasi Data dari Awal sampai Terakhir</small>
                            </h3>
                        </div>
                        <ul>
                            <li><a href="#survey" data-toggle="tab">Data Survey</a></li>
                            <li><a href="#ahp" data-toggle="tab">Proses AHP</a></li>
                            <li><a href="#clsutering" data-toggle="tab">Proses Clustering</a></li>
                            <li><a href="#hasil" data-toggle="tab">Tingkat Kemiskinan</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane" id="survey">
                                <div class="row">
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive ">
                                        
                                        <?php if($message) { 
                                            $alert = ($code == '212') ? 'alert-success' : 'alert-danger';
                                        ?>
                                            <div class="alert <?= $alert ?> alert-dismissable">
                                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                                <p align="center"> <?=$message?> </p>
                                            </div>
                                        <?php } ?>
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40px">No.</th>
                                                        <?php foreach ($input as $key) {
                                                        if($key['hidden']) continue; ?>
                                                        <th> <?= $key['label'] ?></th>
                                                        <?php } ?>
                                                        <th style="width:15%" align="right">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; if(!empty($data)) foreach ($data as $key) { ?>
                                                    <tr class="odd gradeX">
                                                        <td align="center"><?=$no++?></td>
                                                        <?php foreach ($input as $keys) { 
                                                            if($keys['hidden']) continue; 
                                                        ?>
                                                            <?php if($keys['type'] == 'S') { ?>
                                                                <td><?= $keys['option'][$key[$keys['key']]] ?></td>
                                                            <?php } else { ?>
                                                                <td><?= $key[$keys['key']] ?></td>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php if(!empty($c_edit) || !empty($c_delete)) { ?>
                                                        <td align="center">
                                                            <form action="delete" method="post" class="form">
                                                                <?php if(!empty($c_edit)) { ?>
                                                                <div class="btn btn-warning btn-xs" id="<?=$key[$p_key]?>" onclick="goEdit(this)" data-target="#formUpdate" data-toggle="modal">
                                                                    <span class="fa fa-pencil "></span> Edit
                                                                </div>
                                                                <?php } if(!empty($c_delete)) { ?>
                                                                <button class="btn btn-danger btn-xs" type="submit" name="id_delete" value="<?=$key[$p_key]?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                                                    <span class="fa fa-trash-o"></span> Hapus
                                                                </button>
                                                                <?php } ?>
                                                                <a href="http://maps.google.com?q=<?=$key['lattitude']?>,<?=$key['longitude']?>" target="_blank">
                                                                <div class="btn btn-success btn-xs">
                                                                    <span class="fa fa-map-marker"></span> Loc.
                                                                </div>
                                                                </a>
                                                            </form>
                                                        </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                              </div>
                            </div>                      
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                            <?php if(!empty($idsurvey)) { ?>
                                <input type='button' class='btn btn-next btn-fill btn-success btn-wd btn-sm' name='next' value='Next' />
                            <?php } ?>
                                <input type='submit' class='btn btn-finish btn-fill btn-primary btn-wd btn-sm' name='finish' value='Finish' />
        
                            </div>
                            
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>  
                    </form>
                </div>
            </div> <!-- wizard container -->
            <?php } ?>
            <br>
            <br>
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
                                    <div class="huge"><?= number_format($total,0,",",".") ?></div>
                                    <div>Data Target</div>
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
                                    <div class="huge"><?= number_format($record,0,",",".") ?></div>
                                    <div>Data Record</div>
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
                                    <div class="huge"><?= number_format($valid,0,",",".") ?></div>
                                    <div>Data Valid</div>
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
                                    <div class="huge"><?= number_format($invalid,0,",",".") ?></div>
                                    <div>Data Invalid</div>
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
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Grafik Tingkat Kemiskinan Berdasarkan Kecamatan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <!-- /.col-lg-4 (nested) -->
                                <div id="load" align="center"> 
                                    <img src="<?= base_url() ?>images/loading.gif" alt="Mountain View" style="width:100px;height:100px;">
                                </div>
                                <div class="col-lg-12">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <div class="col-lg-4">
                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Perbandingan Data Per Kecamatan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kecamatan</th>
                                            <th>Target</th>
                                            <th>Masuk</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($tabelkecamatan as $key) { ?>
                                        <tr>
                                            <td><?=$key['namakecamatan'] ?></td>
                                            <td><?= number_format($key['target'],0,",",".") ?></td>
                                            <td><?= number_format($key['masuk'],0,",",".") ?></td>
                                            <td><?= round($key['masuk']/$key['target'], 2) * 100 ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">

                        </div>
                        <!-- /.panel-footer -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                     <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Kategori Hampir Miskin
                        </div>
                        <div class="panel-body">
                            <div id="load1" align="center"> 
                                <img src="<?= base_url() ?>images/loading.gif" alt="Mountain View" style="width:100px;height:100px;">
                            </div>
                            <div id="morris-donut-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-4">
                     <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Kategori Miskin
                        </div>
                        <div class="panel-body">
                            <div id="load2" align="center"> 
                                <img src="<?= base_url() ?>images/loading.gif" alt="Mountain View" style="width:100px;height:100px;">
                            </div>
                            <div id="morris-donut-chart2"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-4">
                     <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Kategori Sangat Miskin
                        </div>
                        <div class="panel-body">
                            <div id="load3" align="center"> 
                                <img src="<?= base_url() ?>images/loading.gif" alt="Mountain View" style="width:100px;height:100px;">
                            </div>
                            <div id="morris-donut-chart3"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <?php } ?>
        <!-- /#page-wrapper -->

        <?php if(!empty($c_edit)) { ?>
            <form id="formUpdate" class="modal fade" action="home/proses" method="post" class="form" style="display: none; align:center">
            <div class="modal-dialog modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title">Detail <?=$label ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <?php if($tab) { $aktif = "class='active'";?>
                                <ul class="nav nav-tabs">
                                    <?php foreach ($tab as $key) { ?>
                                        <li <?=$aktif ?> ><a href="#u_<?=$key['key'] ?>" data-toggle="tab"><?=$key['label'] ?></a> </li>
                                    <?php $aktif = ''; } ?>
                                </ul>
                            <?php } ?>
                                <div class="tab-content">
                                <?php  
                                    $indek = 0; $i_up = 0; $i_down = 0; $i_u_before = 0; $i_before = -1; 
                                    foreach ($input as $key) { 
                                    $key['readonly'] == true ? $disabled = "disabled": $disabled = "";
                                    if(!empty($key['add'])) $add = $key['add'];
                                    else $add = '';
                                    if($key['key'] == $p_key) { ?>
                                        <input  type="hidden" class="form-control" name="<?= $key['key'] ?>" />
                                    <?php
                                    $key_req = $key['key'];
                                    continue;
                                    }
                                ?>
                                <?php if(!empty($tab)) { ?>
                                    <?php if($indek == 0) { ?>
                                        <div class="tab-pane fade in active" id="u_<?=$tab[$i_up]['key'] ?>">
                                            <table class="table table-striped table-bordered" cellspacing="0">                     
                                    <?php 
                                        $i_u_before = $tab[$i_up]['row']; $i_up++; } 
                                        else if($indek == $i_u_before) { ?>
                                        <div class="tab-pane fade" id="u_<?=$tab[$i_up]['key'] ?>">
                                            <table class="table table-striped table-bordered" cellspacing="0">
                                <?php $i_u_before += $tab[$i_up]['row']; $i_up++; } } ?>
                                
                                <tr>                                    
                                    <td>
                                        <label class="col-xs-8 control-label"><?= $key['label'] ?></label>
                                    </td>
                                    <td>
                                        <?php if($key['type'] == 'T') { ?>
                                            <div class="col-xs-12">
                                                <input  type="text" class="form-control" name="<?= $key['key'] ?>" required <?=$disabled ?> />
                                            </div>
                                        <?php } else if($key['type'] == 'S') { ?>
                                            <div class="col-xs-12">
                                                <select class="form-control" id="u_<?= $key['key'] ?>" name="<?= $key['key'] ?>" <?=$disabled ?>  <?=$add ?> >
                                                    <?php foreach ($key['option'] as $keys => $value) { 
                                                        $val = array_search ($value, $key['option']);
                                                    ?>
                                                       <option value="<?=$val ?>"> <?=$value ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } else if($key['type'] == 'F') {?>
                                            <div class="col-xs-12">
                                                <input type="file" name="<?= $key['key'] ?>" />
                                            </div>
                                        <?php } else if($key['type'] == 'D') {?>
                                            <div class="col-xs-12">
                                            <div class='input-group date datetimepicker' data-date-format="yyyy-mm-dd">
                                                <input type='text' class="form-control" name="<?= $key['key'] ?>" disabled />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php if( $indek == $tab[$i_down]['row'] + $i_before) { ?>
                                    </table>
                                    </div>                            
                                <?php $i_before = $indek; $i_down++; } ?>
                                <?php  $indek++; } ?>
                            </table>
                            <?php if(empty($idsurvey)) { ?>
                            <div class="col-xs-6 col-xs-offset-3">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Proses</button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </form>
            <?php } ?>

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
    <script src="<?= base_url() ?>css/bower_components/raphael/raphael-min.js"></script>
    <script src="<?= base_url() ?>css/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?= base_url() ?>css/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url() ?>css/dist/js/sb-admin-2.js"></script>


    <!--   plugins   -->
    <script src="<?= base_url() ?>assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
    
    <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
    <script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
    
    <!--  methods for manipulating the wizard and the validation -->
    <script src="<?= base_url() ?>assets/js/wizard.js"></script>

    <?php 
        include ('script/script_survey.php');
    ?>

    <script type="text/javascript">
    var col = new String();
    var x=1;var y;

    function blink()
    {
        if(x%2) 
        {
            col = "rgb(255,0,0)";
        }else{
            col = "rgb(255,255,255)";
        }

        aF.style.color=col;x++;if(x>2){x=1};setTimeout("blink()",500);
    }
    </script>


</body>

</html>
