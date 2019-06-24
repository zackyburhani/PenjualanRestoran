  <aside class="main-sidebar">
    <section class="sidebar">    
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><i class="fa fa-asterisk"></i> MAIN NAVIGATION</li>
        <li>
          <a href="<?php echo site_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('pelanggan') ?>">
            <i class="fa fa-users"></i>
            <span>Data Pelanggan</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('barang') ?>">
            <i class="fa fa-cube"></i>
            <span>Data Barang</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('barang/copy_barang') ?>">
            <i class="fa fa-cubes"></i>
            <span>Data Copy Barang</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url('pesan') ?>">
                <i class="fa fa-circle-o"></i>
                <span>Nota</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('pesan/tambah_pesan') ?>">
                <i class="fa fa-circle-o"></i>
                <span>Pesan Barang</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="<?php echo site_url('retur') ?>">
            <i class="fa fa-retweet"></i>
            <span>Retur</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url('laporan_penjualan') ?>">
                <i class="fa fa-circle-o"></i> <span>Laporan Penjualan</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('laporan_retur') ?>">
                <i class="fa fa-circle-o"></i> <span>Laporan Retur</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('laporan_pesan') ?>">
                <i class="fa fa-circle-o"></i> <span>Laporan Pesan</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="header"></li>
        <li>
          <a href="<?php echo site_url('login/logout') ?>">
            <i class="fa fa-sign-out"></i>
            <span>Keluar</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>