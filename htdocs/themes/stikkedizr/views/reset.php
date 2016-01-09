<?php $this->load->view('defaults/header'); ?>
<div class="row" style="margin-top:20px;">
    <div class="col-6 col-sm-12 col-lg-6" style="margin:0 auto;">
      <form action="" method="post" class="form-vertical well">
				<div class="col-12 col-sm-12 col-lg-12" style="margin:0 auto;">
					<label for="email">
						<i class="fa fa-envelope-o"></i> Email
					</label>
					<?php echo form_error('email', '<div style="color: rgb(224, 63, 63);">', '</div>'); ?>
					<input type="email" name="email" class="form-control" maxlength="32">
				</div>
				<div class="form-actions col-12 col-sm-12 col-lg-12" style="text-align:center; margin:0 auto;">
					</br>
					<button type="submit" name="submit" value="submit" class="btn btn-large btn-primary" style="width:100%;">
						<i class="icon-pencil icon-white"></i>
						Reset Password!
					</button>
				</div>
      </form>
    </div>
</div>
<?php $this->load->view('defaults/footer');?>
