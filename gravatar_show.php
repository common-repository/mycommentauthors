<?php

				echo" <h3>Total Comments on this blog in $month $date2 With Gravatar</h3>
						<b>NB:</b> This list while on your post will follow your theme settings<br>";
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
						$grav_url = "http://www.gravatar.com/avatar/".md5(strtolower($gCom->e))."?d=".urlencode($default)."&s=50";
						
echo "<div style=\"background-color: $gravatar_bg; padding: 2px; border: 1px solid $gravatar_border;text-align:center; margin:3px; width:150px\"><img src=\"$grav_url\" border=\"0\" vspace=\"5\" hspace=\"5\"><br><b>$author</b><br><b>".$gCom->NumCom." comment".$s."</b></div><br>";

						$countComments=$countComments+$gCom->NumCom;
					}
						echo"<br><b>$countAuthors</b> comment authors with <b>$countComments</b> 
						comments  in the month of <b>$month $date2</b><br>
						<a href=\"options-general.php?page=".$_GET['page']."&MailTo=$date1&n=$date2&m=$month&count=$countAuthors\">
					<img src=\"" .plugins_url( 'images/maillist.gif' , __FILE__ ). "\" border=\"0\"> </a>";
?>