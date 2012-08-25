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
* account/swg_pms_control.php
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

/*#use(direct_use) */
use dNG\sWG\directSendmailerFormtags,
    dNG\sWG\dhandler\directDataLinkerUHome,
    dNG\sWG\dhandler\directPMSBox,
    dNG\sWG\dhandler\directPMSMessage,
    dNG\sWG\web\directPyHelper;
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

//j// Script specific commands

if (!isset ($direct_settings['datalinker_title_min'])) { $direct_settings['datalinker_title_min'] = 3; }
if (!isset ($direct_settings['datalinker_title_max'])) { $direct_settings['datalinker_title_max'] = 255; }
if (!isset ($direct_settings['account_mods_profile_pms_via_email'])) { $direct_settings['account_mods_profile_pms_via_email'] = true; }
if (!isset ($direct_settings['account_pms_delete_credits_onetime'])) { $direct_settings['account_pms_delete_credits_onetime'] = 0; }
if (!isset ($direct_settings['account_pms_https_delete'])) { $direct_settings['account_pms_https_delete'] = false; }
if (!isset ($direct_settings['account_pms_https_new'])) { $direct_settings['account_pms_https_new'] = false; }
if (!isset ($direct_settings['account_pms_message_min'])) { $direct_settings['account_pms_message_min'] = 25; }
if (!isset ($direct_settings['account_pms_messages_max'])) { $direct_settings['account_pms_messages_max'] = 50; }
if (!isset ($direct_settings['account_pms_new_credits_onetime'])) { $direct_settings['account_pms_new_credits_onetime'] = 0; }
if (!isset ($direct_settings['account_pms_recipients_check_limit'])) { $direct_settings['account_pms_recipients_check_limit'] = false; }
if (!isset ($direct_settings['account_pms_recipients_max'])) { $direct_settings['account_pms_recipients_max'] = 5; }
if (!isset ($direct_settings['account_pms_recipients_max_internal'])) { $direct_settings['account_pms_recipients_max_internal'] = 30; }
if (!isset ($direct_settings['account_pms_title_max'])) { $direct_settings['account_pms_title_max'] = $direct_settings['datalinker_title_max']; }
if (!isset ($direct_settings['account_pms_title_min'])) { $direct_settings['account_pms_title_min'] = $direct_settings['datalinker_title_min']; }
if (!isset ($direct_settings['formtags_overview_document_url'])) { $direct_settings['formtags_overview_document_url'] = "m=contentor;a=view;dsd=cdid+dng_{$direct_settings['lang']}_2_90000000001"; }
if (!isset ($direct_settings['serviceicon_default_back'])) { $direct_settings['serviceicon_default_back'] = "mini_default_back.png"; }
if (!isset ($direct_settings['swg_data_limit'])) { $direct_settings['swg_data_limit'] = 16777216; }
if (!isset ($direct_settings['swg_pyhelper'])) { $direct_settings['swg_pyhelper'] = false; }
$direct_settings['additional_copyright'][] = array ("Module account_pms #echo(sWGaccountPmsVersion)# - (C) ","http://www.direct-netware.de/redirect.php?swg","direct Netware Group"," - All rights reserved");

//j// BOS
switch ($direct_settings['a'])
{
//j// $direct_settings['a'] == "delete"
case "delete":
{
	$g_mode_ajax_dialog = (($direct_settings['ohandler'] == "ajax_dialog") ? true : false);
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=delete_ (#echo(__LINE__)#)"); }

	$g_message_id = (isset ($direct_settings['dsd']['amid']) ? ($direct_globals['basic_functions']->inputfilterBasic ($direct_settings['dsd']['amid'])) : "");
	$g_source = (isset ($direct_settings['dsd']['source']) ? ($direct_globals['basic_functions']->inputfilterBasic ($direct_settings['dsd']['source'])) : "");
	$g_target = (isset ($direct_settings['dsd']['target']) ? ($direct_globals['basic_functions']->inputfilterBasic ($direct_settings['dsd']['target'])) : "");

	$g_source_url = ($g_source ? base64_decode ($g_source) : "m=account;s=pms;a=view;dsd=[oid]");
	$g_target_url = ($g_target ? base64_decode ($g_target) : "m=account;s=pms;a=box;dsd=[oid]");

	$direct_cachedata['page_this'] = "m=account;s=pms_control;a=delete;dsd=amid+{$g_message_id}++source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
	$direct_cachedata['page_backlink'] = str_replace ("[oid]","amid+$g_message_id++",$g_source_url);
	$direct_cachedata['page_homelink'] = $direct_cachedata['page_backlink'];

	if ($direct_globals['kernel']->serviceInitDefault ())
	{
	if ($direct_settings['account_pms'])
	{
	if ($direct_globals['kernel']->vUsertypeGetInt ($direct_settings['user']['type']))
	{
	//j// BOA
	$direct_globals['basic_functions']->settingsGet ($direct_settings['path_data']."/settings/swg_account_pms.php",true);
	$direct_globals['basic_functions']->requireFile ($direct_settings['path_system']."/functions/swg_credits_manager.php");
	direct_local_integration ("account_pms");

	$direct_globals['output']->servicemenu ("account_pms");
	$direct_globals['output']->optionsInsert (2,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

	$g_box_array = NULL;
	$g_continue_check = true;
	$g_message_object = new directPMSMessage ();

	$g_message_array = ($g_message_object ? $g_message_object->get ($g_message_id) : NULL);

	if (is_array ($g_message_array))
	{
		$g_box_object = new directPMSBox ();
		if ($g_box_object) { $g_box_array = $g_box_object->get ($g_message_array['ddbdatalinker_id_main']); }
		if (!direct_credits_payment_check (false,$direct_settings['account_pms_delete_credits_onetime'])) { $g_continue_check = false; }
	}

	if (!is_array ($g_box_array)) { $direct_globals['output']->outputSendError ("standard","account_pms_mid_invalid","","sWG/#echo(__FILEPATH__)# _a=delete_ (#echo(__LINE__)#)"); }
	elseif ($g_continue_check)
	{
		$g_mode = ($g_mode_ajax_dialog ? "_ajax" : "");
		$direct_globals['output']->relatedManager ("account_pms_control_delete_{$g_box_array['ddbdatalinker_id']}_".$g_message_id,"pre_module_service_action".$g_mode);

		$direct_globals['db']->vTransactionBegin ();

		if (($g_message_object->delete ())&&($g_box_object->removeMessages (1))&&($direct_globals['db']->vTransactionCommit ()))
		{
			direct_credits_payment_exec ("account","pms_delete",$g_message_array['ddbdatalinker_id'],$direct_settings['user']['id'],$direct_settings['account_pms_delete_credits_onetime']);

			$direct_cachedata['output_job'] = direct_local_get ("account_pms_delete");
			$direct_cachedata['output_job_desc'] = direct_local_get ("account_pms_done_delete");

			if ($g_target_url)
			{
				$g_target_link = str_replace ("[oid]","abox_d+{$g_message_array['ddbdatalinker_id_main']}++",$g_target_url);

				$direct_cachedata['output_jsjump'] = 2000;
				$direct_cachedata['output_pagetarget'] = str_replace ('"',"",(direct_linker ("url0",$g_target_link)));
				$direct_globals['output']->optionsFlush (true);
			}
			else { $direct_cachedata['output_jsjump'] = 0; }

			$direct_globals['output']->relatedManager ("account_pms_control_delete_{$g_box_array['ddbdatalinker_id']}_".$g_message_id,"post_module_service_action".$g_mode);
			$direct_globals['output']->oset ("default","done");

			if ($g_mode_ajax_dialog)
			{
				$direct_globals['output']->header (false,true);
				$direct_globals['output']->outputSend (direct_local_get ("core_done").": ".$direct_cachedata['output_job']);
			}
			else
			{
				$direct_globals['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
				$direct_globals['output']->outputSend ($direct_cachedata['output_job']);
			}
		}
		else
		{
			$direct_globals['db']->vTransactionRollback ();
			$direct_globals['output']->outputSendError ("fatal","core_database_error","","sWG/#echo(__FILEPATH__)# _a=delete_ (#echo(__LINE__)#)");
		}
	}
	else { $direct_globals['output']->outputSendError ("standard","core_credits_insufficient","SERVICE ERROR:<br />".(-1 * $direct_settings['account_pms_delete_credits_onetime'])." Credits are required but not available. This error has been reported by the sWG Credits Manager.","sWG/#echo(__FILEPATH__)# _a=delete_ (#echo(__LINE__)#)"); }
	//j// EOA
	}
	else { $direct_globals['output']->outputSendError ("login","core_access_denied","","sWG/#echo(__FILEPATH__)# _a=delete_ (#echo(__LINE__)#)"); }
	}
	else { $direct_globals['output']->outputSendError ("standard","core_service_inactive","","sWG/#echo(__FILEPATH__)# _a=delete_ (#echo(__LINE__)#)"); }
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// ($direct_settings['a'] == "new")||($direct_settings['a'] == "new-save")
case "new":
case "new-save":
case "reply":
{
	$g_mode_ajax_dialog = false;
	$g_mode_save = false;

	if ($direct_settings['a'] == "new-save")
	{
		if ($direct_settings['ohandler'] == "ajax_dialog") { $g_mode_ajax_dialog = true; }
		$g_mode_save = true;
	}

	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }

	$g_reply_message_id = (isset ($direct_settings['dsd']['amid']) ? ($direct_globals['basic_functions']->inputfilterBasic ($direct_settings['dsd']['amid'])) : "");
	$g_source = (isset ($direct_settings['dsd']['source']) ? ($direct_globals['basic_functions']->inputfilterBasic ($direct_settings['dsd']['source'])) : "");
	$g_target = (isset ($direct_settings['dsd']['target']) ? ($direct_globals['basic_functions']->inputfilterBasic ($direct_settings['dsd']['target'])) : "");

	$g_mid_dsd = (strlen ($g_reply_message_id) ? "amid+{$g_reply_message_id}++" : "");
	$g_source_url = ($g_source ? base64_decode ($g_source) : "m=account;s=pms;a=box;dsd=[oid]");

	if ($g_target) { $g_target_url = base64_decode ($g_target); }
	else
	{
		$g_target = $g_source;
		$g_target_url = $g_source_url;
	}

	if ($g_mode_save)
	{
		$direct_cachedata['page_this'] = "";
		$direct_cachedata['page_backlink'] = "m=account;s=pms_control;a=new;dsd={$g_mid_dsd}source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
		$direct_cachedata['page_homelink'] = str_replace ("[oid]","abox+in++",$g_source_url);
	}
	else
	{
		$direct_cachedata['page_this'] = "m=account;s=pms_control;a=new;dsd={$g_mid_dsd}source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
		$direct_cachedata['page_backlink'] = str_replace ("[oid]","abox+in++",$g_source_url);
		$direct_cachedata['page_homelink'] = $direct_cachedata['page_backlink'] ;
	}

	if ($direct_globals['kernel']->serviceInitDefault ())
	{
	if ($direct_settings['account_pms'])
	{
	if ($direct_globals['kernel']->vUsertypeGetInt ($direct_settings['user']['type']))
	{
	//j// BOA
	$g_mode = ($g_mode_ajax_dialog ? "_ajax" : "");

	if ($g_mode_save) { $direct_globals['output']->relatedManager ("account_pms_control_new_form_save","pre_module_service_action".$g_mode); }
	else
	{
		$direct_globals['output']->relatedManager ("account_pms_control_new_form","pre_module_service_action".$g_mode);
		$direct_globals['kernel']->serviceHttps ($direct_settings['account_pms_https_new'],$direct_cachedata['page_this']);
	}

	$direct_globals['basic_functions']->settingsGet ($direct_settings['path_data']."/settings/swg_account_pms.php",true);
	$direct_globals['basic_functions']->requireClass ('dNG\sWG\dhandler\directPMSBox');
	direct_local_integration ("account_pms");

	$direct_globals['output']->servicemenu ("account_pms");
	$direct_globals['output']->optionsInsert (2,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

	$g_datalinker_object = new directDataLinkerUHome ();

	if ($g_datalinker_object)
	{
		$g_boxes_array = $g_datalinker_object->getSubs ("directPMSBox","u-".$direct_settings['user']['id'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba",2,0,1,"position-asc");
		// md5 ("account_pms")
		$g_continue_check = true;
		$g_messages = 0;

		if ((is_array ($g_boxes_array))&&(!empty ($g_boxes_array)))
		{
			reset ($g_boxes_array);
			$g_box_object = current ($g_boxes_array);

			if ($g_box_object)
			{
				$g_box_array = $g_box_object->get ();
				$g_box_out_id = $g_box_array['ddbdatalinker_id'];
			}
			else { $g_continue_check = false; }
		}
		else
		{
			$g_box_out_id = uniqid ("");
			$g_box_object = new directPMSBox ();

			if ($g_box_object)
			{
$g_insert_array = array (
"ddbdatalinker_id" => $g_box_out_id,
"ddbdatalinker_id_parent" => "u-".$direct_settings['user']['id'],
"ddbdatalinker_id_main" => "u-".$direct_settings['user']['id'],
"ddbdatalinker_sid" => "c0a38f7c90c17551fb03dbd2d80f0aba",
"ddbdatalinker_type" => 2,
"ddbdatalinker_position" => 0,
"ddbdatalinker_subs" => 0,
"ddbdatalinker_objects" => 0,
"ddbdatalinker_sorting_date" => $direct_cachedata['core_time'],
"ddbdatalinker_symbol" => "",
"ddbdatalinker_title" => ""
);

				$g_continue_check = $g_box_object->setInsert ($g_insert_array);
			}
			else { $g_continue_check = false; }
		}

		if (($g_continue_check)&&($direct_globals['kernel']->vUsertypeGetInt ($direct_settings['user']['type']) == 1))
		{
			$g_messages = $g_box_object->getMessagesSinceDate (3,0,0,1,"",true,true);
			if ($g_messages >= $direct_settings['account_pms_messages_max']) { $g_continue_check = false; }
		}
	}
	else { $g_continue_check = false; }

	if ($g_continue_check)
	{
		$direct_globals['basic_functions']->requireClass ('dNG\sWG\directFormbuilder');
		$direct_globals['basic_functions']->requireFile ($direct_settings['path_system']."/functions/swg_credits_manager.php");
		$direct_globals['basic_functions']->requireFile ($direct_settings['path_system']."/functions/swg_tmp_storager.php");

		if (($g_reply_message_id)||($g_mode_save)) { $direct_globals['basic_functions']->requireClass ('dNG\sWG\directFormtags'); }
		if ($g_mode_save) { $direct_globals['basic_functions']->requireClass ('dNG\sWG\directSendmailerFormtags'); }

		direct_class_init ("formbuilder");
		if (($g_reply_message_id)||($g_mode_save)) { direct_class_init ("formtags"); }

		if ($g_reply_message_id)
		{
			$g_message_object = new directPMSMessage ();
			$g_message_array = ($g_message_object ? $g_message_object->get ($g_reply_message_id) : NULL);
			if (!is_array ($g_message_array)) { $g_reply_message_id = ""; }
		}

		$g_credits_periodically = 0;
		direct_credits_payment_get_specials ("account_pms_new","",$direct_settings['account_pms_new_credits_onetime'],$g_credits_periodically);
		$direct_cachedata['output_credits_information'] = direct_credits_payment_info ($direct_settings['account_pms_new_credits_onetime'],0);
		$direct_cachedata['output_credits_payment_data'] = direct_credits_payment_check (true,$direct_settings['account_pms_new_credits_onetime']);

		if ($g_mode_save)
		{
/* -------------------------------------------------------------------------
We should have input in save mode
------------------------------------------------------------------------- */

			$direct_cachedata['i_ato'] = (isset ($GLOBALS['i_ato']) ? (urlencode ($GLOBALS['i_ato'])) : "");
			$direct_cachedata['i_atitle'] = (isset ($GLOBALS['i_atitle']) ? ($direct_globals['basic_functions']->inputfilterBasic ($GLOBALS['i_atitle'])) : "");
			$direct_cachedata['i_amessage'] = (isset ($GLOBALS['i_amessage']) ? ($direct_globals['basic_functions']->inputfilterBasic ($GLOBALS['i_amessage'])) : "");

			$direct_cachedata['i_asaveout'] = (isset ($GLOBALS['i_asaveout']) ? (str_replace ("'","",$GLOBALS['i_asaveout'])) : "");
			$direct_cachedata['i_asaveout'] = str_replace ("<value value='$direct_cachedata[i_asaveout]' />","<value value='$direct_cachedata[i_asaveout]' /><selected value='1' />","<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>");
		}
		else
		{
			$direct_cachedata['i_ato'] = uniqid ("");
			$g_recipients_max = (($direct_globals['kernel']->vUsertypeGetInt ($direct_settings['user']['type']) > 1) ? $direct_settings['account_pms_recipients_max_internal'] : $direct_settings['account_pms_recipients_max']);

$g_task_array = array (
"core_back_return" => $direct_cachedata['page_this'],
"core_sid" => "e268443e43d93dab7ebef303bbe9642f",
// md5 ("account")
"account_selection_done" => 0,
"account_selection_quantity" => $g_recipients_max,
"uuid" => $direct_settings['uuid']
);

			if (($g_reply_message_id)&&($g_message_array['ddbdatalinker_type'] == 4)&&(strlen ($g_message_array['ddbpms_from_id']))) { $g_task_array['account_users_marked'] = array ($g_message_array['ddbpms_from_id'] => $g_message_array['ddbpms_from_id']); }

			direct_tmp_storage_write ($g_task_array,$direct_cachedata['i_ato'],"e268443e43d93dab7ebef303bbe9642f","task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 900));
			// md5 ("account")

			if ($g_reply_message_id)
			{
				$direct_cachedata['i_atitle'] = "Re: ".(preg_replace ("#^((Re\: )+)#i","",$g_message_array['ddbdatalinker_title']));
				$direct_cachedata['i_amessage'] = preg_replace ("#\[quote(.*?)\](.*?)\[\/quote\](\[newline\]|)#i","",$g_message_array['ddbdata_data']);

				$direct_cachedata['i_amessage'] = ((($g_message_array['ddbdatalinker_type'] == 4)&&(strlen ($g_message_array['ddbpms_from_id']))) ? "[quote:{$g_message_array['ddbpms_from_id']}:{$g_message_array['ddbusers_name']}]{$direct_cachedata['i_amessage']}[/quote]" : "[quote]{$direct_cachedata['i_amessage']}[/quote]");
				$direct_cachedata['i_amessage'] = $direct_globals['output']->smileyCleanup ($direct_cachedata['i_amessage']);
				$direct_cachedata['i_amessage'] = (($direct_globals['formtags']->recodeNewlines ($direct_cachedata['i_amessage'],false))."\n");
			}
			else
			{
				$direct_cachedata['i_atitle'] = "";
				$direct_cachedata['i_amessage'] = "";
			}

			$direct_cachedata['i_asaveout'] = "<evars><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>";
		}

/* -------------------------------------------------------------------------
Build the form
------------------------------------------------------------------------- */

		$g_helper_text = (($direct_globals['kernel']->vUsertypeGetInt ($direct_settings['user']['type']) > 1) ? (direct_local_get ("account_pms_helper_to_1")).$direct_settings['account_pms_recipients_max_internal'].(direct_local_get ("account_pms_helper_to_2")) : (direct_local_get ("account_pms_helper_to_1")).$direct_settings['account_pms_recipients_max'].(direct_local_get ("account_pms_helper_to_2")));
		$direct_globals['formbuilder']->entryAddEmbed (array ("name" => "ato","title" => (direct_local_get ("account_pms_to")),"size" => "s","helper_text" => $g_helper_text),"m=account;s=selector;dsd=");
		$direct_globals['formbuilder']->entryAddText (array ("name" => "atitle","title" => (direct_local_get ("account_pms_title")),"required" => true,"size" => "s","min" => $direct_settings['account_pms_title_min'],"max" => $direct_settings['account_pms_title_max']));

		if ($direct_settings['formtags_overview_document_url']) { $direct_globals['formbuilder']->entryAddRcpTextarea (array ("name" => "amessage","title" => (direct_local_get ("core_text")),"required" => true,"size" => "l","min" => $direct_settings['account_pms_message_min'],"max" => $direct_settings['swg_data_limit'],"helper_text" => (direct_local_get ("formtags_overview_document")),"helper_url" => (direct_linker ("url0",$direct_settings['formtags_overview_document_url'])))); }
		else { $direct_globals['formbuilder']->entryAddRcpTextarea (array ("name" => "amessage","title" => (direct_local_get ("core_text")),"required" => true,"size" => "l","min" => $direct_settings['account_pms_message_min'],"max" => $direct_settings['swg_data_limit'])); }

		$direct_globals['formbuilder']->entryAdd ("spacer");
		$direct_globals['formbuilder']->entryAddRadio (array ("name" => "asaveout","title" => (direct_local_get ("account_pms_new_saveout")),"required" => true));

		$direct_cachedata['output_formelements'] = $direct_globals['formbuilder']->formGet ($g_mode_save);

		if (($g_mode_save)&&($direct_globals['formbuilder']->check_result))
		{
/* -------------------------------------------------------------------------
Save data edited
------------------------------------------------------------------------- */

			$direct_cachedata['i_amessage'] = $direct_globals['formtags']->encode ($direct_cachedata['i_amessage']);
			$direct_cachedata['i_amessage'] = $direct_globals['output']->smileyEncode ($direct_cachedata['i_amessage']);

			if (!direct_credits_payment_check (false,$direct_settings['account_pms_new_credits_onetime'])) { $g_continue_check = false; }

			if ($g_continue_check)
			{
				$g_task_array = direct_tmp_storage_get ("evars",$direct_cachedata['i_ato'],"","task_cache");
				$g_continue_check = false;

				if ((is_array ($g_task_array['account_users_marked']))&&(!empty ($g_task_array['account_users_marked']))) { $g_continue_check = true; }
				else { $direct_globals['output']->outputSendError ("standard","core_username_unknown","","sWG/#echo(__FILEPATH__)# _a=new-save_ (#echo(__LINE__)#)"); }
			}
			else { $direct_globals['output']->outputSendError ("standard","core_credits_insufficient","SERVICE ERROR:<br />".(-1 * $direct_settings['account_pms_new_credits_onetime'])." Credits are required but not available. This error has been reported by the sWG Credits Manager.","sWG/#echo(__FILEPATH__)# _a=new-save_ (#echo(__LINE__)#)"); }

			if ($g_continue_check)
			{
/* -------------------------------------------------------------------------
Deliver messages
------------------------------------------------------------------------- */

				$direct_globals['db']->vTransactionBegin ();

				$g_daemon_object = ($direct_settings['swg_pyhelper'] ? new directPyHelper () : NULL);
				$g_limit_check = (($direct_globals['kernel']->vUsertypeGetInt ($direct_settings['user']['type']) > 1) ? false : true);
				$g_message_id = "";
				$g_messages_failed = 0;
				$g_messages_sent = 0;
				if (!isset ($g_message_object)) { $g_message_object = new directPMSMessage (); }
				$g_recipient_message_id = "";
				$g_results_array = array ();
				$g_sender_message_id = "";
				$g_sendmailer_message = trim ($direct_globals['output']->smileyCleanup ($direct_cachedata['i_amessage']));

				foreach ($g_task_array['account_users_marked'] as $g_recipient_uid)
				{
					$g_recipient_array = $direct_globals['kernel']->vUserGet ($g_recipient_uid,"",true);
					$g_result_array = array ("entries" => array ());

					if ($g_recipient_array)
					{
						if (!$g_message_id) { $g_message_id = uniqid (""); }
						$g_result_array['name'] = direct_html_encode_special ($g_recipient_array['ddbusers_name']);

						if ($direct_cachedata['i_asaveout'])
						{
							$g_continue_check = false;
							$g_messages++;

							if ((!$g_limit_check)||($g_messages <= $direct_settings['account_pms_messages_max']))
							{
								if ($g_sender_message_id) { $g_sender_message_id = uniqid (""); }
								else
								{
									$g_sender_message_id = $g_message_id;
									$g_recipient_message_id = $g_message_id;
								}

$g_insert_array = array (
"ddbdatalinker_id" => $g_sender_message_id,
"ddbdatalinker_id_object" => $g_message_id,
"ddbdatalinker_id_main" => $g_box_out_id,
"ddbdatalinker_sid" => "c0a38f7c90c17551fb03dbd2d80f0aba",
"ddbdatalinker_type" => 5,
"ddbdatalinker_position" => 0,
"ddbdatalinker_subs" => 0,
"ddbdatalinker_objects" => 0,
"ddbdatalinker_sorting_date" => $direct_cachedata['core_time'],
"ddbdatalinker_symbol" => "",
"ddbdatalinker_title" => $direct_cachedata['i_atitle'],
"ddbpms_from_id" => $direct_settings['user']['id'],
"ddbpms_from_ip" => $direct_settings['user_ip'],
"ddbpms_to_id" => $g_recipient_uid,
"ddbdata_data" => $direct_cachedata['i_amessage']
);

								$g_insert_array['ddbdatalinker_id_parent'] = ($g_reply_message_id ? $g_reply_message_id : "");

								if ($g_message_object->setInsert ($g_insert_array)) { $g_continue_check = true; }
								else
								{
									$g_messages_failed++;
									$g_result_array['entries'][] = array ("identifier" => direct_local_get ("account_pms_box_out"),"status" => "error","details" => direct_local_get ("account_pms_sent_mailbox_error"));
								}
							}
							else
							{
								$g_messages_failed++;
								$g_result_array['entries'][] = array ("identifier" => direct_local_get ("account_pms_box_out"),"status" => "error","details" => direct_local_get ("account_pms_outbox_full"));
							}
						}
						else { $g_continue_check = true; }
					}
					else
					{
						$g_continue_check = false;
						$g_messages_failed++;
						$g_results_array[] = array ("identifier" => "id:".$g_recipient_uid,"status" => "error","details" => direct_local_get ("account_pms_sent_mailbox_error"));
					}

					if ($g_continue_check)
					{
						if ((!$direct_settings['account_mods_profile_pms_via_email'])||($g_recipient_array['ddbusers_pms_via_email'] != 1))
						{
							$g_recipient_message_id = ($g_recipient_message_id ? uniqid ("") : $g_message_id);

$g_insert_array = array (
"ddbdatalinker_id" => $g_recipient_message_id,
"ddbdatalinker_id_object" => $g_message_id,
"ddbdatalinker_id_main" => NULL,
"ddbdatalinker_sid" => "c0a38f7c90c17551fb03dbd2d80f0aba",
"ddbdatalinker_type" => 4,
"ddbdatalinker_position" => 1,
"ddbdatalinker_subs" => 0,
"ddbdatalinker_objects" => 0,
"ddbdatalinker_sorting_date" => $direct_cachedata['core_time'],
"ddbdatalinker_symbol" => "",
"ddbdatalinker_title" => $direct_cachedata['i_atitle'],
"ddbpms_from_id" => $direct_settings['user']['id'],
"ddbpms_from_ip" => $direct_settings['user_ip'],
"ddbpms_to_id" => $g_recipient_uid,
"ddbdata_data" => $direct_cachedata['i_amessage'],
"box" => "in"
);

							$g_insert_array['ddbdatalinker_id_parent'] = ($g_reply_message_id ? $g_reply_message_id : "");

							if ($g_message_object->setInsert ($g_insert_array))
							{
								$g_insert_array = $g_message_object->get ();
								$g_recipient_box_object = new directPMSBox ();
								if (($g_insert_array)&&($g_insert_array['ddbdatalinker_id_main'])&&($g_recipient_box_object->get ($g_insert_array['ddbdatalinker_id_main']))) { $g_recipient_box_object->addMessages (1); }

								if (empty ($g_result_array['entries'])) { $g_results_array[] = array ("identifier" => direct_html_encode_special ($g_recipient_array['ddbusers_name']),"status" => "completed","details" => direct_local_get ("account_pms_sent_successfully")); }
								else { $g_result_array['entries'][] = array ("status" => "completed","details" => direct_local_get ("account_pms_sent_successfully")); }
							}
							else
							{
								$g_messages_failed++;

								if (empty ($g_result_array['entries'])) { $g_results_array[] = array ("identifier" => direct_html_encode_special ($g_recipient_array['ddbusers_name']),"status" => "error","details" => direct_local_get ("account_pms_sent_mailbox_error")); }
								else { $g_result_array['entries'][] = array ("status" => "error","details" => direct_local_get ("account_pms_sent_mailbox_error")); }
							}
						}
						else
						{
							$g_user_array = $direct_globals['kernel']->vUserGet ($direct_settings['user']['id']);
							$g_sender = ($g_user_array['ddbusers_email_public'] ? $direct_settings['user']['name']." ({$g_user_array['ddbusers_email']})" : $direct_settings['user']['name']);

$g_message = ("[contentform:highlight]".(direct_local_get ("core_message_by_request","text"))."

[font:bold]".(direct_local_get ("core_message_to","text")).":[/font] {$g_recipient_array['ddbusers_name']} ({$g_recipient_array['ddbusers_email']})
[font:bold]".(direct_local_get ("core_message_from","text")).":[/font] {$g_sender}[/contentform]

".(direct_local_get ("account_pms_message_via_email","text"))."

".(direct_local_get ("account_pms_sender_name","text")).": {$direct_settings['user']['name']}
".(direct_local_get ("account_pms_sender_id","text")).": {$direct_settings['user']['id']}

[contentform:highlight][font:bold]".(direct_local_get ("account_pms_title","text")).":[/font] {$direct_cachedata['i_atitle']}[/contentform]

$g_sendmailer_message

[hr]

".(direct_local_get ("account_pms_email_only","text")));

							if (($g_daemon_object)&&($g_daemon_object->resourceCheck ()))
							{
$g_entry_array = array (
"id" => uniqid (""),
"name" => "de.direct_netware.sWG.plugins.sendmail",
"identifier" => $g_recipient_array['ddbusers_email'],
"data" => direct_evars_write (array (
 "core_lang" => $g_recipient_array['ddbusers_lang'],
 "account_sendmail_message" => $g_message,
 "account_sendmail_recipient_email" => $g_recipient_array['ddbusers_email'],
 "account_sendmail_recipient_name" => $g_recipient_array['ddbusers_name'],
 "account_sendmail_title" => direct_local_get ("account_pms_title_message_via_email","text")
 ))
);

								$g_continue_check = $g_daemon_object->request ("de.direct_netware.psd.plugins.queue.addEntry",(array ($g_entry_array)));
							}
							else
							{
								$g_sendmailer_object = new directSendmailerFormtags ();
								$g_sendmailer_object->messageSet ($g_message);
								$g_sendmailer_object->recipientsDefine (array ($g_recipient_array['ddbusers_email'] => $g_recipient_array['ddbusers_name']));

								$g_continue_check = $g_sendmailer_object->send ("single",$direct_settings['administration_email_out'],$direct_settings['swg_title_txt']." - ".(direct_local_get ("account_pms_title_message_via_email","text")));
								$g_sendmailer_object = NULL;
							}

							if ($g_continue_check)
							{
								if (empty ($g_result_array['entries'])) { $g_results_array[] = array ("identifier" => direct_html_encode_special ($g_recipient_array['ddbusers_name']),"status" => "completed","details" => direct_local_get ("account_pms_sent_successfully")); }
								else { $g_result_array['entries'][] = array ("status" => "completed","details" => direct_local_get ("account_pms_sent_successfully")); }
							}
							else
							{
								$g_messages_failed++;

								if (empty ($g_result_array['entries'])) { $g_results_array[] = array ("identifier" => direct_html_encode_special ($g_recipient_array['ddbusers_name']),"status" => "error","details" => direct_local_get ("account_pms_sent_mailbox_error")); }
								else { $g_result_array['entries'][] = array ("status" => "error","details" => direct_local_get ("account_pms_sent_mailbox_error")); }
							}
						}
					}

					if ($g_continue_check) { $g_messages_sent++; }
					if (!empty ($g_result_array['entries'])) { $g_results_array[] = $g_result_array; }
				}

				if (($g_messages_sent)&&($g_box_object->addMessages ($g_messages_sent))&&($direct_globals['db']->vTransactionCommit ()))
				{
					direct_credits_payment_exec ("account","pms_new",$g_message_id,$direct_settings['user']['id'],$direct_settings['account_pms_new_credits_onetime']);

					$g_task_array = array ("core_done_title" => direct_local_get ("account_pms_new"),"core_done_description" => direct_local_get ("account_pms_done_new"),"core_done_report" => $g_results_array,"uuid" => $direct_settings['uuid']);
					direct_tmp_storage_write ($g_task_array,$direct_cachedata['i_ato'],"c0a38f7c90c17551fb03dbd2d80f0aba","task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));

					$g_target_url = urlencode (base64_encode (str_replace ("[oid]","abox_d+$g_box_out_id++",$g_target_url)));
					$direct_globals['output']->redirect (direct_linker ("url1","s=task;a=done;dsd=tid+{$direct_cachedata['i_ato']}++target+".$g_target_url,false));
				}
				else
				{
					$direct_globals['db']->vTransactionRollback ();
					$direct_globals['output']->outputSendError ("standard","account_pms_send_all_failed","","sWG/#echo(__FILEPATH__)# _a=new-save_ (#echo(__LINE__)#)");
				}
			}
		}
		elseif ($g_mode_ajax_dialog)
		{
			$direct_globals['output']->header (false,true);
			$direct_globals['output']->relatedManager ("account_pms_control_new_form_save","post_module_service_action".$g_mode);
			$direct_globals['output']->oset ("default","form_results");
			$direct_globals['output']->outputSend (direct_local_get ("formbuilder_error"));
		}
		else
		{
/* -------------------------------------------------------------------------
View form
------------------------------------------------------------------------- */

			$direct_cachedata['output_formbutton'] = direct_local_get ("core_save");
			$direct_cachedata['output_formsupport_ajax_dialog'] = true;
			$direct_cachedata['output_formtarget'] = "m=account;s=pms_control;a=new-save;dsd={$g_mid_dsd}source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
			$direct_cachedata['output_formtitle'] = direct_local_get ("account_pms_new");

			$direct_globals['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
			$direct_globals['output']->relatedManager ("account_pms_control_new_form","post_module_service_action".$g_mode);
			$direct_globals['output']->oset ("default","form");
			$direct_globals['output']->outputSend ($direct_cachedata['output_formtitle']);
		}
	}
	else { $direct_globals['output']->outputSendError ("standard","account_pms_outbox_full","","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	//j// EOA
	}
	else { $direct_globals['output']->outputSendError ("login","core_access_denied","","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	}
	else { $direct_globals['output']->outputSendError ("standard","core_service_inactive","","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// EOS
}

//j// EOF
?>