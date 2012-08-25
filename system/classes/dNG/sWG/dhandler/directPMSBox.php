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
/*#ifdef(PHP5n) */

namespace dNG\sWG\dhandler;
/* #*/
/*#use(direct_use) */
use dNG\sWG\dhandler\directDataLinker,
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

if (!defined ("CLASS_directPMSBox"))
{
/**
* This abstraction layer provides PMS list (account) specific functions.
*
* @author     direct Netware Group
* @copyright  (C) direct Netware Group - All rights reserved
* @package    sWG
* @subpackage account_pms
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/
class directPMSBox extends directDataLinker
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

/**
	* Constructor (PHP5) __construct (directPMSBox)
	*
	* @since v0.1.00
*/
	public function __construct ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -PMSBox->__construct (directPMSBox)- (#echo(__LINE__)#)"); }

/* -------------------------------------------------------------------------
My parent should be on my side to get the work done
------------------------------------------------------------------------- */

		parent::__construct ();

/* -------------------------------------------------------------------------
Informing the system about available functions 
------------------------------------------------------------------------- */

		$this->functions['addMessages'] = true;
		$this->functions['delete'] = false;
		$this->functions['getMessages'] = direct_autoload ('dNG\sWG\dhandler\directPMSMessage');
		$this->functions['getMessagesSinceDate'] = $this->functions['getMessages'];
		$this->functions['removeMessages'] = true;

/* -------------------------------------------------------------------------
Set up additional settings 
------------------------------------------------------------------------- */

		$this->class_messages = array ();
		$this->class_subboxes = array ();
		$this->data_sid = "c0a38f7c90c17551fb03dbd2d80f0aba";
	}

/**
	* Increases the message counter.
	*
	* @param  number $f_count Number to be added to the message counter
	* @param  boolean $f_update True to update the database entry
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function addMessages ($f_count,$f_update = true)
	{
		if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -PMSBox->addMessages ($f_count,+f_update)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -PMSBox->addMessages ()- (#echo(__LINE__)#)",(:#*/$this->addObjects ($f_count,$f_update)/*#ifdef(DEBUG):),true):#*/;
	}

/**
	* Delete the object from the database.
	*
	* @param  boolean $f_link_data Delete *_datalinker if true
	* @param  boolean $f_data Delete *_datalinkerd if true
	* @return boolean Always false; TODO: Code me
	* @since  v0.1.00
*/
	public function delete ($f_link_data = true,$f_data = true)
	{
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -PMSBox->delete (+f_link_data,+f_data)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->delete ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/;
	}

/**
	* Reads the box data with the given ID.
	*
	* @param  string $f_bid PMS box ID
	* @param  string $f_uid Optional user ID to check
	* @param  boolean $f_load Load DataLinker data from the database
	* @return mixed Box data array; false on error
	* @since  v0.1.00
*/
	public function get ($f_bid = "",$f_uid = NULL,$f_load = true)
	{
		if (USE_debug_reporting) { direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->get ($f_bid,+f_uid,+f_load)- (#echo(__LINE__)#)"); }

		$f_return = ($f_load ? $this->getAid (NULL,$f_bid,$f_uid) : parent::get ($f_bid,false));
		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -PMSBox->get ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

/**
	* Request and load the box data based on a custom attribute ID. Please
	* note that only attributes of type "string" are supported.
	*
	* @param  mixed $f_attributes Attribute name(s) (array or string)
	* @param  mixed $f_values Attribute value(s) (array or string)
	* @param  string $f_uid Optional user ID to check
	* @return mixed Box data array; false on error
	* @since  v0.1.00
*/
	public function getAid ($f_attributes = NULL,$f_values = "",$f_uid = NULL)
	{
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -PMSBox->getAid (+f_attributes,+f_values,+f_uid)- (#echo(__LINE__)#)"); }
		$f_return = false;

		if ($this->data) { $f_return = $this->data; }
		elseif ((is_array ($f_values))||(is_string ($f_values)))
		{
			$f_result_array = parent::getAid ($f_attributes,$f_values);

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

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->getAid ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

/**
	* Returns all messages for the requested filter definition.
	*
	* @param  integer $f_message_status Message status (1 = unread; 2 = read; 3 = all)
	* @param  integer $f_offset Offset for the result list
	* @param  integer $f_perpage Object count limit for the result list
	* @param  string $f_sorting_mode Sorting algorithm
	* @return array Array with message objects
	* @since  v0.1.00
*/
	public function getMessages ($f_message_status,$f_offset = 0,$f_perpage = "",$f_sorting_mode = "time-sticky-desc")
	{
		global $direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -PMSBox->getMessages ($f_message_status,$f_offset,$f_perpage,$f_sorting_mode,+f_frontpage_mode)- (#echo(__LINE__)#)"); }

		$f_return = array ();
		$f_cache_signature = md5 ($this->data['ddbdatalinker_id_object'].$f_message_status.$f_offset.$f_perpage.$f_sorting_mode);

		if (isset ($this->class_messages[$f_cache_signature])) { $f_return =& $this->class_messages[$f_cache_signature]; }
		elseif (isset ($this->data['ddbdatalinker_id_object']))
		{
			$this->defineExtraAttributes (array ($direct_settings['account_pms_table'].".*",$direct_settings['data_table'].".ddbdata_sid",$direct_settings['data_table'].".ddbdata_mode_user",$direct_settings['data_table'].".ddbdata_mode_group",$direct_settings['data_table'].".ddbdata_mode_all",$direct_settings['users_table'].".ddbusers_type",$direct_settings['users_table'].".ddbusers_banned",$direct_settings['users_table'].".ddbusers_deleted",$direct_settings['users_table'].".ddbusers_name",$direct_settings['users_table'].".ddbusers_title",$direct_settings['users_table'].".ddbusers_avatar",$direct_settings['users_table'].".ddbusers_signature",$direct_settings['users_table'].".ddbusers_rating"));

$this->defineExtraJoins (array (
 array ("type" => "left-outer-join","table" => $direct_settings['account_pms_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['account_pms_table']}.ddbpms_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['data_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['data_table']}.ddbdata_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['users_table'],"condition" => "<sqlconditions>
  <sub1 type='sublevel' condition='or'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' /><element2 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['account_pms_table']}.ddbpms_from_id' type='attribute' /></sub1>
  <sub2 type='sublevel' condition='or'><element3 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' /><element4 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['account_pms_table']}.ddbpms_to_id' type='attribute' /></sub2>
  </sqlconditions>")
));

			$this->defineExtraConditions ("<sub1 type='sublevel'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' condition='or' /><element2 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' condition='or' /></sub1>");

			if ($f_message_status < 3)
			{
				if ($f_message_status == 1) { $this->defineExtraConditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_position' value='1' type='number' />"); }
				else { $this->defineExtraConditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_position' value='0' type='number' />"); }
			}

			$this->class_messages[$f_cache_signature] = parent::getSubs ("directPMSMessage",$this->data['ddbdatalinker_id_object'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",$f_offset,$f_perpage,$f_sorting_mode);
			// md5 ("account_pms")

			$f_return =& $this->class_messages[$f_cache_signature];
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->getMessages ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

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
	* @return mixed Array with message objects or quantity as integer
	* @since  v0.1.00
*/
	public function getMessagesSinceDate ($f_message_status,$f_date,$f_offset = 0,$f_perpage = "",$f_sorting_mode = "time-sticky-desc",$f_count_only = false,$f_all_boxes = false)
	{
		global $direct_globals,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -PMSBox->getMessagesSinceDate ($f_message_status,$f_date,$f_offset,$f_perpage,$f_sorting_mode,+f_count_only,+f_all_boxes)- (#echo(__LINE__)#)"); }

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
			else { $f_select_attributes = array ($direct_settings['account_pms_table'].".*",$direct_settings['data_table'].".ddbdata_sid",$direct_settings['data_table'].".ddbdata_mode_user",$direct_settings['data_table'].".ddbdata_mode_group",$direct_settings['data_table'].".ddbdata_mode_all",$direct_settings['users_table'].".ddbusers_type",$direct_settings['users_table'].".ddbusers_banned",$direct_settings['users_table'].".ddbusers_deleted",$direct_settings['users_table'].".ddbusers_name",$direct_settings['users_table'].".ddbusers_title",$direct_settings['users_table'].".ddbusers_avatar",$direct_settings['users_table'].".ddbusers_signature",$direct_settings['users_table'].".ddbusers_rating"); }

			$this->defineExtraAttributes ($f_select_attributes);

			if (!$f_count_only)
			{
$this->defineExtraJoins (array (
 array ("type" => "left-outer-join","table" => $direct_settings['account_pms_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['account_pms_table']}.ddbpms_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['data_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['data_table']}.ddbdata_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>"),
 array ("type" => "left-outer-join","table" => $direct_settings['users_table'],"condition" => "<sqlconditions>
  <sub1 type='sublevel' condition='or'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' /><element2 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['account_pms_table']}.ddbpms_from_id' type='attribute' /></sub1>
  <sub2 type='sublevel' condition='or'><element3 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' /><element4 attribute='{$direct_settings['users_table']}.ddbusers_id' value='{$direct_settings['account_pms_table']}.ddbpms_to_id' type='attribute' /></sub2>
  </sqlconditions>")
));
			}

			if ($f_date > 0) { $this->defineExtraConditions ($direct_globals['db']->defineRowConditionsEncode ($direct_settings['datalinkerd_table'].".ddbdatalinker_sorting_date",$f_date,"number",">")); }

			if ($f_message_status < 3)
			{
				if ($f_message_status == 1) { $this->defineExtraConditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_position' value='1' type='number' />"); }
				else { $this->defineExtraConditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_position' value='0' type='number' />"); }
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
							$direct_globals['db']->initSelect ($direct_settings['datalinker_table']);
							$direct_globals['db']->defineAttributes (array ($direct_settings['datalinker_table'].".ddbdatalinker_id"));

$direct_globals['db']->defineRowConditions ("<sqlconditions>
".($direct_globals['db']->defineRowConditionsEncode ($direct_settings['datalinker_table'].".ddbdatalinker_id_main",$this->data['ddbdatalinker_id_main'],"string"))."
<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_sid' value='c0a38f7c90c17551fb03dbd2d80f0aba' type='string' />
<element2 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='3' type='number' operator='&lt;=' />
</sqlconditions>");

							$this->class_subboxes[$f_boxes_signature] = $direct_globals['db']->queryExec ("ms");
						}

						if ($this->class_subboxes[$f_boxes_signature])
						{
							$f_select_conditions .= "<sub2 type='sublevel'>";
							foreach ($this->class_subboxes[$f_boxes_signature] as $f_subbox_id) { $f_select_conditions .= $direct_globals['db']->defineRowConditionsEncode ($direct_settings['datalinker_table'].".ddbdatalinker_id_main",$f_subbox_id,"string","==","or"); }
							$f_select_conditions .= "</sub2>";

						}

						$this->defineExtraConditions ($f_select_conditions);
						$this->class_messages[$f_cache_signature] = parent::getSubs ("",NULL,NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",0,1,"time-desc");
					}
					else
					{
						$this->defineExtraConditions ($f_select_conditions);
						$this->class_messages[$f_cache_signature] = parent::getSubs ("",$this->data['ddbdatalinker_id_object'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",0,1,"time-desc");
					}
				}
				else
				{
					$this->defineExtraConditions ("<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='3' type='number' operator='&lt;=' />");
					$this->class_messages[$f_cache_signature] = parent::getSubs ("",$this->data['ddbdatalinker_id_main'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",0,1,"time-desc");
				}
			}
			elseif ($f_all_boxes)
			{
$this->defineExtraConditions ("<sqlconditions>
<sub1 type='sublevel' condition='or'><element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='4' type='number' />".($direct_globals['db']->defineRowConditionsEncode ($direct_settings['account_pms_table'].".ddbpms_to_id",$this->data['ddbdatalinker_id_main'],"string"))."</sub1>
<sub2 type='sublevel' condition='or'><element2 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='5' type='number' />".($direct_globals['db']->defineRowConditionsEncode ($direct_settings['account_pms_table'].".ddbpms_from_id",$this->data['ddbdatalinker_id_main'],"string"))."</sub2>
</sqlconditions>");

				$this->class_messages[$f_cache_signature] = parent::getSubs ("directPMSMessage",NULL,NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",$f_offset,$f_perpage,$f_sorting_mode);
			}
			else { $this->class_messages[$f_cache_signature] = parent::getSubs ("directPMSMessage",$this->data['ddbdatalinker_id_object'],NULL,"c0a38f7c90c17551fb03dbd2d80f0aba","",$f_offset,$f_perpage,$f_sorting_mode); }
			// md5 ("account_pms")

			$f_return =& $this->class_messages[$f_cache_signature];
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->getMessagesSinceDate ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

/**
	* Returns true if the item can be read by everyone.
	*
	* @return boolean State
	* @since  v0.1.00
*/
	public function isWorldReadable ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -PMSBox->isWorldReadable ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->isWorldReadable ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/;
	}

/**
	* Decreases the message counter.
	*
	* @param  number $f_count Number to be removed from the message counter
	* @param  boolean $f_update True to update the database entry
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function removeMessages ($f_count,$f_update = true)
	{
		if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -PMSBox->removeMessages ($f_count,+f_update)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -PMSBox->removeMessages ()- (#echo(__LINE__)#)",(:#*/$this->removeObjects ($f_count,$f_update)/*#ifdef(DEBUG):),true):#*/;
	}

/**
	* Sets (and overwrites existing) data for this PMS box.
	*
	* @param  array $f_data Box data
	* @param  string $f_uid Optional user ID to check
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function set ($f_data,$f_uid = NULL)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -PMSBox->set (+f_data,$f_uid)- (#echo(__LINE__)#)"); }
		$f_return = parent::set ($f_data);

		if ($f_return)
		{
			if ((isset ($f_uid))&&(("u-".$f_uid) != $this->data['ddbdatalinker_id_main'])) { $f_return = false; }
		}
		else { $f_return = false; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->set ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

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
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function setInsert ($f_data,$f_uid = NULL,$f_insert_mode_deactivate = true)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -PMSBox->setInsert (+f_data,$f_uid,+f_insert_mode_deactivate)- (#echo(__LINE__)#)"); }

		if ($this->set ($f_data,$f_uid))
		{
			$this->data_insert_mode = true;
			return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->setInsert ()- (#echo(__LINE__)#)",(:#*/$this->update ($f_insert_mode_deactivate)/*#ifdef(DEBUG):),true):#*/;
		}
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->setInsert ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
	}

/**
	* Updates (and overwrites) the existing DataLinker entry and saves it to the
	* database. Note: If "set()" fails because of permission problems 
	* "update()" has to be called manually to write data to the database.
	* Please make sure that this is the intended behavior. You can use
	* "is_empty()" to check for the current data state of this object.
	*
	* @param  array $f_data DataLinker entry
	* @param  string $f_uid Optional user ID to check
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function setUpdate ($f_data,$f_uid = NULL)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -PMSBox->setUpdate (+f_data,$f_uid)- (#echo(__LINE__)#)"); }

		if ($this->set ($f_data,$f_uid))
		{
			$this->data_insert_mode = false;
			return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->setUpdate ()- (#echo(__LINE__)#)",(:#*/$this->update ()/*#ifdef(DEBUG):),true):#*/;
		}
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -PMSBox->setUpdate ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
	}
}

/* -------------------------------------------------------------------------
Mark this class as the most up-to-date one
------------------------------------------------------------------------- */

define ("CLASS_directPMSBox",true);
}

//j// EOF
?>