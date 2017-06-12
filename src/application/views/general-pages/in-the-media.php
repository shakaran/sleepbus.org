<?php
 echo $top_text['content'];
?>
<input type="hidden" name="total_item" id="total_item" value="<?php echo $total_item;?>">
<input type="hidden" name="show_item" id="show_item" value="<?php echo $show_item;?>">
<input type="hidden" name="remain_item" id="remain_item" value="<?php echo ($total_item-$show_item);?>">

<style>
.nshow{display:none;}
</style>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container">
  <?php
   if($total_item > 0)
   {
    ?>
  	<div class="inthemediatable">
    <table class="table table-striped">
    <thead>
      <tr class="tablecolor">
        <th width="13%">Date</th>
        <th width="15%">Publication</th>
        <th width="72%">Topic</th>
      </tr>
    </thead>
    <tbody>
    <?php
	$i=0;
    foreach($media_items as $item)
	{
     $i++;		
	 ?>
	  <tr <?php if($i > $show_item){?> class="nshow"<?php }?>>
        <td><?php echo $item['item_date'];?></td>
        <td><?php echo $item['publication'];?> </td>
        <td><a href="<?php echo $item['url'];?>" target="_blank"><?php echo $item['media_title'];?></a></td>
      </tr>
	 <?php
	}
	?>
   
      <?php 
	  if($total_item > $show_item)
	  {
	   ?> 
       <tr id="olderPostTr">
        <td colspan="3" align="center" class="font12"><a href="javascript:void(0)" id="showOlderPost">Older Posts &nbsp; <img src="<?php echo base_url();?>images/icon27.png" alt=""></a></td>
       </tr>
      <?php
	  }
	  ?> 
    </tbody>
  </table>
    </div>
    <?php
	}
    echo $bottom_text['content'];
    ?>
    
  </div>
</div> 
