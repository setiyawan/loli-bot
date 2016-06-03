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

            <div> 
                
                <div class="card wizard-card ct-wizard-green" id="wizardProfile">
                    <form action="finish" method="post">
                <!--        You can switch "ct-wizard-orange"  with one of the next bright colors: "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"             -->
            
                        <div class="wizard-header">
                            <h3>
                               <b> Aliran Data Survey</b><br>
                               <small>Proses Validasi Data dari Awal sampai Terakhir</small>
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
                            <div class="tab-pane" id="ahp">
                                <h4 class="info-text">Proses Perhitungan AHP</h4>
                                <div class="row">
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive ">
                                            <table class="table table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                   <tr>
                                                        <th align="center">No.</th>
                                                        <th align="center">Variabel</th>
                                                        <th align="center">Bobot</th>
                                                        <th align="center">Hasil Survey</th>
                                                        <th align="center">Iterasi 1</th>
                                                        <th align="center">Iterasi 2</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $hasilAHP = 0; 
                                                        foreach ($pekerjaan as $key => $val) { 
                                                        if($key == count($pekerjaan)) {
                                                                $hasilAHP = $val[4];
                                                                $tingkatKesejahteraan = $val[5];
                                                                continue;
                                                            }
                                                    ?>
                                                        <tr>
                                                            <td align="center"><?=$key ?></td>
                                                            <?php foreach ($val as $keys => $value) { 
                                                                if($keys > 2 && ($key == 1 || $key == 7)) $align = "right";
                                                                else if($keys > 0) $align = "center";
                                                                else
                                                                    $align = "";
                                                            ?>
                                                                <td align="<?=$align ?>"> 
                                                                    <?php 
                                                                        if($keys == 0 && $key != 1 && $key != 7) echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
                                                                        echo $value;
                                                                    ?>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="4" align="center"> <b> Hasil Akhir AHP</b></td>
                                                        <td align="center"> <b> <?=$hasilAHP ?> </b> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                            </div>
                            <div class="tab-pane" id="clsutering">
                                <h4 class="info-text">Hasil AHP : <b> <?=$hasilAHP ?> </b></h4>
                                <div class="row">
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive ">
                                            <div align="center"> <b> <font size="+1"> Tabel Tingkat Kesejahteraan </font> </b> </div>
                                            <table class="table table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                   <tr>
                                                        <th align="center">No.</th>
                                                        <th align="center">Tingkat Kesejahteraan</th>
                                                        <th align="center">Batas Bawah</th>
                                                        <th align="center">Batas Atas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($kesejahteraan as $key => $val) { 
                                                    ?>
                                                        <tr>
                                                            <td align="center"><?=$key ?></td>
                                                            <?php foreach ($val as $keys => $value) { ?>
                                                                <td align="center"> 
                                                                    <?php 
                                                                        echo $value;
                                                                    ?>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                            <i> <small> *) Tabel ini didapatkan dengan menggunakan metode KMEANS </small>  </i>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                            </div>

                            <div class="tab-pane" id="hasil">
                                <h4 class="info-text"><b> Kesimpulan!</b></h4>
                                <div class="row">
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive ">
                                            <!-- <div align="center"> <b> <font size="+1"> Tabel Tingkat Kesejahteraan </font> </b> </div> -->
                                            <table class="table table-striped table-bordered table-hover" width="100%">
                                                <thead>
                                                   <tr>
                                                        <th align="center">Nama</th>
                                                        <th align="center">Alamat</th>
                                                        <th align="center">Desa</th>
                                                        <th align="center">Kecamatan</th>
                                                        <th align="center">Kabupaten</th>
                                                        <th align="center">Tingkat Kesejahteraan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        foreach ($hasil as $key => $val) { 
                                                    ?>
                                                        <tr>
                                                            <?php foreach ($val as $keys => $value) { ?>
                                                                <td align="center"> 
                                                                    <?php 
                                                                        echo $value;
                                                                    ?>
                                                                </td>
                                                            <?php } ?>
                                                            <td align="center"><?=$tingkatKesejahteraan?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <div class="choice" data-toggle="wizard-radio" rel="tooltip" onclick="setvalidvalue(0)" title="Data Tidak Valid">
                                                    <input type="radio" >
                                                    <div class="icon">
                                                        <i class="fa fa-times"></i>
                                                    </div>
                                                    <h6>Invalid</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="choice active" data-toggle="wizard-radio" rel="tooltip" onclick="setvalidvalue(1)" title="Data Valid">
                                                    <input type="radio">
                                                    <div class="icon">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                    <h6>Valid</h6>
                                                </div>
                                            </div>                                        
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                            <?php if(!empty($idsurvey)) { ?>
                                <input type='button' class='btn btn-next btn-fill btn-success btn-wd btn-sm' name='next' value='Next' />
                            <?php } ?>
                                <input type="hidden" name="hasil" value="<?=$hasilAHP?>">
                                <input type="hidden" name="idsurvey" value="<?=$idsurvey?>">
                                <input type="hidden" name="isvalid" value="1" id="isvalid">
                                <input type='submit' class='btn btn-finish btn-fill btn-primary btn-wd btn-sm' name='finished' value='Finish' />
        
                            </div>
                            
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>  
                    </form>
                </div>
            </div> <!-- wizard container -->
            <br>
            <br>           
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

    <!-- Morris Charts JavaScript --
    <script src="<?= base_url() ?>css/bower_components/raphael/raphael-min.js"></script>
    <script src="<?= base_url() ?>css/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?= base_url() ?>css/js/morris-data.js"></script>
    -->
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
    function setvalidvalue(elem) {
        var x = document.getElementById("isvalid");
        x.value = elem;
    }
    </script>

</body>

</html>
