<?php
if(isset($cta)) {
    if(count($cta) > 0)
    {
     ?>
     <div class="ctaman"> 
     <?php
     foreach($cta as $c_item)
     {
      echo $c_item['intro_text'];
     }
     ?>
     </div>
     <?php
    }
}
?>
