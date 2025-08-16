 <script type="text/javascript" src="<?php echo $base_url.'library/vendor/';?>ckeditor/ckeditor.js"></script>
 <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

<div class="container-fluid">

    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
    <h5 class="card-title">Policy</h5>
    </div>
    </div>
    </div>

    <div class="container-fluid">
    <div class="card">
    <div class="card-header">
    <h5 class="card-title">Add Policy</h5>
    <span id="msgadd_policy"></span>
    <Form name="add_policy" id="add_policy" method="post" action="<?php echo $base_url.'index.php?action=agent&query=add_policy'?>">
    <div class="form-group row">
        <div class="form-group col-sm-3">
            <label>Policy Name</label>
            <input type="text" class="form-control" name="policy_name" placeholder="Policy Name">
        </div>
        <div class="form-group col-sm-7">
            <label>Details</label>
            <textarea id="editor" name="details"></textarea>
        </div>
        <div class="form-group col-sm-2">
            <button type="buton" onclick="form_submit('add_policy')" class="btn btn-primary">Add</button>
        </div>
        </form>
    </div>

    </div>
    </div>

    
    
        <div class="container-fluid">
          <div class="card">


<?php $policy=$admin->get_all_policy();
if($policy){
    foreach($policy as $k=>$v){
        //-- access UID and BID from array
?>
        <div class="card-body content">
            <div class="card-body">
                <span id="msg<?php echo $v['policy_name'] ?>"></span>
                <form name="<?php echo $v['policy_name'] ?>" id="<?php echo $v['policy_name'] ?>" method="post" action="<?php echo $base_url.'index.php?action=agent&query=update_policy'?>">
                    <div class="form-group row">
                       <div class="form-group col-sm-3">
                            <label>Policy Name</label>
                            <input type="text" class="form-control" name="policy_name" value="<?=$v['policy_name'];?>" readonly>
                        </div>
                        <div class="form-group col-sm-7">
                            <label>Details</label>    
                            <textarea id="<?php echo str_replace(" ","_",$v['policy_name']);?>editor" name="details"><?=$v['details'];?></textarea>
                        </div>
                        <div class="form-group col-sm-2">
                            <span class="text-danger">Last Updated On : <?=$v['date_update'];?></span>
                            <button type="buton" onclick="form_submit('<?php echo $v['policy_name'] ?>')" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                
            </div>
            <hr>
        </div>
            
        <script>
            $( document ).ready(function() {
             CKEDITOR.replace('<?php echo str_replace(" ","_",$v['policy_name']);?>editor' );
            });
        </script>
    <?php } }?>
        
    
    </div>
</div>



                  </div>

                </div>
                
               
              </div>
            </div>
          </div>
        </div>
      </div>


     
     
