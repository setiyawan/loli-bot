<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?= base_url() ?>index.php/home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>

           <li>
                <a href="<?= base_url() ?>index.php/user/getall"><i class="fa fa-user fa-fw"></i> Daftar Akun</a>
            </li>

            <li>
                <a href="<?= base_url() ?>index.php/daerah/getall"><i class="fa fa-institution fa-fw"></i> Daerah</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-edit fa-fw"></i> Wisata<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= base_url() ?>index.php/wisata/kuliner">Wisata Kuliner</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/wisata/alam">Wisata Alam</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>index.php/wisata/produk">Daftar Produk</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->