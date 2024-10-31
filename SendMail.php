<?php
session_start();
include'config.php';
/////Login
if(isset($_POST['ComAuthorLog']))
	{
		$username=$_POST['u'];
		$password=$_POST['p'];
	if(($username == "$ComAuthorAdminUser") AND ($password=="$ComAuthorAdminPass"))
		{
			$_SESSION['MyCommentAuthors'] = "IAMIN";
		}
	}
/////Log out
if(isset($_GET['ComAuthorOut']))
	{
		if(isset($_SESSION['MyCommentAuthors']))
  		unset($_SESSION['MyCommentAuthors']);
  	}

		
if(!$_SESSION['MyCommentAuthors'])
	{
		include'login.php';
	exit;
}
///http://sendgrid.com/blog/email-throttling-basics/
////Check if config file has been set
if(empty($dbName) OR empty($dbUser) OR empty($dbPass)  OR ($wpAdminEmail=="enstinemuki@yahoo.com") OR empty($wpAdminEmail))
	{
		echo"Please be sure to edit the config file. For more information, go to <a href=\"http://enstinemuki.com/show-all-commentators\">http://enstinemuki.com/show-all-commentators</a>";
		exit;
	}
	///////////////////// Connect to db
	$dbConn = @ mysql_connect ("$dbHost", "$dbUser", "$dbPass") 
or die ("$err MySQL connect failed. " . mysql_error());
@ mysql_select_db("$dbName",$dbConn) 
or die("Cannot select database. " . mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Show My Commentators - &gt; Enstine Muki</title>
<style type="text/css">
<!--
.showCom {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333333;
}
.style1 {
	font-size: 36px
}
.style2 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
</head>

<body bgcolor="#0099CC">
<table width="85%" border="0" align="center" bordercolor="#0099CC" bgcolor="#007297" class="showCom">
  <tr>
    <td valign="top" bgcolor="#E1F8FF"><p align="center"><span class="style1">Show My Commentators<br />
    </span>      This little script will show a list of visitors who have left a comment on your blog within a given period</p>
      <p align="center"><a href="index.php"><strong><font color="#FF0000">&lt;-- Back to form </font></strong> </a></p></td>
  </tr>
  <tr>
    <td height="800" valign="top" bgcolor="#FFFFFF"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="51%" border="0" align="center">
      <tr>
        <td>Please don't close this window until finish! </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?php
if(isset($_POST['SendMailNow']))
	{
		$date1=$_POST['y'];
		$date2=$_POST['month'];
		$count=$_POST['count'];
		$month=$_POST['m'];
	$YearMonth="$date1-$date2";
			/////Start the job
$query="SELECT comment_author as Commentator, comment_author_url as URL, comment_author_email as e, COUNT(*) as NumCom 
FROM ".$wpTblPr."comments WHERE  comment_approved ='1' AND comment_type ='' AND 
comment_author_email !='".$wpAdminEmail."' AND comment_date LIKE'$YearMonth%' GROUP BY comment_author ORDER BY COUNT(*) DESC LIMIT $mailLimit";
$result=mysql_query($query);

while($gCom=mysql_fetch_object($result))
					{
$msg=trim(strip_tags($_POST['msg']));
$msg=stripslashes($msg);

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

$add="FROM:$mailFromName<$replytoAdd>\t\n".
     "Reply-to:$replytoAdd";

$greetings="Hi ".$gCom->Commentator.",";

$msg=str_replace("[NumOfCom]","$comCount",$msg);
$FinalMsg="
$greetings

$msg
--------------------------------------
This message was sent using MyCommentAuthors Script
developed by Enstine Muki. Download it here:
http://enstinemuki.com/my-comment-authors";
mail("$email",$subject,$FinalMsg,$add);
echo"Email sent to <b>".$gCom->Commentator." -> $email</b><br>";
							}
					}
	}

		?></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>

</html>
