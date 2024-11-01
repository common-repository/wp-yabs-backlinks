<?php 
/*
Plugin Name: WP YaBS Backlinks
Plugin URI: http://tigor.me/wp-yabs-backlinks/
Description: Show Yandex Blogsearch Backlinks in sidebar.
Version: 0.4.0.1
Author: TIgor
Author URI: http://tigor.org.ua
License: GPL2
*/


/*  Copyright 2010 Tesliuk Igor  (email : tigoria@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

load_textdomain('wp_yabs_backlinks',ABSPATH.'wp-content/plugins/wp-yabs-backlinks/translation/'. get_locale().'.mo');



function options_wp_yabs_backlinks() { 
?>     <div class="wrap">

        <h2>WP YaBS Options</h2>

        <form method="post" action="options.php">

            <?php settings_fields('wp_yabs_backlinks_group'); ?>

            <?php $options = get_option('wp_yabs_backlinks');	
			$options['blacklist'] = str_replace(' ', '', $options['blacklist']);
			$options['ft'] = str_replace(' ', '', $options['ft']);
			update_option('wp_yabs_backlinks', $options);
			
			
			?>
			

            <table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Posts to proceed at one WP Cron run','wp_yabs_backlinks')?></th>

                    <td><input type="text" name="wp_yabs_backlinks[atonce]" value="<?php echo $options['atonce']; ?>" /></td>
					<td><?php _e('More posts - more execution time and memory usage(default: 10).','wp_yabs_backlinks')?></td>

                </tr>
				
				<tr valign="top"><th scope="row"><?php _e('Items in Yandex Search query','wp_yabs_backlinks')?></th>

                    <td><input type="text" name="wp_yabs_backlinks[numdoc]" value="<?php echo $options['numdoc']; ?>" /></td>
					
					<td><?php _e('How many results are posted on search page. Some backlinks could be lost if value is to low (default: 10)','wp_yabs_backlinks')?></td>
			
                </tr>

				<tr valign="top">
				
					<th scope="row"><?php _e('Which types to include is search','wp_yabs_backlinks')?></th>

                    <td><input type="text" name="wp_yabs_backlinks[ft]" value="<?php echo $options['ft']; ?>" /></td>
					
					<td><?php _e('Which types to search: popular blogs(<b>popular</b>), blog posts(<b>blog</b>), community blogs (<b>community</b>), personal blogs (<b>personal</b>), blog comments(<b>comments</b>), forums (<b>forum</b>), all sources (<b>all</b>). You can use several parametrs(coma separated). Default: all. ','wp_yabs_backlinks')?></td>

                </tr>
				
				<tr valign="top">
					<th scope="row"><?php _e('Post ID that will be processed in next Cron run','wp_yabs_backlinks')?></th>

                    <td><input type="text" name="wp_yabs_backlinks[last_post]" value="<?php echo $options['last_post']; ?>" /></td>
					
					<td><?php _e('You can change this, to set certain post id for next Cron run.','wp_yabs_backlinks')?></td>

                </tr>
				
				
				<tr valign="top">
					<th scope="row"><?php _e('Exclude domains','wp_yabs_backlinks')?></th>

                    <td><textarea  cols="40" rows="5" name="wp_yabs_backlinks[blacklist]" /><?php echo $options['blacklist']; ?></textarea></td>
					
					<td><?php _e('Exclude backlinks from domains. Coma separated.','wp_yabs_backlinks')?></td>

                </tr>
				

				
                



            </table>

            <p class="submit">

            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />

            </p>

        </form>

    </div>    <?php  
	
	

	
}


// Options Page End

/*function add_wp_yabs_backlinks_stylesheet() {
        $myStyleUrl = WP_PLUGIN_URL . '/wp-yabs-backlinks/wp-yabs-backlinks.css';
        $myStyleFile = WP_PLUGIN_DIR . '/wp-yabs-backlinks/wp-yabs-backlinks.css';
        if ( file_exists($myStyleFile) ) {
            wp_register_style('myStyleSheets', $myStyleUrl);
            wp_enqueue_style( 'myStyleSheets');
        }
    }
*/


function wp_yabs_insert_pingback($yabs) {

$data = array (
	'comment_post_ID' => $yabs['post_ID'],
    'comment_author' => $yabs['title'],
    'comment_author_email' => $yabs['email'],
    'comment_author_url' => $yabs['link'],
    'comment_content' => $yabs['description'],
    'comment_type' => 'pingback',
    'comment_parent' => 0,
    'user_id' => 0,
    'comment_author_IP' => '',
    'comment_agent' => 'WP YABS plugin ver:4.0',
    'comment_date' => (string)wp_yabs_convert_date($yabs['time']),
    'comment_approved' => 0,

);


	

return wp_insert_comment($data);
}


function wp_yabs_convert_date($date) {
	$string = 'Wed, 07 Dec 2011 22:26:59 GMT';
	
	
	$pattern = '/(\w+), (\d+) (\w+) (\d+) (\d+):(\d+):(\d+)/';
	$replacement = '$4-$3$2 $5:$6:$7';
	$result = preg_replace($pattern, $replacement, $date);
	
	$month = $result[5].$result[6].$result[7];
	
	switch ($month) {
		case 'Jan' : $month = '01-';
			break;
		case 'Feb' : $month = '02-';
			break;
		case 'Mar' : $month = '03-';
			break;
		case 'Apr' : $month = '04-';
			break;
		case 'May' : $month = '05-';
			break;
		case 'Jun' : $month = '06-';
			break;
		case 'Jul' : $month = '07-';
			break;
		case 'Aug' : $month = '08-';
			break;
		case 'Sep' : $month = '09-';
			break;
		case 'Oct' : $month = '10-';
			break;
		case 'Nov' : $month = '11-';
			break;
		case 'Dec' : $month = '12-';
			break;
	
	
	
	}
	
	$result[5] = $month[0];
	$result[6] = $month[1];
	$result[7] = $month[2];
	
	
	
	$string = implode('',$result);

	
	return $string;
	}


	

function wp_yabs_get_xml($post_url) {




$options = get_option('wp_yabs_backlinks');

$url = 'http://blogs.yandex.ru/search.rss?link='.$post_url.'&ft='.$options['ft'].'&numdoc='.$options['numdoc'];




return simplexml_load_file($url);

}

function wp_yabs_check_pings($this_post){
	$xml = wp_yabs_get_xml(site_url().'/'.$this_post['post_name']);
	foreach ($xml->channel->item as $item)
		{
		
		
		
		$data['post_id'] = $this_post['ID'];
		$guid = (string) $item->link;
		$data['author_email'] = wp_yabs_email_creator($guid);
		
		$comments = get_comments($data);
		$data ['status'] = 'spam';
		$comments = $comments + get_comments($data);
		$data ['status'] = 'trash';
		$comments = $comments + get_comments($data);
		
		$duplicate = false;
		foreach($comments as $comment) 
			{
				if ($comment->comment_author_url == $guid)
					{$duplicate = true;

					
					}
				
			}
		 
		
		if (((!$duplicate) AND (! wp_yabs_in_blacklist($guid)))) {
			$yabs = array (
			'post_ID' => $this_post['ID'],
			'title' => (string) $item->title,
			'email' => wp_yabs_email_creator($guid),
			'link' => (string) $item->link,
			'description' => (string) $item->description,
			'time' => (string) $item->date,
			);
			wp_yabs_insert_pingback($yabs);
			}
		
		}


}



function wp_yabs_in_blacklist($link) {
	$options = get_option('wp_yabs_backlinks');
	$return = false;
	preg_match('@^(?:http://)?([^/]+)@i',    $link, $matches);
	$host = $matches[1];
	$blacklist = explode(",", $options['blacklist']);
		foreach ($blacklist as $black)
			{
			
			

			
			
			if (stripos($host,$black) !== false)
				{
				$return = true;

				}
			}
	return $return;
	
}

function wp_yabs_email_creator($link)	{
	preg_match('@^(?:http://)?([^/]+)@i',    $link, $matches);
	
	return 'wp-yabs-fake-mail@'.$matches[1];	
}
	
function register_yabs_settings() {
register_setting('wp_yabs_backlinks_group','wp_yabs_backlinks');
}


function menu_wp_yabs_backlinks() {
add_options_page('WP YaBS Backlinks', 'WP YaBS Backlinks', 'manage_options', 'wp_yabs_backlinks', 'options_wp_yabs_backlinks');

add_action( 'admin_init', 'register_yabs_settings' );

}

function wp_yabs_backlinks_init() {
	// register_sidebar_widget(__('wp_yabs_backlinks'), 'widget_wp_yabs_backlinks');
	// register_widget_control(__('wp_yabs_backlinks'), 'control_wp_yabs_backlinks');
}
// add_action('wp_yabs_trackbacks', 'wp_yabs_trackbacks');
add_action("plugins_loaded", "wp_yabs_backlinks_init");
// add_action('wp_print_styles', 'add_wp_yabs_backlinks_stylesheet');
add_action('admin_menu',"menu_wp_yabs_backlinks");


register_activation_hook(__FILE__, 'wp_yabs_activation');
add_action('wp_yabs_hourly_event', 'wp_yabs_hourly');

function wp_yabs_activation() {
	wp_schedule_event(time(), 'hourly', 'wp_yabs_hourly_event');
	$options = get_option('wp_yabs_backlinks');
		if ($options['atonce'] == '')
			{
			$options['atonce'] = 10;
			}
		if ($options['ft'] == '')
			{
			$options['ft'] = all;
			}
		if ($options['numdoc'] == '')
			{
			$options['numdoc'] = 10;
			}
	 update_option('wp_yabs_backlinks', $options);
	
}

function wp_yabs_hourly() {
	$options = get_option('wp_yabs_backlinks');
	$post_id = $options['last_post'];
	$args = array( 'numberposts' => 1,'post_status'     => 'publish' );
	$lastposts = get_posts( $args );
		foreach ($lastposts as $lastpost) {$max_post_id = $lastpost->ID;}
	
	$i = 0;
	while ($i <= $options['atonce']) {
		
		if ($max_post_id < $post_id)
			{$post_id = 0;}
		$this_post = get_post($post_id, ARRAY_A);
		


		
		if (($this_post['ping_status']=='open') and ($this_post['post_status']=='publish'))
			{
	
			$i = $i + 1;
			wp_yabs_check_pings($this_post);
			
			



			}
		$post_id = $post_id + 1;
		}
	 $options['last_post'] = $post_id;
	 update_option('wp_yabs_backlinks', $options);
}

register_deactivation_hook(__FILE__, 'wp_yabs_deactivation');

function wp_yabs_deactivation() {
	wp_clear_scheduled_hook('wp_yabs_hourly_event');
}

?>