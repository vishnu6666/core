 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 Flashdata by Codeigniter
 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

 <?php 
/* Controller File */
 $this->session->set_flashdata('success_msg', 'Gastronomy Added Successfully');
 redirect('gastronomy');   
 ?>          
<!-- view file -->
<br>
<?php
    $success_msg=$this->session->flashdata('success_msg');
    $error_msg=$this->session->flashdata('error_msg');
    if($error_msg){
        ?>
            <div class="alert alert-danger background-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="ti-close" style="color:#fff"></i></button>
                <small><?php echo $error_msg; ?></small>
            </div>
        <?php }elseif($success_msg){?>
            <div class="alert alert-success background-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="ti-close" style="color:#fff"></i></button>
                <small><?php echo $success_msg; ?></small>
            </div>
    <?php } ?>
?>

<script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
  }, 3000);
</script>