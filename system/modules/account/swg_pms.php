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
* account/swg_pms.php
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

if (!isset ($direct_settings['account_pms'])) { $direct_settings['account_pms'] = false; }
if (!isset ($direct_settings['account_pms_https_view'])) { $direct_settings['account_pms_https_view'] = false; }
if (!isset ($direct_settings['account_pms_messages_max'])) { $direct_settings['account_pms_messages_max'] = 50; }
if (!isset ($direct_settings['account_pms_messages_per_page'])) { $direct_settings['account_pms_messages_per_page'] = 20; }
if (!isset ($direct_settings['serviceicon_account_pms_box_in'])) { $direct_settings['serviceicon_account_pms_box_in'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_account_pms_box_out'])) { $direct_settings['serviceicon_account_pms_box_out'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_account_pms_delete'])) { $direct_settings['serviceicon_account_pms_delete'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_account_pms_new'])) { $direct_settings['serviceicon_account_pms_new'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_account_pms_reply'])) { $direct_settings['serviceicon_account_pms_reply'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_default_back'])) { $direct_settings['serviceicon_default_back'] = "mini_default_back.png"; }
$direct_settings['additional_copyright'][] = array ("Module account_pms #echo(sWGaccountPmsVersion)# - (C) ","http://www.direct-netware.de/redirect.php?swg","direct Netware Group"," - All rights reserved");

if ($direct_settings['a'] == "index") { $direct_settings['a'] = "box"; }
//j// BOS
switch ($direct_settings['a'])
{
//j// $direct_settings['a'] == "box"
case "box":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=box_ (#echo(__LINE__)#)"); }

	$g_box_id_d = (isset ($direct_settings['dsd']['abox_d']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['abox_d'])) : "in");
	$direct_cachedata['output_box'] = (isset ($direct_settings['dsd']['abox']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['abox'])) : $g_box_id_d);
	$direct_cachedata['output_page'] = (isset ($direct_settings['dsd']['page']) ? ($direct_classes['basic_functions']->inputfilter_number ($direct_settings['dsd']['page'])) : 1);

	$direct_cachedata['page_this'] = "m=account&s=pms&a=box&dsd=abox+{$direct_cachedata['output_box']}++page+".$direct_cachedata['output_page'];
	$direct_cachedata['page_backlink'] = "m=account&a=services";
	$direct_cachedata['page_homelink'] = "m=account&a=services";

	if ($direct_classes['kernel']->service_init_default ())
	{
	if ($direct_settings['account_pms'])
	{
	if ($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']))
	{
	//j// BOA
	direct_output_related_manager ("account_pms_box_".$direct_cachedata['output_box'],"pre_module_service_action");
	$direct_classes['kernel']->service_https ($direct_settings['account_pms_https_view'],$direct_cachedata['page_this']);
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_account_pms_box.php");
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_account_pms_message.php");
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_datalinker_uhome.php");
	direct_local_integration ("account_pms");

	direct_class_init ("output");
	$direct_classes['output']->servicemenu ("account_pms");

	$direct_classes['output']->options_insert (2,"servicemenu","m=account&a=services",(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

	$g_box_object = NULL;
	$g_datalinker_object = new direct_datalinker_uhome ();

	if (($g_datalinker_object)&&($g_datalinker_object->get ($direct_settings['user']['id'])))
	{
		switch ($direct_cachedata['output_box'])
		{
		case "in":
		{
			$g_box_type = 1;
			break 1;
		}
		case "out":
		{
			$g_box_type = 2;
			break 1;
		}
		default:
		{
			$g_box_type = "";

$g_datalinker_object->define_extra_conditions (($direct_classes['db']->define_row_conditions_encode ("ddbdatalinker_id",$direct_cachedata['output_box'],"string"))."
<element2 attribute='ddbdatalinker_type' value='3' type='number' operator='&lt;=' />");
		}
		}

		$g_boxes_array = $g_datalinker_object->get_subs ("direct_account_pms_box","u-".$direct_settings['user']['id'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba",$g_box_type,0,0,"position-asc");
		// md5 ("account_pms")

		if ($g_boxes_array)
		{
			reset ($g_boxes_array);
			$g_box_object = current ($g_boxes_array);
			if ($g_box_object) { $g_box_array = $g_box_object->get (); }
		}
	}

	$direct_cachedata['output_pms_messages'] = array ();

	if ($g_box_object)
	{
		if ($g_box_array['ddbdatalinker_type'] == 1) { $direct_cachedata['output_box'] = "in"; }
		elseif ($g_box_array['ddbdatalinker_type'] == 2) { $direct_cachedata['output_box'] = "out"; }

		if (strlen ($g_box_array['ddbdatalinker_title_alt'])) { $direct_cachedata['output_box_name'] = direct_html_encode_special ($g_box_array['ddbdatalinker_title_alt']); }
		elseif (strlen ($g_box_array['ddbdatalinker_title'])) { $direct_cachedata['output_box_name'] = direct_html_encode_special ($g_box_array['ddbdatalinker_title']); }
		else { $direct_cachedata['output_box_name'] = ""; }

		$direct_cachedata['output_pms_counter'] = $g_box_object->get_messages_since_date (3,0,0,1,"",true,true);
		$g_box_messages = $g_box_object->get_messages_since_date (3,0,0,1,"",true);

		$direct_cachedata['output_page_url'] = "m=account&s=pms&a=box&dsd=abox+{$direct_cachedata['output_box']}++";
		$direct_cachedata['output_pages'] = ceil ($g_box_messages / $direct_settings['account_pms_messages_per_page']);
		if ($direct_cachedata['output_pages'] < 1) { $direct_cachedata['output_pages'] = 1; }

		if ((!$direct_cachedata['output_page'])||($direct_cachedata['output_page'] < 1)) { $direct_cachedata['output_page'] = 1; }
		if ($direct_cachedata['output_page'] > $direct_cachedata['output_pages']) { $direct_cachedata['output_page'] = $direct_cachedata['output_pages']; }

		if ($g_box_messages)
		{
			$g_offset = (($direct_cachedata['output_page'] - 1) * $direct_settings['account_pms_messages_per_page']);
			$g_messages_array = $g_box_object->get_messages (3,$g_offset,$direct_settings['account_pms_messages_per_page']);

			if ($g_messages_array)
			{
				foreach ($g_messages_array as $g_message_object) { $direct_cachedata['output_pms_messages'][] = $g_message_object->parse ("m=account&s=pms&a=[a]&dsd=[oid][page{$direct_cachedata['output_page']}]"); }
			}
		}
	}
	else
	{
		$g_boxes_array = $g_datalinker_object->get_subs ("direct_account_pms_box","u-".$direct_settings['user']['id'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",0,1,"position-asc");
		// md5 ("account_pms")

		if ($g_boxes_array)
		{
			reset ($g_boxes_array);
			$g_box_object = current ($g_boxes_array);
			$direct_cachedata['output_pms_counter'] = $g_box_object->get_messages_since_date (3,0,0,1,"",true,true);
		}
		else { $direct_cachedata['output_pms_counter'] = 0; }

		$direct_cachedata['output_page'] = 1;
		$direct_cachedata['output_pages'] = 1;

	}

	if ($direct_cachedata['output_box'] != "in") { $direct_classes['output']->options_insert (1,"servicemenu","m=account&s=pms&a=box&dsd=abox+in",(direct_local_get ("account_pms_box_in")),$direct_settings['serviceicon_account_pms_box_in'],"url0"); }
	if ($direct_cachedata['output_box'] != "out") { $direct_classes['output']->options_insert (1,"servicemenu","m=account&s=pms&a=box&dsd=abox+out",(direct_local_get ("account_pms_box_out")),$direct_settings['serviceicon_account_pms_box_out'],"url0"); }

	if ($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']) > 1)
	{
		$direct_cachedata['output_pms_quota'] = "";
		$direct_cachedata['output_pms_quota_percentage'] = direct_local_get ("core_unlimited");
		$direct_classes['output']->options_insert (1,"servicemenu","m=account&s=pms_control&a=new",(direct_local_get ("account_pms_new")),$direct_settings['serviceicon_account_pms_new'],"url0");
	}
	else
	{
		$direct_cachedata['output_pms_quota'] = round (($direct_cachedata['output_pms_counter'] / $direct_settings['account_pms_messages_max']),2);
		$direct_cachedata['output_pms_quota_percentage'] = (($direct_cachedata['output_pms_quota'] * 100)."%");
		if ($direct_cachedata['output_pms_counter'] < $direct_settings['account_pms_messages_max']) { $direct_classes['output']->options_insert (1,"servicemenu","m=account&s=pms_control&a=new",(direct_local_get ("account_pms_new")),$direct_settings['serviceicon_account_pms_new'],"url0"); }
	}

	switch ($direct_cachedata['output_box'])
	{
	case "in":
	{
		$direct_cachedata['output_box_name'] = direct_local_get ("account_pms_box_in");
		break 1;
	}
	case "out":
	{
		$direct_cachedata['output_box_name'] = direct_local_get ("account_pms_box_out");
		break 1;
	}
	default:
	{
		if (!strlen ($direct_cachedata['output_box_name'])) { $direct_cachedata['output_box_name'] = direct_local_get ("account_pms_box"); }
	}
	}

	direct_output_related_manager ("account_pms_box_".$direct_cachedata['output_box'],"post_module_service_action");
	$direct_classes['output']->oset ("account_pms","box");
	$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
	$direct_classes['output']->page_show ($direct_cachedata['output_box_name']);
	//j// EOA
	}
	else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a=box_ (#echo(__LINE__)#)"); }
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_service_inactive","sWG/#echo(__FILEPATH__)# _a=box_ (#echo(__LINE__)#)"); }
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// $direct_settings['a'] == "view"
case "view":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=view_ (#echo(__LINE__)#)"); }

	$g_message_id = (isset ($direct_settings['dsd']['amid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['amid'])) : "");

	$direct_cachedata['output_printview'] = (isset ($direct_settings['dsd']['printview']) ? ($direct_classes['basic_functions']->inputfilter_number ($direct_settings['dsd']['printview'])) : "");
	if (!$direct_cachedata['output_printview']) { $direct_cachedata['output_printview'] = 0; }

	$direct_cachedata['page_this'] = "m=account&s=pms&a=view&dsd=amid+".$g_message_id;
	$direct_cachedata['page_backlink'] = "m=account&a=services";
	$direct_cachedata['page_homelink'] = "m=account&a=services";

	if ($direct_classes['kernel']->service_init_default ())
	{
	if ($direct_settings['account_pms'])
	{
	if ($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']))
	{
	//j// BOA
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_account_pms_box.php");
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_account_pms_message.php");

	$g_box_array = NULL;
	$g_message_object = new direct_account_pms_message ();

	$g_message_array = ($g_message_object ? $g_message_object->get ($g_message_id,$direct_settings['user']['id']) : NULL);

	if ($g_message_array)
	{
		$g_box_object = new direct_account_pms_box ();
		if ($g_box_object) { $g_box_array = $g_box_object->get ($g_message_array['ddbdatalinker_id_main'],$direct_settings['user']['id']); }
	}

	if (!is_array ($g_box_array)) { $direct_classes['error_functions']->error_page ("standard","account_pms_mid_invalid","sWG/#echo(__FILEPATH__)# _a=view_ (#echo(__LINE__)#)"); }
	else
	{
		$direct_cachedata['page_backlink'] = "m=account&s=pms&a=box&dsd=abox+".$g_box_array['ddbdatalinker_id'];

		direct_output_related_manager ("account_pms_view_{$g_box_array['ddbdatalinker_id']}_".$g_message_id,"pre_module_service_action");
		$direct_classes['kernel']->service_https ($direct_settings['account_pms_https_view'],$direct_cachedata['page_this']);
		direct_local_integration ("account_pms");

		if ($direct_cachedata['output_printview']) { direct_output_theme_subtype ("printview"); }
		direct_class_init ("output");

		if ($direct_cachedata['output_printview']) { $direct_classes['output']->options_insert (2,"servicemenu",$direct_cachedata['page_this'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0"); }
		else
		{
			$direct_classes['output']->servicemenu ("account_pms");

			$direct_classes['output']->options_insert (1,"servicemenu","m=account&s=pms&a=box&dsd=abox+in",(direct_local_get ("account_pms_box_in")),$direct_settings['serviceicon_account_pms_box_in'],"url0");
			$direct_classes['output']->options_insert (1,"servicemenu","m=account&s=pms&a=box&dsd=abox+out",(direct_local_get ("account_pms_box_out")),$direct_settings['serviceicon_account_pms_box_out'],"url0");
			$direct_classes['output']->options_insert (1,"servicemenu","m=account&s=pms_control&a=delete&dsd=amid+".$g_message_id,(direct_local_get ("account_pms_delete")),$direct_settings['serviceicon_account_pms_delete'],"url0");
			$direct_classes['output']->options_insert (2,"servicemenu","m=account&s=pms&a=box&dsd=abox+".$g_box_array['ddbdatalinker_id'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");
		}

		if (($g_message_array['ddbdatalinker_type'] == 4)&&($g_message_array['ddbdatalinker_position'] > 0))
		{
			$g_message_object->define_read (true);
			$g_message_object->update (false,true);
		}

		$direct_cachedata['output_pms_counter'] = $g_box_object->get_messages_since_date (3,0,0,1,"",true,true);

		if ($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']) > 1) { $g_rights_check = true; }
		elseif ($direct_cachedata['output_pms_counter'] < $direct_settings['account_pms_messages_max']) { $g_rights_check = true; }
		else { $g_rights_check = false; }

		if ($g_rights_check)
		{
			$direct_classes['output']->options_insert (1,"servicemenu","m=account&s=pms_control&a=reply&dsd=amid+".$g_message_id,(direct_local_get ("account_pms_reply")),$direct_settings['serviceicon_account_pms_reply'],"url0");
			$direct_classes['output']->options_insert (1,"servicemenu","m=account&s=pms_control&a=new",(direct_local_get ("account_pms_new")),$direct_settings['serviceicon_account_pms_new'],"url0");
		}

		$direct_cachedata['output_message'] = $g_message_object->parse ("m=account&s=pms&a=[a]&dsd=[oid][page]");

		direct_output_related_manager ("account_pms_view_{$g_box_array['ddbdatalinker_id']}_".$g_message_id,"post_module_service_action");
		$direct_classes['output']->oset ("account_pms","view");
		$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
		$direct_classes['output']->page_show ($direct_cachedata['output_message']['title']);
	}
	//j// EOA
	}
	else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a=view_ (#echo(__LINE__)#)"); }
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_service_inactive","sWG/#echo(__FILEPATH__)# _a=view_ (#echo(__LINE__)#)"); }
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// EOS
}

//j// EOF
?>