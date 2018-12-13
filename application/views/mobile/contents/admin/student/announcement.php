<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="green">
				<i class="fa fa-bullhorn fa-2x"></i>
			</div>
			<div class="card-content">
				<h4 class="card-title">Pengumuman</h4>
					<div class="row">
						<div class="col-md-12" style="min-height: 400px">
							
							<div class="box-body">
								<div id="calendarIO2"></div>
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
		
        $('#calendarIO2').fullCalendar({
			height: $(window).height()*0.83,
			theme: true,
			//dayNamesShort: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
			header: {
				left: 'prev,next',
				center: 'title',
				right: 'month,listMonth'
			},
			views: {
				month: { // name of view
					titleFormat: 'MMM YYYY'
					// other view-specific options here
				}
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
				$('.spinner-bg-web').fadeIn();
				$('.spinner-img-web').fadeIn();
				
				$("#CalendarMd").attr('src', "announcement/view_calendar/" + event.id + "/<?php echo $school_id ?>");
				setTimeout(function() {
					$('#CalendarViewM').modal('show');
				}, 1000);
				$('#calendarIO2').fullCalendar('unselect');
				$('.spinner-bg-web').fadeOut();
				$('.spinner-img-web').fadeOut();
			},
			events: JSON.parse(calendars)			
			
		});

		
	});
</script>
