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
* account_registration/swgi_pms.php
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
* @subpackage account
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/

/*#use(direct_use) */
use dNG\sWG\dhandler\directPMSBox,
    dNG\sWG\dhandler\directPMSMessage;
/* #\n*/

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

/**
* Modification function called by:
* m = validation
* for account registration
*
* @param  array $f_data Array containing call specific data.
* @return boolean Always true
* @since  v0.1.00
*/
function direct_mods_account_registration_pms_validation ($f_data)
{
	global $direct_cachedata,$direct_globals,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_mods_account_registration_pms_validation (+f_data)- (#echo(__LINE__)#)"); }

	if (isset ($f_data[1]))
	{
		$f_continue_check = ($direct_globals['basic_functions']->settingsGet ($direct_settings['path_data']."/settings/swg_account_pms.php") ? $direct_settings['account_mods_profile_pms_via_email'] : false);
		$f_return = $f_data[1];
	}
	else
	{
		$f_continue_check = false;
		$f_return = NULL;
	}

	if ($f_continue_check) { $f_continue_check = direct_autoload ('dNG\sWG\dhandler\directPMSBox'); }
	if ($f_continue_check) { $f_continue_check = direct_autoload ('dNG\sWG\dhandler\directPMSMessage'); }

	if ($f_continue_check)
	{
		$f_box_id = uniqid ("");
		$f_box_object = new directPMSBox ();

		if ($f_box_object)
		{
$f_insert_array = array (
"ddbdatalinker_id" => $f_box_id,
"ddbdatalinker_id_parent" => "u-".$f_return['ddbusers_id'],
"ddbdatalinker_id_main" => "u-".$f_return['ddbusers_id'],
"ddbdatalinker_sid" => "c0a38f7c90c17551fb03dbd2d80f0aba",
// md5 ("account_pms")
"ddbdatalinker_type" => 1,
"ddbdatalinker_position" => 0,
"ddbdatalinker_subs" => 0,
"ddbdatalinker_objects" => 1,
"ddbdatalinker_sorting_date" => $direct_cachedata['core_time'],
"ddbdatalinker_symbol" => "",
"ddbdatalinker_title" => ""
);

			$f_continue_check = $f_box_object->setInsert ($f_insert_array);
		}
		else { $f_continue_check = false; }

		$f_message_object = new directPMSMessage ();
		if (!$f_message_object) { $f_continue_check = false; }

		if ($f_continue_check)
		{
			$f_message_id = uniqid ("");

$f_insert_array = array (
"ddbdatalinker_id" => $f_message_id,
"ddbdatalinker_id_object" => $f_message_id,
"ddbdatalinker_id_parent" => "",
"ddbdatalinker_id_main" => $f_box_id,
"ddbdatalinker_sid" => "c0a38f7c90c17551fb03dbd2d80f0aba",
// md5 ("account_pms")
"ddbdatalinker_type" => 4,
"ddbdatalinker_position" => 1,
"ddbdatalinker_subs" => 0,
"ddbdatalinker_objects" => 0,
"ddbdatalinker_sorting_date" => $direct_cachedata['core_time'],
"ddbdatalinker_symbol" => "",
"ddbdatalinker_title" => direct_local_get ("account_title_registration_welcome","text"),
"ddbpms_id" => $f_message_id,
"ddbpms_from_id" => "",
"ddbpms_to_id" => $f_return['ddbusers_id'],
"ddbdata_data" => direct_local_get ("account_registration_welcome","text"),
"box" => "in"
);

			if (!$f_message_object->setInsert ($f_insert_array)) { $f_return = NULL; }
		}
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_mods_account_registration_pms_validation ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
}

//j// Script specific commands

direct_local_integration ("account");
if (!isset ($direct_settings['account_mods_registration_pms'])) { $direct_settings['account_mods_registration_pms'] = true; }

//j// EOF
?>