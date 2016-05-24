
<script>
    
     jQuery(window).resize(function(){
         

 $('#modal_ajax').on('shown',function(){
     var offset = 0;
     $(this).find('.modal-body').attr('style','max-height:'+($(window).height()-offset)+'px !important;');
  });
  $('modal.fade.in').on('shown',function(){
     var offset = 0;
     $(this).find('.modal-body').attr('style','max-height:'+($(window).height()-offset)+'px !important;');
  }); 
  });  
</script>

<script type="text/javascript">
    function showAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="<?php echo base_url(); ?>assets/img/preloader.gif" /></div>');

        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});

        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function (response)
            {
                jQuery('#modal_ajax .modal-body').html(response);
            }
        });
    }
</script>

<div aria-hidden="true" role="dialog" tabindex="-1" id="modal_ajax" class="modal fade">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 id="myModalLabel2" class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
    </div>
</div>
<!-- (Ajax Modal)-->
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Learning Management System</h4>
            </div>

            <div class="modal-body" style=" overflow:auto;">



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    function confirm_modal(delete_url)
    {
        jQuery('#modal-4').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href', delete_url);
    }
</script>

<!-- (Normal Modal)-->
<div class="modal fade" id="modal-4">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Are you sure to remove this information ?</h4>
            </div>


            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <a href="" class="btn btn-danger" id="delete_link">Remove</a>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>