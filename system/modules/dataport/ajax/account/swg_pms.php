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
* dataport/ajax/account/swg_pms.php
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

//j// Script specific commands

//j// BOS
switch ($direct_settings['a'])
{
//j// $direct_settings['a'] == "status_and_pms"
case "status_and_pms":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=status_and_pms_ (#echo(__LINE__)#)"); }

	if ($direct_classes['kernel']->service_init_rboolean ())
	{
	//j// BOA
	$direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_account_pms_box.php");
	$direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_datalinker_uhome.php");
	direct_class_init ("output");

	$direct_cachedata['output_account_status_and_pms_unread_include'] = false;
	$direct_cachedata['output_last_update'] = $direct_classes['basic_functions']->datetime ("time",$direct_cachedata['core_time'],$direct_settings['user']['timezone']);

	if ($direct_settings['user']['type'] == "gt")
	{
		$direct_cachedata['output_account_status_and_pms_logged_in'] = false;
		$direct_cachedata['output_account_status_and_pms_username'] = "";
	}
	else
	{
		$direct_cachedata['output_account_status_and_pms_logged_in'] = true;
		$direct_cachedata['output_account_status_and_pms_username'] = $direct_settings['user']['name'];

		if ($direct_settings['user']['type'] != "ex")
		{
			$g_box_in_object = NULL;
			$g_datalinker_object = new direct_datalinker_uhome ();

			if ($g_datalinker_object)
			{
				if ($g_datalinker_object->get ($direct_settings['user']['id']))
				{
					$g_boxes_array = $g_datalinker_object->get_subs ("direct_account_pms_box","u-".$direct_settings['user']['id'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba",1,0,0,"position-asc");
					// md5 ("account_pms")

					if ($g_boxes_array)
					{
						reset ($g_boxes_array);
						$g_box_in_id = key ($g_boxes_array);
						$g_box_in_object = current ($g_boxes_array);
					}
				}
			}

			if ($g_box_in_object) { $g_messages_unread = $g_box_in_object->get_messages_since_date (1,0,0,1,"",true); }
			else { $g_messages_unread = 0; }

			$direct_cachedata['output_account_status_and_pms_unread_include'] = true;

			if ($g_messages_unread == 1) { $direct_cachedata['output_account_status_and_pms_unread_text'] = (direct_local_get ("core_userbox_unread_pms_1_1"))."<span style='font-weight:bold'><a href='".(direct_linker ("url0","m=account&s=pms&a=box&dsd=abox+in"))."' target='_self'>".(direct_local_get ("core_userbox_unread_pms_1_2"))."</a></span>".(direct_local_get ("core_userbox_unread_pms_1_3")); }
			elseif ($g_messages_unread) { $direct_cachedata['output_account_status_and_pms_unread_text'] = (direct_local_get ("core_userbox_unread_pms_2_1"))."<span style='font-weight:bold'><a href='".(direct_linker ("url0","m=account&s=pms&a=box&dsd=abox+in"))."' target='_self'>$g_messages_unread</a></span>".(direct_local_get ("core_userbox_unread_pms_2_2")); }
			else { $direct_cachedata['output_account_status_and_pms_unread_text'] = direct_local_get ("core_userbox_unread_pms_0"); }
		}
	}

	$direct_classes['output']->header (false);
	header ("Content-type: text/xml; charset=".$direct_local['lang_charset']);

echo ("<?xml version='1.0' encoding='$direct_local[lang_charset]' ?>
".($direct_classes['output']->oset_content ("account_pms_embedded","ajax_status")));
	//j// EOA
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// EOS
}

//j// EOF
?>