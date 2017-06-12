           <div style="padding:25px;">
            <div id="input_text">
             <?php
			  if($this->session->userdata('session_data'))
			  {
			   $session_data = $this->session->userdata('session_data');	
			   $scid = $session_data['scid'];  
			   $dcid = $session_data['dcid'];  
			   $option = $session_data['option'];  
			   $products = $session_data['products'];
			   $duplicate_products = $session_data['duplicate_products'];  
			  }

			  $form_attributes = array('name' => 'copy_move_frm', 'onsubmit' => 'return ValidateCopyMoveProducts()');
              echo form_open(base_url().'admin/products/copy-move-products', $form_attributes);
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
               
              <tr height="25" valign="bottom">
               <td align="left">Select a source category:</td>
               <td align="left">Select a destination category:</td>
               <td align="left">Action</td>
               <td align="left">&nbsp;</td>
              </tr>
              <tr>
               <td> 
                <?php
				$sc_attributes = 'id=scid class="select_action" style="width: 230px;" onchange="window.location=\''.base_url().'admin/products/copy-move-products/\'+this.value"';
				$source_categories = array();
				$source_categories[''] = 'Select source category';
				foreach($categories as $key => $value) $source_categories[$key] = $value;
                echo form_dropdown('scid', $source_categories, $scid, $sc_attributes);				
                ?>
               </td>
               <td> 
                <?php
				$dest_attributes = 'id="dcid" class="select_action" style="width: 230px;"';
				$dest_categories = array();
				$dest_categories[''] = 'Select destination category';
				foreach($categories as $key => $value) $dest_categories[$key] = $value;
                echo form_dropdown('dcid', $dest_categories, $dcid, $dest_attributes);				
                ?>
               </td>
               <td> 
                <?php
				$option_attributes = 'id="option" class="select_action" style="width: 125px;"';
				$options = array('' => 'Select action', 'copy' => 'Copy', 'move' => 'Move', 'clone' => 'Clone');
				echo form_dropdown('option', $options, $option, $option_attributes);
                ?>
               </td>
               <td>
                <?php
				 echo form_submit('submit_value','Submit');
				?>
               </td>                                              
              </tr> 
              <tr valign="top">
               <td align="left"><span id="error1" class="error1"></span></td>
               <td align="left"><span id="error2" class="error1"></span></td>
               <td align="left"><span id="error3" class="error1"></span></td>
               <td align="left">&nbsp;</td>
              </tr>
              <tr>
               <td colspan="4" valign="top">
               Note: <span style="font-weight:normal;">To copy/move a products from one category to another, destination category must be diffrent from source category</span><br /><br />
               <?php
               if(count($duplicate_products) > 0)
               {
               ?>
                <span class="error1">Following checked products already exist in destination categegory</span>
               <?php	   
               }
               ?>
               </td>
              </tr>                

              <?php
			  $count = 0;
			  if(count($products) > 0)
			  {
			  ?>	   
               <tr>
                <td colspan="4" align="left" valign="top" style="border: solid thin #CCC; padding: 0px; font-weight: normal;">
                 <table width="100%" cellpadding="0" cellspacing="10">
                  <tr><td colspan="4">
                   Please select one or more products from following list to copy/move/clone. &nbsp;&nbsp;
                   <span id="error4" class="error1"></span>
                  </td></tr>
                  <?php
				  $td_cnt = 0;
				  foreach($products as $product)
				  {
				   $td_cnt++; $count++;	  
				   if($td_cnt==1) echo "<tr>";
				   ?>
                   <td>
                   <?php 
				   $check = FALSE;
				   if(in_array($product['id'], $duplicate_products)) $check = TRUE; 
				   $product_list = array
				   (
					'name'    => 'products[]',
					'id'      =>  'product_'.$count,
					'value'   => $product['id'],
					'checked' => $check
				   );
				   echo form_checkbox($product_list)."&nbsp;".$product['product_name']; 
                   if($td_cnt==4) $td_cnt=0;
				  }
				  if($td_cnt < 4) echo "</tr>";
                  ?> 
                </table>
               </td>
              </tr>   
              <?php
			  }
			  else if($scid != '')
			  {
			  ?>
               <tr><td><span class="error1">No product(s) found in selected category</span></td></tr>
              <?php
			  }
             ?>
             </table> 
			 <?php
			  echo form_hidden('total_products',$count);
              echo form_close();
			  
			  if($this->session->userdata('session_data'))
			  {
			   $this->session->unset_userdata('session_data');
			  }
             ?>  
            </div>
           </div>