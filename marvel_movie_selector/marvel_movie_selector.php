<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              /https://github.com/anumit-web
 * @since             1.0.0
 * @package           Marvel_movie_selector
 *
 * @wordpress-plugin
 * Plugin Name:       Marvel movie selector
 * Plugin URI:        https://github.com/anumit-web/marvel_movie_selector
 * Description:       Which Marvel movie should you watch today? This plugin suggests random marvel movie from the MCU for you to watch it. No more guessing. No more confusion.
 * Version:           1.0.0
 * Author:            Anumit Jooloor
 * Author URI:        https://github.com/anumit-web/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       marvel_movie_selector
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MARVEL_MOVIE_SELECTOR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-marvel_movie_selector-activator.php
 */
function activate_marvel_movie_selector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-marvel_movie_selector-activator.php';
	Marvel_movie_selector_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-marvel_movie_selector-deactivator.php
 */
function deactivate_marvel_movie_selector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-marvel_movie_selector-deactivator.php';
	Marvel_movie_selector_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_marvel_movie_selector' );
register_deactivation_hook( __FILE__, 'deactivate_marvel_movie_selector' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-marvel_movie_selector.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_marvel_movie_selector() {

	$plugin = new Marvel_movie_selector();
	$plugin->run();

}
run_marvel_movie_selector();


/*ANUMIT JOOLOOR - START*/ 
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
// debug_to_console("Test");


$json = file_get_contents('https://mcuapi.herokuapp.com/api/v1/movies');
$obj = json_decode($json);
echo $obj->total;
// debug_to_console($obj->total);
// debug_to_console($obj->data[0]->id);
// debug_to_console("Count = " . count($obj->data));

$marvel_movie_count = count($obj->data);
$data = json_decode($json);
//debug_to_console($data->data);

for ($x = 0; $x < $marvel_movie_count; $x++) {
	//echo "The movie is: ". $obj->data[0]->id. " <br>";
	// debug_to_console("The movie is: ". $obj->data[$x]->id. ", ".  $obj->data[$x]->title);
}

$random_number = rand(1, $marvel_movie_count - 1);
// debug_to_console("Random number = " . $random_number);
// debug_to_console("The movie to watch is: ". $obj->data[$random_number]->id. ", ".  $obj->data[$random_number]->title);
$selected_marvel_movie_selector = $obj->data[$random_number]->title;


function marvel_movie_selector_css() {
	echo "
	<style type='text/css'>
		#marvel_movie_selector{
			float: right;
			padding-bottom: 5px;
			padding-top: 5px;
			margin: 0;
			direction: ltr;
		}
	</style>
	";
}

add_action( 'admin_head', 'marvel_movie_selector_css' );


function watch_marvel_movie_selector() {
	global $selected_marvel_movie_selector;
	$marvel_text_to_display = $selected_marvel_movie_selector;
	$marvel_text_to_display = "Marvel MCU movie to watch is: " . $marvel_text_to_display;

	echo "<p id='marvel_movie_selector'>" . $marvel_text_to_display . "</p>";
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'watch_marvel_movie_selector' );



//debug_to_console("End of Marvel plugin code");


/*ANUMIT JOOLOOR - END*/ 
