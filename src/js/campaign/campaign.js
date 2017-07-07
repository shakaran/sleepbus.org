function getMoreRecords(cp,campaign_id)
{

  var path=document.getElementById('path').value;
  var param = {'cp':cp,'campaign_id':campaign_id}; // you can send multiple argument as {cp:cp,name:name}
	
	$.ajax({
  	url: path+'campaigns/getMoreRecords',
	type:'POST', // You may use GET method also
   	data: param, 

  	success: function(result) {
    $("#donation-list").html(result);		
   } 
  });	
}
