<?php
function template_main()
{
	global $context, $settings, $options, $scripturl, $modSettings, $txt;

	echo '
	<div class="forum__categories">';

	if (!empty($context['boards']) && (!empty($options['show_children']) || $context['start'] == 0))
	{

		echo '
		<div class="forum__category">
			<div class="category__name">', $txt['parent_boards'] ,'</div>
			<div class="forum__boards">';

			foreach ($context['boards'] as $board)
			{

				if ($board === end($context['boards'])) {
					echo '
				<div class="forum__board forum__board--last">';					
				} else {
					echo '
				<div class="forum__board">';	
				}
				echo '
					<div class="board__content">
						<div class="board__icon"></div>
						<div class="board__details">
							<a href="', $board['href'] ,'" class="board__subject">', $board['name'], '</a>
							<div class="board__description">', $board['description'] , '</div>';

				if (!empty($board['moderators']))
					echo '
							<div class="board__moderators">', count($board['moderators']) == 1 ? $txt['moderator'] : $txt['moderators'], ': ', implode(', ', $board['link_moderators']), '</div>';

					echo '
						</div>
						<div class="board__flex"></div>
						<div class="board__right">
							<div class="board__stats">
								<div>', comma_format($board['posts']), ' ', $board['is_redirect'] ? $txt['redirects'] : $txt['posts'], '</div>
								<div>', $board['is_redirect'] ? '' : comma_format($board['topics']) . ' ' . $txt['board_topics'], '</div>
							</div>
							<div class="board__lastpost">';

				if (!empty($board['last_post']['id']))
					echo '
								<span>', $board['last_post']['link'], '</span>
								<div>', $txt['by'] ,' ', $board['last_post']['member']['link'] , '<a href="', $board['last_post']['href'], '" target="_self"></a></div>		
								<div class="lastpost__timestamp">', time_elapsed_string('@' . $board['last_post']['timestamp']) ,'</div>';
				echo '
							</div>
						</div>
					</div>';

				if (!empty($board['children']))
				{
					$children = array();
					foreach ($board['children'] as $child)
					{
						if (!$child['is_redirect'])
							$child['link'] = '<a href="' . $child['href'] . '" ' . ($child['new'] ? 'class="new_posts" ' : '') . 'title="' . ($child['new'] ? $txt['new_posts'] : $txt['old_posts']) . ' (' . $txt['board_topics'] . ': ' . comma_format($child['topics']) . ', ' . $txt['posts'] . ': ' . comma_format($child['posts']) . ')">' . $child['name'] . ($child['new'] ? '</a> <a style="line-height: 0;" href="' . $scripturl . '?action=unread;board=' . $child['id'] . '" title="' . $txt['new_posts'] . ' (' . $txt['board_topics'] . ': ' . comma_format($child['topics']) . ', ' . $txt['posts'] . ': ' . comma_format($child['posts']) . ')"><span class="board__child-new">new</span>' : '') . '</a>';
						else
							$child['link'] = '<a href="' . $child['href'] . '" title="' . comma_format($child['posts']) . ' ' . $txt['redirects'] . '">' . $child['name'] . '</a>';

						$children[] = $child['new'] ? '<strong>' . $child['link'] . '</strong>' : $child['link'];
					}
					echo '
					<div class="board__children">';

					foreach ($children as $child) {
						echo '
						<div class="board__child">
							<span class="board__children-circle" style="background-color: rgb(71, 104, 253);"></span>
							<span>', $child, '</span>
						</div>';
					}

					echo'
					</div>';
				}
				echo '
				</div>';
			}
		echo '
			</div>
		</div>';
	}

	if (!$context['no_topic_listing'])
	{


		echo '
	<div class="forum__category">
		<div class="category__name">Topics</div>
		<div class="forum__boards">';

		foreach ($context['topics'] as $topic)
		{
			echo '
		<div class="forum__board">';	

		echo '
			<div class="board__content">
				<div class="board__icon"></div>
				<div class="board__details">
					<a href="', $topic['href'] ,'" class="board__subject">', $topic['first_post']['link'] ,'</a>
					<div class="board__description">', $txt['started_by'], ' ', $topic['first_post']['member']['link'], '</div>';

			echo '
				</div>
				<div class="board__flex"></div>
				<div class="board__right">
				<div class="board__stats">
					<div>', $topic['replies'], ' ', $txt['replies'], '</div>
					<div>', $topic['views'], ' ', $txt['views'], '</div>
				</div>
				<div class="board__lastpost">';

		if (!empty($topic['last_post']['id']))
			echo '
					<span>', $topic['last_post']['link'], '</span>
					<div>', $txt['by'] ,' ', $topic['last_post']['member']['link'] , '<a href="', $topic['last_post']['href'], '" target="_self"></a></div>		
					<div class="lastpost__timestamp">', time_elapsed_string('@' . $topic['last_post']['timestamp']) ,'</div>';
		echo '
				</div>
			</div>
		</div>
		</div>';
		}

		echo '
			</div>
		</div>';

	}

	echo '
	</div>';

	/* theme_linktree(); */
}

?>