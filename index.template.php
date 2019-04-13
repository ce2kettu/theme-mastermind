<?php
function template_init()
{
	global $context, $settings, $options, $txt;

	$settings['use_default_images'] = 'never';
	$settings['theme_version'] = '2.0.15';
	$settings['use_tabs'] = true;
	$settings['use_buttons'] = false;
	$settings['separate_sticky_lock'] = true;
	$settings['strict_doctype'] = false;
	$settings['message_index_preview'] = false;
	$settings['require_theme_strings'] = true;
}

function template_html_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	echo '<!doctype html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/css/index', $context['theme_variant'], '.css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
	<script type="text/javascript" src="', $settings['default_theme_url'], '/scripts/script.js"></script>
	<script type="text/javascript"><!-- // --><![CDATA[
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_default_theme_url = "', $settings['default_theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
		var smf_scripturl = "', $scripturl, '";
		var smf_iso_case_folding = ', $context['server']['iso_case_folding'] ? 'true' : 'false', ';
		var smf_charset = "', $context['character_set'], '";', $context['show_pm_popup'] ? '
		var fPmPopup = function ()
		{
			if (confirm("' . $txt['show_personal_messages'] . '"))
				window.open(smf_prepareScriptUrl(smf_scripturl) + "action=pm");
		}
		addLoadEvent(fPmPopup);' : '', '
		var ajax_notification_text = "', $txt['ajax_in_progress'], '";
		var ajax_notification_cancel_text = "', $txt['modify_cancel'], '";
	// ]]></script>
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<meta name="theme-color" content="#6284F3">
	<meta content="IE=Edge" http-equiv="X-UA-Compatible">
	<link rel="manifest" href="/assets/manifest.json">
	<link rel="shortcut icon" href="/assets/favicon.png">
	<meta name="description" content="', $context['page_title_html_safe'], '" />', !empty($context['meta_keywords']) ? '
	<meta name="keywords" content="' . $context['meta_keywords'] . '" />' : '', '
	<title>', $context['page_title_html_safe'], '</title> ', $context['html_headers'],'
</head>
<body>';
}

function template_body_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	echo '
	<div class="background"></div>
	<header class="header">
		<div class="header__content">
		<div class="header__hamburger" aria-label="menu" role="button" tabindex="0">
			<svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"></path><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path></svg>
		</div>
		<div class="header__logo">
			<a href="/">
				<img src="', $settings['header_logo_url'] ,'">
			</a>
		</div>
		<nav class="header__nav header__nav--desktop">';
		template_menu();
		echo
		'</nav>
		</div>
	</header>
	<aside class="header__nav header__nav--mobile">
		<div class="header__nav__content">
		<div class="header__nav__details">
			<div class="header__nav__logo">
			<a href="/">
				<img src="http://ddc.community/Themes/Analysis/images/img/olaheader123.gif">
			</a>
			</div>
			<h2>',empty($settings['site_slogan']) ? 'Site slogan' : $settings['site_slogan'],'</h2>
		</div>
		<nav class="header__nav__items" role="navigation">';
		template_menu();
			echo '    
		</nav>
		</div>
  	</aside>
	<main class="container">
		<div class="content">';
}

function template_body_below()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	echo '
		</div>
	<footer class="footer">
		<div class="footer__content">
			<a class="footer__fab" href="#top" aria-label="Back to top"></a>
			<div class="footer__row">
				<div class="footer__logo">';
				theme_copyright();
				echo'
				</br>
				</br>
				',empty($settings['site_slogan']) ? 'Site slogan' : $settings['site_slogan'],'</div>
				<div class="footer__copyright">Mastermind © 2018 by Garry Bane</div>
			</div>
			<div class="footer__row">
				<div class="footer__nav">
					<div class="footer__nav__item">
						<a href="#" aria-label="FAQ">FAQ</a>
					</div>
					<div class="footer__nav__item">
						<a href="#" aria-label="Rules">Rules</a>
					</div>
					<div class="footer__nav__item">
						<a href="#" aria-label="Something">Something</a>
					</div>
					<div class="footer__nav__item">
						<a href="#" aria-label="Something">Something</a>
					</div>
					<div class="footer__nav__item">
						<a href="#" aria-label="Something">Something</a>
					</div>
				</div>
				<div class="footer__social">
					<a target="_blank" aria-label="Facebook" href="#" class="footer__social__icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="-296.6 411.2 11.2 13.6"><style>.st0{opacity:.7;fill:#616161}</style><path class="st0" d="M-288.9 417.1h-1.4v4.9h-2v-4.9h-1v-1.7h1v-1c0-1.4.6-2.2 2.2-2.2h1.4v1.7h-.8c-.6 0-.7.2-.7.7v.8h1.5l-.2 1.7z"></path></svg>
					</a>
					<a target="_blank" aria-label="Google+" href="#" class="footer__social__icon">
						<svg width="22" height="14" viewBox="0 0 22 14" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd" opacity=".7"><path d="M7 6v2.4h3.97c-.16 1.03-1.2 3.02-3.97 3.02-2.39 0-4.34-1.98-4.34-4.42S4.61 2.58 7 2.58c1.36 0 2.27.58 2.79 1.08l1.9-1.83C10.47.69 8.89 0 7 0 3.13 0 0 3.13 0 7s3.13 7 7 7c4.04 0 6.72-2.84 6.72-6.84 0-.46-.05-.81-.11-1.16H7zm15 0h-2V4h-2v2h-2v2h2v2h2V8h2V6z" fill="#616161"></path><path d="M-1-5h24v24H-1z"></path></g></svg>
					</a>
					<a target="_blank" aria-label="Twitter" href="#" class="footer__social__icon">
						<svg width="17" height="14" viewBox="0 0 17 14" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd" opacity=".7"><path d="M17 1.657a6.9 6.9 0 0 1-2.003.557A3.537 3.537 0 0 0 16.53.258c-.674.406-1.42.7-2.214.858A3.462 3.462 0 0 0 11.77 0C9.844 0 8.282 1.582 8.282 3.534c0 .277.03.547.09.806C5.474 4.192 2.904 2.785 1.184.647a3.56 3.56 0 0 0-.473 1.777c0 1.226.616 2.308 1.552 2.942a3.439 3.439 0 0 1-1.58-.443v.045c0 1.712 1.202 3.14 2.798 3.466a3.452 3.452 0 0 1-1.575.06c.443 1.404 1.731 2.426 3.258 2.455A6.94 6.94 0 0 1 0 12.412 9.778 9.778 0 0 0 5.346 14c6.416 0 9.924-5.385 9.924-10.056 0-.153-.004-.306-.01-.457A7.142 7.142 0 0 0 17 1.657" fill="#616161"></path><path d="M-4-5h24v24H-4z"></path></g></svg>
					</a>
					<a target="_blank" aria-label="YouTube" href="#" class="footer__social__icon">
						<svg width="20" height="14" viewBox="0 0 20 14" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd" opacity=".7"><path d="M7.935 9.582V3.989l5.403 2.806-5.403 2.787zM19.8 3.02s-.195-1.371-.795-1.976c-.76-.792-1.613-.796-2.004-.843C14.203 0 10.004 0 10.004 0h-.008S5.798 0 2.999.201c-.391.047-1.243.05-2.004.843C.395 1.65.2 3.02.2 3.02S0 4.631 0 6.242v1.51c0 1.61.2 3.221.2 3.221s.195 1.372.795 1.976c.76.793 1.76.768 2.205.851 1.6.153 6.8.2 6.8.2s4.203-.006 7.001-.208c.391-.046 1.244-.05 2.004-.843.6-.604.795-1.976.795-1.976s.2-1.61.2-3.221v-1.51c0-1.611-.2-3.222-.2-3.222z" fill="#616161"></path><path d="M-2-5h24v24H-2z"></path></g></svg>
					</a>
				</div>
			</div>
		</div>
	</footer>';
}

function template_html_below()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	echo '
	</main>
	<script type="text/javascript" src="', $settings['theme_url'], '/scripts/theme.js"></script>
</body>
</html>';
}

function theme_linktree($force_show = false)
{
	global $context, $settings, $options, $shown_linktree;

	if (empty($context['linktree']) || (!empty($context['dont_default_linktree']) && !$force_show))
		return;

	echo '
	<div>
	<div class="breadcrumbs">
		<ul>';

	foreach ($context['linktree'] as $link_num => $tree)
	{
		echo '
			<li>';

		echo $settings['linktree_link'] && isset($tree['url']) ? '<a href="' . $tree['url'] . '"><span>' . $tree['name'] . '</span></a>' : '<span>' . $tree['name'] . '</span>';

		echo '
			</li>';
	}
	echo '
		</ul>
	</div>
	</div>';

	$shown_linktree = true;
}

function template_menu()
{
	global $context, $settings, $options, $scripturl, $txt;

	foreach ($context['menu_buttons'] as $act => $button)
	{
		echo '
				<div class="header__nav__item ', $button['active_button'] ? 'header__nav__item--active ' : '','button_', $act, '">
					<a href="', $button['href'], '"', isset($button['target']) ? ' target="' . $button['target'] . '"' : '', '>', $button['title'], '</a>';

 		if (!empty($button['sub_buttons']))
		{
			echo '
					<ul>';

			foreach ($button['sub_buttons'] as $childbutton)
			{
				echo '
						<li>
							<a href="', $childbutton['href'], '"', isset($childbutton['target']) ? ' target="' . $childbutton['target'] . '"' : '', '>', $childbutton['title'], !empty($childbutton['sub_buttons']) ? '...' : '', '</a>';

				// 3rd level menus :)
				if (!empty($childbutton['sub_buttons']))
				{
					echo '
							<ul>';

					foreach ($childbutton['sub_buttons'] as $grandchildbutton)
						echo '
								<li>
									<a href="', $grandchildbutton['href'], '"', isset($grandchildbutton['target']) ? ' target="' . $grandchildbutton['target'] . '"' : '', '>', $grandchildbutton['title'], '</a>
								</li>';

					echo '
						</ul>';
				}

				echo '
						</li>';
			}
			echo '
					</ul>';
		} 
		echo '
				</div>';
	}
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function format_timestamp($datetime)
{
    return date("d/m/Y H:i:s", $datetime);
}
?>