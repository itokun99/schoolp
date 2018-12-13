				<?php if (isset($messages) && count($messages) > 0) { ?>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-bell notif" style="float: left; width: 12px; padding: 0px; margin: 0px;"></i><div class="wtd-container"><?php echo $total_msg ?></div>
					<p class="hidden-lg hidden-md">
						Notification
						<b class="caret"></b>
					</p>
				</a>
				<?php if (count($messages) > 0) { ?>				
				<ul class="dropdown-menu menu-hover">
					<?php foreach($messages as $message) { ?>
					<li>
						<a href="#" data-toggle="modal" data-load-url="notification/notify_detail/<?php echo $message->notifyid ?>" data-target="#myModalNotify">
						<?php if ($message->notify_read == 1) echo "$message->title"; else echo "<b>$message->title</b>" ?>
						</a>
					</li>
					<?php } ?>
					<li>
						<a href="notification/notify_more" class="btn btn-info btn-sm">
						<b>Lihat Semua</b>
						</a>
					</li>
				</ul>
				<?php } ?>
				<?php } ?>
				
				