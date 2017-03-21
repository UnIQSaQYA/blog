<?php
require_once 'core/init.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true
			),
			'password' => array(
				'required' => true,
			),
		));

		if($validation->passed()) {
			$user = new User();
			$remember = (Input::get('remember') ==='on') ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($remember) {

			}
			
			if($login) {
				Redirect::to('index.php');
			} else {
				echo '<p>sorry, login failed</p>';
			}

		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}
?>

<?php
include "includes/header.php";
?>
<div class="container">
	<div class="row justify-content-center align-items-center min-height-100">
		<div class="col-lg-4 col-md-4">
			<div class="card no-border-radius">
				<div class="card-header">
					<h5>Login</h5>
				</div>
				<div class="card-block">
					<form action="" method="post">
						<div class="form-group">
							<input type="text" name="username" class="form-control" autocomplete="off" placeholder="username">
						</div>

						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="password">
						</div>

						<div class="form-check">
						    <label class="form-check-label">
						      <input type="checkbox" class="form-check-input" name="remember">
						      Remember me
						    </label>
						</div>
						<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
						<hr>
						<div class="">
							<button type="submit" class="btn btn-success btn-block">Login</button>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<p>New here! <a href="register.php">Register</a></p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include "includes/footer.php";
?>