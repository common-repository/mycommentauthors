<?php
///Generate script
				echo"<center><b>Select, copy and paste this html script in the TEXT mode of your post.</b><br></center>";
				$tableHead="<div align=\"center\"><h3>Total Comments on this blog in $month $date2</h3>";	
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
								}
									else
								{
									$rt="made";
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
				if($PageBreak > 0 )
					{
						////Add page break after a certain number of entries
						if($pageBreakCounter == $PageBreak)
							{
								////Add page break and reset counter
								$tbData.="<br><b>Click The Page Number Below To Continue</b><br>
								</div><center><!--nextpage--></center><br><div align=\"center\"><h3>Total Comments on this blog in $month $date2</h3> <br>List Continues</b><br>";
								$pageBreakCounter=0;
							}
					}
						$tbData.="<div style=\"background-color: $gravatar_bg; padding: 2px; border: 1px solid $gravatar_border;text-align:center; margin:2px; width:150px\"><img src=\"$grav_url\" border=\"0\" vspace=\"5\" hspace=\"5\"><br><b>$author</b><br><b>".$gCom->NumCom." comment".$s."</b></div><br>";
						
						$countComments=$countComments+$gCom->NumCom;
					}
					$html=$tableHead;
					$html.=$tbData;
					$html.="
						<br><b>$countAuthors</b> comment authors with <b>$countComments</b> comments in the month of <b>$month $date2</b>
						<br><i>This list was generated by <a href=\"http://enstinemuki.com/my-comment-authors\" target=\"_blank\">MyCommentAuthors</a></i></div>";
					echo"<center><textarea cols=\"70\" rows=\"20\">$html</textarea><br><br>
					<a href=\"options-general.php?page=".$_GET['page']."&MailTo=$date1&n=$date2&m=$month&count=$countAuthors\">
					<img src=\"" .plugins_url( 'images/maillist.gif' , __FILE__ ). "\" border=\"0\"> </a></center>";
?>