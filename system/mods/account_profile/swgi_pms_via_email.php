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
* account_profile/swgi_pms_via_email.php
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
* m = account
* s = profile
* a = edit
*
* @param  array $f_data Array containing call specific data.
* @return boolean True on success
* @since  v0.1.00
*/
function direct_mods_account_profile_pms_via_email_edit ($f_data)
{
	global $direct_cachedata,$direct_globals,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit (+f_data)- (#echo(__LINE__)#)"); }

	if ($direct_globals['basic_functions']->settingsGet ($direct_settings['path_data']."/settings/swg_account_pms.php")&&($direct_settings['account_mods_profile_pms_via_email']))
	{
		$direct_cachedata['i_apms_via_email'] = ($f_data[1]['ddbusers_pms_via_email'] ? "<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>" : "<evars><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>");
		$direct_globals['formbuilder']->entryAddSelect (array ("section" => (direct_local_get ("account_pms_setting")),"name" => "apms_via_email","title" => (direct_local_get ("account_pms_via_email"))));
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit ()- (#echo(__LINE__)#)",:#*/true/*#ifdef(DEBUG):,true):#*/;
}

/**
* Modification function called by:
* m = account
* s = profile
* a = edit-save
*
* @param  array $f_data Array containing call specific data.
* @return boolean Always true
* @since  v0.1.00
*/
function direct_mods_account_profile_pms_via_email_edit_check ($f_data)
{
	global $direct_cachedata,$direct_globals,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit_check (+f_data)- (#echo(__LINE__)#)"); }

	if (($direct_globals['basic_functions']->settingsGet ($direct_settings['path_data']."/settings/swg_account_pms.php"))&&($direct_settings['account_mods_profile_pms_via_email']))
	{
		$direct_cachedata['i_apms_via_email'] = (isset ($GLOBALS['i_apms_via_email']) ? (str_replace ("'","",$GLOBALS['i_apms_via_email'])) : $f_data[1]['ddbusers_pms_via_email']);
		$direct_cachedata['i_apms_via_email'] = str_replace ("<value value='$direct_cachedata[i_apms_via_email]' />","<value value='$direct_cachedata[i_apms_via_email]' /><selected value='1' />","<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>");

		$direct_globals['formbuilder']->entryAddSelect (array ("section" => (direct_local_get ("account_pms_setting")),"name" => "apms_via_email","title" => (direct_local_get ("account_pms_via_email"))));
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit_check ()- (#echo(__LINE__)#)",:#*/true/*#ifdef(DEBUG):,true):#*/;
}

/**
* Modification function called by:
* m = account
* s = profile
* a = edit-save
*
* @param  array $f_data Array containing call specific data.
* @return mixed Input based, edited user array or NULL on error
* @since  v0.1.00
*/
function direct_mods_account_profile_pms_via_email_edit_save ($f_data)
{
	global $direct_cachedata,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit_save (+f_data)- (#echo(__LINE__)#)"); }

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

	if ($f_continue_check) { $f_return['ddbusers_pms_via_email'] = ($direct_cachedata['i_apms_via_email'] ? 1 : 0); }
	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit_save ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
}

/**
* direct_mods_account_profile_pms_via_email_edit_saved ($f_data)
*
* @param  array $f_data Array containing call specific data.
* @return mixed Input based, edited user array or NULL on error
* @since  v0.1.00
*/
function direct_mods_account_profile_pms_via_email_edit_saved ($f_data)
{
	if (isset ($f_data[0])) { $f_return = $f_data[0]; }
	else { $f_return = array (); }

	return $f_return;
}

//j// Script specific commands

direct_local_integration ("account_pms");
if (!isset ($direct_settings['account_mods_profile_pms_via_email'])) { $direct_settings['account_mods_profile_pms_via_email'] = true; }

//j// EOF
?>