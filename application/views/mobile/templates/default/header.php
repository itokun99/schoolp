<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>IKES - ORANGTUA </title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content=""/>
	<base href="<?php url('') ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="assets/mobile/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="assets/mobile/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="assets/mobile/css/material-dashboard.css">
    <link rel="stylesheet" type="text/css" href="assets/mobile/css/demo.css">    
    <link rel="stylesheet" type="text/css"  href="assets/mobile/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/mobile/css/font-material.css">
	
	<link rel="stylesheet" type="text/css" href="assets/mobile/css/box.css" />
	
	<script src="assets/mobile/js/jquery.min.js" type="text/javascript"></script>
	<script src="assets/mobile/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="assets/mobile/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/mobile/js/material.min.js" type="text/javascript"></script>
	<script src="assets/mobile/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
	<script src="assets/mobile/js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="assets/mobile/js/moment.min.js" type="text/javascript"></script>
	<script src="assets/mobile/js/bootstrap-notify.js" type="text/javascript"></script>
	<script src="assets/mobile/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
	<script src="assets/mobile/js/jquery.select-bootstrap.js" type="text/javascript"></script>
	<script src="assets/mobile/js/jquery.datatables.js" type="text/javascript"></script>
	<script src="assets/mobile/js/jquery.tagsinput.js" type="text/javascript"></script>
	
	<link type="text/css" rel="stylesheet" href="assets/mobile/css/jqselect.css">
	<script type="text/javascript" src="assets/mobile/js/jqselect.js"></script>
	
	<link type="text/css" rel="stylesheet" href="assets/mobile/css/fullcalendar.css">
	<script type="text/javascript" src="assets/mobile/js/fullcalendar.js"></script>	
	
	<script type="text/javascript">
		(function ($) {
			$.baseUrl = function () {
				return "<?php echo base_url() ?>";
			};
		})(jQuery);
	</script>
</head>

<style type="text/css">
body {
    overflow-y:hidden;
}
</style>

<style>
	.ui-dialog { z-index: 3000 !important ;}
	/*
	.ui-dialog-titlebar-close {
	    visibility: hidden;
	}
	*/
</style>
<script type="text/javascript">
        $(document).ready(function () {
			$('a#popdialog').on("click", function(e) {
                e.preventDefault();
                var page = $(this).attr("href")
                var pagetitle = $(this).attr("title")
                var $dialog = $('<div></div>')
                .html('<iframe style="border: 0px; " src="' + page + '" width="100%" height="99%"></iframe>')
                .dialog({
                    autoOpen: false,
                    modal: true,
                    draggable: false,
		            resizable: false,
                    height: 600,
                    width: 1100,
                    title: pagetitle,
                    open: function() {
                      $('.ui-widget-overlay').addClass('custom-overlay');
					  
                    },
                    close: function(ev, ui) {
                      $('.ui-widget-overlay').removeClass('custom-overlay');
                      //window.location.reload()
                    }
                });
                $dialog.dialog('open');
            });
		});
</script>

<body>

<div class="spinner-bg-web" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #333333; opacity: 0.3; z-index: 9999;"></div>
<div class="spinner-img-web" style="position: absolute; top: 45%; left: 45%; z-index: 99999;">
	<div align="center"><img src="assets/mobile/images/loading.gif"/></div>
</div>

<?php
	$cek_menu = $this->session->userdata("schoolp_menuaccess");	
?>

	<?php
		$menu_dashboard = "";
		$menu_school = "";
		$menu_message = "";
		
		$menu_student_profile = "";
		$menu_student_schedule = "";		
		$menu_student_calendar = "";
		$menu_student_attendance = "";
		$menu_student_fee = "";
		$menu_student_daily_exam = "";
		$menu_student_exam = "";
		$menu_student_rapor = "";
		$menu_student_message = "";
		$menu_student_announcement = "";
		$menu_student_assessment = "";
		$menu_student_suggestion = "";
		$menu_student_send_message = "";
		
		if ($menu_id == 1) $menu_dashboard = "active";
		else if ($menu_id == 2) $menu_school = "active";
		else if ($menu_id == 3) $menu_message = "active";
		
		else if ($menu_id == 30) $menu_student_profile = "active";
		else if ($menu_id == 31) $menu_student_schedule = "active";
		else if ($menu_id == 32) $menu_student_calendar = "active";
		else if ($menu_id == 33) $menu_student_attendance = "active";
		else if ($menu_id == 34) $menu_student_fee = "active";
		else if ($menu_id == 35) $menu_student_daily_exam = "active";
		else if ($menu_id == 36) $menu_student_exam = "active";
		else if ($menu_id == 37) $menu_student_rapor = "active";
		else if ($menu_id == 38) $menu_student_message = "active";
		else if ($menu_id == 39) $menu_student_announcement = "active";
		else if ($menu_id == 40) $menu_student_assessment = "active";
		else if ($menu_id == 41) $menu_student_suggestion = "active";
		else if ($menu_id == 42) $menu_student_send_message = "active";
    ?>
<div class="wrapper">
        <div class="sidebar" data-active-color="green" data-background-color="black" data-image="assets/mobile/img/sidebar-1.jpg">         
            <div class="logo">
                <a class="simple-text">
                    ORANGTUA
                </a>
            </div>
            <div class="logo logo-mini">
                <a class="simple-text">
                    ORANGTUA
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
						<?php
							$full_path = "assets/images/profile/ss_" . $picprofile;
							if (!file_exists($full_path) || $picprofile == "") $img_type = 0; else $img_type = 1;
							
							if ($img_type == 1) {
						?>
							<img src="assets/images/profile/ss_<?php echo $picprofile ?>">
						<?php } else { ?>
							<img src="assets/images/avatar.jpg">
						<?php } ?>
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <?php echo $this->session->userdata("schoolp_fname") ?>
                            <b class="caret"></b>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li><a href="profile">Profil Saya</a></li>
                                <li><a href="profile/change_password">Ganti Kata Sandi</a></li>
								<li><a href="school">Kelola Anak</a></li>
								<li><a href="message/inbox">Pesan</a></li>
                            </ul>
                        </div>
						<?php if (isset($dataChildrens) && count($dataChildrens) > 0) { ?>
						<div style="height: 10px"></div>
						<div class="form-group" style="margin: 5px; text-align: center; color: #bbbbbb">
							Pilih Anak
						</div>

						<form name="frm" action="school/children_access" method="POST">
						<div class="form-group" style="text-align: center; margin: 0px">
							  <select name="children_id" onchange="document.frm.submit()" class="form-control" style="width: 210px; height: 28px; padding: 0px 0px 0px 5px; background-color: #efefef; display: inline" autocomplete="off" required="yes">
								<?php foreach($dataChildrens AS $dataChildren) { ?>
									<option value="<?php echo $dataChildren->student_id ?>" <?php if ($this->session->userdata("schoolp_children_id") == $dataChildren->student_id) echo "Selected" ?>><?php echo "$dataChildren->student_name" ?></option>	
								<?php } ?>	
							  </select>
						</div>
						</form>
						<?php } ?>
                    </div>
                </div>
                <ul class="nav">
                    <!---- <li class="<?php echo $menu_dashboard ?>"><a href="admin"><i class="material-icons">dashboard</i><p>Dashboard</p></a></li>
					<li class="<?php echo $menu_school ?>"><a href="school"><i class="fa fa-university"></i><p>Children School</p></a></li>
					<li class="<?php echo $menu_message ?>"><a href="message/inbox"><i class="fa fa-envelope"></i><p>Message</p></a></li> ---->

					<?php if ($this->session->userdata("schoolp_children_id") <> -1) { ?>
					<li class="<?php echo $menu_student_profile ?>"><a href="children/profile"><i class="fa fa-user"></i><p>Profil Anak</p></a></li>
					<li class="<?php echo $menu_student_schedule ?>"><a href="classroom/class_schedule"><i class="fa fa-clock-o"></i><p>Jadwal Kelas</p></a></li>
					<li class="<?php echo $menu_student_calendar ?>"><a href="classroom/class_calendar"><i class="fa fa-calendar"></i><p>Kalender Kelas</p></a></li>
					<li class="<?php echo $menu_student_attendance ?>"><a href="classroom/class_attendance"><i class="fa fa-list-alt"></i><p>Absensi Kelas</p></a></li>
					<li class="<?php echo $menu_student_exam ?>"><a href="classroom/class_exam_schedule"><i class="fa fa-book"></i><p>Jadwal Ujian</p></a></li>
					<li class="<?php echo $menu_student_daily_exam ?>"><a href="classroom/class_daily_exam"><i class="fa fa-book"></i><p>Tugas Kelas</p></a></li>
					<li class="<?php echo $menu_student_rapor ?>"><a href="classroom/class_rapor_score"><i class="fa fa-bar-chart"></i><p>Nilai Rapor</p></a></li>
					<!-- <li class="<?php echo $menu_student_fee ?>"><a href="fee/history_payment"><i class="fa fa-money"></i><p>Uang Sekolah</p></a></li> -->
					<li class="<?php echo $menu_student_message ?>"><a href="message/student_inbox"><i class="fa fa-envelope"></i><p>Pesan Anak</p></a></li>
					<li class="<?php echo $menu_student_announcement ?>"><a href="announcement"><i class="fa fa-bullhorn"></i><p>Pengumuman</p></a></li>
					<li class="<?php echo $menu_student_send_message ?>"><a href="message/send_message"><i class="fa fa-envelope"></i><p>Pesan Ke Guru</p></a></li>
					<li class="<?php echo $menu_student_assessment ?>"><a href="assessment/add_assessment"><i class="fa fa-star-o"></i><p>Penilaian Guru</p></a></li>
					<li class="<?php echo $menu_student_suggestion ?>"><a href="suggestion/add_suggestion"><i class="fa fa-comments"></i><p>Saran</p></a></li>
					<?php } ?>
					
                </ul>
            </div>
            <div style="height: 20px"></div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
					<!----
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
					--->		
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand"><img src="assets/images/logo.png" style="position:relative; top: -15px"></a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
							<!---
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="hidden-lg hidden-md">
                                        Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Mike John responded to your email</a>
                                    </li>
                                    <li>
                                        <a href="#">You have 5 new tasks</a>
                                    </li>
                                    <li>
                                        <a href="#">You're now friend with Andrew</a>
                                    </li>
                                    <li>
                                        <a href="#">Another Notification</a>
                                    </li>
                                    <li>
                                        <a href="#">Another One</a>
                                    </li>
                                </ul>
                            </li>
                            ---->
							
							<li id="Alertcontainer" class="dropdown"></li>
							
							<li id="Messagescontainer" class="dropdown"></li>
							
                            <li class="separator hidden-lg hidden-md"></li>
                            <li>
                                <a href="login/signout" title="Sign Out">                                    
									<button type="button" id="btn-signout" class="btn btn-danger btn-round" style="position: relative; top: -5px;"><i class="fa fa-sign-out"></i> Keluar</button>
									<p class="hidden-lg hidden-md"><i class="fa fa-sign-out"></i> Keluar</p>
                                </a>
                            </li>
                        </ul>
                       
                    </div>
                </div>
            </nav>

			<div class="content">
                <div class="container-fluid">
					<div style="height: 10px"></div>
<?php          
	$message_alert = $this->session->userdata('message_alert');
	$this->session->unset_userdata("message_alert");
	$msg_type_alert = $this->session->userdata('msg_type_alert');
	$this->session->unset_userdata("msg_type_alert");
	
	$type_alert = "info";
	if ($msg_type_alert == 2) $type_alert = "danger";
?>
<?php if (isset($message_alert) && $message_alert <> "") { ?>
<script>
	$(document).ready(function() {
		showNotification('top', 'center', '<?php echo $type_alert ?>', '<?php echo $message_alert ?>');
	});
</script>
<?php } ?>

<script>
	$(document).ready(function() {
		$("#Messagescontainer").load("notification/message");
		var refreshId = setInterval(function() 
		{
		  $("#Messagescontainer").load("notification/message");
		  
		}, 50000000);
		
		$("#Alertcontainer").load("notification/payment");
		var refreshId = setInterval(function() 
		{
		  $("#Alertcontainer").load("notification/payment");
		  
		}, 50000000);
	});
</script>

<div class="modal fade" id="myModalPayment" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog modal-big">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel"><strong>Reminder School Fee</strong></h5>
			</div>
			<div class="modal-body">
				<div class="instruction">
					<div class="row">
						
					</div>
				</div>															  
			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript">
	 $('#myModalPayment').on('show.bs.modal', function (e) {
		//$("#iframeId").attr("src", $(this).attr("href"));
		var loadurl = $(e.relatedTarget).data('load-url');
		$(this).find('.modal-body').load(loadurl);
	});
	
</script>