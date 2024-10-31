<?php
			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			global $wpdb;
			$tblPrf=$wpdb->prefix;
			$default_admin_email = get_option("admin_email");
			$option = get_option("mca_mail_limit");
			
	 
function getFeed($feed_url,$limit) {
     
    $content = @file_get_contents($feed_url);
    $x = @new SimpleXmlElement($content);
     
    
    $i = 0;
    foreach($x->channel->item as $entry) {
	
    if ($i < $limit)
		 {
		 	        echo "<b><a href=\"$entry->link?utm_source=$entry->link&utm_medium=".$_SERVER['HTTP_HOST']."&utm_campaign=MyCommentAuthors\" title=\"$entry->title\" target=\"_blank\">" . $entry->title . "</a></b>";
					
					if($i < ($limit-1))
						{
							echo"<hr size=\"1\" noshad>";
						}
					
  		  }
		  	else
		{
			break;
		}
		$i++;
    }
}

?>
<style type="text/css">
<!--
.style1 {
	color: #0066CC;
	font-weight: bold;
}
.style12 {font-weight: bold}
-->
</style>
<table width="100%" border="0"  class="widefat">
  <tr>
    <td valign="top"><form name="form1" method="post" action="<?php echo "options-general.php?page=".$_GET['page']; ?>">
      <table width="100%" border="0">
        <tr>
          <td width="71%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="7"><h1><strong><font color="#0066CC">MyCommentAuthors</font></strong></h1></td>
              </tr>
              <tr>
                <td colspan="7"><hr size="1" noshade="noshade" /></td>
              </tr>

              <tr>
                <td width="15%"><strong><font color="#0066CC">Month</font></strong></td>
                <td width="8%"><div align="left"><strong><font color="#0066CC">Year</font></strong></div></td>
                <td width="17%"><font color="#0066CC"><strong>Dofollow limit</strong></font></td>
                <td width="16%"><font color="#0066CC"><strong>Option</strong></font></td>
                <td width="14%"><strong><font color="#0066CC">Page break</font></strong></td>
                <td width="19%"><strong><font color="#0066CC">Template</font></strong></td>
                <td width="11%">&nbsp;</td>
                </tr>
              <tr>
                <td>
                
                <select name="mth" id="mth">
                <?php
					if(!isset($_POST['mth']))
						{
				?>
						                    <option value="01,Jan" selected="selected" >January</option>
				<?php
                }
					else
				{
				?>
                    <option value="01,January" <?php if($_POST['mth'] == "01,January") { echo"selected=\"selected\""; } ?> >January</option>
                   <?php
				   }
				   ?>
                    <option value="02,February" <?php if($_POST['mth'] == "02,February") { echo"selected=\"selected\""; } ?> >February</option>
                    <option value="03,March" <?php if($_POST['mth'] == "03,March") { echo"selected=\"selected\""; } ?> >March</option>
                    <option value="04,April" <?php if($_POST['mth'] == "04,April") { echo"selected=\"selected\""; } ?> >April</option>
                    <option value="05,May" <?php if($_POST['mth'] == "05,May") { echo"selected=\"selected\""; } ?> >May</option>
                    <option value="06,June" <?php if($_POST['mth'] == "06,June") { echo"selected=\"selected\""; } ?> >June</option>
                    <option value="07,July" <?php if($_POST['mth'] == "07,July") { echo"selected=\"selected\""; } ?> >July</option>
                    <option value="08,August" <?php if($_POST['mth'] == "08,August") { echo"selected=\"selected\""; } ?> >August</option>
                    <option value="09,September" <?php if($_POST['mth'] == "09,September") { echo"selected=\"selected\""; } ?> >September</option>
                    <option value="10,October" <?php if($_POST['mth'] == "10,October") { echo"selected=\"selected\""; } ?> >October</option>
                    <option value="11,November" <?php if($_POST['mth'] == "11,November") { echo"selected=\"selected\""; } ?> >November</option>
                    <option value="12,December" <?php if($_POST['mth'] == "12,December") { echo"selected=\"selected\""; } ?> >December</option>
                </select></td>
                <td><select name="yr" id="yr">
                <?php
				if(!isset($_POST['yr']))
					{
				?>
        <option value="<?php echo date("Y"); ?>"  selected="selected"><?php echo date("Y"); ?></option>
			<?php
				}
					else
				{
			?>
                  <option value="<?php echo date("Y"); ?>"  <?php if($_POST['yr'] == date("Y")) { echo"selected=\"selected\""; } ?> ><?php echo date("Y"); ?></option>

       	<?php
		}
		?>
      <option value="<?php echo (date("Y")-1); ?>" <?php if($_POST['yr'] == (date("Y")-1)) { echo"selected=\"selected\""; } ?> ><?php echo (date("Y")-1); ?></option>

                </select></td>
       <td><input name="ltype" type="text" id="ltype" value="<?php if(isset($_POST['ltype'])) { echo $_POST['ltype']; } else { echo"20"; } ?>" size="1" maxlength="3" />
                  <a title="Everyone with comment count &gt;= this number will be given a dofollow link. Set to 0 to disable DOFOLLOW">?</a></td>
                <td><label>
                  <select name="showTable" id="showTable">
                  <?php
				if(!isset($_POST['showTable']))
					{
				?>
        <option value="NO"  selected="selected">Get HTML</option>
			<?php
				}
					else
				{
			?>
                  <option value="NO" <?php if($_POST['showTable'] == "NO") { echo"selected=\"selected\""; } ?>>Get HTML</option>
			<?php
            }
            ?>
                <option value="YES" <?php if($_POST['showTable'] == "YES") { echo"selected=\"selected\""; } ?>>Preview</option>
                  </select>
                  </label></td>
                <td><input name="mca_page_break" type="text" id="mca_page_break" value="<?php if(isset($_POST['mca_page_break'])) { echo $_POST['mca_page_break']; } else { echo"0"; } ?>" size="1" maxlength="2" />
                 <a title="If the number of comments is too long, you may want to break it into multiple pages. Here, enter the number of comments per page">?</a></td>
                <td><label>
                  <select name="temp" id="temp">
                   <?php
				if(!isset($_POST['temp']))
					{
				?>
     			  <option value="gtbl"  selected="selected">Gravatar Table</option>
			<?php
				}
					else
				{
			?>
                                      <option value="gtbl" <?php if($_POST['temp'] == "gtbl") { echo"selected=\"selected\""; } ?>>Gravatar Table</option>
				<?php
				}
				?>
                    <option value="gbox" <?php if($_POST['temp'] == "gbox") { echo"selected=\"selected\""; } ?>>Gravatar Box</option>
                    <option value="stxt" <?php if($_POST['temp'] == "stxt") { echo"selected=\"selected\""; } ?>>Simple Text List</option>
                  </select>
                </label></td>
                <td><input name="ShowAuthors" type="submit" id="ShowAuthors" value="Generate" class="button-primary"/></td>
                </tr>
              <tr>
                <td colspan="7"><hr size="1" noshade="noshade" /></td>
                </tr>
            </table>
            
              <p>
                <?php
		///////////////Save option
		if(isset($_POST['MailLimEdit']))
			{
				$mailLim=$_POST['mLim'];
				$admin_email_frm=$_POST['admin_email'];
				$blogname_frm=$_POST['blogname'];
				$gravatar_bg=$_POST['gravatar_bg']; //get_option("mca_gravatar_bg");
  				$gravatar_border=$_POST['gravatar_border']; //get_option("mca_gravatar_border");
				$reserveList=trim(strip_tags($_POST['reserveList']),',');

				if(($mailLim < 451 ) AND ($mailLim > 0) AND !empty($blogname_frm) AND !empty($admin_email_frm))
					{
						///Modify uption
						update_option("mca_mail_limit",esc_html($mailLim));
						update_option("mca_Mail_From_Name",esc_html($blogname_frm));
						update_option("mca_Mail_From_Email",esc_html($admin_email_frm));
						update_option("mca_gravatar_bg",esc_html($gravatar_bg));
						update_option("mca_gravatar_border",esc_html($gravatar_border));
						update_option("mca_Reserve_List",esc_html($reserveList));


						echo"<div id=\"message\" class=\"updated fade\" style=\"padding:8px\">Mailing Limit Updated</div>";
					}
						elseif(empty($mailLim) OR empty($blogname_frm) OR empty($admin_email_frm))
					{
					echo"<div id=\"message\" class=\"error fade\" style=\"padding:8px\">Fail! Empty fields not accepted</div>";

					}
						else
					{
						echo"<div id=\"message\" class=\"error fade\" style=\"padding:8px\">Fail! For security reasons, your limit should not exceed 450 mails per hour</div>";
					}
			}

		$mcaMailLim = get_option("mca_mail_limit");
		$blogname=get_option("mca_Mail_From_Name");
		$admin_email=get_option("mca_Mail_From_Email");
		$gravatar_bg=get_option("mca_gravatar_bg");
		$gravatar_border=get_option("mca_gravatar_border");
		$reserveList=get_option("mca_Reserve_List");


    if(isset($_POST['ShowAuthors']))
		{
			$showTable=$_POST['showTable'];
			$ltype=$_POST['ltype'];
			$date1=$_POST['mth'];
			$date2=$_POST['yr'];
			$temp=$_POST['temp'];
			$PageBreak=$_POST['mca_page_break'];
			$gM=explode(',',$date1);
			$date1=$gM[0];
			$month=$gM[1];
			$YearMonth="$date2-$date1";
		
			/////Start the job
$where=" NOT comment_author_email ='".$default_admin_email."'";
$em=explode(',',$reserveList);
foreach($em as $emNt)
		{
		$where.=" AND NOT comment_author_email ='$emNt'";
		}
$query="SELECT comment_author as Commentator, comment_author_url as URL, comment_author_email as e, COUNT(*) as NumCom 
FROM ".$tblPrf."comments WHERE  ($where) AND comment_approved ='1' AND comment_type ='' AND comment_date LIKE'$YearMonth%' GROUP BY comment_author ORDER BY COUNT(*) DESC";
$result=$wpdb->get_results($query);

///////////////////Which action to take
		if($showTable=="YES")
			{
				if($temp=="gbox")
					{
						include'gravatar_show.php';
					}
						elseif($temp=="stxt")
					{
						include'list_show.php';
					}
						else
					{
						include'gravatar_tbl.php';
					}
			}
				else
			{
				if($temp=="gbox")
					{
						include'html_gravatar.php';
					}
						elseif($temp=="stxt")
					{
						include'html_list.php';
					}
						else
					{
						include'html_gravatar_tbl.php';
					}

				
			}

}
	////Show top commentators of the current month by defaut and limit to 20
if(!isset($_POST['ShowAuthors']) AND !isset($_GET['MailTo']) AND !isset($_POST['SendMailNow']))
{

$where=" NOT comment_author_email ='".$default_admin_email."'";
$em=explode(',',$reserveList);
foreach($em as $emNt)
		{
		$where.=" AND NOT comment_author_email ='$emNt'";
		}
$query="SELECT comment_author as Commentator, comment_author_url as URL, comment_author_email as e, COUNT(*) as NumCom 
FROM ".$tblPrf."comments WHERE  ($where) AND comment_approved ='1' AND comment_type ='' AND comment_date LIKE'".date("Y-m")."%' GROUP BY comment_author ORDER BY COUNT(*) DESC LIMIT 10";


$result=$wpdb->get_results($query);


				echo"<h3>TOP 10 COMMENT AUTHORS THIS MONTH</h3><br>
				<i>Excluding Admin Comments</i>
						<ol>";
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
					$r=rand(1,2);
							if($r==1)
								{
									$rt="dropped";
								}
									else
								{
									$rt="made";
								}
						echo"<li>$author $rt <b>".$gCom->NumCom." comment".$s."</b></li>";

						$countComments=$countComments+$gCom->NumCom;
					}
						echo"</ol>";
}
if(isset($_GET['MailTo']))
	{
		$m=$_GET['MailTo'];
		$year=$_GET['n'];
		$count=$_GET['count'];
		$month=$_GET['m'];
		include'mailtowarning.php';
	}
	//////Time to se,d mail
if(isset($_POST['SendMailNow']))
	{
		$date1=$_POST['y'];
		$date2=$_POST['month'];
		$count=$_POST['count'];
		$month=$_POST['m'];
	$YearMonth="$date1-$date2";
			$reserveList=get_option("mca_Reserve_List");

$where=" NOT comment_author_email ='".$default_admin_email."'";
$em=explode(',',$reserveList);
foreach($em as $emNt)
		{
		$where.=" AND NOT comment_author_email ='$emNt'";
		}

			/////Start the job
$query="SELECT comment_author as Commentator, comment_author_url as URL, comment_author_email as e, COUNT(*) as NumCom 
FROM ".$tblPrf."comments WHERE  ($where) AND comment_approved ='1' AND comment_type ='' AND  comment_date LIKE'$YearMonth%' GROUP BY comment_author ORDER BY COUNT(*) DESC LIMIT $mcaMailLim";

$result=$wpdb->get_results($query);

foreach($result as $gCom) 
					{
$msg=trim(strip_tags($_POST['msg']));
$SendCopy=$_POST['SendCopy'];

						$countAuthors++;
						$email=$gCom->e;
						if(empty($email))
							{
								echo" No email for ".$gCom->Commentator."<br>";
							}
								else
							{

								/////Send email

if($gCom->NumCom > 1 )
	{
		$s="s";
	}
		else
	{
		$s="";
	}
$comCount=$gCom->NumCom." comment".$s;
$subject="You made $comCount in $month ".$gCom->Commentator.". Thank You!";

$add="FROM:$blogname<$admin_email>\t\n".
     "Reply-to:$admin_email";

$greetings="Hi ".$gCom->Commentator.",";

$msg=str_replace("[NumOfCom]","$comCount",$msg);
$FinalMsg="
$greetings

$msg
--------------------------------------
This message was sent using MyCommentAuthors WP Plugin
developed by Enstine Muki. Download it here:
http://enstinemuki.com/my-comment-authors";
//mail("$email",$subject,$FinalMsg,$add);
mail($email,$subject,stripslashes($FinalMsg),$add);

echo"Email sent to <b>".$gCom->Commentator." -> $email </b><br>";
							}
		}
			if($SendCopy == "YES")
					{
				      mail($admin_email,$subject,stripslashes($FinalMsg),$add);
		
					}		
	}
	?>
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
              </p>
              <table width="100%" border="0">
                <tr>
                  <td><hr size="1" noshade="noshade" /></td>
                </tr>
                <tr>
                  <td><strong><font color="#0066CC">MyCommentAuthors Sponsors</font></strong></td>
                </tr>
                <tr>
                  <td><p>Want to sponsore this project? <a href="http://enstinemuki.com/contact/" target="_blank"><b>Contact us</b></a> to <u>place your banner here</u></p>
                  <p>&nbsp;</p></td>
                </tr>
            </table>            </td>
          <td width="29%" rowspan="2" valign="top"><table width="100%" class="widefat">
              <thead>
                <tr valign="top">
                  <th height="29" colspan="3" scope="row"><div align="left"><strong>BASIC SETTINGS</strong></div>
                      <font color="#23769D" size="3"></th>
                </tr>
              </thead>
              <tr valign="top">
                <td><p>
                  <label></label>
                  <label></label>
Mailing  limit per hour</p>                  </td>
                <td><input name="mLim" type="text" id="mLim" value="<?php echo $mcaMailLim; ?>" size="5" maxlength="5" /></td>
              </tr>
              <tr valign="top">
                <td>Email From <font size="2">(<font color="#FF0000">use address attached to this domain</font> )</font></td>
                <td><input name="admin_email" type="text" id="admin_email" value="<?php echo $admin_email; ?>" size="10" /></td>
              </tr>
              <tr valign="top">
                <td>Name From</td>
                <td><input name="blogname" type="text" id="blogname" value="<?php echo $blogname; ?>" size="10" /></td>
              </tr>
              <tr valign="top">
                <td colspan="2"><strong>GRAVATAR OPTION</strong></td>
                </tr>
              <tr valign="top">
                <td>Background color</td>
                <td><input name="gravatar_bg" type="text" id="gravatar_bgFrm" value="<?php echo $gravatar_bg; ?>" size="10" />
                <div id="gravatar_bg"></div></td>
              </tr>
              <tr valign="top">
                <td>Border color</td>
                <td><input name="gravatar_border" type="text" id="gravatar_borderFrm" value="<?php echo $gravatar_border; ?>" size="10" />
                <div id="gravatar_border"></div></td>
              </tr>
              <tr valign="top">
                <td colspan="2"><strong>RESERVE LIST (</strong>emails of commentators you want to exclude from the list<strong>) Comma seperated</strong></td>
                </tr>
              <tr valign="top">
                <td colspan="2"><input name="reserveList" type="text" id="gravatar_borderFrm2" value="<?php echo $reserveList; ?>" size="28" /></td>
                </tr>
              <tr valign="top">
                <td>&nbsp;</td>
                <td><input type="submit" name="MailLimEdit" id="MailLimEdit" value="Save" class="button-primary"/></td>
              </tr>
              <tr valign="top">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr valign="top">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr valign="top">
                <td colspan="2">Do you need support? <a href="http://enstinemuki.com/contact/" target="_blank"><b>Contact Enstine Muki here.</b></a><b> You can also read <a href="https://enstinemuki.com/my-comment-authors/" target="_blank">this blog post </a>for some details</b></td>
                </tr>
              

            </table>
              <br />
              <br />
            <p>&nbsp;</p></td>
        </tr>
        
        
        <tr>
          <td valign="top">
              <font size="4"><b>GENERAL INFO</b></font>
              <hr size="1" noshade="noshade" />
              <table width="100%" border="0">
                <tr>
                  <td valign="top"><p align="justify"><strong><font color="#0066CC">Dofollow Limit:</font></strong> When you generate a list of comment authors to publish on your blog, you may want to give a dollow link to those who were more active. </p>
                    <p align="justify">The default value of <strong>20</strong> means that everyone that has 20+ comments will be given a dofollow link on the list.</p>
                    <p align="justify">Set to 0 to disable Dofollow</p>
                    <p align="justify"><strong><font color="#0066CC">Option: </font></strong>Select HTML to generate the html code to paste in your blog post. </p>
                    <p align="justify"><strong><font color="#0066CC">Page Break:</font></strong> If the list of comment authors become long, you may want to split the page. Enter the number of enteries per page. Default is <strong>0</strong>. If you set <strong>20</strong> , for instance, that means after displaying <strong>20</strong> commentators, the system will break and insert a link to next page. If there are many pages, it will automatically count the number of pages and create pages accordingly. So you have something like<strong> Pages: 1 <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">5</a> <a href="#">6</a> <a href="#">7</a></strong></p>
                    <p align="justify"><strong>NB:</strong> The Page Break feture is only available with the HTML option</p>
                    <p align="justify"><strong><font color="#0066CC">Gravatar:</font></strong> There are two ways to display the list; 1 - with Gravatar, 2 - No gravatar. Select YES if you want the list generated to have the picture of the comment author. If the commentator does not have gravatar with the email used, the default gravatar will be used.</p>
                    <p align="justify">
                      <label></label>
                      <label></label>
                      <strong><font color="#0066CC">Server Limit per hour:</font></strong> Most shared server won't allow you send more than a certain number of mails per hour from a specific domain.To make sure you don't get into trouble with your server, we are setting a limit on the number of mails MyCommentAuthors can send per Campaign.</p>
                    <p align="justify"><strong><font color="#0066CC">Email From and Name From:</font></strong> If you send a THANK YOU message to your comment uthors, this email and name will be used in the FROM fields. Use an email attached to this domain. Don't use yahoo,gmail</p>
                  <p align="justify"><strong>NB:</strong> Use the mail function once per month. Don't spam</p></td>
                </tr>
              </table>
            <p>&nbsp;</p>            </td>
          </tr>
      </table>
    </form>
    <p>&nbsp;</p></td>
  </tr>
</table>
