           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open_multipart(base_url().admin.'/media/validate-item',$attributes['form']);
			  
			  if(!empty($edit_id)){ echo form_hidden('edit_id',$edit_id);$activity="updating";}else{$activity="adding";}
			  
			  
			 ?>
              <table width="98%" border="0" cellpadding="0" cellspacing="0">
               <tr>
               <td style="padding-bottom:9px;">
                <span class="main_heading"><?php echo $page_title;?></span>
               </td>
                <td colspan="3">
                  <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                 </td>
                      
               </tr>
               

			   
               
			   <tr><td style="padding-top:0px;padding-bottom:5px;">
                 *Topic&nbsp;<span class="error1" id="error1"><?php echo form_error('media_title'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['media_title']); ?>&nbsp;
                </td>
               </tr> 
			   <tr><td style="padding-top:10px;padding-bottom:5px;">
                 *Publication&nbsp;<span class="error1" id="error3"><?php echo form_error('publication'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['publication']); ?>&nbsp;
                </td>
               </tr> 
               
               
			   <tr><td style="padding-top:10px;padding-bottom:5px;">
                 *URL&nbsp;<span class="remarks">[External URL]</span>&nbsp;<span class="error1" id="error2"><?php echo form_error('url'); ?></span>
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['url']); ?>&nbsp;
                </td>
               </tr> 

			   <tr><td style="padding-top:10px;padding-bottom:5px;">
                 *Select Date 
               </td></tr>
               <tr>
                <td colspan="4" align="left" valign="top">
                 <?php echo form_input($attributes['date_display']); ?>&nbsp;
                 <img src="<?php echo base_url();?>/images/<?php echo admin;?>/icons/tools/calender.gif" id="date_selected_trigger" style="position:relative; top:5px; cursor:pointer; height:18px" >
                        <script type="text/javascript">
                          new Calendar({
                                  inputField: "date_display",
                                  dateFormat: "%d-%m-%Y",
                                  trigger: "date_selected_trigger",
                                  bottomBar: false,
                                  onSelect: function() {
                                          var date = Calendar.intToDate(this.selection.get());
                                         /* LEFT_CAL.args.min = date;*/
                                          LEFT_CAL.redraw();
                                          this.hide();
                                  }
                          });
                          function clearRangeStart() {
                                  document.getElementById("date_display").value = "";
                                  LEFT_CAL.args.min = null;
                                  LEFT_CAL.redraw();
                          };
                        </script>
                </td>
               </tr>                  

			   
              
  		          
				<tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
               
               &nbsp;<?php echo form_submit($attributes['submit']);?>
               </td></tr>                         

               <tr><td colspan="4" height="10" style="padding-top:10px;padding-bottom:10px;">
               </td></tr>
              </table> 
			 <?php
              echo form_close();
             ?>  
            </div>
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