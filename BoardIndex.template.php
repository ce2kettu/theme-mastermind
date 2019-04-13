<?php
function template_main()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	echo '
	<div class="forum">
		<div class="forum__categories">';

	foreach ($context['categories'] as $category)
	{
		if (empty($category['boards'])) continue;

		echo '
			<div class="forum__category">
				<div class="category__name">', $category['name'] ,'</div>
				<div class="forum__boards">';

			foreach ($category['boards'] as $board)
			{

				if ($board === end($category['boards'])) {
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
	echo '
		</div>';

		echo '
		</div>';
		
	/* template_stats(); */


}

function template_stats()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

/* 	', $context['common_stats']['total_posts'], ' ', $txt['posts_made'], ' ', $txt['in'], ' ', $context['common_stats']['total_topics'], ' ', $txt['topics'], ' ', $txt['by'], ' ', $context['common_stats']['total_members'], ' ', $txt['members'], '. ', !empty($settings['show_latest_member']) ? $txt['latest_member'] . ': <strong> ' . $context['common_stats']['latest_member']['link'] . '</strong>' : '', '<br />
			', (!empty($context['latest_post']) ? $txt['latest_post'] . ': <strong>&quot;' . $context['latest_post']['link'] . '&quot;</strong>  ( ' . $context['latest_post']['time'] . ' )<br />' : ''), ' */

	echo '
		<div class="forum__stats">
			<div class="stats__content">
				<div class="stats__block">
					<div class="stats__block-header">Recent Posts</div>
					<div class="stats__block-body">', template_recent(5, true) ,'</div>
				</div>
				<div class="stats__block">
					<div class="stats__block-header">Recent Topics</div>
					<div class="stats__block-body">', template_recent(5, false) ,'</div>
				</div>
				<div class="stats__block">
					<div class="stats__block-header">Forum Stats</div>
					<div class="stats__block-body">', template_recent(5, true) ,'</div>
				</div>
			</div>
		</div>
	';

}

function template_recent($limit = 5, $type = true)
{
	global $txt, $scripturl, $settings, $context, $memberContext, $color_profile;

	$type = 'ssi_recent' . ($type ? 'Posts' : 'Topics');
	$items = $type($limit, null, $boards, 'array');

	if (empty($items))
	{
		echo '
								', $txt['error_sp_no_posts_found'];
		return;
	}
	else
		$items[count($items) - 1]['is_last'] = true;

	$colorids = array();
	foreach ($items as $item)
		$colorids[] = $item['poster']['id'];

	if (!empty($colorids) && sp_loadColors($colorids) !== false)
	{
		foreach ($items as $k => $p)
		{
			if (!empty($color_profile[$p['poster']['id']]['link']))
				$items[$k]['poster']['link'] = $color_profile[$p['poster']['id']]['link'];
		}
	}

	
	$users = array();
	foreach ($items as $item)
	{
		$users[] = $item['poster']['id'];
	}

 	loadMemberData($users, false, 'normal');  

 		echo '
		<div class="recents">';
		foreach ($items as $key => $item)
		{
      	 loadMemberContext($item['poster']['id']);     
		echo '
		<div class="recents__item">
			<div class="recents__item__content">
				<a href="', $item['poster']['href'] ,'" class="recents__item__avatar" style="background-image: url(', $memberContext[$item['poster']['id']]['avatar']['url'] ,')">
				', $item['new'] ? '' : '<div class="recents__item__badge">'. $txt['new'] .'</div>', '
				</a>
				<div class="recents__item__detail">
				<div class="recents__item__primary">
					<a href="' . $scripturl . '?topic=' . $item['topic'] . '.msg' . $item['new_from'] . ';topicseen#new" rel="nofollow">', $item['subject'] ,'</a> ', $txt['by'], ' ', $item['poster']['link'] ,'
				</div>
				<div class="recents__item__secondary">', time_elapsed_string('@' . $item['timestamp']) ,'</div>
				</div>
			</div>
		</div>
		';
		}

		echo '
		</div>'; 
}
?>