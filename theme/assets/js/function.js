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