<?php 
include 'server/security.php';
include 'includes/header.php';
?>

<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-xl-6 col-lg-6 col-md-6">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-12 text-center">
							<div class="p-5">
								<img src="img/logo.png" class="col-lg-12">
								<hr>
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Login Here !</h1>

									<?php if (isset($_SESSION['status'])) { ?>
										<div class="alert alert-danger" role="alert">
											<?php echo $_SESSION['status']; 
												unset($_SESSION['status']);
												?>
										</div>
									<?php } ?>
								</div>


								<form class="user" action="quanlitaikhoan.php" method="POST">
									<div class="form-group">
										<input type="email" name="email" class="form-control form-control-user" aria-describedby="emailHelp"
										placeholder="Enter Email Address...">
									</div>
									<div class="form-group">
										<input type="password" name="password" class="form-control form-control-user" placeholder="Password">
									</div>
									<br>
									<button type="submit" name="login_btn" class="button btn-user btn-block btn btn-dark">
										Login
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>


<?php 
include 'includes/scripts.php';
?>