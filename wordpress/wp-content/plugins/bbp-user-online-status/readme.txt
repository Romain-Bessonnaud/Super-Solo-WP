=== bbp user online status ===
Contributors: abreksa4
Tags: bbpress, forums, user online, user offline
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A Wordpress plugin to show user online/offline statuses in bbpress topics and replies

== Description ==

Simply adds an "Online" or "Offline" under the author information in [bbpress](https://bbpress.org/) topics and replies.

Parts of code adapted from Robin Wilson's [bbp profile information](https://wordpress.org/plugins/bbp-profile-information/), Raul Illana's [Awebsome! Online Registered Users Widget](https://wordpress.org/plugins/awebsome-online-registered-users-widget/), and from [onetrickpony](http://wordpress.stackexchange.com/questions/34429/how-to-check-if-a-user-not-current-user-is-logged-in) at stackoverflow.

== Installation ==

1. Upload the plugin zip to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Activate the Online/Offline status message by going to 'Settings' -> 'bbp user online status'
4. Style li.bbp-online-status span.bbp-offline and li.bbp-online-status span.bbp-online

== Frequently Asked Questions ==

= How does BBP User Online Status check keep track of who's online? =

Whenever a user logs in or logs out, a variable is set or unset respectively. If a user doesn't logout, 
if the user has been inactive for more than 15 minuets, there status is set as offline. 

== Screenshots ==

1. Online status (redacted IP, line break isn't a bug)
2. Offline status
3. Settings

== TODO ==

* Make inactive time configurable
* Include images in addition to text (configurable)
* Make location configurable
* Make text configurable

== Changelog ==

= 1.1 =
* added CSS styling (from https://github.com/jacobwarduk/bbp-user-online-status/commit/55a3084ee106fe5d911ce2191a28091092da7b6c)

= 1.0 =
* basic Online/Offline message
