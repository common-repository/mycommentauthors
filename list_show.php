<?php

				echo" <h3>Total Comments on this blog in $month $date2</h3>
						<b>NB:</b> This list while on your post will follow your theme settings<br><ol>";
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
						echo"</ol>
						<br><b>$countAuthors</b> comment authors with <b>$countComments</b> 
						comments  in the month of <b>$month $date2</b><br>
						<a href=\"options-general.php?page=".$_GET['page']."&MailTo=$date1&n=$date2&m=$month&count=$countAuthors\">
					<img src=\"" .plugins_url( 'images/maillist.gif' , __FILE__ ). "\" border=\"0\"> </a>";
?>