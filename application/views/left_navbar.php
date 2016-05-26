<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?= base_url() ?>index.php/home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>

            <?php if($this->session->userdata('jabatan') == 'superadmin') { ?>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Page and Role<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url() ?>index.php/page/getall">Page</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/role/getall">Role</a>
                    </li>
                </ul>
            </li>
            <?php } ?>

            <?php if($this->session->userdata('jabatan') == 'validator') { ?>
            <li>
                <a href="<?= base_url() ?>index.php/survey/getall"><i class="fa fa-edit fa-fw"></i> Data Survey</a>
            </li>
            <?php } ?>

            <?php if($this->session->userdata('jabatan') == 'admin') { ?>
            <li>
                <a href="#"><i class="fa fa-user fa-fw"></i> Akun<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url() ?>index.php/user/getall">Daftar Akun</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/akses/getall">Assignment Akun</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-edit fa-fw"></i> Survey<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url() ?>index.php/variabel/getall">Variabel</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/gaji/getall">Gaji</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/kesejahteraan/getall">Kategori Kemiskinan</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/survey/getall">Hasil Survey</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/datakesejahteraan/getlist">Tingkat Kesejahteraan</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-institution fa-fw"></i> Daerah<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url() ?>index.php/provinsi/getall">Provinsi</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/kabupaten/getall">Kabupaten</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/kecamatan/getall">Kecamatan</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/desa/getall">Desa</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?= base_url() ?>index.php/keluarga/getall"><i class="fa fa-home fa-fw"></i> Keluarga</a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->