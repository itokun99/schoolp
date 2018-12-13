			
				<?php if (isset($payments) && count($payments) > 0) { ?>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-money"></i>
					<span class="notification"><?php echo $total_msg ?></span>
					<p class="hidden-lg hidden-md">
						Payment
						<b class="caret"></b>
					</p>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($payments as $payment) { ?>
					<li>
						<?php
						    $payment_desc = "Reminder <b>$payment->student_name</b> School Fee <br><i>$payment->month_name $payment->payment_year</i>";
						?>
						<a href="#" data-toggle="modal" data-load-url="notification/payment_read/<?php echo $payment->notificationid ?>" data-target="#myModalPayment">
						<?php echo $payment_desc ?>
						</a>
					</li>
					<?php } ?>
				</ul>
				<?php } ?>
				
