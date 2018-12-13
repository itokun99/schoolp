<?php          
	$class_menu_active = $this->session->userdata('class_menu_active');
	$this->session->unset_userdata("class_menu_active");
	
	$class_active_1 = "";
	$class_active_2 = "";
	$class_active_3 = "";
	$class_active_4 = "";
	$class_active_5 = "";
	$class_active_6 = "";
	$class_active_7 = "";
	$class_active_8 = "";
	$class_active_9 = "";
	
	if (!isset($class_menu_active)) $class_menu_active = 1;
	if ($class_menu_active == 1) $class_active_1 = "active";	
	else if ($class_menu_active == 2) $class_active_2 = "active";
	else if ($class_menu_active == 3) $class_active_3 = "active";
	else if ($class_menu_active == 4) $class_active_4 = "active";
	else if ($class_menu_active == 5) $class_active_5 = "active";
	else if ($class_menu_active == 6) $class_active_6 = "active";
	else if ($class_menu_active == 7) $class_active_7 = "active";
	else if ($class_menu_active == 8) $class_active_8 = "active";
	else if ($class_menu_active == 9) $class_active_9 = "active";
?>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-user fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title"><?php echo $student->fullname ?> School Details</h4>
				<div class="row">
					<div class="col-md-12" style="min-height: 800px">
						
						<div class="box-body">
							<div class="row">	
								 <?php          
								   $err_message = $this->session->userdata('err_message');
								   $this->session->unset_userdata("err_message");
								 ?>
								 <?php if (isset($err_message) && $err_message <> "") { ?>
								   <div class="alert alert-warning">
									 <center><font color="#ffffff"><?php echo $err_message; ?></font></center>
								   </div>
								 <?php } ?>
								 
								 <div class="col-lg-12">
									<table width="100%">
										<tr>
											<td><a href="school" class="btn btn-default">Back</a></td>
											<td align="right">
												<a href="#" data-toggle="modal" data-load-url="assessment/add_assessment/<?php echo $student->memberid ?>/<?php echo $classroom->classroomid ?>/<?php echo $school->schoolid ?>" class="btn btn-info" data-target="#myModalTeacherAssessment" title="Teacher Assessment">Teacher Assessment</a>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="#" data-toggle="modal" data-load-url="suggestion/add_suggestion/<?php echo $student->memberid ?>/<?php echo $school->schoolid ?>" class="btn btn-info" data-target="#myModalSuggestion" title="Add Suggestion">Add Suggestion</a>
											</td>
										</tr>
									</table>
									
								 </div>								 
								 
								 <?php if (isset($classroom) && count($classroom) > 0) { ?>
								 <div class="col-lg-6">
									 <table class="table table-bordered">
										 <tbody>
										 <tr>
											 <td bgcolor="#f7f7f7" width="140"><b>School</b></td>
											 <td><?php echo $school->school_name ?></td>
										 </tr>
										 <tr>
											 <td bgcolor="#f7f7f7"><b>Classroom</b></td>
											 <td><?php echo $classroom->classroom_name ?></td>
										 </tr>
										 <tr>
											 <td bgcolor="#f7f7f7"><b>Homeroom Teacher</b></td>
											 <td><?php echo $classroom->teacher_name ?></td>
										 </tr>
										 </tbody>
									 </table>
								 </div>
								 
								 <div class="col-lg-6">
									 <table class="table table-bordered">
										 <tbody>
										 <tr>
											 <td bgcolor="#f7f7f7" width="140"><b>Education Level</b></td>
											 <td><?php echo $classroom->edulevel_name ?></td>
										 </tr>
										 <tr>
											 <td bgcolor="#f7f7f7"><b>NIK</b></td>
											 <td><?php echo $student->member_code ?></td>
										 </tr>
										 <tr>
											 <td bgcolor="#f7f7f7"><b>School Year</b></td>
											 <td><?php echo $classroom->scyear_name ?></td>
										 </tr>
										 </tbody>
									 </table>
								 </div>		
							 
								 <div class="col-lg-12">
										<div id="tabs">
											<ul class="nav nav-pills nav-pills-warning" id="prodTabs">
												<li class="<?php echo $class_active_1 ?>">
													<a href="#class_menu_schedule" id="class_menu_sch" data-url="<?php url("classroom/class_schedule/$student->memberid/$classroom->classroomid/$school->schoolid"); ?>">Schedule</a>
												</li>
												<li class="<?php echo $class_active_7 ?>">
													<a href="#class_menu_dailyexam" id="class_menu_dexam" data-url="<?php url("classroom/class_daily_exam/$student->memberid/$classroom->classroomid/$school->schoolid"); ?>">Class Test</a>
												</li>
												<li class="<?php echo $class_active_8 ?>">
													<a href="#class_menu_exam" id="class_menu_sexam" data-url="<?php url("classroom/class_exam_schedule/$student->memberid/$classroom->classroomid/$school->schoolid"); ?>">Exam</a>
												</li>
												<li class="<?php echo $class_active_9 ?>">
													<a href="#class_menu_rapor_score" id="class_menu_rapor" data-url="<?php url("classroom/class_rapor_score/$student->memberid/$classroom->classroomid/$school->schoolid"); ?>">Rapor</a>
												</li>
												<li class="<?php echo $class_active_2 ?>">
													<a href="#class_menu_message" id="class_menu_msg" data-url="<?php url("message/student_inbox/$student->memberid/$school->schoolid"); ?>">Message</a>
												</li>
												<li class="<?php echo $class_active_3 ?>">
													<a href="#class_menu_calendar" id="class_menu_cal" data-url="<?php url("classroom/class_calendar/$classroom->classroomid/$school->schoolid"); ?>">Calendar</a>
												</li>												
												<li class="<?php echo $class_active_4 ?>">
													<a href="#class_menu_attendance">Attendance</a>
												</li>
												<li class="<?php echo $class_active_4 ?>">
													<a href="#class_menu_fee">School Fees</a>
												</li>
												<li class="<?php echo $class_active_5 ?>">
													<a href="#class_menu_announcement" id="class_menu_ann" data-url="<?php url("announcement/index/$student->memberid/$school->schoolid"); ?>">Announcement</a>
												</li>
											</ul>
											<div class="tab-content">
												<div id="class_menu_schedule" class="tab-pane <?php echo $class_active_1 ?>"></div>
												<div id="class_menu_dailyexam" class="tab-pane <?php echo $class_active_7 ?>"></div>
												<div id="class_menu_exam" class="tab-pane <?php echo $class_active_8 ?>"></div>
												<div id="class_menu_rapor_score" class="tab-pane <?php echo $class_active_9 ?>"></div>
												<div id="class_menu_message" class="tab-pane <?php echo $class_active_2 ?>"></div>
												<div id="class_menu_calendar" class="tab-pane <?php echo $class_active_3 ?>"></div>
												
												<div id="class_menu_attendance" class="tab-pane <?php echo $class_active_4 ?>">
													<iframe id="class_menu_attend" src="<?php url("classroom/class_attendance/$student->memberid/$classroom->classroomid/$school->schoolid"); ?>" width="100%" frameborder="0" scrolling="no" onload="resizeIframe(this)" style="min-height: 600px"></iframe>
												</div>
							
												<div id="class_menu_fee" class="tab-pane <?php echo $class_active_6 ?>">
													<iframe id="class_menu_fee_history" src="<?php url("fee/history_payment/$student->memberid/$school->schoolid"); ?>" width="100%" frameborder="0" scrolling="no" onload="resizeIframe(this)" style="min-height: 700px"></iframe>
												</div>
							
												<div id="class_menu_announcement" class="tab-pane <?php echo $class_active_5 ?>"></div>
												
											</div>
										</div>	
								 </div>		
								 <?php } else { ?>
									<div style="height:100px"></div>
								   	<div align='center' class='alert-box info'>Student cannot exist in the Classroom. <br> Please contact the School.</div>								   
								 <?php } ?>
								 
							 </div>
									
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
<div class="modal fade" id="myModalSuggestion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog modal-big">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel"><strong>Add New Suggestion</strong></h5>
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

<div class="modal fade" id="myModalTeacherAssessment" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
	<div class="modal-dialog modal-big">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel"><strong>Teacher Assessment</strong></h5>
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
	function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	}
  
	$('#myModalSuggestion').on('show.bs.modal', function (e) {
		var loadurl = $(e.relatedTarget).data('load-url');
		$(this).find('.modal-body').load(loadurl);
	});
	
	$('#myModalTeacherAssessment').on('show.bs.modal', function (e) {
		var loadurl = $(e.relatedTarget).data('load-url');
		$(this).find('.modal-body').load(loadurl);
	});
	
	$(document).ready(function() {
		$('#tabs').on('click','.tablink,#prodTabs a',function (e) {
			e.preventDefault();
			var url = $(this).attr("data-url");
		
			if (typeof url !== "undefined") {
				var pane = $(this), href = this.hash;
		
				// ajax load from data-url
				$(href).load(url,function(result){      
					pane.tab('show');
				});
			} else {
				$(this).tab('show');
			}
		});
		
		<?php if ($class_menu_active == 1) { ?>
		var urlcal = $('#class_menu_sch').attr("data-url");		
		$('#class_menu_schedule').load(urlcal);
		<?php } ?>
		
		<?php if ($class_menu_active == 2) { ?>		
		var urlcal = $('#class_menu_msg').attr("data-url");
		$('#class_menu_message').load(urlcal);
		<?php } ?>
		
		<?php if ($class_menu_active == 3) { ?>
		var urlcal = $('#class_menu_cal').attr("data-url");		
		$('#class_menu_calendar').load(urlcal);
		<?php } ?>
		
		<?php if ($class_menu_active == 4) { ?>
		var urlattend = $('#class_menu_attend').attr("data-url");		
		$('#class_menu_attendance').load(urlattend);
		<?php } ?>
		
		<?php if ($class_menu_active == 5) { ?>
		var urlannounce = $('#class_menu_ann').attr("data-url");		
		$('#class_menu_announcement').load(urlannounce);
		<?php } ?>
		
		<?php if ($class_menu_active == 6) { ?>
		var urlfee = $('#class_menu_fee_history').attr("data-url");		
		$('#class_menu_fee').load(urlfee);
		<?php } ?>
		
		<?php if ($class_menu_active == 7) { ?>
		var urldailyexam = $('#class_menu_dexam').attr("data-url");		
		$('#class_menu_dailyexam').load(urldailyexam);
		<?php } ?>
		
		<?php if ($class_menu_active == 8) { ?>
		var urlexam = $('#class_menu_sexam').attr("data-url");		
		$('#class_menu_exam').load(urlexam);
		<?php } ?>
		
		<?php if ($class_menu_active == 9) { ?>
		var urlexam = $('#class_menu_rapor').attr("data-url");		
		$('#class_menu_rapor_score').load(urlexam);
		<?php } ?>
		
	});
</script>
	