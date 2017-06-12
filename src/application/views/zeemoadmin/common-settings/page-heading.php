           <div style="padding:25px;">
            <div id="input_text">
             <?php
              echo form_open(base_url().admin.'/commonsettings/validateheadings',$attributes['form']);
			 ?>
              <table width="100%" style="margin-top: -15px">
               <tr>
                <td>
                 <div class="error1" id="error"><?php if(isset($error_msg)) echo $error_msg; ?></div>
                </td>
               </tr>                       
               <tr>
                <td>Select a page to change page heading / name
                       &nbsp;&nbsp;<span class="error1" id="error1"><?php echo form_error('heading_id');?></span></td></tr>
                      <tr>
                       <td>
                        <?php
						 $css="class='select_action' style='width:220px;'";
						 $js="onchange=window.location='".base_url().admin."/commonsettings/pageheadings/'+this.value";
						 
						 echo form_dropdown('heading_id',$attributes['heading_id'],$page_id,$css." id='heading_id' ".$js);?>
                       </td>
                      </tr>


                      <tr height="25" valign="bottom"><td>
                       *Enter page heading / name&nbsp;&nbsp;<span class="error1" id="error2"><?php echo form_error('page_heading');?></span>
                       </td>
                      </tr>
                      <tr>
                       <td align="left">
                        <?php
						 echo form_input($attributes['page_heading']);
                        ?>
                        &nbsp;&nbsp;
                        <?php
                         echo form_input($attributes['limit1']);
                        ?> 
						 &nbsp;<span class="remarks">*Maximum 45 chars</span>&nbsp;&nbsp;
                       </td>
                      </tr>  
                      <tr height="30" valign="bottom">
                       <td align="left">
                       <?php
                         echo form_submit($attributes['submit']);
                       ?>
					   </td>
                      </tr>  
                      
                      <tr height="100"><td></td></tr>
                    </table> 
                     <?php
					  echo form_close();
					 ?>  
                    </div>
                   </div>
