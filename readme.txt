=== Simple Crumbs ===
Contributors: Can Koluman
Tags: comments, spam
Requires at least: 2.7
Tested up to: 2.7.1
Stable tag: 0.1.6


== Description ==
Summary: Allows for breadcrumbs in WordPress. Requires permalinks.

Simple Breadcrumbs - Generates a breadcrumb trail for pages and blog entries. Requires use of permalinks, and php > 4.1.0, tested WP 2.7x.

Notes: link/crumb information from $query_string, page/post information from $post, using permalink info for making links, using permalink structure for bootstrapping unrolled recursions (deepest to topmost)

Author URI: http://www.cankoluman.com

Usage Examples:
Usage: <?php echo do_shortcode('[simple_crumbs root="Home" /]') ?>
Usage: [simple_crumbs root="Some Root" /]
Usage: [simple_crumbs /]

Released under GNU v2 June 1991


== Installation ==

A. Configuration Options
----------------------------------
1. Document Root Crumb name passed to function
2. Following css class may be defined externally: navCrumb.lnk if needed.
3. Separator may be chosen

B. Installation
----------------------------------
0. Copy to plugins folder
1. Use:
from php: <?php echo do_shortcode('[simple_crumbs root="Home" /]') ?>
from html with document root: [simple_crumbs root="Some Root" /]
from html without document root: [simple_crumbs /]
