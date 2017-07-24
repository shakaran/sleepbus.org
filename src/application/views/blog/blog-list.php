
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="container">
    <div class="row">
       <div class="funding">
        <?php
         echo $top_text['content'];
		?>
       </div>
       </div>
    </div>
  </div>
  
<?php
if(count($all_blogs) > 0)
{
 ?>  
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blogmainbox">
  <div class="row">
  
  <?php
   foreach($all_blogs as $blog)
   {
    ?>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 blogbox">
      <a href="<?php echo base_url().'blog/'.$blog['cat_url'].'/'.$blog['url'];?>"> 
       <?php
        echo $blog['intro_text'];
	   ?>
       </a>
    </div>
	<?php
   }
   ?>
  </div>  
 </div>
 <?php
}
?> 

