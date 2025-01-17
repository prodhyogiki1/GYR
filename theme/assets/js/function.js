var loading_img='../../images/loading.gif';

function get_details(inputid,outputid,url)
{
// alert(outputid);
  $('#'+outputid).html('');
  var id=$('#'+inputid).val();
  //alert(id);
  $.ajax({
           type: "POST",
           url: url+id,
           success: function(data)
           {
           //alert(data);
               $('#msg'+outputid).html("Please Wait !!!");
               $('#'+outputid).html(data);
               $('#msg'+outputid).html("")
              
           }
        });

}


function form_submit(x) 
{
      var form = $("#"+x);
        $('#msg'+x).html("Please Wait !");
       // form.hide();
        $.ajax({
           type: "POST",
           url: $("#"+x).attr("action"),
           data: form.serialize(),
           success: function(result)
           {
              $('#msg'+x).html(result);  
              // setTimeout(function(){
              //       $('#msg'+x).slideUp('slow').fadeOut(function() {
              //           window.location.reload();
              //       });
              // }, 1000); 
           }
        }); 
        //form.show(); 
 } 


  //-- action, query , id
function deleteme(h,i,j)
{
  var r = confirm("Are you sure you want to delete  ??");
  
  if (r == true) 
  {
     $.ajax({
           type: "GET",
           url: 'index.php?action='+h+'&query='+i+'&id='+j,
           success: function(data)
           {
            //alert(data);
               alert('index.php?action='+h+'&query='+i+'&id='+j);
               $('#'+j).toggle(750); 
            
           }
       }); 
  } 
}


function show_page_model(title,page)
{
  //alert(base_url+page);
  $('#modal-title').html(title); 
  //alert(page);
  $('#modal-body').html('<img src='+loading_img+'>');
  $('#modal-body').load(page); 
}