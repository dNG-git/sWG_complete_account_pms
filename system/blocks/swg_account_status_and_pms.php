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
* Block presenting available PMs as well as the online status.
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

/* -------------------------------------------------------------------------
Our Block System is always giving an array with requested options to the
called function. We don't need it for "account_status_and_pms"
------------------------------------------------------------------------- */

/**
* Generate output statistics including available messages as well as the 
* online status based on given options.
*
* @param  array $f_options Array with parameters from the block call
* @return boolean True on success
* @since  v0.1.00
*/
function direct_output_block_account_status_and_pms ($f_options)
{
	global $direct_cachedata,$direct_globals,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_block_account_status_and_pms (+f_options)- (#echo(__LINE__)#)"); }

	if (isset ($direct_globals['output']))
	{
		$direct_globals['basic_functions']->settingsGet ($direct_settings['path_data']."/settings/swg_account.php");
		$direct_cachedata['output_account_status_and_pms_unread_include'] = false;

		if ($direct_settings['user']['type'] != "gt")
		{
			$direct_cachedata['output_account_status_and_pms_logged_in'] = true;
			if ($direct_globals['kernel']->vUsertypeGetInt ($direct_settings['user']['type'])) { $direct_cachedata['output_account_status_and_pms_unread_include'] = true; }
			$direct_cachedata['output_account_status_and_pms_username'] = $direct_settings['user']['name'];

			$f_return = $direct_globals['output']->osetContent ("account_pms_embedded","block_status");
		}
		elseif ($direct_settings['blocks_account_status_and_pms_guestbox'])
		{
			$direct_cachedata['output_account_status_and_pms_logged_in'] = false;
			$f_return = $direct_globals['output']->osetContent ("account_pms_embedded","block_status");
		}
		else { $f_return = "&#0160;"; }
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_output_block_account_status_and_pms ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
}

//j// Script specific commands

if (!isset ($direct_settings['blocks_account_status_and_pms_guestbox'])) { $direct_settings['blocks_account_status_and_pms_guestbox'] = true; }

//j// EOF
?>