<?php
defined('BASEPATH') || exit;
/**
 * Reportico for CodeIgniter
 *
 * Based on Reportico 4
 *
 * @author vikseriq
 * @license MIT
 */

/**
 * Class Reporter
 *
 * Reportico URL handler controller
 */
class Reporter extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('ciportico');
	}

	/**
	 * AJAX Reportico entry point
	 */
	public function index(){
		$this->ciportico->reportico->reportico_ajax_mode = true;
		$this->ciportico->reportico->execute();
	}

}