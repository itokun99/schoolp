			
				<?php if (isset($messages) && count($messages) > 0) { ?>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-envelope"></i>
					<span class="notification"><?php echo $total_msg ?></span>
					<p class="hidden-lg hidden-md">
						Message
						<b class="caret"></b>
					</p>
				</a>
				<ul class="dropdown-menu">
					<?php foreach($messages as $message) { ?>
					<li>
						<a href="message/inbox_detail/<?php echo $message->messageid ?>/<?php echo $message->reply_message_id ?>">
						<?php echo word_limiter(strip_tags($message->message_cont), 6);	?>
						</a>
					</li>
					<?php } ?>
				</ul>
				<?php } ?>