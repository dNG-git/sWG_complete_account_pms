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

$g_continue_check = ((defined ("CLASS_direct_account_pms_box")) ? false: true);
if (!defined ("CLASS_direct_datalinker")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_datalinker.php"); }
if (!defined ("CLASS_direct_datalinker")) { $g_continue_check = false; }

if ($g_continue_check)
{
//c// direct_account_pms_box
/**
* This abstraction layer provides PMS list (account) specific functions.
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
class direct_account_pms_box extends direct_datalinker
{
/**
	* @var array $class_messages Cached message objects
*/
	protected $class_messages;
/**
	* @var array $class_subboxes Cached subbox objects
*/
	protected $class_subboxes;

/* -------------------------------------------------------------------------
Extend the class
------------------------------------------------------------------------- */

	//f// direct_account_pms_box->__construct ()
/**
	* Constructor (PHP5) __construct (direct_account_pms_box)
	*
	* @uses  direct_debug()
	* @uses  USE_debug_reporting
	* @since v0.1.00
*/
	public function __construct ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_box->__construct (direct_account_pms_box)- (#echo(__LINE__)#)"); }

/* -------------------------------------------------------------------------
My parent should be on my side to get the work done
------------------------------------------------------------------------- */

		parent::__construct ();

/* -------------------------------------------------------------------------
Informing the system about available functions 
------------------------------------------------------------------------- */

		$this->functions['add_messages'] = true;
		$this->functions['delete'] = false;
		$this->functions['get_message'] = true;
		$this->functions['get_messages_since_date'] = true;
		$this->functions['remove_messages'] = true;

/* -------------------------------------------------------------------------
Set up additional settings 
------------------------------------------------------------------------- */

		$this->class_messages = array ();
		$this->class_subboxes = array ();
		$this->data_sid = "c0a38f7c90c17551fb03dbd2d80f0aba";
	}

	//f// direct_account_pms_box->add_messages ($f_count,$f_update = true)
/**
	* Increases the message counter.
	*
	* @param  number $f_count Number to be added to the message counter
	* @param  boolean $f_update True to update the database entry
	* @uses   direct_datalinker::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function add_messages ($f_count,$f_update = true)
	{
		if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -account_pms_box->add_messages ($f_count,+f_update)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -account_pms_box->add_messages ()- (#echo(__LINE__)#)",(:#*/$this->add_objects ($f_count,$f_update)/*#ifdef(DEBUG):),true):#*/;
	}

	//f// direct_account_pms_box->delete ($f_link_data = true,$f_data = true)
/**
	* Delete the object from the database.
	*
	* @param  boolean $f_link_data Delete *_datalinker if true
	* @param  boolean $f_data Delete *_datalinkerd if true
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean Always false; TODO: Code me
	* @since  v0.1.00
*/
	public function delete ($f_link_data = true,$f_data = true)
	{
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -account_pms_box->delete (+f_link_data,+f_data)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->delete ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_box->get ($f_bid = "",$f_uid = NULL,$f_load = true)
/**
	* Reads the box data with the given ID.
	*
	* @param  string $f_bid PMS box ID
	* @param  string $f_uid Optional user ID to check
	* @param  boolean $f_load Load DataLinker data from the database
	* @uses   direct_account_pms_box::get_aid()
	* @uses   USE_debug_reporting
	* @return mixed Box data array; false on error
	* @since  v0.1.00
*/
	public function get ($f_bid = "",$f_uid = NULL,$f_load = true)
	{
		if (USE_debug_reporting) { direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->get ($f_bid,+f_uid,+f_load)- (#echo(__LINE__)#)"); }

		$f_return = ($f_load ? $this->get_aid (NULL,$f_bid,$f_uid) : parent::get ($f_bid,false));
		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -account_pms_box->get ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_box->get_aid ($f_attributes = NULL,$f_values = "",$f_uid = NULL)
/**
	* Request and load the box data based on a custom attribute ID. Please
	* note that only attributes of type "string" are supported.
	*
	* @param  mixed $f_attributes Attribute name(s) (array or string)
	* @param  mixed $f_values Attribute value(s) (array or string)
	* @param  string $f_uid Optional user ID to check
	* @uses   direct_account_pms_box::get_rights()
	* @uses   direct_datalinker::get_aid()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return mixed Box data array; false on error
	* @since  v0.1.00
*/
	public function get_aid ($f_attributes = NULL,$f_values = "",$f_uid = NULL)
	{
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -account_pms_box->get_aid (+f_attributes,+f_values,+f_uid)- (#echo(__LINE__)#)"); }
		$f_return = false;

		if ($this->data) { $f_return = $this->data; }
		elseif ((is_array ($f_values))||(is_string ($f_values)))
		{
			$f_result_array = parent::get_aid ($f_attributes,$f_values);

			if (($f_result_array)&&($f_result_array['ddbdatalinker_sid'] == $this->data_sid))
			{
				$f_rights_check = false;
				$this->data = $f_result_array;

				if (isset ($f_uid))
				{
					if (("u-".$f_uid) == $this->data['ddbdatalinker_id_main']) { $f_rights_check = true; }
				}
				else { $f_rights_check = true; }

				if ($f_rights_check) { $f_return = $this->data; }
			}
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->get_aid ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_box->get_messages ($f_message_status,$f_offset = 0,$f_perpage = "",$f_sorting_mode = "time-sticky-desc")
/**
	* Returns all messages for the requested filter definition.
	*
	* @param  integer $f_message_status Message status (1 = unread; 2 = read; 3 = all)
	* @param  integer $f_offset Offset for the result list
	* @param  integer $f_perpage Object count limit for the result list
	* @param  string $f_sorting_mode Sorting algorithm
	* @uses   direct_datalinker::define_extra_attributes()
	* @uses   direct_datalinker::define_extra_conditions()
	* @uses   direct_datalinker::define_extra_joins()
	* @uses   direct_datalinker::get_subs()
	* @uses   direct_db::define_row_conditions_encode()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return array Array with message objects
	* @since  v0.1.00
*/
	public function get_messages ($f_message_status,$f_offset = 0,$f_perpage = "",$f_sorting_mode = "time-sticky-desc")
	{
		global $direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_box->get_messages ($f_message_status,$f_offset,$f_perpage,$f_sorting_mode,+f_frontpage_mode)- (#echo(__LINE__)#)"); }

		$f_return = array ();
		$f_cache_signature = md5 ($this->data['ddbdatalinker_id_object'].$f_message_status.$f_offset.$f_perpage.$f_sorting_mode);

		if (isset ($this->class_messages[$f_cache_signature])) { $f_return =& $this->class_messages[$f_cache_signature]; }
		elseif (isset ($this->data['ddbdatalinker_id_object']))
		{
			$this->define_extra_attributes (array ($direct_settings['users_pms_table'].".*",$direct_settings['data_table'].".ddbdata_sid",$direct_settings['data_table'].".ddbdata_mode_user",$direct_settings['data_table'].".ddbdata_mode_group",$direct_settings['data_table'].".ddbdata_mode_all",$direct_settings['users_table'].".ddbusers_type",$direct_settings['users_table'].".ddbusers_banned",$direct_settings['users_table'].".ddbusers_deleted",$direct_settings['users_table'].".ddbusers_name",$direct_settings['users_table'].".ddbusers_title",$direct_settings['users_table'].".ddbusers_avatar",$direct_settings['users_table'].".ddbusers_signature",$direct_settings['users_table'].".ddbusers_rating"));

$f_select_joins = array (
 array ("type" => "left-outer-join","table" => $direct_settings['users_pms_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['users_pms_table']}.ddbpms_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['data_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['data_table']}.ddbdata_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['users_table'],"condition" => "<sqlconditions>
  <sub1 type='sublevel' condition='or'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' /><element2 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['users_pms_table']}.ddbpms_from_id' type='attribute' /></sub1>
  <sub2 type='sublevel' condition='or'><element3 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' /><element4 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['users_pms_table']}.ddbpms_to_id' type='attribute' /></sub2>
  </sqlconditions>")
);

			$this->define_extra_joins ($f_select_joins);

			$this->define_extra_conditions ("<sub1 type='sublevel'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' condition='or' /><element2 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' condition='or' /></sub1>");

			if ($f_message_status < 3)
			{
				if ($f_message_status == 1) { $this->define_extra_conditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_position' value='1' type='number' />"); }
				else { $this->define_extra_conditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_position' value='0' type='number' />"); }
			}

			$this->class_messages[$f_cache_signature] = parent::get_subs ("direct_account_pms_message",$this->data['ddbdatalinker_id_object'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",$f_offset,$f_perpage,$f_sorting_mode);
			// md5 ("account_pms")

			$f_return =& $this->class_messages[$f_cache_signature];
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->get_messages ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_box->get_messages_since_date ($f_message_status,$f_date,$f_offset = 0,$f_perpage = "",$f_sorting_mode = "time-sticky-desc",$f_count_only = false,$f_all_boxes = false)
/**
	* Returns all messages for the requested filter definition and that are
	* newer than a specific date.
	*
	* @param  integer $f_message_status Message status (1 = unread; 2 = read; 3 = all)
	* @param  integer $f_date UNIX timestamp for the oldest valid post date
	* @param  integer $f_offset Offset for the result list
	* @param  integer $f_perpage Object count limit for the result list
	* @param  string $f_sorting_mode Sorting algorithm
	* @param  boolean $f_count_only True to return the number of posts
	* @param  boolean $f_all_boxes Return data for all boxes
	* @uses   direct_datalinker::define_extra_attributes()
	* @uses   direct_datalinker::define_extra_conditions()
	* @uses   direct_datalinker::define_extra_joins()
	* @uses   direct_datalinker::get_subs()
	* @uses   direct_db::define_attributes()
	* @uses   direct_db::define_row_conditions()
	* @uses   direct_db::define_row_conditions_encode()
	* @uses   direct_db::init_select()
	* @uses   direct_db::query_exec()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return mixed Array with message objects or quantity as integer
	* @since  v0.1.00
*/
	public function get_messages_since_date ($f_message_status,$f_date,$f_offset = 0,$f_perpage = "",$f_sorting_mode = "time-sticky-desc",$f_count_only = false,$f_all_boxes = false)
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_box->get_messages_since_date ($f_message_status,$f_date,$f_offset,$f_perpage,$f_sorting_mode,+f_count_only,+f_all_boxes)- (#echo(__LINE__)#)"); }

		if ($f_count_only)
		{
			$f_cache_signature = ($f_all_boxes ? md5 ("msdc".$f_message_status) : md5 ("msdc".$this->data['ddbdatalinker_id_main'].$f_message_status));
			$f_return = 0;
		}
		else
		{
			$f_cache_signature = ($f_all_boxes ? md5 ("msd".$f_message_status) : md5 ("msd".$this->data['ddbdatalinker_id_object'].$f_message_status.$f_offset.$f_perpage.$f_sorting_mode));
			$f_return = array ();
		}

		$f_boxes_signature = md5 ("msd".$this->data['ddbdatalinker_id_main']);

		if (isset ($this->class_messages[$f_cache_signature])) { $f_return =& $this->class_messages[$f_cache_signature]; }
		elseif (($f_count_only)&&(!$f_all_boxes)&&($f_message_status == 3)&&($f_date < 1)) { $f_return = $this->data['ddbdatalinker_objects']; }
		elseif (isset ($this->data['ddbdatalinker_id_main']))
		{
			if ($f_count_only) { $f_select_attributes = ((($f_date < 1)&&($f_message_status == 3)) ? array ("sum-rows({$direct_settings['datalinkerd_table']}.ddbdatalinker_objects)") : array ("count-rows({$direct_settings['datalinker_table']}.ddbdatalinker_id)")); }
			else { $f_select_attributes = array ($direct_settings['users_pms_table'].".*",$direct_settings['data_table'].".ddbdata_sid",$direct_settings['data_table'].".ddbdata_mode_user",$direct_settings['data_table'].".ddbdata_mode_group",$direct_settings['data_table'].".ddbdata_mode_all",$direct_settings['users_table'].".ddbusers_type",$direct_settings['users_table'].".ddbusers_banned",$direct_settings['users_table'].".ddbusers_deleted",$direct_settings['users_table'].".ddbusers_name",$direct_settings['users_table'].".ddbusers_title",$direct_settings['users_table'].".ddbusers_avatar",$direct_settings['users_table'].".ddbusers_signature",$direct_settings['users_table'].".ddbusers_rating"); }

			$this->define_extra_attributes ($f_select_attributes);

			if (!$f_count_only)
			{
$f_select_joins = array (
 array ("type" => "left-outer-join","table" => $direct_settings['users_pms_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['users_pms_table']}.ddbpms_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['data_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['data_table']}.ddbdata_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['users_table'],"condition" => "<sqlconditions>
 <sub1 type='sublevel' condition='or'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' /><element2 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['users_pms_table']}.ddbpms_from_id' type='attribute' /></sub1>
 <sub2 type='sublevel' condition='or'><element3 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' /><element4 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['users_pms_table']}.ddbpms_to_id' type='attribute' /></sub2>
</sqlconditions>")
);

				$this->define_extra_joins ($f_select_joins);
			}

			if ($f_date > 0) { $this->define_extra_conditions ($direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinkerd_table'].".ddbdatalinker_sorting_date",$f_date,"number",">")); }

			if ($f_message_status < 3)
			{
				if ($f_message_status == 1) { $this->define_extra_conditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_position' value='1' type='number' />"); }
				else { $this->define_extra_conditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_position' value='0' type='number' />"); }
			}

			if ($f_count_only)
			{
				if (($f_message_status < 3)||($f_date > 0))
				{
					$f_select_conditions = "<sub1 type='sublevel'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' condition='or' /><element2 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' condition='or' /></sub1>";

					if ($f_all_boxes)
					{
						if (!isset ($this->class_subboxes[$f_boxes_signature]))
						{
							$direct_classes['db']->init_select ($direct_settings['datalinker_table']);
							$direct_classes['db']->define_attributes (array ($direct_settings['datalinker_table'].".ddbdatalinker_id"));

$direct_classes['db']->define_row_conditions ("<sqlconditions>
".($direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinker_table'].".ddbdatalinker_id_main",$this->data['ddbdatalinker_id_main'],"string"))."
<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_sid' value='c0a38f7c90c17551fb03dbd2d80f0aba' type='string' />
<element2 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='3' type='number' operator='&lt;=' />
</sqlconditions>");

							$this->class_subboxes[$f_boxes_signature] = $direct_classes['db']->query_exec ("ms");
						}

						if ($this->class_subboxes[$f_boxes_signature])
						{
							$f_select_conditions .= "<sub2 type='sublevel'>";
							foreach ($this->class_subboxes[$f_boxes_signature] as $f_subbox_id) { $f_select_conditions .= $direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinker_table'].".ddbdatalinker_id_main",$f_subbox_id,"string","==","or"); }
							$f_select_conditions .= "</sub2>";

						}

						$this->define_extra_conditions ($f_select_conditions);
						$this->class_messages[$f_cache_signature] = parent::get_subs ("",NULL,NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",0,1,"time-desc");
					}
					else
					{
						$this->define_extra_conditions ($f_select_conditions);
						$this->class_messages[$f_cache_signature] = parent::get_subs ("",$this->data['ddbdatalinker_id_object'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",0,1,"time-desc");
					}
				}
				else
				{
					$this->define_extra_conditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='3' type='number' operator='&lt;=' />");
					$this->class_messages[$f_cache_signature] = parent::get_subs ("",$this->data['ddbdatalinker_id_main'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",0,1,"time-desc");
				}
			}
			else
			{
				if ($f_all_boxes)
				{
$this->define_extra_conditions ("<sqlconditions>
<sub1 type='sublevel' condition='or'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' />".($direct_classes['db']->define_row_conditions_encode ($direct_settings['users_pms_table'].".ddbpms_to_id",$this->data['ddbdatalinker_id_main'],"string"))."</sub1>
<sub2 type='sublevel' condition='or'><element2 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' />".($direct_classes['db']->define_row_conditions_encode ($direct_settings['users_pms_table'].".ddbpms_from_id",$this->data['ddbdatalinker_id_main'],"string"))."</sub2>
</sqlconditions>");

					$this->class_messages[$f_cache_signature] = parent::get_subs ("direct_account_pms_message",NULL,NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",$f_offset,$f_perpage,$f_sorting_mode);
				}
				else { $this->class_messages[$f_cache_signature] = parent::get_subs ("direct_account_pms_message",$this->data['ddbdatalinker_id_object'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",$f_offset,$f_perpage,$f_sorting_mode); }
				// md5 ("account_pms")
			}

			$f_return =& $this->class_messages[$f_cache_signature];
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->get_messages_since_date ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_box->remove_messages ($f_count,$f_update = true)
/**
	* Decreases the message counter.
	*
	* @param  number $f_count Number to be removed from the message counter
	* @param  boolean $f_update True to update the database entry
	* @uses   direct_datalinker::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function remove_messages ($f_count,$f_update = true)
	{
		if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -account_pms_box->remove_messages ($f_count,+f_update)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -account_pms_box->remove_messages ()- (#echo(__LINE__)#)",(:#*/$this->remove_objects ($f_count,$f_update)/*#ifdef(DEBUG):),true):#*/;
	}

	//f// direct_account_pms_box->set ($f_data,$f_uid = NULL)
/**
	* Sets (and overwrites existing) data for this PMS box.
	*
	* @param  array $f_data Box data
	* @param  string $f_uid Optional user ID to check
	* @uses   direct_datalinker::set()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function set ($f_data,$f_uid = NULL)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_box->set (+f_data,$f_uid)- (#echo(__LINE__)#)"); }
		$f_return = parent::set ($f_data);

		if ($f_return)
		{
			if ((isset ($f_uid))&&(("u-".$f_uid) != $this->data['ddbdatalinker_id_main'])) { $f_return = false; }
		}
		else { $f_return = false; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->set ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_account_pms_box->set_insert ($f_data,$f_uid = NULL,$f_insert_mode_deactivate = true)
/**
	* Sets (and overwrites existing) the DataLinker entry and saves it to the
	* database. Note: If "set()" fails because of permission problems 
	* "update()" has to be called manually to write data to the database.
	* Please make sure that this is the intended behavior. You can use
	* "is_empty()" to check for the current data state of this object.
	*
	* @param  array $f_data DataLinker entry
	* @param  string $f_uid Optional user ID to check
	* @param  boolean $f_insert_mode_deactivate Deactive insert mode after calling
	*         update ()
	* @uses   direct_datalinker::set()
	* @uses   direct_datalinker::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function set_insert ($f_data,$f_uid = NULL,$f_insert_mode_deactivate = true)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_box->set_insert (+f_data,$f_uid,+f_insert_mode_deactivate)- (#echo(__LINE__)#)"); }

		if ($this->set ($f_data,$f_uid))
		{
			$this->data_insert_mode = true;
			return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->set_insert ()- (#echo(__LINE__)#)",(:#*/$this->update ($f_insert_mode_deactivate)/*#ifdef(DEBUG):),true):#*/;
		}
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->set_insert ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
	}

	//f// direct_account_pms_box->set_update ($f_data,$f_uid = NULL)
/**
	* Updates (and overwrites) the existing DataLinker entry and saves it to the
	* database. Note: If "set()" fails because of permission problems 
	* "update()" has to be called manually to write data to the database.
	* Please make sure that this is the intended behavior. You can use
	* "is_empty()" to check for the current data state of this object.
	*
	* @param  array $f_data DataLinker entry
	* @param  string $f_uid Optional user ID to check
	* @uses   direct_datalinker::set()
	* @uses   direct_datalinker::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function set_update ($f_data,$f_uid = NULL)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -account_pms_box->set_update (+f_data,$f_uid)- (#echo(__LINE__)#)"); }

		if ($this->set ($f_data,$f_uid))
		{
			$this->data_insert_mode = false;
			return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->set_update ()- (#echo(__LINE__)#)",(:#*/$this->update ()/*#ifdef(DEBUG):),true):#*/;
		}
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -account_pms_box->set_update ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
	}
}

/* -------------------------------------------------------------------------
Mark this class as the most up-to-date one
------------------------------------------------------------------------- */

define ("CLASS_direct_account_pms_box",true);
}

//j// EOF
?>