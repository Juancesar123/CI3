<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Financial Monitoring System | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link href="plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <script src="dist/js/jquery.min.js"></script>
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="plugins/iCheck/icheck.min.js"></script>
  
  <script>
  $(document).ready(function(){

    //$("#content_app").load("Pengawasan%20Anggaran/Laporan");
    //$("#content_app").load("Kasir");
    //$("#content_app").load("Manajemen%20Pengguna");
    //$("#content_app").load("Perencanaan%20Anggaran/Bagian");
    //$("#content_app").load("Perencanaan%20Anggaran/Rencana%20Per%20Bagian");
    //$("#content_app").load("Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru");
    $("#content_app").load("Pengawasan%20Anggaran/Laporan");
    
    $("#dashboard").click(function(){
         $("#content_app").load("Pengawasan%20Anggaran/Laporan");
    });

    $("#manajemen_pengguna").click(function(){
         $("#content_app").load("Manajemen%20Pengguna");
    }); 

    $("#anggaran_tahunan").click(function(){
         $("#content_app").load("Perencanaan%20Anggaran/Rencana%20Per%20Bagian");
    }); 

    $("#bagian").click(function(){
         $("#content_app").load("Perencanaan%20Anggaran/Bagian");
    }); 

    $("#pengajuan_anggaran_baru").click(function(){
         $("#content_app").load("Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru");
    }); 

    $("#konfirmasi").click(function(){
         $("#content_app").load("Pengawasan%20Anggaran/Konfirmasi");
    }); 

    $("#notifikasi").click(function(){
         $("#content_app").load("Pengawasan%20Anggaran/Notifikasi");
    }); 

    $("#laporan").click(function(){
         $("#content_app").load("Pengawasan%20Anggaran/Laporan");
    }); 

    $("#kasir").click(function(){
         $("#content_app").load("Kasir");
    });     


    $("#adendum").click(function(){
         $("#content_app").load("Adendum");
    });     


    $("#mutasi_anggaran").click(function(){
         $("#content_app").load("Mutasi%20Anggaran");
    });     

  });
  </script>
  <!-- Ini tidak digunakan -->
  <!--<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">-->
  <!--<link rel="stylesheet" href="plugins/morris/morris.css">-->
  <!--<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">-->
  <!--<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">-->
  <!--<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">-->
  <!--<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="index2.html" class="logo">
      <span class="logo-mini"><b>FMS</b></span>
      <span class="logo-lg"><b>FiMon</b>System</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src=<?php echo "\"".$raw_data['foto_path_FMS']."\"";?> width="160" height="160" class="user-image" alt="User Image">
              <span class="hidden-xs">
              <?php
               echo $raw_data['nama_lengkap_FMS']; 
              ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src=<?php echo "\"".$raw_data['foto_path_FMS']."\"";?> width="160" height="160" class="img-circle" alt="User Image">
                <p>
                  <?php
                   echo $raw_data['nama_lengkap_FMS']." - ".$raw_data['level_FMS']; 
                  ?>
                  <small>Menjadi anggota sejak
                    <?php
                     echo $raw_data['create_at_FMS']; 
                    ?>
                  </small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout"  class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

<!--Start Menu List-->
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src=<?php echo "\"".$raw_data['foto_path_FMS']."\"";?> class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php
                echo $raw_data['nama_lengkap_FMS']; 
              ?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#" id="dashboard">
            <i class="fa fa-dashboard"></i><span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#" id="manajemen_pengguna">
            <i class="fa fa-users"></i> <span>Manajemen Pengguna</span>
          </a>
        </li>         
        <li class="treeview">
          <a href="#" id="perencanaan_anggaran">
            <i class="fa fa-table"></i> <span>Perencanaan Anggaran</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" id="bagian"><i class="fa fa-circle-o"></i> Bagian</a></li>
            <li><a href="#" id="anggaran_tahunan"><i class="fa fa-circle-o"></i>Rencana Perbagian</a></li>
          </ul>
        </li>        
        <li class="treeview">
          <a href="#" id="pengajuan_anggaran_baru" >
            <i class="fa fa-edit" ></i> <span>Pengajuan Anggaran</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-eye"></i> <span>Pengawasan Anggaran</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" id="konfirmasi"><i class="fa fa-circle-o"></i>Konfirmasi</a></li>
            <li><a href="#" id="notifikasi"><i class="fa fa-circle-o"></i>Notifikasi</a></li>
            <li><a href="#" id="laporan"><i class="fa fa-circle-o"></i>Laporan</a></li>
          </ul>
        </li> 
        <li class="treeview">
          <a href="#"  id="kasir">
            <i class="fa fa-laptop"></i>
            <span>Kasir</span>
          </a>
        </li> 
        <li class="treeview">
          <a href="#"  id="adendum">
            <i class="fa fa-plus"></i>
            <span>Adendum</span>
          </a>
        </li>      
        <li class="treeview">
          <a href="#"  id="mutasi_anggaran">
            <i class="fa fa-exchange"></i>
            <span>Mutasi Anggaran</span>
          </a>
        </li>      		
      </ul>
    </section>
  </aside>
<!--End Menu List-->

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper" id="content_app" >
  <?php
    print_r($raw_data);
  ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.1
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>. Modified by <a href="#">Juan Cesar Andrianto</a> & <a href="http://gdreamproject.890m.com"> Gita Citra Puspita</a>. </strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
$(function () {
	$("#example1").DataTable();
	$('#example2').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false
	});
});
</script>

<!-- Ini tidak digunakan -->
<!-- jQuery 2.1.4 -->
<!--<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>-->
<!-- jQuery UI 1.11.4 -->
<!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>-->
<!-- Morris.js charts -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
<!--<script src="plugins/morris/morris.min.js"></script>-->
<!-- Sparkline -->
<!--<script src="plugins/sparkline/jquery.sparkline.min.js"></script>-->
<!-- jvectormap -->
<!--<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>-->
<!--<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->
<!-- jQuery Knob Chart -->
<!--<script src="plugins/knob/jquery.knob.js"></script>-->
<!-- daterangepicker -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>-->
<!--<script src="plugins/daterangepicker/daterangepicker.js"></script>-->
<!-- datepicker -->
<!--<script src="plugins/datepicker/bootstrap-datepicker.js"></script>-->
<!-- FastClick -->
<!--<script src="plugins/fastclick/fastclick.min.js"></script>-->


</body>

</html>
