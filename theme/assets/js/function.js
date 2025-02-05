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
      var form = $("#form"+x);
      
        $('#result'+x).html("Please Wait !");
        
        $.ajax({
           type: "POST",
           url: form.attr("action"),
           data: form.serialize(),
           success: function(result)
           {
              $('#result'+x).html(result);  
           }
        }); 
 }
 
 function form_submit2(x) 
{
      var form = $("#"+x);
      
        $('#result'+x).html("Please Wait !!");
       
        $.ajax({
           type: "POST",
           url: $("#"+x).attr("action"),
           data: form.serialize(),
           success: function(result)
           {
              //$('#result'+x).html(result);  
              
              console.log(result);
              setTimeout(function(){
                    $('#result'+x).slideUp('slow').fadeOut(function() {
                    });
              }, 1000); 
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
  
  $('#modal-title').html(title); 
  $('#modal-body').html('<img src='+loading_img+'>');
  $('#modal-body').load(page); 
}

function show_hide(id1,id2)
{
  $('.'+id1).hide();
  $('.'+id2).show();
}



function form_submit_bulk(classname) 
{
  var r = confirm("Are you sure you want to update all  ??");
  
  if (r == true) 
  {
    var arr=[];
      $("."+classname).each(function(){
        var checked_Data=$(this).is(":checked");
        
        if(checked_Data==true)
        {
          var check_val =$(this).val();
          $('#result'+check_val).html('<span class="text-secondary">Please Wait...</span>');  
          form_submit2('form'+check_val);
          $('#result'+check_val).html('<span class="text-success">Updated !!!</span>');  
          show_hide('check_btn','bulk_upload');
        }

        });
        
      //--unchecked all checkbox
      $('.'+classname).prop("checked", false);

  }
}
