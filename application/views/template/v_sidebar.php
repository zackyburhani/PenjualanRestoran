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
          <a href="<?php echo site_url('Kategori') ?>">
            <i class="fa fa-tag"></i>
            <span>Data Kategori</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('Menu') ?>">
            <i class="fa fa-tags"></i>
            <span>Data Menu</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('Pelanggan') ?>">
            <i class="fa fa-users"></i>
            <span>Data Pelanggan</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('Nota') ?>">
            <i class="fa fa-money"></i>
            <span>Data Pesan</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Data Laporan</span>
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
      </ul>
    </section>
  </aside>