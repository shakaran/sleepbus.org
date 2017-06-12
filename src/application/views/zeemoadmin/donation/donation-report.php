<div class="record_list">
             <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                    <form action="" method="post" name="frm2">
             <table width="90%" border="0" cellspacing="0" cellpadding="0" style="color: #636466;font-family: Arial;font-size: 11px;font-weight: bold;padding-top: 10px;text-align: left;">
                              <tr style="height: 25px">
                                <td width="34%" align="left" valign="middle" class="">
                                  *From Date
                                  <input id="f_rangeStart" name="f_rangeStart" readonly="readonly"  value="<?=$f_rangeStart?>" style="width:100px;" />
                                  <img src="<?php echo base_url(); ?>/images/<?php echo admin;?>/calender.gif" id="f_rangeStart_trigger" style="position:relative; top:5px; cursor:pointer; height:18px" > 
                                  <script type="text/javascript">
                              new Calendar({
                                      inputField: "f_rangeStart",
                                      dateFormat: "%d-%m-%Y",
                                      trigger: "f_rangeStart_trigger",
                                      bottomBar: false,
                                      onSelect: function() {
                                              var date = Calendar.intToDate(this.selection.get());
                                             /* LEFT_CAL.args.min = date;*/
                                              LEFT_CAL.redraw();
                                              this.hide();
                                      }
                              });
                              function clearRangeStart() {
                                      document.getElementById("f_rangeStart").value = "";
                                      LEFT_CAL.args.min = null;
                                      LEFT_CAL.redraw();
                              };
                            </script></td>
                                <td width="30%" align="left" valign="middle" class="">
                                  *To Date
                                  <input id="to_rangeStart" name="to_rangeStart" readonly="readonly"  value="<?=$to_rangeStart?>"  style="width:100px;" />
                                  <img src="<?php echo base_url(); ?>/images/<?php echo admin;?>/calender.gif" id="to_rangeStart_trigger" style="position:relative; top:5px; cursor:pointer; height:18px" > 
                                  <script type="text/javascript">
                              new Calendar({
                                      inputField: "to_rangeStart",
                                      dateFormat: "%d-%m-%Y",
                                      trigger: "to_rangeStart_trigger",
                                      bottomBar: false,
                                      onSelect: function() {
                                              var date = Calendar.intToDate(this.selection.get());
                                             /* LEFT_CAL.args.min = date;*/
                                              LEFT_CAL.redraw();
                                              this.hide();
                                      }
                              });
                              function clearRangeStart() {
                                      document.getElementById("to_rangeStart").value = "";
                                      LEFT_CAL.args.min = null;
                                      LEFT_CAL.redraw();
                              };
                            </script></td>
                                <td width="10%" align="center" valign="middle" class="">Select type</td>
                                <td width="20%" align="left">
                                <select name="reports_type" id="reports_type" class="select_action" style="width:125px;" >
                                    <option value="" selected="selected">All</option>
                                 <option value="campaign" <?php if($reports_type=="campaign") echo 'selected';?>>Campaign</option>
                                 <option value="one-time-donation" <?php if($reports_type=="one-time-donation") echo 'selected';?>>One Time Donation</option>
<option value="monthly" <?php if($reports_type=="monthly") echo 'selected';?>>Monthly</option>                                 
                                  </select>
                                  <?php
			   //echo "Report".$reports_type;
			   ?></td>
                                <td width="6%" align="left"><input type="submit" name="action" value="Submit" /></td>
                              </tr>
                            </table>
             </form>
             <br />
              
             <?php
			 if(isset($list_records) && count($list_records) > 0)
		     {
				 ?>
					<div style="padding:0px 0px 0px 40px;">
               	   <div id="note" class="ulTableinner_record sn-no-other" style="width:680px;background-color:white;border:thin solid #CACAFF;padding: 0px 0px 0px 0px;">
                   
                   
                    <table cellpadding="0" cellspacing="0" style="width:680px;">
                    <tr>
                     <td width="100%" colspan="4" style="background:#005279;color:#fff;" align="center"><b>Total Donation For Selected Date Range :-</b></td>
                    </tr>
                    
                    <?php
					  $total=0;	
					  if(count($total_donations) > 0) 
					  {
					   foreach($total_donations as $donation)
					   {	 
					    ?>
                        <tr>
                         <td style="padding-left:5px;"><b><?php echo ucwords(str_replace("-"," ",$donation['donation_type']));?> </b>: </td>
                         <td>$<?php echo $donation['total_amount'];?></td>
                         <td width="60%">&nbsp;</td>
                        </tr>
                       <?php
					   $total+=$donation['total_amount'];
					  }
					  ?>
                      <tr style="background:#F5F5F5">
                       <td style="padding-left:5px;"><b>Total Donation :</b></td>
                       <td><b>$<?php echo $total;?></b></td>
                       <td width="60%">&nbsp;</td>
                      </tr>
					  <?php
					 }
					 ?>
                     </table> 
                    
                    </div>
                    </div>
                    <div style="clear:both;">&nbsp;</div>                 
                 
                 <div style="text-align:right;" class="cate_result1"><a href="<?=base_url().admin;?>/donation/download-excel/<?=$f_rangeStart?>/<?=$to_rangeStart?>/<?php echo $reports_type;?>" class="link2">Click here</a> to download in excel format.</div>
                 <div class="ulTable">
            
            <ul>
            	<li>
                	<div style="width:40px;" class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
                	<div style="width:160px;" class="ulTableinner sn-no-other">Email</div>
                    <div style="width:210px;" class="ulTableinner sn-no-other">Date</div>
                    <div style="width:80px;" class="ulTableinner sn-no-other">Donation</div>
                	<div style="width:80px;" class="ulTableinner sn-no-other">Type</div>
                	<div style="width:125px;" class="ulTableinner sn-no-other">Tools</div>
                 <div class="clearfix"></div>
                </li>
            </ul>
           </div>
                 <div class="ulTable_record" id="recordList">
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  
			  foreach($list_records as $records)
			  {
			   ?>
			    <li style="padding:2px;">
                	<div style="width:40px; padding:2px;" class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
                	<div style="width:160px;" class="ulTableinner_record sn-no-other"><?php echo $records['payer_email'];?>&nbsp;</div>
                    <div style="width:210px;" class="ulTableinner_record sn-no-other"><?php echo $records['donation_date'];?>&nbsp;</div>
                    <div style="width:80px;" class="ulTableinner_record sn-no-other">$<?php echo $records['donation'];?>&nbsp;</div> 
                	<div style="width:80px;" class="ulTableinner_record sn-no-other"><?php echo ucwords(str_replace("-"," ",$records['donation_type']));?>&nbsp;</div>
                	<div style="width:103px;" class="ulTableinner_record sn-no-other"><a href="<?php echo base_url().admin."/donation/donation-details/".$records['id'];?>">View Details</a>&nbsp;</div>
                 <div class="clearfix"></div>
                </li>
			   <?php
			   $j++;
			  }
			  ?>
               </ul>
			  </div>
                 
                 <?php
			 }
			 else
			 {
			  if(isset($submit_form) && $submit_form=='yes') {
			 } else {
			  ?>
			   <div class="success"> No records found.</div>
			  <?php
			 }
			 }
		    ?>
           <div class="clearfix"></div>
          </div>
         <div class="clear"></div>
			<div id="cont" style="display:none;"></div>
			<script type="text/javascript">
            var LEFT_CAL = Calendar.setup({
                    cont: "cont",
                    weekNumbers: true,
                    selectionType: Calendar.SEL_MULTIPLE,
                    showTime: 12
                    // titleFormat: "%B %Y"
            })
			</script>          