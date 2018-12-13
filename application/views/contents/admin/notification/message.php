			
				<?php if (isset($messages) && count($messages) > 0) { ?>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-envelope notif" style="float: left; width: 14px; padding: 0px; margin: 0px;"></i><div class="wtd-container"><?php echo $total_msg ?></div>
					<p class="hidden-lg hidden-md">
						Pesan
						<b class="caret"></b>
					</p>
				</a>
				<ul class="dropdown-menu menu-hover">
					<?php foreach($messages as $message) { ?>
					<li>
						<a href="message/inbox_detail/<?php echo $message->messageid ?>/<?php echo $message->reply_message_id ?>">
						<?php echo word_limiter(strip_tags($message->message_cont), 6);	?>
						</a>
					</li>
					<?php } ?>
				</ul>
				<?php } ?>