<?php
/*
Plugin Name: MyCommentAuthors
Plugin URI: http://enstinemuki.com/my-comment-authors
Description: Generate a list of all your comment authors monthly. Publish the list on your blog and give them a shout out.
Version: 2.0
Author: Enstine Muki
Author URI: http://enstinemuki.com
*/
//////////////////////////////
define( 'mca_PATH', plugin_dir_path(__FILE__) );
function mca_install()
	{
		global $wpdb;
		$tableName=$wpdb->prefix."mca_settings";
		$admin_email=get_option("admin_email");
		$blogname=get_option("blogname");
		add_option("mca_db_version","1.0");
		add_option("mca_mail_limit","450");
		add_option("MyCommentAuthors",'');
		add_option("mca_Mail_From_Name","$blogname");
		add_option("mca_Mail_From_Email","$admin_email");
		add_option("mca_Reserve_List","$admin_email");
		add_option("mca_gravatar_bg","#EBEBEB");
		add_option("mca_gravatar_border","#CCCCCC");


	}
function mca_pre_data()
	{
		global $wpdb;
		$tableName=$wpdb->prefix."mca_settings";
	    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
		require_once('mca_sql_install_data.php');
	}

register_activation_hook(__FILE__,'mca_install');
register_deactivation_hook(__FILE__,'mca_destroy');

////////////////////Function to remove plugin
function mca_destroy()
	{
		delete_option('MyCommentAuthors');
		delete_option('mca_db_version');
		delete_option('mca_mail_limit');
		delete_option('mca_Mail_From_Name');
		delete_option('mca_Mail_From_Email');
		delete_option('mca_Reserve_List');
	}

	

///Function admin menu
function mcaAdminMenu()
	{
		add_options_page('Plugin Admin Options','MyCommentAuthors','manage_options','mycommentauthors','mcaMainPage');
	}


add_action('admin_init', 'mca_init' );
add_action('admin_menu', 'mcaAdminMenu');

function mca_init()
	{
		register_setting( 'mca_Options', "MyCommentAuthors", 'mca_validate' );
	}

// Draw the menu page itself
function mcaMainPage() {
	
	echo"<div class=\"wrap\">
	<div id=\"mainblock\">";
	////Show form here
			require_once('mca-home.php');
	
	echo"</div>";
	
}
add_action('wp_dashboard_setup', 'mca_dashboard_widgets');
function mca_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'TOP 3 COMMENT AUTHORS OF ALL TIMES', 'mca_custom_dashboard_help');
}
function mca_custom_dashboard_help() {
			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			global $wpdb;
			$tblPrf=$wpdb->prefix;
			$default_admin_email = get_option("admin_email");

$reserveList=get_option("mca_Reserve_List");

$where=" NOT comment_author_email ='".$default_admin_email."'";
$em=explode(',',$reserveList);
foreach($em as $emNt)
		{
		$where.=" AND NOT comment_author_email ='$emNt'";
		}

	$query="SELECT comment_author as Commentator, comment_author_url as URL, comment_author_email as e, COUNT(*) as NumCom 
FROM ".$tblPrf."comments WHERE  ($where) AND comment_approved ='1' AND comment_type =''  GROUP BY comment_author ORDER BY COUNT(*) DESC LIMIT 3";
$result=$wpdb->get_results($query);

echo"<br>
				<i>Excluding Admin Comments</i>
						";
				$countAuthors=0;
				$countComments=0;
				foreach($result as $gCom)
					{
						$countAuthors++;
						$url=$gCom->URL;
						
						if(empty($url))
							{
								$author=$gCom->Commentator;
							}
								else
							{
								$author="<a href=\"".$gCom->URL."\" target=\"_blank\">".$gCom->Commentator."</a>";
							}
					if($gCom->NumCom > 1 )
						{
							$s="s";
						}
							else
						{
							$s="";
						}
					/////////////////////::Random dropped or made
/*					$r=rand(1,2);
							if($r==1)
								{
									$rt="dropped";
								}
									else
								{
									$rt="made";
								}
						echo"<li>$author $rt <b>".$gCom->NumCom." comment".$s."</b></li>";
					
*/
$grav_url = "http://www.gravatar.com/avatar/".md5(strtolower($gCom->e))."?d=".urlencode($default)."&s=30";
						
echo "<div style=\"background-color: ".get_option("mca_gravatar_bg")."; padding: 2px; border: 1px solid ".get_option("mca_gravatar_border").";text-align:center; margin:3px; width:100px\"><img src=\"$grav_url\" border=\"0\" vspace=\"5\" hspace=\"5\"><br><b>$author</b><br><b>".$gCom->NumCom." comment".$s."</b></div><br>";
					}
						echo"<br><br><b>MyCommentAuthors Sponsors: <a href=\"http://worthblogger.com/\" target=\"_blank\">WorthBlogger</a> | <a href=\"http://enstinemuki.com/xtheme-mca\" target=\"_blank\">x-Theme</a></b>";
}
//////////////////////////////Add the widget to this plugin
class MyCommentAuthors extends WP_Widget {
function MyCommentAuthors()
  {
    $widget_ops = array('classname' => 'MyCommentAuthors', 'description' => 'Show the most active commentators since the history of your blog' );
    $this->WP_Widget('MyCommentAuthors', 'MyCommentAuthors', $widget_ops);
  }


function form($instance) {

// Check values
if( $instance) {
$title = esc_attr($instance['title']);
$mcaNum = $instance['mcaNum'];
	} 
	else 
	{
		$title = '';
		$mcaNum = '5';
	}
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('mcaNum'); ?>"><?php _e('Number of Commentators to show', 'wp_widget_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('mcaNum'); ?>" name="<?php echo $this->get_field_name('mcaNum'); ?>" type="text" value="<?php echo $mcaNum; ?>" />
</p>


<?php
}
function update($new_instance, $old_instance) 
{
$instance = $old_instance;
// Fields
if(empty($new_instance['mcaNum']))
	{
		$new_instance['mcaNum'] = 5;
	}
$instance['title'] = strip_tags($new_instance['title']);
$instance['mcaNum'] = strip_tags($new_instance['mcaNum']);
return $instance;
}
// display widget
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = apply_filters('widget_title', $instance['title']);
$mcaNum = $instance['mcaNum'];
echo $before_widget;
if (!empty($title))
{
    echo $before_title . $title . $after_title;
}
	

/////Show widget

	require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			global $wpdb;
			$tblPrf=$wpdb->prefix;
			$default_admin_email = get_option("admin_email");
			$reserveList=get_option("mca_Reserve_List");

$where=" NOT comment_author_email ='".$default_admin_email."'";
$em=explode(',',$reserveList);
foreach($em as $emNt)
		{
		$where.=" AND NOT comment_author_email ='$emNt'";
		}

	$query="SELECT comment_author as Commentator, comment_author_url as URL, comment_author_email as e, COUNT(*) as NumCom 
FROM ".$tblPrf."comments WHERE ($where) AND comment_approved ='1' AND comment_type ='' GROUP BY comment_author ORDER BY COUNT(*) DESC LIMIT $mcaNum";
$result=$wpdb->get_results($query);
echo"<ul>";
				$countAuthors=0;
				$countComments=0;
				foreach($result as $gCom)
					{
						$countAuthors++;
						$url=$gCom->URL;
						
						if(empty($url))
							{
								$author=$gCom->Commentator;
							}
								else
							{
								$author="<a href=\"".$gCom->URL."\" target=\"_blank\" rel=\"nofollow\">".$gCom->Commentator."</a>";
							}
					if($gCom->NumCom > 1 )
						{
							$s="s";
						}
							else
						{
							$s="";
						}
$grav_url = "http://www.gravatar.com/avatar/".md5(strtolower($gCom->e))."?d=".urlencode($default)."&s=60";
						
echo "<li><img src=\"$grav_url\" border=\"0\" vspace=\"5\" hspace=\"5\" align=\"left\" style=\"padding:2px; border:1px solid #999999;  background-color:#F9F8F7;\"><b>$author </b> <br><b>".$gCom->NumCom."</b>	 awesome comment".$s."<br><BR></li>";
					}
					echo"</ul>";
//////////////End widget

echo $after_widget;
}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("MyCommentAuthors");'));

?>
