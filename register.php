<?php
require_once 'core/init.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6,
			),
			'password_again' => array(
				'required' => true,
				'matches' => 'password',
			),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));

		if($validation->passed()) {
			$user = new User();

			$salt = Hash::salt(32);
			try {
				$user->create(array(
					'username' => Input::get('username'),
					'passwords' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
					'user_group' => 1,
				));

				Session::flash('home', 'You have been registered and can now login!');
				Redirect::to('index.php');
			} catch(Exception $e) {
				die($e->getMessage());
			}
		}else {
			foreach($validation->errors() as $error) {
				echo $error, '<br/>';
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
					<h5>Register</h5>
				</div>
				<div class="card-block">
					<form action="" method="post">
						<div class="form-group">
							<input type="text" name="username" class="form-control" autocomplete="off" placeholder="Username" value="<?php echo escape(Input::get('username')); ?>">
						</div>

						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>

						<div class="form-group">
							<input type="password" name="password_again" class="form-control" placeholder="Confirm Password">
						</div>
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Full name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off">
						</div>
						<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
						<hr>
						<div class="">
							<button type="submit" class="btn btn-success btn-block">Register</button>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<p>Already have an account! <a href="login.php">Login</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include "includes/footer.php";
?>