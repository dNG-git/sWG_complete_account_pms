<?php
//j// BOF

/*n// NOTE
----------------------------------------------------------------------------
secured WebGine
net-based application engine
----------------------------------------------------------------------------
(C) direct Netware Group - All rights reserved
http://www.direct-netware.de/redirect.php?swg

The following license agreement remains valid unless any additions or
changes are being made by direct Netware Group in a written form.

This program is free software; you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the
Free Software Foundation; either version 2 of the License, or (at your
option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along with
this program; if not, write to the Free Software Foundation, Inc.,
59 Temple Place, Suite 330, Boston, MA 02111-1307, USA.
----------------------------------------------------------------------------
http://www.direct-netware.de/redirect.php?licenses;gpl
----------------------------------------------------------------------------
#echo(sWGaccountPmsVersion)#
sWG/#echo(__FILEPATH__)#
----------------------------------------------------------------------------
NOTE_END //n*/
/**
* osets/default/swg_account_pms.php
*
* @internal   We are using phpDocumentor to automate the documentation process
*             for creating the Developer's Manual. All sections including
*             these special comments will be removed from the release source
*             code.
*             Use the following line to ensure 76 character sizes:
* ----------------------------------------------------------------------------
* @author     direct Netware Group
* @copyright  (C) direct Netware Group - All rights reserved
* @package    sWG
* @subpackage account_pms
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/

/* -------------------------------------------------------------------------
All comments will be removed in the "production" packages (they will be in
all development packets)
------------------------------------------------------------------------- */

//j// Functions and classes

/**
* direct_output_oset_account_pms_box ()
*
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_account_pms_box ()
{
	global $direct_cachedata,$direct_globals,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_account_pms_box ()- (#echo(__LINE__)#)"); }

	$f_return = "<h1 class='pagecontenttitle{$direct_settings['theme_css_corners']}'>{$direct_cachedata['output_box_name']}</h1>\n<p class='pagehighlightborder{$direct_settings['theme_css_corners']} pageextrabg pageextracontent' style='text-align:center'>".(direct_local_get ("account_pms_quota")).": <strong>{$direct_cachedata['output_pms_counter']}</strong> ({$direct_cachedata['output_pms_quota_percentage']})</p>";

	if (empty ($direct_cachedata['output_pms_messages'])) { $f_return .= "<p class='pagecontent'><strong>".(($direct_cachedata['output_box'] == "out") ? direct_local_get ("account_pms_box_out_list_empty") : direct_local_get ("account_pms_box_in_list_empty"))."</strong></p>"; }
	else
	{
		if ($direct_cachedata['output_pages'] > 1) { $f_return .= "<p class='pageborder{$direct_settings['theme_css_corners']} pageextrabg pageextracontent' style='text-align:center;font-size:10px'>".($direct_globals['output']->pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</p>"; }

$f_return .= ("\n<table class='pagetable' style='width:100%'>
<thead><tr>
<td class='pagetitlecell' style='width:50%;padding:$direct_settings[theme_td_padding];text-align:center;vertical-align:middle'>".(direct_local_get ("account_pms_title"))."</td>
<td valign='middle' align='center' class='pagetitlecell' style='width:25%;padding:$direct_settings[theme_td_padding];text-align:center;vertical-align:middle'>".(($direct_cachedata['output_box'] == "out") ? direct_local_get ("account_pms_to") : direct_local_get ("account_pms_from"))."</td>
<td class='pagetitlecell' style='width:25%;padding:$direct_settings[theme_td_padding];text-align:center;vertical-align:middle'>".(direct_local_get ("account_pms_time"))."</td>
</tr></thead><tbody>");

		foreach ($direct_cachedata['output_pms_messages'] as $f_message_array)
		{
			$f_return .= "<tr>\n<td class='pagebg pagecontent' style='width:50%;padding:$direct_settings[theme_td_padding];text-align:left;vertical-align:middle'><strong>";
			if (($direct_cachedata['output_box'] == "in")&&(!$f_message_array['read'])) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache;dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_message_new.png",true,false))."' border='0' alt='".(direct_local_get ("account_pms_unread"))."' title='".(direct_local_get ("account_pms_unread"))."' style='float:right' />"; }

$f_return .= ("<a href=\"".(direct_linker ("url0",$f_message_array['pageurl']))."\" target='_self'>{$f_message_array['title']}</a></strong></td>
<td class='pageextrabg pageextracontent' style='width:25%;padding:$direct_settings[theme_td_padding];text-align:center;vertical-align:middle'>");

			$f_return .= ($f_message_array['userpageurl'] ? "<a href=\"".(direct_linker ("url0",$f_message_array['userpageurl']))."\" target='_self'>{$f_message_array['username']}</a>" : $f_message_array['username']);

$f_return .= ("</td>
<td class='pagebg pagecontent' style='width:25%;padding:$direct_settings[theme_td_padding];text-align:center;vertical-align:middle'>".($direct_globals['basic_functions']->datetime ("shortdate&time",$f_message_array['time'],$direct_settings['user']['timezone'],(direct_local_get ("datetime_dtconnect"))))."</td>
</tr>");
		}

		$f_return .= "</tbody>\n</table>";
		if ($direct_cachedata['output_pages'] > 1) { $f_return .= "\n<p class='pageborder{$direct_settings['theme_css_corners']} pageextrabg pageextracontent' style='text-align:center;font-size:10px'>".($direct_globals['output']->pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</p>"; }
	}

	return $f_return;
}

/**
* direct_output_oset_account_pms_view ()
*
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_account_pms_view ()
{
	global $direct_cachedata,$direct_globals,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_account_pms_view ()- (#echo(__LINE__)#)"); }

	$direct_globals['basic_functions']->requireFile ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_account_profile.php");
	$f_userdata_type = (($direct_cachedata['output_message']['type'] == "out") ? direct_local_get ("account_pms_to") : direct_local_get ("account_pms_from"));

$f_return = ("<h1 class='pagecontenttitle{$direct_settings['theme_css_corners']}'>{$direct_cachedata['output_message']['title']}</h1>
<p class='pageborder{$direct_settings['theme_css_corners']} pageextrabg pageextracontent' style='text-align:left'>{$direct_cachedata['output_message']['text']}</p>
<table class='pagetable' style='width:100%'>
<thead><tr>
<td class='pagetitlecell' style='padding:$direct_settings[theme_td_padding];text-align:left'>$f_userdata_type</td>
</tr></thead><tbody><tr>
<td class='pageextrabg' style='padding:$direct_settings[theme_td_padding];text-align:left'>".(direct_account_oset_parse_user_fullh ($direct_cachedata['output_message'],"page","","","user"))."</td>
</tr>");

	if ($direct_cachedata['output_message']['usersignature'])
	{
$f_return .= ("<tr>
<td class='pagebg' style='padding:$direct_settings[theme_td_padding];text-align:center'><span class='pagecontent'>{$direct_cachedata['output_message']['usersignature']}</span></td>
</tr>");
	}

	return $f_return."</tbody>\n</table>";
}

//j// Script specific commands

$direct_settings['theme_css_corners'] = (isset ($direct_settings['theme_css_corners_class']) ? " ".$direct_settings['theme_css_corners_class'] : " ui-corner-all");
if (!isset ($direct_settings['theme_td_padding'])) { $direct_settings['theme_td_padding'] = "5px"; }

//j// EOF
?>