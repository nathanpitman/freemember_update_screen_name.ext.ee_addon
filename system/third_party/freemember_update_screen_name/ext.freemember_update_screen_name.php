<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * FreeMember Update Screen Name Extension
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Extension
 * @author		Nathan Pitman
 * @link		http://www.ninefour.co.uk
 */

class Freemember_update_screen_name_ext {

	public $settings 		= array();
	public $description		= 'Updates {screen_name} with your chosen fields on register and/or profile edit using FreeMember.';
	public $docs_url		= 'http://www.ninefour.co.uk/labs/';
	public $name			= 'FreeMember Update Screen Name';
	public $settings_exist	= 'n';
	public $version			= '1.0';

	private $EE;

	/**
	 * Constructor
	 *
	 * @param 	mixed	Settings array or empty string if none exist.
	 */
	public function __construct($settings = '')
	{
		$this->EE =& get_instance();
		$this->settings = $settings;
	}// ----------------------------------------------------------------------

	/**
	 * Activate Extension
	 *
	 * This function enters the extension into the exp_extensions table
	 *
	 * @see http://codeigniter.com/user_guide/database/index.html for
	 * more information on the db class.
	 *
	 * @return void
	 */
	public function activate_extension()
	{
		// Setup custom settings in this array.
		$this->settings = array();

		$data = array(
			'class'		=> __CLASS__,
			'method'	=> 'freemember_update_screen_name',
			'hook'		=> 'freemember_update_member_start',
			'settings'	=> serialize($this->settings),
			'version'	=> $this->version,
			'enabled'	=> 'y'
		);

		$this->EE->db->insert('extensions', $data);

		// No hooks selected, add in your own hooks installation code here.
	}

	// ----------------------------------------------------------------------

	/**
	 * freemember_update_screen_name
	 *
	 * @param
	 * @return
	 */
	public function freemember_update_screen_name($member_id, $data)
	{
		// Updates the members screen_name on register or profile edit via FreeMember
		// Assumes that your custom member field names match the variables below.
		$data['screen_name'] = $data['first_name'] . ' ' . $data['last_name'];
    		return $data;
	}

	// ----------------------------------------------------------------------

	/**
	 * Disable Extension
	 *
	 * This method removes information from the exp_extensions table
	 *
	 * @return void
	 */
	function disable_extension()
	{
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
	}

	// ----------------------------------------------------------------------

	/**
	 * Update Extension
	 *
	 * This function performs any necessary db updates when the extension
	 * page is visited
	 *
	 * @return 	mixed	void on update / false if none
	 */
	function update_extension($current = '')
	{
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}
	}

	// ----------------------------------------------------------------------
}

/* End of file ext.freemember_update_screen_name.php */
/* Location: /system/expressionengine/third_party/freemember_update_screen_name/ext.freemember_update_screen_name.php */
