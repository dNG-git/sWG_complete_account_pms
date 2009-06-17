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
$Id: swg_account_pms.php,v 1.2 2008/12/24 23:53:49 s4u Exp $
#echo(sWGaccountPmsVersion)#
sWG/#echo(__FILEPATH__)#
----------------------------------------------------------------------------
NOTE_END //n*/
/**
* osets/default_etitle/swg_account_pms.php
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
* @uses       direct_product_iversion
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/

/* -------------------------------------------------------------------------
All comments will be removed in the "production" packages (they will be in
all development packets)
------------------------------------------------------------------------- */

//j// Basic configuration

/* -------------------------------------------------------------------------
Direct calls will be honored with an "exit ()"
------------------------------------------------------------------------- */

if (!defined ("direct_product_iversion")) { exit (); }

//j// Functions and classes

//f// direct_output_oset_account_pms_box ()
/**
* direct_output_oset_account_pms_box ()
*
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_account_pms_box ()
{
	global $direct_cachedata,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_account_pms_box ()- (#echo(__LINE__)#)"); }

	$direct_settings['theme_output_page_title'] = $direct_cachedata['output_box_name'];
	$f_return = "<p class='pagecontent' style='text-align:center'>".(direct_local_get ("account_pms_quota")).": <span style='font-weight:bold'>{$direct_cachedata['output_pms_counter']}</span> ({$direct_cachedata['output_pms_quota_percentage']})</p>";

	if (empty ($direct_cachedata['output_pms_messages']))
	{
		if ($direct_cachedata['output_box'] == "out") { $f_return .= "<p class='pagecontent' style='font-weight:bold'>".(direct_local_get ("account_pms_box_out_list_empty"))."</p>"; }
		else { $f_return .= "<p class='pagecontent' style='font-weight:bold'>".(direct_local_get ("account_pms_box_in_list_empty"))."</p>"; }
	}
	else
	{
		if ($direct_cachedata['output_pages'] > 1) { $f_return .= "<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>"; }

$f_return .= ("\n<table cellspacing='1' summary='' class='pageborder1' style='width:100%'>
<thead><tr>
<td valign='middle' align='center' class='pagetitlecellbg' style='width:50%;padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>".(direct_local_get ("account_pms_title"))."</span></td>");

		if ($direct_cachedata['output_box'] == "out") { $f_return .= "\n<td valign='middle' align='center' class='pagetitlecellbg' style='width:25%;padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>".(direct_local_get ("account_pms_to"))."</span></td>"; }
		else { $f_return .= "\n<td valign='middle' align='center' class='pagetitlecellbg' style='width:25%;padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>".(direct_local_get ("account_pms_from"))."</span></td>"; }

$f_return .= ("\n<td valign='middle' align='center' class='pagetitlecellbg' style='width:25%;padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent' style='font-size:10px'>".(direct_local_get ("account_pms_time"))."</span></td>
</tr></thead><tbody>");

		foreach ($direct_cachedata['output_pms_messages'] as $f_message_array)
		{
			$f_return .= "<tr>\n<td valign='middle' align='left' class='pagebg' style='width:50%;padding:$direct_settings[theme_td_padding]'><span class='pagecontent' style='font-weight:bold'>";

			if (($direct_cachedata['output_box'] == "in")&&(!$f_message_array['read'])) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_message_new.png",true,false))."' border='0' alt='".(direct_local_get ("account_pms_unread"))."' title='".(direct_local_get ("account_pms_unread"))."' style='float:right' />"; }

$f_return .= ("<a href=\"{$f_message_array['pageurl']}\" target='_self'>{$f_message_array['title']}</a></span></td>
<td valign='middle' align='center' class='pageextrabg' style='width:25%;padding:$direct_settings[theme_td_padding]'><span class='pageextracontent'>");

			if ($f_message_array['userpageurl']) { $f_return .= "<a href=\"{$f_message_array['userpageurl']}\" target='_self'>{$f_message_array['username']}</a>"; }
			else { $f_return .= $f_message_array['username']; }

$f_return .= ("</span></td>
<td valign='middle' align='center' class='pagebg' style='width:25%;padding:$direct_settings[theme_td_padding]'><span class='pagecontent'>{$f_message_array['time']}</span></td>
</tr>");
		}

		$f_return .= "</tbody>\n</table>";
		if ($direct_cachedata['output_pages'] > 1) { $f_return .= "\n<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>"; }
	}

	return $f_return;
}

//f// direct_output_oset_account_pms_view ()
/**
* direct_output_oset_account_pms_view ()
*
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_account_pms_view ()
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_account_pms_view ()- (#echo(__LINE__)#)"); }

	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_account_profile.php");
	$direct_settings['theme_output_page_title'] = $direct_cachedata['output_message']['title'];

	if ($direct_cachedata['output_message']['type'] == "out") { $f_userdata_type = direct_local_get ("account_pms_to"); }
	else { $f_userdata_type = direct_local_get ("account_pms_from"); }

$f_return = ("<p class='pageborder2' style='text-align:left'><span class='pagecontent'>{$direct_cachedata['output_message']['text']}</span></p>
<table cellspacing='1' summary='' class='pageborder1' style='width:100%'>
<thead><tr>
<td align='left' class='pagetitlecellbg' style='padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>$f_userdata_type</span></td>
</tr></thead><tbody><tr>
<td valign='middle' align='left' class='pageextrabg' style='padding:$direct_settings[theme_td_padding]'>".(direct_account_oset_parse_user_fullh ($direct_cachedata['output_message'],"page","","","user"))."</td>
</tr>");

	if ($direct_cachedata['output_message']['usersignature'])
	{
$f_return .= ("<tr>
<td align='center' class='pagebg' style='padding:$direct_settings[theme_td_padding]'><span class='pagecontent'>{$direct_cachedata['output_message']['usersignature']}</span></td>
</tr>");
	}

	return $f_return."</tbody>\n</table>";
}

//j// EOF
?>