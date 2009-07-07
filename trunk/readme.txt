=== Simple Crumbs ===
Contributors: Can Koluman
Tags: breadcrumbs, navigation
Requires at least: 2.7
Tested up to: 2.8
Stable tag: 0.2.3


Summary: Generates navigation bread crumbs in WordPress. Requires permalinks.

== Description ==


Simple Breadcrumbs - Generates a breadcrumb trail for pages and blog entries. Requires use of permalinks, and php > 4.1.0, tested WP 2.7x, 2.8.  

**Notes:** link/crumb information from $query_string, page/post information from $post, using permalink info for making links, using permalink structure for bootstrapping unrolled recursions (deepest to topmost).  
Author URI: http://www.strawberryfin.co.uk


== Changelog ==


Version: 0.2.3  
fixes in this version:    
* Missing function `sc_unpack_query_string` added. Yes! it actually works now. Sorry about the earlier omission.  
* Multiple article category handling added.    
  


**Usage Examples:** 
---------------------------------- 
*	  Usage: `<?php echo do_shortcode('[simple_crumbs root="Home" /]') ?>`  
*	  Usage: `[simple_crumbs root="Some Root" /]`  
*	  Usage: `[simple_crumbs /]`


**Sample Output:** (with Home as 'root') 
---------------------------------- 
1. Home > Section > Subsection
1. Home > Blog > 2009 > 04 > 01 > Blog Title  
1. Home > Search Results  
1. Home > Tag > Tag Name  

Released under GNU v2 June 1991


== Installation ==

A. Configuration Options
----------------------------------
1. Document Root Crumb name passed to function.
1. Following css class may be defined externally: navCrumb.lnk if needed.
1. Separator may be chosen.  


B. Installation
----------------------------------
1. Copy to plugins (`/wp-content/plugins/`) folder
1. Usage:  
* from php: `<?php echo do_shortcode('[simple_crumbs root="Home" /]') ?>`  
* from html with document root: `[simple_crumbs root="Some Root" /]`  
* from html without document root: `[simple_crumbs /]`