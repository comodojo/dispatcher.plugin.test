<?php namespace comodojo\DispatcherPlugin;

/**
 * Event routing presets for dispatcher.servicebundle.test
 * 
 * @package		Comodojo dispatcher (Spare Parts)
 * @author		comodojo <info@comodojo.org>
 * @license		GPL-3.0+
 *
 * LICENSE:
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

global $dispatcher;


class plugintest {

	public static function custom_404($ObjectError) {

		$error_page = file_get_contents(DISPATCHER_REAL_PATH."vendor/comodojo/dispatcher.plugin.test/resources/html/404.html";);

		$ObjectError->setContent($error_page);

		return $ObjectError;

	}

	public static function conditional_routing_header($ObjectRoute) {

		$headers = apache_request_headers();

		if ( array_key_exists("C-Conditional-route", $headers) ) {

			$ObjectRoute->setTarget("vendor/comodojo/dispatcher.servicebundle.test/services/test_route_second.php")
		}

		return $ObjectRoute;

	}

}

$pt = new plugintest();

$dispatcher->addHook("dispatcher.error.404", $pt, "custom_404");

$dispatcher->addHook("dispatcher.serviceroute.test_route_first", $pt, "conditional_routing_header");

?>