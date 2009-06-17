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
$Id: swg_account_pms_embedded.php,v 1.1 2008/12/23 21:15:35 s4u Exp $
#echo(sWGaccountPmsVersion)#
sWG/#echo(__FILEPATH__)#
----------------------------------------------------------------------------
NOTE_END //n*/
/**
* osets/default/swg_account_pms_embedded.php
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

//f// direct_output_oset_account_pms_embedded_ajax_status ()
/**
* direct_output_oset_account_pms_embedded_ajax_status ()
*
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_account_pms_embedded_ajax_status ()
{
	global $direct_cachedata,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_account_pms_embedded_ajax_status ()- (#echo(__LINE__)#)"); }

	$f_return = "<span id='swgAJAX_blocks_account_status_and_pms_point'>";

	if ($direct_cachedata['output_account_status_and_pms_logged_in'])
	{
		$f_return .= "<span style='font-weight:bold'>".(direct_local_get ("core_userbox_member_1"))."<a href='".(direct_linker ("url0","m=account"))."' target='_self'>".$direct_cachedata['output_account_status_and_pms_username']."</a>".(direct_local_get ("core_userbox_member_2"))."</span>";

		if ($direct_cachedata['output_account_status_and_pms_unread_include'])
		{
$f_return .= ("<br />
$direct_cachedata[output_account_status_and_pms_unread_text] <span style='font-size:10px'>($direct_cachedata[output_last_update])</span>");
		}
	}
	else
	{
		if ($direct_settings['account_registration']) { $f_return .= ((direct_local_get ("core_userbox_guest_1_1"))."<a href='".(direct_linker ("url0","m=account&s=status&a=login"))."' target='_self'>".(direct_local_get ("core_userbox_guest_1_2"))."</a>".(direct_local_get ("core_userbox_guest_1_3"))."<a href='".(direct_linker ("url0","m=account&s=registration"))."' target='_self'>".(direct_local_get ("core_userbox_guest_1_4"))."</a>".(direct_local_get ("core_userbox_guest_1_5"))); }
		else { $f_return .= ((direct_local_get ("core_userbox_guest_2_1"))."<a href='".(direct_linker ("url0","m=account&s=status&a=login"))."' target='_self'>".(direct_local_get ("core_userbox_guest_2_2"))."</a>".direct_local_get ("core_userbox_guest_2_3")); }
	}

	return $f_return."</span>";
}

//j// EOF
?>