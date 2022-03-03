<!-- <script>
$(document).ready(function(){
  $("input.numbers").blur(function(){
	  if(isNaN(new Number(this.value))){
		this.value = ''
	  } else {
		var d = new Number(this.value);
	  	this.value = d.toLocaleString('de');
	  }
  });
});
</script> -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; <?php echo date('Y'); ?> <?php echo $this->config->item('title_web'); ?>.</strong> All rights
  reserved.
</footer>