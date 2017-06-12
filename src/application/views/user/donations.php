<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 profilemain" style="margin:89px 0 0;">
    <div class="row positionrelative"><div id="bluetitlebar" style="padding:20px 30px; background:#2AC4F3;color:#fff;">
            <h3>PROJECTS</h3>
        </div>
    </div>
    <div class="row positionrelative">
            <?php
            $this->load->view('user/left-menu-donations');
            ?>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 donationcenter">
            <div id="donorinfo" class="donationmsg"><span>DONOR</span> | <?php echo $user_info['full_name']; ?></div>
        <div class="donationmsg">
            <div class="col-lg-4 col-md-4 col-sm-4" ><img src="<?php echo base_url();?>/images/Simon_Bitmoji_Thank_You_no_logo.jpeg"/></div>

            <div class="col-lg-8 col-md-8 col-sm-8">Thank you for your support!</br>
                Our promise to you is that you will always know where your money has gone and how it’s helping provide safe sleeps. The 100% model.</div>
        </div>
            <div class="donationmsg" id="howtogetinvolved"><span>ENGAGEMENT</span>
                <div id="engagementsteps">
                    <div class="progresssintro">
                        <img src="<?php echo base_url();?>/images/sleepbusprogress_0.png"/></div>

<?php if ($user_progress['onetime']): ?>

                    <div class="progressstep complete">
                            <img src="<?php echo base_url();?>/images/ProgressOTDYes.jpeg"/>
                    </div>
<?php else: ?>
                    <div class="progressstep todo">
                        <a href="/donate" id="progressonetimedonate">
                            <img src="<?php echo base_url();?>/images/ProgressOTDNo.jpeg"/>
                        </a>
                    </div>

<?php endif; ?>

<?php if ($user_progress['monthly']): ?>
                    <div class="progressstep complete">
                        <img src="<?php echo base_url();?>/images/ProgressMDYes.jpeg"/>
                    </div>

<?php else: ?>
                    <div class="progressstep todo">
                        <a href="/donate" id="progressmonthlydonate">
                            <img src="<?php echo base_url();?>/images/ProgressMDNo.jpeg"/>
                        </a>
                    </div>
<?php endif; ?>

<?php if ($user_progress['birthday']): ?>
                    <div class="progressstep complete">
                        <img src="<?php echo base_url();?>/images/ProgressBPYes.jpeg"/>
                    </div>
<?php else: ?>
                    <div class="progressstep todo">
                    <a href="/pledge" target="_blank" id="progresspledge">
                        <img src="<?php echo base_url();?>/images/ProgressBPNo.jpeg"/>
                    </a>
                </div>
<?php endif; ?>

<?php if ($user_progress['campaign']): ?>
                <div class="progressstep complete">
                        <img src="<?php echo base_url();?>/images/ProgressSCYes.jpeg"/>
                    </div>
<?php else: ?>
                    <div class="progressstep todo">
                    <a href="/fundraise" target="_blank" id="progressfundraise">
                        <img src="<?php echo base_url();?>/images/ProgressSCNo.jpeg"/>
                    </a>
                </div>
<?php endif; ?>
                </div>
            </div>
            <div id="donationtable" style="width:100%;">
            <table>
                <tr>
                    <th>Date</th><th>Amount</th><th>Donation Type</th> <th>Campaign Fund Allocation</th>
                </tr>
                <tbody>
                <?php foreach($my_donations as $donation): ?>
                    <tr>
                        <td><?php echo $donation['payment_date']; ?></td>
                        <td><?php echo $donation['paid_amount']; ?></td>
                        <td><?php echo $donation['donation_type']; ?></td>
<?php if (isset($donation['donation_type']) && $donation['donation_type'] == 'one-time-donation'): ?>

                        <td>Waiting to be allocated. Check back here soon.</td>
<?php elseif (isset($donation['donation_type']) && $donation['donation_type'] == 'monthly'): ?>
                        <td>Monthly donation</td>
<?php else: ?>
                        <td><a href="/<?php echo $donation['url']; ?>"><?php echo $donation['campaign_name']; ?></a></td>
<?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                <tr id="totaldonation">
                    <td id="totallabel">TOTAL</td>
                    <td id="totalamount">$<?php echo number_format($my_donations_total, 2, ".", ","); ?></td>
                    <td id="totalthanks"><?php echo $my_safe_sleeps; ?></td>
                    <td id="totalthanks"></td></tr>
                </tbody>
            </table>
            </div>
            <div class="donationmsg" id="donationtip">
                <img src="<?php echo base_url();?>/images/tip.png">
                <div class="col-lg-8 col-md-8 col-sm-8">Click on the campaign / bus that you have donated to in order to see live updates.</div>
            </div>
            <div class="donationmsg" id="sleepbuslive">
                    <img src="<?php echo base_url();?>/images/sleepbulive.jpg"/>
<p>Easily engage, understand, communicate, collarborate and know what is happening in the  eld in real time. See the whole story with sleepbusLIVE; a real time data portal, visible from any connected device, that gives you complete access to any and all sleepbus service locations.</p>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 donationright" style="background:#A9B1B0;color:#000;text-align: center;padding: 20px;">
        <img src="<?php echo base_url();?>images/100model.png" alt="" width="100%">
        <h3>100% MODEL</h3>
        <p>
        100% of your donation is allocated to a sleepbus project; that’s our 100% Model promise to you. When you donate or fundraise, every dollar goes to building and maintaining a sleepbus project.
        Private donors fund our Charity operating costs, so 100% of your money can go towards getting people off the street.</p>
        </div>
        </div>

</div>
