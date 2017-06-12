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
                                  <option value="Contact-Enquiry" <?php if($reports_type=="Contact-Enquiry") echo 'selected';?>>Contact Enquiry</option>
                                  <option value="Ask-Question" <?php if($reports_type=="Ask-Question") echo 'selected';?>>Ask Question</option>
                                  <option value="Tell-The-Boss" <?php if($reports_type=="Tell-The-Boss") echo 'selected';?>>Tell The Boss</option>
                                  <option value="Refer-A-Friend" <?php if($reports_type=="Refer-A-Friend") echo 'selected';?>>Refer A Friend</option>                                 </select>
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
              <div class="ulTable" style="padding-left: 0px">
               <ul>
            	<li>
                	<div style="width:150px; padding-left:6px;" class="ulTableinner sn-no-other">Source</div>
                    <div style="width:70px;" class="ulTableinner sn-no-other">Count</div>
                 <div class="clearfix"></div>
                </li>
               </ul>
              </div>
              <div class="ulTable_record" id="recordList" style="width:266px; float:left; padding-left: 0px">
              <ul>
			  <?php
			  $i=1;
			  $j=1;
			  $total=0;
			  foreach($list_records as $records)
			  {
			   $total=$total+$records->cnt;
			   ?>
			    <li style="padding:2px;">
                	<div style="width:146px; padding-left:6px;" class="ulTableinner_record sn-no-other"><?php echo $records->question;?></div>
                    <div style="width:65px;" class="ulTableinner_record sn-no-other"><?php echo $records->cnt;?></div>
                 <div class="clearfix"></div>
                </li>
			   <?php
			   $j++;
			  }
			  ?>
              <li style="padding:2px;">
              	<div  class="ulTableinner_record sn-no-other" style="width:146px; padding-left:6px; color: black;"><strong>TOTAL</strong></div>
                <div style="width:65px;" class="ulTableinner_record sn-no-other"><?php echo $total;?></div>
                <div class="clearfix"></div>
              </li>
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