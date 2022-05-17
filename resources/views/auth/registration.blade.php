
						<!--section dashboard-->
		<div class="section dashboard">
			<div class="container" style="margin: 0px">
				<div class="text-center mb-2  mb-md-3 mb-lg-4">
					<div class="h-sub theme-color">Register to</div>
					<h1>Your Account</h1>
					<div class="h-decor"></div>
				</div>

							<!-- Login Container -->
				<div class="row">
					<div class="col-md-5 m-auto">
						<div class="login-reg">
							<form method="post" action="{{url('register-save')}}" enctype="multipart/form-data">
								<div class="form-group">
									<label>Name*</label>
									<input name="username" class="form-control" placeholder="Name" type="text">
									@if($errors->has('username'))
										<span class="invalid-feedback" style="display:block;">{{$errors->first('username')}}</span>
									@endif
								</div>
								<div class="form-group">
									<label>Email*</label>
									<input name="email" class="form-control" placeholder="Email or Username" type="text">
									@if($errors->has('email'))
										<span class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</span>
									@endif
								</div>



								<div class="form-group">
									<label>Password</label>
									<input type="password"  name="password" class="form-control" placeholder="password" >
								</div>

								<div class="form-group">

									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<button  type="submit"  class="btn btn-outline-success">Submit </button>
									<!--<input class="btn btn-sm btn-hover-fill mt-10 submit" type="submit" name="submit" value="Register Now"/>-->

								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
				<!--//section services-->






