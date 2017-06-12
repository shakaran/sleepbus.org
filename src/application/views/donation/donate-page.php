        <?php
		 $content= str_replace('[[ONE_TIME_DONATION_FORM]]',$one_time_donation_form,$top_text['content']);
		 $content= str_replace('[[MONTHLY_DONATION_FORM]]',$monthly_donation_form,$content);
		 echo $content;
		?>
