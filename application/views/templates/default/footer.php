        
              </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        Copyright &copy; 2018 KES - Kids Education System. All rights reserved. 
                    </p>
                </div>
            </footer>
        </div>
    </div>

</body>
</html>


<script src="assets/js/material-dashboard.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
<script src="assets/js/scripts.js?t=<?php echo time(); ?>" type="text/javascript"></script>

<script type="text/javascript">
	function showNotification (from, align, type, message)
	{			
		//type = ['', 'info', 'success', 'warning', 'danger', 'rose', 'primary'];
		//color = Math.floor((Math.random() * 6) + 1);

		$.notify({
			icon: "notifications",
			message: message

		}, {
			type: type,
			timer: 1000,
			placement: {
				from: from,
				align: align
			}
		});
	}
	
    $(document).ready(function() {
		$('#dataTables').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			//"pageLength": 2,
			"info": true,
			"autoWidth": false,
						
			"order": [[ 1, "asc" ]],
			
            columnDefs: [
                { orderable: false, targets: -1 }, 
                { orderable: false, targets: -2 }
            ],
            
			responsive: true,
			language: {
				"paginate": {
					next: 'Next', // or '→'
					previous: 'Prev' // or '←' 
				},
			}
	
		});
		
		$('#dataTables2').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			//"pageLength": 2,
			"info": true,
			"autoWidth": false,
						
			"order": [[ 1, "asc" ]],
			
			responsive: true,
			language: {
				"paginate": {
					next: 'Next', // or '→'
					previous: 'Prev' // or '←' 
				},
			}
	
		});
        
        $('#reportTables').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			//"pageLength": 2,
			"info": true,
			"autoWidth": false,
			
            "order": [[ 0, "desc" ]],
			            
			responsive: true,
			language: {
				"paginate": {
					next: 'Next', // or '→'
					previous: 'Prev' // or '←' 
				},
			}
	
		});
		
		$('#userTables').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			//"pageLength": 2,
			"info": true,
			"autoWidth": false,
			
            "order": [[ 0, "asc" ]],
			            
			responsive: true,
			language: {
				"paginate": {
					next: 'Next', // or '→'
					previous: 'Prev' // or '←' 
				},
			}
	
		});
		
		$('#userTables2').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			//"pageLength": 2,
			"info": true,
			"autoWidth": false,
			
            "order": [[ 0, "desc" ]],
			            
			responsive: true,
			language: {
				"paginate": {
					next: 'Next', // or '→'
					previous: 'Prev' // or '←' 
				},
			}
	
		});
		
		$('#attendTables').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			//"pageLength": 2,
			"info": true,
			"autoWidth": false,
			
            "order": [[ 0, "asc" ]],
			            
			responsive: true,
			language: {
				"paginate": {
					next: 'Next', // or '→'
					previous: 'Prev' // or '←' 
				},
			}
	
		});
		
		$('#scoreTables').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			//"pageLength": 2,
			"info": false,
			"autoWidth": false,
			
            "order": [[ 0, "asc" ]],
			            
			responsive: true,
			language: {
				"paginate": {
					next: 'Next', // or '→'
					previous: 'Prev' // or '←' 
				},
			}
	
		});
		
	});
	
</script>

<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            $('.spinner-bg-web').fadeOut();
            $('.spinner-img-web').fadeOut();
        });

    })(jQuery);
</script>