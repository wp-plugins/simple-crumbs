<?php
/*
@Plugin Name: Simple Crumbs
@Description: Simple Crumbs - Generates a breadcrumb trail for pages and blog entries. Requires use of permalinks, and php > 4.1.0, tested WP 2.7
@Note: link/crumb information from $query_string
@Note: page/post information from $post
@Note: using permalink info for making links
@Note: using permalink structure for bootstrapping unrolled recursions (deepest to topmost)
@Author: Can Koluman
@Version: 0.1.6
Author URI: http://design.cankoluman.com/
Usage Examples:
Usage: <?php echo do_shortcode('[simple_crumbs root="Home" /]') ?>
Usage: [simple_crumbs root="Some Root" /]
Usage: [simple_crumbs /]
License: Released under GNU v2 June 1991
*/

function get_path_titles ($post, &$titles) {
	$post_parent;

	if ($post->post_parent) {
		$post_parent = get_post($post->post_parent);
		$titles[$post_parent->post_name] = "$post_parent->post_title";
		get_path_titles ($post_parent, &$titles);
	}
	return;
}


// mimics get_permalink, does not parse
// page numbers
// returns ordered string
function make_permalink($array, $post_type) {

	if (isset($array['s'])) return 'Search Results'; 

	$base_URL = get_bloginfo( 'url' );	
	$permalink = get_permalink();

	switch ($post_type) {

		//reconstruct permalink to match link selection
		case 'post':
			$permalink = '/';
			if (isset($array['category_name'])) $permalink .= urldecode($array['category_name']) . '/';
			if (isset($array['year'])) $permalink .= urldecode($array['year']) . '/';
			if (isset($array['monthnum'])) $permalink .= urldecode($array['monthnum']) . '/';
			if (isset($array['day'])) $permalink .= urldecode($array['day']) . '/';
			if (isset($array['name'])) $permalink .= urldecode($array['name']) . '/';
			
			if (isset($array['tag'])) $permalink .= 'tag/'.urldecode($array['tag']) . '/';
			
			break;
	
		case 'page':		
		case 'attachment':
		default:		
			$permalink = str_replace( $base_URL, '', $permalink );

	}
	
	//strip first and last '/'
	//we will add these later
	$permalink = preg_replace('/^\/(.+)\/$/', '${1}', $permalink);
	
	return $permalink;

}



function simplecrumbs_shortcode ( $attr )
{
	$divider = ' &gt; ';
	$titles = '';
	$titles_divider = '|^|';
	$theCrumb = array( );
	$strCrumb = '';
	$baseURL = get_bloginfo( 'url' );


	//use post id to get original title
	//note: ideally should sanitise title to HTML conformant
	global $post;
	global $query_string;
	$query_array = unpack_query_string($query_string);

	extract(shortcode_atts(array(
		'root'		 =>	''
	), $attr));	
	
	
	$postID = (int) $post->ID;
	$post_name = $post->post_name;
	$post_type = $post->post_type;  //select page (default) versus post
	
	//templating
	$htmlTemplate = '<a class="navCrumb lnk" href="[__1__]">[__2__]</a>';
	$pattern = array('/\[__1__\]/','/\[__2__\]/');
	
	
	//make permalink from query string
	$permalink = make_permalink($query_array, $post_type);
	
	$titles[$post_name] = get_the_title($postID);
	get_path_titles ($post, $titles);
	

	//populate crumb structure
	if ($root) 
	{
		$replace = array($baseURL,ucfirst($root));
		$strCrumb = preg_replace($pattern, $replace, $htmlTemplate);
	}

	
	$tok = strtok( $permalink, '/');


	while  ($tok ) 
	{		
		$baseURL .= sprintf("/$tok");
		
		$strCrumb .= ($strCrumb) ? $divider : '';
		switch ($tok) {
			
			// breadcrumb components which are not linked
			// can be customised
			case 'attachment':
			case 'share':
			case 'tag':
			case 'Search Results':
				$strCrumb .= ucfirst($tok);		
				break;
		
			default:
				if (isset($query_array['tag'])) $titles[$tok] = single_tag_title("", false);
				$replace = (isset($titles[$tok])) ? array($baseURL . '/', $titles[$tok]) : array($baseURL . '/', ucfirst($tok));
				$strCrumb .= preg_replace($pattern, $replace, $htmlTemplate);
		}
		
		$tok = strtok( '/' );
			
	}

	return $strCrumb;
	
}

add_shortcode('simple_crumbs', 'simplecrumbs_shortcode');
?>