<?php
///Generate script
				echo"<div align=\"center\"><h3>Total Comments on this blog in $month $date2</h3></div>
				<table width=\"60%\" align=\"center\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">";	
				$tbData="";
				$countAuthors=0;
				$countComments=0;
				$pageBreakCounter=0;
				foreach( $result as $gCom) //=mysql_fetch_object($result))
					{
						$countAuthors++;
						$pageBreakCounter++;
						$url=$gCom->URL;
						////Set the nofollow tag
						if(($gCom->NumCom >= $ltype) AND ($ltype > 0))
							{
								$dof="";
							}
								else
							{
								$dof="rel=\"nofollow\"";
							}
						if(empty($url))
							{
								$author=$gCom->Commentator;
							}
								else
							{
								$author="<a href=\"".$gCom->URL."\" target=\"_blank\" $dof>".$gCom->Commentator."</a>";
							}
							$r=rand(1,2);
							if($r==1)
								{
									$rt="dropped";
									$greet="Hello, ";
								}
									else
								{
									$rt="made";
									$greet="Hi, ";
								}
							
							$ph=rand(1,4);
							if($ph==1)
								{
									$phr="It was good to be here in $month $date2";
								}
									elseif($ph=="2")
								{
									$phr="I love this community";
								}
									elseif($ph=="3")
								{
									$phr="I had a wonderful experience here in $month $date2";
								}
									else
								{
									$phr="I'll surely be back again ;)";
								}
							//////////////////
							if($gCom->NumCom > 1 )
								{
									$s="s";
								}
									else
								{
									$s="";
								}
				$grav_url = "http://www.gravatar.com/avatar/".md5(strtolower($gCom->e))."?d=".urlencode($default)."&s=50";
				
echo"<tr><td valign=\"top\" width=\"10%\" style=\"border-bottom: #CCCCCC dotted thin;\">
<img src=\"$grav_url\" border=\"0\" vspace=\"7\" hspace=\"2\" align=\"left\" style=\"padding:2px; border:1px solid #999999;  background-color:#F9F8F7;\"></td>
						<td valign=\"top\" style=\"border-bottom: #CCCCCC dotted thin;\">$greet My name is <b>$author</b>.<br> I $rt <b>".$gCom->NumCom." awesome comment".$s."</b>.</td></tr>";
						
						$countComments=$countComments+$gCom->NumCom;
					}
					echo"</table><b>$countAuthors</b> comment authors with <b>$countComments</b> comments in the month of <b>$month $date2</b>
						<br>		                        ";
					echo"<br><br><a href=\"options-general.php?page=".$_GET['page']."&MailTo=$date1&n=$date2&m=$month&count=$countAuthors\">
					<img src=\"" .plugins_url( 'images/maillist.gif' , __FILE__ ). "\" border=\"0\"> </a></center>";
?>