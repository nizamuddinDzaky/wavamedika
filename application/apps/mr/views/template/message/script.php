<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/adminlte.min.js');?>"></script>
<?php
if (isset($js)) {
    $this->load->view('js/'.$js);
}
?>