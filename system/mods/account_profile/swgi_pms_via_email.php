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
$Id: swgi_pms_via_email.php,v 1.1 2008/12/22 14:33:50 s4u Exp $
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

//f// direct_mods_account_profile_pms_via_email_edit ($f_data)
/**
* Modification function called by:
* m = account
* s = profile
* a = edit
*
* @param  array $f_data Array containing call specific data.
* @uses   direct_basic_functions::inputfilter_number()
* @uses   direct_debug()
* @uses   direct_formbuilder::entry_add()
* @uses   direct_formbuilder::entry_add_select()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return boolean True on success
* @since  v0.1.00
*/
function direct_mods_account_profile_pms_via_email_edit ($f_data)
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit (+f_data)- (#echo(__LINE__)#)"); }

	if (isset ($f_data[1]))
	{
		$f_continue_check = $direct_settings['account_mods_profile_pms_via_email'];
		$f_return = true;
	}
	else
	{
		$f_continue_check = false;
		$f_return = false;
	}

	if ($f_continue_check)
	{
		if ($f_data[1]['ddbusers_pms_via_email']) { $direct_cachedata['i_apms_via_email'] = "<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>"; }
		else { $direct_cachedata['i_apms_via_email'] = "<evars><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>"; }

		$direct_classes['formbuilder']->entry_add ("subtitle","pms_setting",(direct_local_get ("account_pms_setting")));
		$direct_classes['formbuilder']->entry_add_select ("apms_via_email",(direct_local_get ("account_pms_via_email")),false,"s");
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
}

//f// direct_mods_account_profile_pms_via_email_edit_check ($f_data)
/**
* Modification function called by:
* m = account
* s = profile
* a = edit-save
*
* @param  array $f_data Array containing call specific data.
* @uses   direct_basic_functions::inputfilter_number()
* @uses   direct_debug()
* @uses   direct_formbuilder::entry_add()
* @uses   direct_formbuilder::entry_add_select()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return boolean Always true
* @since  v0.1.00
*/
function direct_mods_account_profile_pms_via_email_edit_check ($f_data)
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit_check (+f_data)- (#echo(__LINE__)#)"); }

	if ($direct_settings['account_mods_profile_pms_via_email'])
	{
		$direct_cachedata['i_apms_via_email'] = (isset ($GLOBALS['i_apms_via_email']) ? (str_replace ("'","",$GLOBALS['i_apms_via_email'])) : "");
		$direct_cachedata['i_apms_via_email'] = str_replace ("<value value='$direct_cachedata[i_apms_via_email]' />","<value value='$direct_cachedata[i_apms_via_email]' /><selected value='1' />","<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>");

		$direct_classes['formbuilder']->entry_add ("subtitle","pms_setting",(direct_local_get ("account_pms_setting")));
		$direct_classes['formbuilder']->entry_add_select ("apms_via_email",(direct_local_get ("account_pms_via_email")),true,"s");
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit_check ()- (#echo(__LINE__)#)",:#*/true/*#ifdef(DEBUG):,true):#*/;
}

//f// direct_mods_account_profile_pms_via_email_edit_save ($f_data)
/**
* Modification function called by:
* m = account
* s = profile
* a = edit-save
*
* @param  array $f_data Array containing call specific data.
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return mixed Input based, edited user array or NULL on error
* @since  v0.1.00
*/
function direct_mods_account_profile_pms_via_email_edit_save ($f_data)
{
	global $direct_cachedata,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit_save (+f_data)- (#echo(__LINE__)#)"); }

	if (isset ($f_data[1]))
	{
		$f_continue_check = $direct_settings['account_mods_profile_pms_via_email'];
		$f_return = $f_data[1];
	}
	else
	{
		$f_continue_check = false;
		$f_return = NULL;
	}

	if ($f_continue_check)
	{
		if ($direct_cachedata['i_apms_via_email']) { $f_return['ddbusers_pms_via_email'] = 1; }
		else { $f_return['ddbusers_pms_via_email'] = 0; }
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit_save ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
}

//f// direct_mods_account_profile_pms_via_email_view ($f_data)
/**
* Modification function called by:
* m = account
* s = profile
* a = view
*
* @param  array $f_data Array containing call specific data.
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return array List of modifications to view in the output
* @since  v0.1.00
*/
function direct_mods_account_profile_pms_via_email_view ($f_data)
{
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_view (+f_data)- (#echo(__LINE__)#)"); }

	if (is_array ($f_data[0])) { $f_return = $f_data[0]; }
	else { $f_return = array (); }

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_mods_account_profile_pms_via_email_edit_view ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
}

//j// Script specific commands

direct_local_integration ("account_pms");
if (!isset ($direct_settings['account_mods_profile_pms_via_email'])) { $direct_settings['account_mods_profile_pms_via_email'] = true; }

//j// EOF
?>