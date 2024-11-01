=== WP YaBS Backlinks ===
Contributors: TIgor4eg
Donate link: http://tigor.org.ua/donate/
Tags: yandex, backlinks, blogsearch, trackback, pingback
Requires at least: 3.0
Tested up to: 3.3
Stable tag: 0.4.0.1

Plugin shows backlinks from blogs.yandex.ru in widget area.

== Description ==

Plugin search backlinks in <a href="http://blogs.yandex.ru">Yandex Blog Search</a> and add them as pingbacks.
<a href="http://tigor.org.ua/wp_yabs_backlinks/">Russian description</a>
You can add domains to blacklist.This plugin uses hourly CronJob to search backlinks.

== Installation ==

1. Upload '/wp-yabs-backlinks/' to the '/wp-content/plugins/' directory2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure plugin through WP YaBS Backlinks menu in Options4. Every hour plugin scans backlinks to certain posts5. Backlinks are showed as an unapproved pingbacks in comments section
== FAQ ==Q: Why you don't use Google?A: Google does not support search for backlinks for individual pages. If you know how it can be done, mail me.

== Changelog ==
= 0.4.0.1 =* FIX: Comments already in trash and spam are ignored.= 0.4 =* NEW: WP-Cron job every hour* NEW: Backlinks are processed as pingbacks= 0.3 =Bad brunch, never released to public
= 0.2.1 =
*Added translation
*Added wp_yabs_trackbacks() function

= 0.2 =
*Added caching
*Added blacklist
*Added options page


= 0.1 =
* First stable version


