<?php

/**
 * @package SimplePortal
 *
 * @author SimplePortal Team
 * @copyright 2014 SimplePortal Team
 * @license BSD 3-clause
 *
 * @version 2.3.6
 */

function template_portal_above()
{
	global $context, $modSettings;

if (!empty($modSettings['showleft']) && !empty($context['SPortal']['blocks'][1])) 
{
	echo '
	<div class="portal">';
} else {
	echo '
	<div class="portal portal--collapsed">';
}

	if (!empty($modSettings['showleft']) && !empty($context['SPortal']['blocks'][1]))
	{
		echo '
			<div class="portal__left">';

		foreach ($context['SPortal']['blocks'][1] as $block)
			template_block($block);

		echo '
			</div>';
	}

	if (!empty($context['SPortal']['blocks'][5]))
	{
		echo '
	<div class="portal__header">';

		foreach ($context['SPortal']['blocks'][5] as $block)
			template_block($block);

		echo '
	</div>';
	}

	echo '
			<div class="portal__center">';

	if (!empty($context['SPortal']['blocks'][2]))
	{
		foreach ($context['SPortal']['blocks'][2] as $block)
			template_block($block);
	}
}

function template_portal_below()
{
	global $context, $modSettings;

	if (!empty($context['SPortal']['blocks'][3]))
	{
		foreach ($context['SPortal']['blocks'][3] as $block)
			template_block($block);
	}

	echo '
			</div>';

	if (!empty($modSettings['showright']) && !empty($context['SPortal']['blocks'][4]))
	{
		echo '
			<div class="portal__right">';

		foreach ($context['SPortal']['blocks'][4] as $block)
			template_block($block);

		echo '
			</div>';
	}
	echo '
	</div>';

	if (!empty($context['SPortal']['blocks'][6]))
	{
		echo '
	<div class="portal__footer">';

		foreach ($context['SPortal']['blocks'][6] as $block)
			template_block($block);

		echo '
	</div>
	<br />';
	}
}

function template_block($block)
{
	global $context, $modSettings, $txt;

	if (empty($block) || empty($block['type']))
		return;

	if (isset($txt['sp_custom_block_title_' . $block['id']]))
		$block['label'] = $txt['sp_custom_block_title_' . $block['id']];

		template_block_mastermind($block);
}

function template_block_mastermind($block)
{
	global $context, $modSettings, $settings;

	echo '
	<div class="portal__block', isset($context['SPortal']['sides'][$block['column']]['last']) && $context['SPortal']['sides'][$block['column']]['last'] == $block['id'] && ($block['column'] != 2 || empty($modSettings['articleactive'])) ? '--last' : '', '">';

	if (empty($block['style']['no_title']))
	{
		echo '
		<div class="portal__block__header">', parse_bbc($block['label']), '</div>';
	}

	echo '
		<div class="portal__block__content">';

	$block['type']($block['parameters'], $block['id']);

	echo '
			</div>';

	echo '
	</div>';
}

?>