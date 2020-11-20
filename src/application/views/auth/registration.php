
  <div class="container">

<div class="col-xl-12">

<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
      <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
      <div class="col-lG">
        <div class="p-5">
          <div class="text-center"> 
            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
          </div>
          <form class="user" method="post" action="<?php echo site_url('auth/registration') ;?>">
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="nim" name="nim" placeholder="NIM" value="<?php echo set_value('nim') ;?>"><?php echo form_error('nim','<small class="text-danger pl-3">','</small>') ; ?>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Full Name" value="<?php echo set_value('nama') ;?>"><?php echo form_error('nama','<small class="text-danger pl-3">','</small>') ; ?>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?php echo set_value('email') ;?>"><?php echo form_error('email','<small class="text-danger pl-3">','</small>') ;   ?>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password"><?php echo form_error('password1','<small class="text-danger pl-3">','</small>') ;   ?>
              </div>
              <div class="col-sm-6">
                <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Register Account
            </button>
          <hr>
          <div class="text-center">
            <a class="small" href="<?php echo site_url('auth') ;?>">Already have an account? Login!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>


