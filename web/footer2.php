</div>
  </div>
  <script src="<?php echo $base_url;?>theme/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo $base_url;?>theme/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $base_url;?>theme/assets/js/sidebarmenu.js"></script>
  <script src="<?php echo $base_url;?>theme/assets/js/app.min.js"></script>
  <script src="<?php echo $base_url;?>theme/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="<?php echo $base_url;?>theme/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="<?php echo $base_url;?>theme/assets/js/dashboard.js"></script>
<!-- custom -->
 
 <script src="<?php echo $base_url.'theme/assets/js/function.js';?>?ver=<?php echo $rand;?>"></script>
  <!-- data table-->

  <link href="<?php echo $base_url;?>theme/assets/js/datatables.min.css" rel="stylesheet">
 <script src="<?php echo $base_url;?>theme/assets/js/datatables.min.js"></script>
 <script>
   $( document ).ready(function() {
    new DataTable('#example');
});
 </script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modal-title"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body" >
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
    </div>
  </div>
</div>


</body>

</html>