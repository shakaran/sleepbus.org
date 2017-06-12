<div class="col1"> 
    <!-- left panel -->
    <div class="leftpanel">
      <h2><?php echo $page_heading['0']['page_heading']?></h2>
      
    </div>
    
    <!-- end left part --> 
    <!-- right part -->
    <div class="col2">
      <div class="pagetitle">
        <h1><?php echo $page_heading['1']['page_heading']?> for : <strong><?php echo $search_text; ?></strong></h1>
        
      </div>
      <div class="col6">
        <?php 
		if(count($search_results) > 0)
		{
	     foreach($search_results as $key => $result_value)		
		 {
		  if($key != 'pages') echo '<span style="padding-left: 13px; font-weight: bold;">'.ucwords($key).'</span>'; 
 echo "<div class='search'><ul>";
		  foreach($result_value as $result)
		  {
           echo "<li>".anchor($result['url'], $result['title'])."</li>";
		  }
		  echo "</ul></div>";
		 }
		}
		else echo "No Searh Result Found";
		?>
        </ul>
      </div>
      <div class="clear">&nbsp;</div>
    </div>
  </div>