<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-calendar fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Kalender Kelas</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
							
							<div class="box-body">
								<div class="row">
									<?php if (isset($classroom) && is_object($classroom) && $classroom != false) { ?>
									<div class="col-lg-6">
										<table class="table table-bordered">
											<tbody>
											<tr>
												<td bgcolor="#f7f7f7" width="140"><b>Kelas</b></td>
												<td><?php echo $classroom->classroom_name ?></td>
											</tr>
											<tr>
												<td bgcolor="#f7f7f7"><b>Tahun Ajaran</b></td>
												<td><?php echo $classroom->scyear_name ?></td>
											</tr>
											</tbody>
										</table>
									</div>
									
									<div class="col-lg-6">
										<table class="table table-bordered">
											<tbody>
											<tr>
												<td bgcolor="#f7f7f7" width="140"><b>Tingkatan Kelas</b></td>
												<td><?php echo $classroom->edulevel_name ?></td>
											</tr>
											<tr>
												<td bgcolor="#f7f7f7"><b>Wali Kelas</b></td>
												<td><?php echo $classroom->teacher_name ?></td>
											</tr>
											</tbody>
										</table>
									</div>									
								
									<div class="col-lg-12">&nbsp;</div>
									
									<div class="col-lg-12">
										<div id="calendarIO"></div>
									</div>
									
									<?php } else { ?>
										<div class="col-lg-12" style="height: 50px"></div>
										<div align='center' class='alert-box info'>Tidak Ada Kegiatan di Database.</div>
								    <?php } ?>
									
								</div>
							</div>
							
						</div>
					</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="CalendarViewM" role="dialog" aria-labelledby="CalendarModalLabel" aria-hidden="false">
	<div class="modal-dialog modal-big">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="CalendarModalLabel"><strong>Kalender&nbsp;</strong></h5>
			</div>
			<div class="modal-body">
				<div class="instruction">
					<div class="row">
						<iframe id="CalendarMd" width="100%" frameborder="0" scrolling="no" onload="resizeIframe(this)" style="min-height: 300px"></iframe>
					</div>
				</div>															  
			</div>
			
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="assets/css/jquery.datetimepicker.css" />
<script type="text/javascript" src="assets/js/jquery.datetimepicker.js"></script>
	
<script type="text/javascript">
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
  
	$(document).ready(function() {
		var calendars        = '<?php echo $calendars ?>';
		var backend_url     = '<?php echo base_url(); ?>';
		
		$('#caldatepicker').datetimepicker({
			datepicker:true,
			timepicker:false,
			format:'d-m-Y'
		});
		
		$('#caltimepicker').datetimepicker({
			formatTime:'H:i',
			format:'H:i',
			datepicker:false,
			step: 15,
			timepickerScrollbar:false
	    });
		
        $('#calendarIO').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listMonth'
			},
			
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				var calendar_date = moment(start).format('DD-MM-YYYY')
			
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position
				//alert("bb");
			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
				//alert("cc");
			},
			eventClick: function(event, element)
			{
				//alert(event.id);
				if (event.id == 0) {
					alert(event.title);
				}
				else
				{
					$('.spinner-bg-web').fadeIn();
					$('.spinner-img-web').fadeIn();
				
					$("#CalendarMd").attr('src', "announcement/view_calendar/" + event.id + "/<?php echo $school_id ?>");
					setTimeout(function() {
						$('#CalendarViewM').modal('show');
					}, 1000);
					
					$('#calendarIO').fullCalendar('unselect');
					$('.spinner-bg-web').fadeOut();
					$('.spinner-img-web').fadeOut();	
				}		
			},
			events: JSON.parse(calendars)
			
			/*
			events: [
				{
					title: 'All Day Event',
					start: '2017-09-01',
					end: '2017-09-01'
				},
				{
					title: 'Long Event',
					start: '2017-09-07'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-09-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2017-09-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2017-09-11'
				},
				{
					title: 'Meeting',
					start: '2017-09-12T10:30:00',
					end: '2017-09-12T10:30:00'
				},
				{
					title: 'Lunch',
					start: '2017-09-12T12:30:00',
					end: '2017-09-12T14:30:00'
				},
				{
					title: 'Meeting',
					start: '2017-09-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2017-09-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2017-09-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2017-09-13T07:00:00'
				}
			]
			*/
		});

		
	});
</script>

<script src="assets/js/material-dashboard.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
