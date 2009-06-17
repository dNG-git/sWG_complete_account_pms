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
$Id: swg_account_pms_message.php,v 1.9 2009/05/05 13:57:34 s4u Exp $
#echo(sWGaccountPmsVersion)#
sWG/#echo(__FILEPATH__)#
----------------------------------------------------------------------------
NOTE_END //n*/
/**
* OOP (Object Oriented Programming) requires an abstract data
* handling. The sWG is OO (where it makes sense).
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
Testing for required classes
------------------------------------------------------------------------- */

$g_continue_check = true;
if (defined ("CLASS_direct_account_pms_message")) { $g_continue_check = false; }
if (!defined ("CLASS_direct_datalinker")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_datalinker.php"); }
if (!defined ("CLASS_direct_datalinker")) { $g_continue_check = false; }

if ($g_continue_check)
{
//c// direct_account_pms_message
/**
* This abstraction layer provides PMS message (account) specific functions.
* The Private Messaging Service is designed to provide access to a message
* to the recipient (and the sender) only. There is no
* "is_readable ()" function theirfore. If the access is not granted
* "get"-functions will always result in "false".
*
* @author     direct Netware Group
* @copyright  (C) direct Netware Group - All rights reserved
* @package    sWG
* @subpackage account_pms
* @uses       CLASS_direct_datalinker
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/
class direct_account_pms_message extends direct_datalinker
{
/**
	* @var string $data_bid Box ID to be used
*/
	protected $data_bid;

/* -------------------------------------------------------------------------
Extend the class
------------------------------------------------------------------------- */

	//f// direct_account_pms_message->__construct ()
/**
	* Constructor (PHP5) __construct (direct_account_pms_message)
	*
	* @param mixed $f_data String containing the allowed box ID or an array
	*        with options
	* @uses  USE_debug_reporting
	* @since v0.1.00
*/
	public function __construct ($f_data = "")
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_message->__construct (direct_account_pms_message)- (#echo(__LINE__)#)"); }

		if (!defined ("CLASS_direct_formtags")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/swg_formtags.php"); }
		if (!isset ($direct_classes['formtags'])) { direct_class_init ("formtags"); }
		if (!defined ("CLASS_direct_account_pms_box")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_account_pms_box.php"); }
		if (!defined ("CLASS_direct_datalinker_uhome")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_datalinker_uhome.php"); }

/* -------------------------------------------------------------------------
My parent should be on my side to get the work done
------------------------------------------------------------------------- */

		parent::__construct ();

/* -------------------------------------------------------------------------
Informing the system about available functions 
------------------------------------------------------------------------- */

		$this->functions['define_bid'] = true;
		$this->functions['define_read'] = true;
		$this->functions['parse'] = isset ($direct_classes['formtags']);
		if ((!defined ("CLASS_direct_account_pms_box"))||(!defined ("CLASS_direct_datalinker_uhome"))) { $this->functions['set'] = false; }

/* -------------------------------------------------------------------------
Set up an additional post class element :)
------------------------------------------------------------------------- */

		$this->data_bid = "";
		$this->data_sid = "c0a38f7c90c17551fb03dbd2d80f0aba";

		if (is_string ($f_data)) { $this->data_bid = $f_data; }
		else
		{
			if (isset ($f_data['bid'])) { $this->data_bid = $f_data['bid']; }
		}
	}

	//f// direct_account_pms_message->define_bid ($f_bid)
/**
	* Sets the box ID of this message.
	*
	* @param  string $f_bid Box ID to use
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return string Accepted box ID
	* @since  v0.1.00
*/
	public function define_bid ($f_bid)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_message->define_bid (+f_bid)- (#echo(__LINE__)#)"); }

		if (is_string ($f_bid)) { $this->data_bid = $f_bid; }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->define_bid ()- (#echo(__LINE__)#)",:#*/$this->data_bid/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_message->define_read ($f_state = NULL,$f_update = false)
/**
	* Sets the read state of this message.
	*
	* @param  mixed $f_state Boolean indicating the state or NULL to switch
	*         automatically
	* @param  boolean $f_update True to update the database entry
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean Accepted state
	* @since  v0.1.00
*/
	public function define_read ($f_state = NULL,$f_update = false)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_message->define_read (+f_state,+f_update)- (#echo(__LINE__)#)"); }
		$f_return = false;

		if (count ($this->data) > 1)
		{
			if (((is_bool ($f_state))||(is_string ($f_state)))&&($f_state)) { $f_return = true; }
			elseif (($f_state === NULL)&&($this->data['ddbdatalinker_position'])) { $f_return = true; }

			if ($f_return) { $this->data['ddbdatalinker_position'] = 0; }
			else { $this->data['ddbdatalinker_position'] = 1; }

			$this->data_changed['ddbdatalinker_position'] = true;
			if ($f_update) { parent::update (false,true); }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->define_read ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_message->delete ()
/**
	* Deletes the message and data entry (if not another PM is still using
	* it).
	*
	* @uses   direct_db::define_attributes()
	* @uses   direct_db::define_limit()
	* @uses   direct_db::define_row_conditions()
	* @uses   direct_db::define_row_conditions_encode()
	* @uses   direct_db::init_delete()
	* @uses   direct_db::init_select()
	* @uses   direct_db::query_exec()
	* @uses   direct_db::v_optimize()
	* @uses   direct_db::v_transaction_begin()
	* @uses   direct_db::v_transaction_commit()
	* @uses   direct_db::v_transaction_rollback()
	* @uses   direct_dbsync_event()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function delete ()
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_message->delete ()- (#echo(__LINE__)#)"); }

		$direct_classes['db']->v_transaction_begin ();
		$f_return = parent::delete (true,false);

		if (($f_return)&&(isset ($this->data['ddbdatalinker_id_object'])))
		{
			$direct_classes['db']->init_delete ($direct_settings['users_pms_table']);

			$f_delete_criteria = "<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['users_pms_table'].".ddbpms_id",$this->data['ddbdatalinker_id'],"string"))."</sqlconditions>";
			$direct_classes['db']->define_row_conditions ($f_delete_criteria);

			if ($direct_classes['db']->query_exec ("ar"))
			{
				if (function_exists ("direct_dbsync_event")) { direct_dbsync_event ($direct_settings['users_pms_table'],"delete",$f_delete_criteria); }
				if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->v_optimize ($direct_settings['users_pms_table']); }

				$direct_classes['db']->init_select ($direct_settings['datalinker_table']);

				$direct_classes['db']->define_attributes (array ("count-rows({$direct_settings['datalinker_table']}.ddbdatalinker_id)"));
				$direct_classes['db']->define_row_conditions ("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinker_table'].".ddbdatalinker_id_object",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>");

				$direct_classes['db']->define_limit (1);
				$f_used_count = $direct_classes['db']->query_exec ("ss");

				if (is_bool ($f_used_count)) { $f_return = false; }
				elseif ($f_used_count < 1)
				{
					$direct_classes['db']->init_delete ($direct_settings['data_table']);

					$f_delete_criteria = "<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['data_table'].".ddbdata_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>";
					$direct_classes['db']->define_row_conditions ($f_delete_criteria);

					$f_return = $direct_classes['db']->query_exec ("ar");

					if ($f_return)
					{
						if (function_exists ("direct_dbsync_event")) { direct_dbsync_event ($direct_settings['data_table'],"delete",$f_delete_criteria); }
						if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->v_optimize ($direct_settings['data_table']); }

						$direct_classes['db']->init_delete ($direct_settings['datalinkerd_table']);

						$f_delete_criteria = "<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinkerd_table'].".ddbdatalinkerd_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>";
						$direct_classes['db']->define_row_conditions ($f_delete_criteria);

						$f_return = $direct_classes['db']->query_exec ("ar");
					}

					if ($f_return)
					{
						if (function_exists ("direct_dbsync_event")) { direct_dbsync_event ($direct_settings['datalinkerd_table'],"delete",$f_delete_criteria); }
						if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->v_optimize ($direct_settings['datalinkerd_table']); }
					}
					
				}
				else { $f_return = true; }
			}
		}

		if ($f_return)
		{
			$this->data = array ();
			$this->data_bid = "";

			$direct_classes['db']->v_transaction_commit ();
		}
		else { $direct_classes['db']->v_transaction_rollback (); }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->delete ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_message->get ($f_mid = "",$f_content = true,$f_load = true)
/**
	* Reads the message data with the given ID.
	*
	* @param  string $f_mid PMS message ID
	* @param  boolean $f_content True to read the PM content as well
	* @param  boolean $f_load Load DataLinker data from the database
	* @uses   direct_account_pms_message::get_aid()
	* @uses   USE_debug_reporting
	* @return mixed Message data array; false on error
	* @since  v0.1.00
*/
	public function get ($f_mid = "",$f_content = true,$f_load = true)
	{
		if (USE_debug_reporting) { direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->get ($f_mid,+f_content,+f_load)- (#echo(__LINE__)#)"); }
		$f_return = false;

		if (($f_content)||($f_load)) { $f_return = $this->get_aid (NULL,$f_mid,$f_content); }
		else { $f_return = parent::get ($f_mid,false); }

		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -account_pms_message->get ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_message->get_aid ($f_attributes = NULL,$f_values = "",$f_content = true)
/**
	* Request and load the message data based on a custom attribute ID. Please
	* note that only attributes of type "string" are supported.
	*
	* @param  mixed $f_attributes Attribute name(s) (array or string)
	* @param  mixed $f_values Attribute value(s) (array or string)
	* @param  boolean $f_content True to read the PM content as well
	* @uses   direct_account_pms_message::get_rights()
	* @uses   direct_datalinker::define_extra_attributes()
	* @uses   direct_datalinker::define_extra_conditions()
	* @uses   direct_datalinker::define_extra_joins()
	* @uses   direct_datalinker::get_aid()
	* @uses   direct_db::define_row_conditions_encode()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return mixed Message data array; false on error
	* @since  v0.1.00
*/
	public function get_aid ($f_attributes = NULL,$f_values = "",$f_content = true)
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -account_pms_message->get_aid (+f_attributes,+f_values,+f_content)- (#echo(__LINE__)#)"); }

		$f_return = false;

		if (count ($this->data) > 1) { $f_return = $this->data; }
		elseif ((is_array ($f_values))||(is_string ($f_values)))
		{
			$f_select_attributes = array ($direct_settings['users_pms_table'].".*",$direct_settings['data_table'].".ddbdata_sid",$direct_settings['data_table'].".ddbdata_mode_user",$direct_settings['data_table'].".ddbdata_mode_group",$direct_settings['data_table'].".ddbdata_mode_all",$direct_settings['users_table'].".ddbusers_type",$direct_settings['users_table'].".ddbusers_banned",$direct_settings['users_table'].".ddbusers_deleted",$direct_settings['users_table'].".ddbusers_name",$direct_settings['users_table'].".ddbusers_title",$direct_settings['users_table'].".ddbusers_avatar",$direct_settings['users_table'].".ddbusers_signature",$direct_settings['users_table'].".ddbusers_rating");
			if ($f_content) { $f_select_attributes[] = $direct_settings['data_table'].".ddbdata_data"; }
			$this->define_extra_attributes ($f_select_attributes);

$f_select_joins = array (
 array ("type" => "left-outer-join","table" => $direct_settings['users_pms_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['users_pms_table']}.ddbpms_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['data_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['data_table']}.ddbdata_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['users_table'],"condition" => "<sqlconditions>
  <sub1 type='sublevel' condition='or'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' /><element2 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['users_pms_table']}.ddbpms_from_id' type='attribute' /></sub1>
  <sub2 type='sublevel' condition='or'><element3 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' /><element4 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['users_pms_table']}.ddbpms_to_id' type='attribute' /></sub2>
  </sqlconditions>")
);

			$this->define_extra_joins ($f_select_joins);

			if (strlen ($this->data_bid)) { $this->define_extra_conditions ($direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinker_table'].".ddbdatalinker_id_main",$this->data_bid,"string")); }
			$f_result_array = parent::get_aid ($f_attributes,$f_values);

			if (($f_result_array)&&($f_result_array['ddbdatalinker_sid'] == $this->data_sid)&&(($f_result_array['ddbdatalinker_type'] == 4)||($f_result_array['ddbdatalinker_type'] == 5)))
			{
				$f_rights_check = false;
				$this->data = $f_result_array;

				if (($this->data['ddbdatalinker_type'] == 4)&&(strlen ($this->data['ddbpms_from_id']))&&(!isset ($this->data['ddbusers_type'],$this->data['ddbusers_banned'],$this->data['ddbusers_deleted'],$this->data['ddbusers_name'],$this->data['ddbusers_title'],$this->data['ddbusers_avatar'],$this->data['ddbusers_signature'],$this->data['ddbusers_rating'])))
				{
					$f_user_array = $direct_classes['kernel']->v_user_get ($this->data['ddbpms_to_id']);
					if ($f_user_array) { $this->data = array_merge ($this->data,$f_user_array); }
				}

				if (($this->data['ddbdatalinker_type'] == 5)&&(strlen ($this->data['ddbpms_to_id']))&&(!isset ($this->data['ddbusers_type'],$this->data['ddbusers_banned'],$this->data['ddbusers_deleted'],$this->data['ddbusers_name'],$this->data['ddbusers_title'],$this->data['ddbusers_avatar'],$this->data['ddbusers_signature'],$this->data['ddbusers_rating'])))
				{
					$f_user_array = $direct_classes['kernel']->v_user_get ($this->data['ddbpms_from_id']);
					if ($f_user_array) { $this->data = array_merge ($this->data,$f_user_array); }
				}

				if (($this->data['ddbdatalinker_type'] == 4)&&($this->data['ddbpms_to_id'] == $direct_settings['user']['id'])) { $f_rights_check = true; }
				if (($this->data['ddbdatalinker_type'] == 5)&&($this->data['ddbpms_from_id'] == $direct_settings['user']['id'])) { $f_rights_check = true; }

				if ($f_rights_check) { $f_return = $this->data; }
			}
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->get_aid ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_message->parse ($f_connector,$f_connector_type = "url0",$f_prefix = "")
/**
	* Parses this message and returns valid (X)HTML.
	*
	* @param  string $f_connector Connector for links
	* @param  string $f_connector_type Linking mode: "url0" for internal links,
	*         "url1" for external ones, "form" to create hidden fields or
	*         "optical" to remove parts of a very long string.
	* @param  string $f_prefix Key prefix
	* @uses   direct_basic_functions::datetime()
	* @uses   direct_datalinker::parse()
	* @uses   direct_debug()
	* @uses   direct_formtags::decode()
	* @uses   direct_kernel_system::v_user_parse()
	* @uses   direct_linker()
	* @uses   direct_local_get()
	* @uses   USE_debug_reporting
	* @return array Output data
	* @since  v0.1.00
*/
	public function parse ($f_connector,$f_connector_type = "url0",$f_prefix = "")
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_message->parse ($f_connector,$f_connector_type,$f_prefix)- (#echo(__LINE__)#)"); }

		$f_return = parent::parse ($f_prefix);

		if (($f_return)&&(count ($this->data) > 1))
		{
			$f_return[$f_prefix."id"] = "swgdhandleraccountpmsmessage".$this->data['ddbdatalinker_id'];

			if ($this->data['ddbdatalinker_type'] == 4) { $f_return[$f_prefix."type"] = "in"; }
			else { $f_return[$f_prefix."type"] = "out"; }

			if (($f_connector_type != "asis")&&(strpos ($f_connector,"javascript:") === 0)) { $f_connector_type = "asis"; }

			$f_pageurl = str_replace ("[a]","view",$f_connector);

			if ($f_connector_type == "asis") { $f_pageurl = str_replace ("[oid]",$this->data['ddbdatalinker_id'],$f_pageurl); }
			else { $f_pageurl = str_replace ("[oid]","amid+{$this->data['ddbdatalinker_id']}++",$f_pageurl); }

			$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
			$f_return[$f_prefix."pageurl"] = direct_linker ($f_connector_type,$f_pageurl);

			$f_pageurl = str_replace ("[a]","box",$f_connector);

			if ($f_connector_type == "asis") { $f_pageurl = str_replace ("[oid]",$this->data['ddbdatalinker_id_main'],$f_pageurl); }
			else { $f_pageurl = str_replace ("[oid]","abox+{$this->data['ddbdatalinker_id_main']}++",$f_pageurl); }

			$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
			$f_return[$f_prefix."pageurl_box"] = direct_linker ($f_connector_type,$f_pageurl);

			if (($f_return[$f_prefix."type"] == "out")&&($this->data['ddbpms_to_id'])&&($this->data['ddbusers_name'])) { $f_user_parsed_array = $direct_classes['kernel']->v_user_parse ($this->data['ddbpms_to_id'],$this->data,$f_prefix."user"); }
			elseif (($this->data['ddbpms_from_id'])&&($this->data['ddbusers_name'])) { $f_user_parsed_array = $direct_classes['kernel']->v_user_parse ($this->data['ddbpms_from_id'],$this->data,$f_prefix."user"); }
			else
			{
$f_user_parsed_array = array (
$f_prefix."userid" => "",
$f_prefix."username" => "",
$f_prefix."userpageurl" => "",
$f_prefix."usertype" => direct_local_get ("core_unknown"),
$f_prefix."usertitle" => "",
$f_prefix."useravatar" => "",
$f_prefix."useravatar_small" => "",
$f_prefix."useravatar_large" => "",
$f_prefix."userrating" => direct_local_get ("core_unknown"),
$f_prefix."usersignature" => ""
);

				if (($f_return[$f_prefix."type"] == "out")&&($this->data['ddbpms_to_id'] == "")) { $f_user_parsed_array[$f_prefix."username"] = direct_local_get ("account_pms_multiple_recipients"); }
				elseif (($f_return[$f_prefix."type"] == "in")&&($this->data['ddbpms_from_id'] == "")) { $f_user_parsed_array[$f_prefix."username"] = direct_local_get ("account_pms_system_message"); }
				else { $f_user_parsed_array[$f_prefix."username"] = direct_local_get ("core_unknown"); }
			}

			$f_return = array_merge ($f_return,$f_user_parsed_array);

			if ($this->data['ddbdatalinker_sorting_date']) { $f_return[$f_prefix."time"] = $direct_classes['basic_functions']->datetime ("shortdate&time",$this->data['ddbdatalinker_sorting_date'],$direct_settings['user']['timezone'],(direct_local_get ("datetime_dtconnect"))); }
			else { $f_return[$f_prefix."time"] = direct_local_get ("core_unknown"); }

			if (isset ($this->data['ddbdata_data'])) { $f_return[$f_prefix."text"] = $direct_classes['formtags']->decode ($this->data['ddbdata_data']); }
			else { $f_return[$f_prefix."text"] = NULL; }

			if ($this->data['ddbdatalinker_position']) { $f_return[$f_prefix."read"] = false; }
			else { $f_return[$f_prefix."read"] = true; }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->parse ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_message->set ($f_data,$f_uid = "")
/**
	* Sets (and overwrites existing) data for this message.
	*
	* @param  array $f_data Message data
	* @param  string $f_uid Optional UID to check
	* @uses   direct_datalinker::set()
	* @uses   direct_datalinker::set_extras()
	* @uses   direct_datalinker::set_insert()
	* @uses   direct_datalinker_uhome::get_subs()
	* @uses   direct_debug()
	* @uses   direct_kernel_system::v_user_get()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function set ($f_data,$f_uid = "")
	{
		global $direct_cachedata,$direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -account_pms_message->set (+f_data,$f_uid)- (#echo(__LINE__)#)"); }

		if ((isset ($f_data['box']))&&(isset ($f_data['ddbdatalinker_type'])))
		{
			switch ($f_data['box'])
			{
			case "in":
			{
				if ($f_data['ddbdatalinker_id_main'] == NULL)
				{
					if ($f_data['ddbdatalinker_type'] == 4)
					{
						$f_datalinker_object = new direct_datalinker_uhome ();

						$f_result_array = $f_datalinker_object->get_subs ("direct_account_pms_box","u-".$f_data['ddbpms_to_id'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba",1,0,1,"position-asc");
						// md5 ("account_pms")

						if (($f_result_array)&&(!empty ($f_result_array))) { $f_data['ddbdatalinker_id_main'] = key ($f_result_array); }
						else
						{
							$f_box_id = uniqid ("");
							$f_datalinker_object = new direct_datalinker ();

							if ($f_datalinker_object)
							{
$f_insert_array = array (
"ddbdatalinker_id" => $f_box_id,
"ddbdatalinker_id_parent" => "u-".$f_data['ddbpms_to_id'],
"ddbdatalinker_id_main" => "u-".$f_data['ddbpms_to_id'],
"ddbdatalinker_sid" => "c0a38f7c90c17551fb03dbd2d80f0aba",
"ddbdatalinker_type" => 1,
"ddbdatalinker_position" => 0,
"ddbdatalinker_subs" => 0,
"ddbdatalinker_objects" => 0,
"ddbdatalinker_sorting_date" => $direct_cachedata['core_time'],
"ddbdatalinker_symbol" => "",
"ddbdatalinker_title" => ""
);

								if ($f_datalinker_object->set_insert ($f_insert_array)) { $f_data['ddbdatalinker_id_main'] = $f_box_id; }
							}
						}
					}

					if ($f_data['ddbdatalinker_id_main'] == NULL) { unset ($f_data['ddbdatalinker_id_main']); }
				}

				break 1;
			}
			case "out":
			{
				if ($f_data['ddbdatalinker_id_main'] == NULL)
				{
					if ($f_data['ddbdatalinker_type'] == 5)
					{
						$f_datalinker_object = new direct_datalinker_uhome ();

						$f_result_array = $f_datalinker_object->get_subs ("direct_account_pms_box","u-".$f_data['ddbpms_from_id'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba",2,0,1,"position-asc");
						// md5 ("account_pms")

						if (($f_result_array)&&(!empty ($f_result_array))) { $f_data['ddbdatalinker_id_main'] = key ($f_result_array); }
						else
						{
							$f_box_id = uniqid ("");
							$f_datalinker_object = new direct_datalinker ();

							if ($f_datalinker_object)
							{
$f_insert_array = array (
"ddbdatalinker_id" => $f_box_id,
"ddbdatalinker_id_parent" => "u-".$f_data['ddbpms_from_id'],
"ddbdatalinker_id_main" => "u-".$f_data['ddbpms_from_id'],
"ddbdatalinker_sid" => "c0a38f7c90c17551fb03dbd2d80f0aba",
"ddbdatalinker_type" => 2,
"ddbdatalinker_position" => 0,
"ddbdatalinker_subs" => 0,
"ddbdatalinker_objects" => 0,
"ddbdatalinker_sorting_date" => $direct_cachedata['core_time'],
"ddbdatalinker_symbol" => "",
"ddbdatalinker_title" => ""
);

								if ($f_datalinker_object->set_insert ($f_insert_array)) { $f_data['ddbdatalinker_id_main'] = $f_box_id; }
							}
						}
					}

					if ($f_data['ddbdatalinker_id_main'] == NULL) { unset ($f_data['ddbdatalinker_id_main']); }
				}

				break 1;
			}
			default:
			{
				if ($f_data['ddbdatalinker_id_main'] == NULL) { unset ($f_data['ddbdatalinker_id_main']); }
			}
			}
		}

		$f_return = parent::set ($f_data);

		if (($f_return)&&(isset ($f_data['ddbpms_from_id'],$f_data['ddbpms_to_id'])))
		{
			if (!isset ($f_data['ddbdata_sid'])) { $f_data['ddbdata_sid'] = $f_data['ddbdatalinker_sid']; }
			if (!isset ($f_data['ddbdata_mode_user'])) { $f_data['ddbdata_mode_user'] = "w"; }
			if (!isset ($f_data['ddbdata_mode_group'])) { $f_data['ddbdata_mode_group'] = "-"; }
			if (!isset ($f_data['ddbdata_mode_all'])) { $f_data['ddbdata_mode_all'] = "-"; }

			if (!isset ($f_data['ddbpms_from_ip'])) { $f_data['ddbpms_from_ip'] = ""; }
			elseif ((!$direct_settings['swg_ip_save2db'])&&(strlen ($f_data['ddbpms_from_ip']))) { $f_data['ddbpms_from_ip'] = "unknown"; }

			if (!isset ($f_data['ddbpms_to_ip'])) { $f_data['ddbpms_to_ip'] = ""; }
			elseif ((!$direct_settings['swg_ip_save2db'])&&(strlen ($f_data['ddbpms_to_ip']))) { $f_data['ddbpms_to_ip'] = "unknown"; }

			if (($f_data['ddbdatalinker_type'] == 4)&&(strlen ($f_data['ddbpms_to_id']))&&(!isset ($f_data['ddbusers_type'],$f_data['ddbusers_banned'],$f_data['ddbusers_deleted'],$f_data['ddbusers_name'],$f_data['ddbusers_title'],$f_data['ddbusers_avatar'],$f_data['ddbusers_signature'],$f_data['ddbusers_rating'])))
			{
				$f_user_array = $direct_classes['kernel']->v_user_get ($f_data['ddbpms_to_id']);
				if ($f_user_array) { $f_data = array_merge ($f_data,$f_user_array); }
			}

			if (($f_data['ddbdatalinker_type'] == 5)&&(strlen ($f_data['ddbpms_from_id']))&&(!isset ($f_data['ddbusers_type'],$f_data['ddbusers_banned'],$f_data['ddbusers_deleted'],$f_data['ddbusers_name'],$f_data['ddbusers_title'],$f_data['ddbusers_avatar'],$f_data['ddbusers_signature'],$f_data['ddbusers_rating'])))
			{
				$f_user_array = $direct_classes['kernel']->v_user_get ($f_data['ddbpms_from_id']);
				if ($f_user_array) { $f_data = array_merge ($f_data,$f_user_array); }
			}

			$this->set_extras ($f_data,(array ("ddbpms_from_id","ddbpms_from_ip","ddbpms_to_id","ddbpms_to_ip","ddbdata_sid","ddbdata_mode_user","ddbdata_mode_group","ddbdata_mode_all","ddbusers_type","ddbusers_banned","ddbusers_deleted","ddbusers_name","ddbusers_title","ddbusers_avatar","ddbusers_signature","ddbusers_rating")));
			if (isset ($f_data['ddbdata_data'])) { $this->set_extras ($f_data,(array ("ddbdata_data"))); }
			$this->data_bid = $f_data['ddbdatalinker_id_main'];

			if (strlen ($f_uid))
			{
				if (($f_data['ddbdatalinker_type'] == 4)&&($f_data['ddbpms_to_id'] != $f_uid)) { $f_return = false; }
				if (($f_data['ddbdatalinker_type'] == 5)&&($f_data['ddbpms_from_id'] != $f_uid)) { $f_return = false; }
			}
		}
		else { $f_return = false; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->set ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_message->set_update ($f_data,$f_pms_content = true,$f_pms_settings = true)
/**
	* Updates (and overwrites) the existing DataLinker entry and saves it to the
	* database. Note: If "set()" fails because of permission problems 
	* "update()" has to be called manually to write data to the database.
	* Please make sure that this is the intended behavior. You can use
	* "is_empty()" to check for the current data state of this object.
	*
	* @param  array $f_data PM data
	* @param  boolean $f_pms_content True to update the data entry
	* @param  boolean $f_pms_settings True to update the settings entry
	* @uses   direct_account_pms_message::set()
	* @uses   direct_account_pms_message::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @since  v0.1.00
*/
	public function set_update ($f_data,$f_pms_content = true,$f_pms_settings = true)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_message->set_update (+f_data,+f_pms_content,+f_pms_settings)- (#echo(__LINE__)#)"); }

		if ($this->set ($f_data))
		{
			$this->data_insert_mode = false;
			return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->set_update ()- (#echo(__LINE__)#)",(:#*/$this->update ($f_pms_content,$f_pms_settings)/*#ifdef(DEBUG):),true):#*/;
		}
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->set_update ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
	}

	//f// direct_account_pms_message->update ($f_pms_content = true,$f_pms_settings = true,$f_insert_mode_deactivate = true)
/**
	* Writes the object data to the database.
	*
	* @param  boolean $f_pms_content Update *_data if true
	* @param  boolean $f_pms_settings Update *_datalinker, *_datalinkerd and
	*         *_pms if true
	* @param  boolean $f_insert_mode_deactivate Deactive insert mode after calling
	*         update ()
 	* @uses   direct_db::define_values()
	* @uses   direct_db::define_values_keys()
	* @uses   direct_db::define_values_encode()
	* @uses   direct_db::init_replace()
	* @uses   direct_db::optimize_random()
	* @uses   direct_db::query_exec()
	* @uses   direct_db::v_transaction_begin()
	* @uses   direct_db::v_transaction_commit()
	* @uses   direct_db::v_transaction_rollback()
	* @uses   direct_dbsync_event()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function update ($f_pms_content = true,$f_pms_settings = true,$f_insert_mode_deactivate = true)
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_message->update (+f_pms_content,+f_pms_settings)- (#echo(__LINE__)#)"); }

		if (empty ($this->data_changed)) { $f_return = true; }
		else
		{
			$direct_classes['db']->v_transaction_begin ();

			if ($this->data['ddbdatalinker_id'] == $this->data['ddbdatalinker_id_object']) { $f_return = parent::update ($f_pms_settings,$f_pms_settings,false); }
			else { $f_return = parent::update ($f_pms_settings,false,false); }

			if (($f_return)&&(count ($this->data) > 1))
			{
				if (($f_pms_settings)&&($this->is_changed (array ("ddbpms_from_id","ddbpms_from_ip","ddbpms_to_id","ddbpms_to_ip"))))
				{
					if ($this->data_insert_mode) { $direct_classes['db']->init_insert ($direct_settings['users_pms_table']); }
					else { $direct_classes['db']->init_update ($direct_settings['users_pms_table']); }

					$f_update_values = "<sqlvalues>";
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdatalinker_id']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['users_pms_table'].".ddbpms_id",$this->data['ddbdatalinker_id'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbpms_from_id']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['users_pms_table'].".ddbpms_from_id",$this->data['ddbpms_from_id'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbpms_from_id']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['users_pms_table'].".ddbpms_from_ip",$this->data['ddbpms_from_ip'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbpms_to_id']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['users_pms_table'].".ddbpms_to_id",$this->data['ddbpms_to_id'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbpms_to_ip']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['users_pms_table'].".ddbpms_to_ip",$this->data['ddbpms_to_ip'],"string"); }
					$f_update_values .= "</sqlvalues>";

					$direct_classes['db']->define_set_attributes ($f_update_values);
					if (!$this->data_insert_mode) { $direct_classes['db']->define_row_conditions ("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['users_pms_table'].".ddbpms_id",$this->data['ddbdatalinker_id'],"string"))."</sqlconditions>"); }
					$f_return = $direct_classes['db']->query_exec ("co");

					if ($f_return)
					{
						if (function_exists ("direct_dbsync_event"))
						{
							if ($this->data_insert_mode) { direct_dbsync_event ($direct_settings['users_pms_table'],"insert",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['users_pms_table'].".ddbpms_id",$this->data['ddbdatalinker_id'],"string"))."</sqlconditions>")); }
							else { direct_dbsync_event ($direct_settings['users_pms_table'],"update",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['users_pms_table'].".ddbpms_id",$this->data['ddbdatalinker_id'],"string"))."</sqlconditions>")); }
						}

						if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->optimize_random ($direct_settings['users_pms_table']); }
					}
				}

				if ($this->data['ddbdatalinker_type'] == 4) { $f_data_owner = "ddbpms_to_id"; }
				else { $f_data_owner = "ddbpms_from_id"; }

				if (($f_return)&&($f_pms_content)&&($this->data['ddbdatalinker_id'] == $this->data['ddbdatalinker_id_object'])&&($this->is_changed (array ("ddbdatalinker_id_main",$f_data_owner,"ddbdata_data","ddbdata_mode_user","ddbdata_mode_group","ddbdata_mode_all"))))
				{
					if (isset ($this->data['ddbdata_data']))
					{
						if ($this->data_insert_mode) { $direct_classes['db']->init_insert ($direct_settings['data_table']); }
						else { $direct_classes['db']->init_update ($direct_settings['data_table']); }

						$f_update_values = "<sqlvalues>";
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdatalinker_id_object']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_id",$this->data['ddbdatalinker_id_object'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdatalinker_id_main']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_id_cat",$this->data['ddbdatalinker_id_main'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed[$f_data_owner]))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_owner",$this->data_changed[$f_data_owner],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdata_data']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_data",$this->data['ddbdata_data'],"string"); }
						if ($this->data_insert_mode) { $f_update_values .= "<element1 attribute='{$direct_settings['data_table']}.ddbdata_sid' value='{$this->data_sid}' type='string' />"; }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdata_mode_user']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_mode_user",$this->data['ddbdata_mode_user'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdata_mode_group']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_mode_group",$this->data['ddbdata_mode_group'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdata_mode_all']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_mode_all",$this->data['ddbdata_mode_all'],"string"); }
						$f_update_values .= "</sqlvalues>";

						$direct_classes['db']->define_set_attributes ($f_update_values);
						if (!$this->data_insert_mode) { $direct_classes['db']->define_row_conditions ("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['data_table'].".ddbdata_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>"); }
						$f_return = $direct_classes['db']->query_exec ("co");

						if ($f_return)
						{
							if (function_exists ("direct_dbsync_event"))
							{
								if ($this->data_insert_mode) { direct_dbsync_event ($direct_settings['data_table'],"insert",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['data_table'].".ddbdata_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>")); }
								else { direct_dbsync_event ($direct_settings['data_table'],"update",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['data_table'].".ddbdata_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>")); }
							}

							if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->optimize_random ($direct_settings['data_table']); }
						}
					}
					else { $f_return = false; }
				}
			}

			if (($f_insert_mode_deactivate)&&($this->data_insert_mode)) { $this->data_insert_mode = false; }

			if ($f_return) { $direct_classes['db']->v_transaction_commit (); }
			else { $direct_classes['db']->v_transaction_rollback (); }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_message->update ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}
}

/* -------------------------------------------------------------------------
Mark this class as the most up-to-date one
------------------------------------------------------------------------- */

define ("CLASS_direct_account_pms_message",true);

//j// Script specific commands

if (!isset ($direct_settings['swg_auto_maintenance'])) { $direct_settings['swg_auto_maintenance'] = false; }
if (!isset ($direct_settings['swg_ip_save2db'])) { $direct_settings['swg_ip_save2db'] = true; }
}

//j// EOF
?>