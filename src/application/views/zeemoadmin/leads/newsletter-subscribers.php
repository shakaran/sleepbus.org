<div class="record_list">
	 <?php
     if(isset($subscribers) && count($subscribers) > 0)
     {
     ?>
      <?php /*<div style="text-align:right" class="cate_result1"><a href="<?=base_url().admin;?>/leads/download-excel/<?=$from_date?>/<?=$to_date?>/<?php echo $reports_type;?>" class="link2">Click here</a> to download in excel format.</div> */ ?>
      <div class="ulTable" style="width: 700px;">
       <ul>
        <li>
            <div style="width:40px;" class="ulTableinner sn-no">&nbsp;&nbsp;S.No</div>
            <div style="width:268px;" class="ulTableinner sn-no-other">Email</div>
            <div style="width:230px;" class="ulTableinner sn-no-other">Name</div>
            <div style="width:120px;" class="ulTableinner sn-no-other">Group</div>
         <div class="clearfix"></div>
        </li>
       </ul>
      </div>
      <div class="ulTable_record" id="recordList"  style="width: 700px;">
      <ul>
       <?php
       $i=1;
       $j=1;
       foreach($subscribers as $records)
       {
       ?>
        <li style="padding:2px;">
         <div style="width:35px; padding:2px;" class="ulTableinner_record sn-no">&nbsp;&nbsp;<?php echo $j;?></div>
         <div style="width:268px;" class="ulTableinner_record sn-no-other">
           <?php echo ucwords($records['email']);?>
         </div>
         <div style="width:220px;" class="ulTableinner_record sn-no-other">
           <?php if(!empty($records['name'])) echo ucwords($records['name']); else echo '--';?>
         </div>
         <div style="width:120px;" class="ulTableinner_record sn-no-other"><?php echo $records['group_name'];?></div>
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
       ?>
        <div class="success"> No records found.</div>
       <?php
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