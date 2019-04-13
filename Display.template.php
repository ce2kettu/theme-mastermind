<?php
function template_main()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	echo '
			<div class="forum__thread">
				<div class="thread__name">', $context['subject'], ' (', $txt['read'], ' ', $context['num_views'], ' ', $txt['times'], ')</div>
				<div class="thread__messages">';

	$messageIndex = 0;

	while ($message = $context['get_message']())
	{

		if ($messageIndex == 0) {
			echo '
				<div class="thread__post thread__post--first">';
		} else {
			echo '
				<div class="thread__post">';
		}

		echo '
					<div class="post__content">';

		echo '
						<div class="post__author">';


		if (!$message['member']['is_guest'] && empty($options['show_no_avatars']) && !empty($settings['show_user_images']))
		{

			if (!empty($message['member']['avatar']['image'])) {
				echo '
							<div class="author__avatar">
								<a href="', $scripturl, '?action=profile;u=', $message['member']['id'], '">
									', $message['member']['avatar']['image'], '
								</a>
							</div>';
			} else {
				echo '
				<div class="author__avatar">
					<a href="', $scripturl, '?action=profile;u=', $message['member']['id'], '">
						<div class="author__avatar-placeholder"></div>
					</a>
				</div>';
			}

		}

		echo '
				<div class="author__details">
							<div class="author__name">', $message['member']['link'], '</div>';

		if (!empty($message['member']['title']))
			echo '
							<div class="author__member-title">', $message['member']['title'], '</div>';

		if (!empty($message['member']['group']))
			echo '
							<div class="author__membergroup">', $message['member']['group'], '</div>';

		if (!$message['member']['is_guest'])
		{
/* 
			if (!empty($settings['show_user_images']) && empty($options['show_no_avatars']) && !empty($message['member']['avatar']['image']))
				echo '
							<div class = "author__avatar">
								<a href   = "', $scripturl, '?action=profile;u=', $message['member']['id'], '">
									', $message['member']['avatar']['image'], '
								</a>
							</div>'; */
			
			if (!isset($context['disabled_fields']['posts']))
				echo '
							<div class="author__postcount">', $txt['member_postcount'], ': ', $message['member']['posts'], '</div>';

		}

		echo '
						</div>
						</div>
						<div class="post__message">
							<div class="post__header">
								<div class="post__header-topic">
									<a href="', $message['href'], '" rel="nofollow">', $message['subject'] ,'</a>
								</div>
								<div class="post__header-detail">', format_timestamp($message['timestamp']) ,' <strong>', !empty($message['counter']) ? '• #' . $message['counter'] : '', '</strong></div>
							</div>';

		echo '
							<div class="post__body">
								<div class="post__body-inner" id="msg_', $message['id'], '"', '>', $message['body'] ,'</div>
							</div>';

		echo '
						</div>';

		echo '

					</div>
				</div>';

				$messageIndex++;
	}

	echo '
				</div>
			</div>';

}

?>