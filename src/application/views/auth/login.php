  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                </br></br>
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                  </div>
                  <?php echo $this->session->flashdata('msg'); ?>
                  <form class="user" method="post" action="<?php echo site_url('Auth/login'); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="NIM" value="<?php echo set_value('nim') ;?>"><?php echo form_error('nim','<small class="text-danger pl-3">','</small>') ;   ?>
                  </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password"><?php echo form_error('password','<small class="text-danger pl-3">','</small>') ; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </br>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo site_url('auth/registration'); ?>">Create an Account!</a>
                  </div></br></br>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


