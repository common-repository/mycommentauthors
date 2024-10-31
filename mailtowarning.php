<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	color: #003399;
	font-weight: bold;
}
-->
</style>
<table width="59%" border="0" align="center">
  <tr>
    <td valign="top"><p><strong>NB: This script uses your server's PHP mail() function.</strong></p>
      <p>Some hosts limit the number of emails your domain can send per hour. They have their reasons  and we are not going to those technical details. Hostgator's shared servers for instance have 500 outgoing&nbsp;<em>email</em>&nbsp;hourly&nbsp;<em>limit</em>&nbsp;per domain. That means they don't allow you to send more than 500 emails per hour per domain. </p>
      <p><strong><font color="#FF0000">NB:</font></strong> <strong> You have <u><?php echo $count; ?></u> authors to send mail to this time. Your limit as set is <u><?php echo $mcaMailLim; ?></u>.</strong></p>
      <p><strong>Here is the mail  to be sent</strong>!</p>
      <p><br>
        NB: Don't use this script to spam your commentators. It's provided just to send a Thank You message. </p>
      <p>Templates:</p>
      <p><strong>Hi [ComAuthorName]</strong> <em>(please don't use this in the mail body. It will be inserted automatically to personalize the mail) </em></p>
      <p><strong>[NumOfCom]</strong> This will be replaced by the number of comments the author has made.</p>
      <p>Modify the content of the mail but be sure to include the template <strong>[NumOfCom]</strong> in your message. This will be replaced with something like: <span class="style2">8 comments</span> if the author made 8 comments on your blog in the selected period. </p>
      <p>Hi [ComAuthorName],</p>
        <label>
        <textarea name="msg" cols="60" rows="20" id="msg">In the month of <?php echo"$month $year"; ?>, you made [NumOfCom] on my blog.
I'm so grateful you were one of those who made my blog
active.

I'm therefore sending this mail just to say thank you for
being part of my community. I really love and appreciate
each minute you spend reading and engaging on my blog

I have written an article for my commentators of the month
of <?php echo"$month $year"; ?>. Here is the post url: (enter url if any)

I'll be so excited to see you on my blog again.

Warm regards,
<?php echo $blogname; ?></textarea>
        <br />
        <br />
        Send me copy 
        <input name="SendCopy" type="checkbox" id="SendCopy" value="YES" checked="checked" />
        <em>(A copy sent to the last recipient on the list will be sent to you)</em></label>
<p>
              <label>
              <input name="SendMailNow" type="submit" id="SendMailNow" value="Send the mail" class="button-primary">
              </label>
              <input name="m" type="hidden" id="m" value="<?php echo $month; ?>">
              <input name="y" type="hidden" id="y" value="<?php echo $year; ?>">
              <input name="count" type="hidden" id="count" value="<?php echo $count; ?>">
              <input name="month" type="hidden" id="month" value="<?php echo $m; ?>">
            </p>
      <p>&nbsp;</p>
    <p>&nbsp; </p></td>
  </tr>
</table>
