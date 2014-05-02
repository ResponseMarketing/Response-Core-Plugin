=== Plugin Name ===

Contributors: Bryan Bielefeldt, Joachim Kudish

Tags: private, organization plugin

Requires at least: 3.9

Tested up to: 3.9

Stable tag: 0.3

License: GPLv2 or later

License URI: http://www.gnu.org/licenses/gpl-2.0.html

~Current Version:0.3~

Usage Instructions
===========

* Update the $config array with your github information

* In v1.6, the updater can pick up the version from the plugin header as well.

* You will need to update the version number anytime you update the plugin, this will ultimately let the plugin know that a new version is available.

* Support for private repository can be enabled by uncommenting the access_token config option and then setting the field in the wp-admin dashboard
	<pre>
		'access_token' => '', // Access private repositories by authorizing under Appearance > Github Updates when this 
	</pre>

Changelog
===========

### 0.2 (test update)

### 0.1 (initial release)

Credits
===========

The original updater class is built and maintained by [Joachim Kudish](http://jkudish.com "Joachim Kudish")

License
===========

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to:

Free Software Foundation, Inc.
51 Franklin Street, Fifth Floor,
Boston, MA
02110-1301, USA.
