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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?=$label ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php if(!empty($datacount) && $datacount > 1) { ?>
                    <table>
                        <tr>
                        <td>
                            <label for="sel1">Mulai Request data (Rb) : &nbsp </label>
                        </td>
                        <td>
                            <form action="getall" method="post" class="form">
                                <select class="form-control" onchange="this.form.submit()" name="page">
                                <?php 
                                    for($i = 0; $i < $datacount; $i++) { 
                                    $selected = ($i == $page) ? "selected" : "";
                                ?>
                                    <option value="<?= $i ?>" <?= $selected ?> > <?= $i ?></option>
                                <?php } ?>
                                </select>
                            </form>
                        </td>
                        </tr>
                    </table>
                    <?php } ?>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <tr>
                                <td> <?=$label ?></td>
                                <?php if(!empty($c_insert)) { ?>
                                <td>                                   
                                    <div class="btn btn-primary btn-md" id="" onclick="goEdit(this)" data-target="#formInput" data-toggle="modal">
                                        <span class="glyphicon glyphicon-edit"></span> Tambah
                                    </div>
                                </td>
                                <?php } ?>
                                <?php if(!empty($sync)) { ?>
                                <td>
                                    <a href="sync">
                                        <div class="btn btn-success btn-md">
                                            <span class="glyphicon glyphicon-edit"></span> Sinkronisasi
                                        </div>
                                    </a>
                                </td>
                                <?php } ?>
                            </tr>                            
                        </div>
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
                                            <?php if(!empty($c_edit) || !empty($c_delete)) { ?>
                                            <th style="width:15%" align="right">Aksi</th>
                                            <?php } ?>
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
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->            
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php if(!empty($c_insert)) { ?> 
            <form id="formInput" class="modal fade" action="add" method="post" class="form" style="display: none; align:center">
            <div class="modal-dialog modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title">Input <?=$label ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered " cellspacing="0">
                                <?php foreach ($input as $key) { 
                                    if(!empty($key['add'])) $add = $key['add'];
                                    else $add = '';
                                    if($key['key'] == $p_key) { ?>
                                        <input  type="hidden" class="form-control" name="<?= $key['key'] ?>" />
                                    <?php
                                    continue;
                                    }
                                ?>
                                <tr>
                                    <td>
                                        <label class="col-xs-6 control-label"><?= $key['label'] ?></label>
                                    </td>
                                    <td>
                                        <?php if($key['type'] == 'T') { ?>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" name="<?= $key['key'] ?>" required/>
                                        </div>
                                        <?php } else if($key['type'] == 'N') { ?>
                                        <div class="col-xs-12">
                                            <input type="number" class="form-control" name="<?= $key['key'] ?>" pattern="^([0-9]){3,}" required/>
                                        </div>
                                        <?php } else if($key['type'] == 'S') { ?>
                                        <div class="col-xs-12">
                                            <select class="form-control" name="<?= $key['key'] ?>" id="i_<?= $key['key'] ?>" <?=$add ?> required>
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
                                                <input type='text' class="form-control" name="<?= $key['key'] ?>" required />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>
                            <div class="col-xs-6 col-xs-offset-3">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
            <?php } if(!empty($c_edit)) { ?>
            <form id="formUpdate" class="modal fade" action="update" method="post" class="form" enctype="multipart/form-data" style="display: none; align:center">
            <div class="modal-dialog modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title">Detail <?=$label ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0">
                                <?php foreach ($input as $key) {
                                    $key['readonly'] == true ? $disabled = "disabled": $disabled = "";
                                    if(!empty($key['add'])) $add = $key['add'];
                                    else $add = '';
                                    if($key['key'] == $p_key) { ?>
                                        <input  type="hidden" class="form-control" name="<?= $key['key'] ?>" />
                                    <?php
                                    continue;
                                    }
                                ?>
                                <tr>                                    
                                    <td>
                                        <label class="col-xs-8 control-label"><?= $key['label'] ?></label>
                                    </td>
                                    <td>
                                        <?php if($key['type'] == 'T') { ?>
                                        <div class="col-xs-12">
                                            <input type="text" class="form-control" name="<?= $key['key'] ?>" required <?=$disabled ?> />
                                        </div>
                                        <?php } else if($key['type'] == 'N') { ?>
                                        <div class="col-xs-12">
                                            <input type="number" class="form-control" name="<?= $key['key'] ?>" pattern="^([0-9]){3,}" required <?=$disabled ?> />
                                        </div>
                                        <?php } else if($key['type'] == 'S') { ?>
                                            <div class="col-xs-12">
                                                <select class="form-control" name="<?= $key['key'] ?>" id="u_<?= $key['key'] ?>" <?=$disabled ?> <?=$add ?> >
                                                    <?php foreach ($key['option'] as $keys => $value) { 
                                                        $val = array_search ($value, $key['option']);
                                                    ?>
                                                       <option value="<?=$val ?>"> <?=$value ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } else if($key['type'] == 'F') {?>
                                            <div class="col-xs-12">
                                                <img id="idfile" alt="No Image" style="width:100px;height:100px;">
                                                <input type="file" name="<?= $key['key'] ?>" />
                                            </div>
                                        <?php } else if($key['type'] == 'D') {?>
                                            <div class="col-xs-12">
                                            <div class='input-group date datetimepicker' data-date-format="yyyy-mm-dd">
                                                <input type='text' class="form-control" name="<?= $key['key'] ?>" required />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>
                            <div class="col-xs-6 col-xs-offset-3">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
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

        <!--Hidden form-->


    <!-- jQuery -->
    <script src="<?= base_url() ?>css/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="<?= base_url() ?>css/formValidation.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= base_url() ?>css/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?= base_url() ?>css/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>css/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url() ?>css/dist/js/sb-admin-2.js"></script>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="<?= base_url()?>css/date_picker_bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?= base_url()?>css/date_picker_bootstrap/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <?php  
        if(!empty($script)){
            include ('script/script_'.$script.'.php');
        } 
    ?>

</body>