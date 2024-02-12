<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://github.com/anumit-web
 * @since      1.0.0
 *
 * @package    Marvel_movie_selector
 * @subpackage Marvel_movie_selector/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Marvel_movie_selector
 * @subpackage Marvel_movie_selector/includes
 * @author     Anumit Jooloor <anumit@gmail.com>
 */
class Marvel_movie_selector_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'marvel_movie_selector',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
