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