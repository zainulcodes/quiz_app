<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ElectronLab Admin</title>

<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/adminlte.min.css'); ?>">
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/all.min.css'); ?>"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="<?php echo base_url('assets/admin/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/js/adminlte.min.js'); ?>"></script>

</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

    <?php $this->load->view('admin/navbar'); ?>
    <?php $this->load->view('admin/sidebar'); ?>

    <!-- CONTENT -->
    <div class="content-wrapper p-3">
        <?php $this->load->view($page); ?>
    </div>

</div>
<script>
$(function(){
    var url = window.location.href;
    $('.nav-link').each(function(){
        if(this.href == url){
            $(this).addClass('active');
        }
    });
});
</script>
</body>
</html>
