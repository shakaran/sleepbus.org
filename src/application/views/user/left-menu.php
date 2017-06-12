<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 profileleft">

      	<ul>

        	<li><span>Raised by campaigns</span> <bdo dir="ltr">$<?php if($total_raised['amount'] != NULL){ echo number_format($total_raised['amount'], 2, ".", ",");}else{?>0<?php }?></bdo></li>

            <li><span>Donated</span> <bdo dir="ltr">$<?php echo number_format($user_donation, 2, ".", ","); ?></bdo></li>

            <li><span><a href="<?php echo base_url();?>user/home">My account</a></span>  <bdo dir="ltr"><a href="<?php echo base_url();?>logout">Log out</a></bdo></li>

            <li><span><a href="<?php echo base_url();?>user/profile">Profile settings</a></span> </li>
            <li><span><a href="<?php echo base_url();?>user/donations">My donations</a></span> </li>

        </ul>

      </div>
