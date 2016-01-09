<?php $this->load->view('defaults/header'); ?>
<?php //echo validation_errors('<div>', '</div>'); ?>
<div class="row" style="margin-top:20px;">
    <div class="col-6 col-sm-12 col-lg-6" style="margin:0 auto;">
      <form action="" method="post" class="form-vertical well">
      	<div class="row col-12 col-sm-12 col-lg-12">
      	<div style="color: rgb(224, 63, 63);">
      		<?php 
      		if (isset($_GET['f']) && $_GET['f'] == 1) {
      			echo "Password reset link sent to your email! please check your email.";
      		}
      		?>
      	</div>
      </div>
      			<div class="col-12 col-sm-12 col-lg-12" style="margin:0 auto;">
					<label for="username">
						<i class="fa fa-user"></i> User Name
					</label>
					<?php echo form_error('username', '<div style="color: rgb(224, 63, 63);">', '</div>'); ?>
					<input type="text" name="username" class="form-control" maxlength="32">
				</div>
				<div class="col-12 col-sm-12 col-lg-12" style="margin:0 auto;">
				</br>
					<label for="password">
							<i class="fa fa-lock"></i> Password
					</label>
					<?php echo form_error('password', '<div style="color: rgb(224, 63, 63);">', '</div>'); ?>
					<input type="password" name="password" class="form-control" maxlength="32">
				</div>
				<div class="col-12 col-sm-12 col-lg-12" style="margin:0 auto;">
				</br>
					<a href="signup"> Don't have account? signup to view your pastes!</a>
				</br>
				</br>
					<a href="reset"> Forgot your password? reset it here!</a>
				</div>
				<div class="form-actions col-12 col-sm-12 col-lg-12" style="text-align:center; margin:0 auto;">
					</br>
					<button type="submit" name="submit" value="submit" class="btn btn-large btn-primary" style="width:100%;">
						<i class="icon-pencil icon-white"></i>
						Login!
					</button>
				</div>
      </form>
    </div>
</div>
<?php $this->load->view('defaults/footer');?>
