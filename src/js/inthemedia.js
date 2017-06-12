$('#showOlderPost').click(function(){
 var total_item=Number($("#total_item").val());
 var show_item=Number($("#show_item").val());
 var remain_item=Number($("#remain_item").val());
 //alert($("tbody tr.nshow").length);
 if(remain_item > 0)
 {
  var counter=1;	 
  $("tbody tr.nshow").each(function(i,d){

  if(remain_item > 0)
  {
   if(counter <= show_item)
   {
	$(this).removeClass('nshow');   
    remain_item--;
    counter++;
   }
  }	
	   
  })
  
  $("#remain_item").val(remain_item);
  if(remain_item <= 0)
  {
   $("#olderPostTr").hide();
  }
 }
 else
 {
  $("#olderPostTr").hide();
 } 	
});