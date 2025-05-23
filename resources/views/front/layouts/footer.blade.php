<footer class="bg-dark text-inverse mt-0">
    <div class="container py-13 py-md-15">
        <div class="row gy-6 gy-lg-0">
            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <img class="mb-4" src="{{asset('Front/assets/img/logo-white.png')}}" srcset="{{asset('Front/assets/img/logo-white.png')}}@2x.png 2x" alt="" style="height: 65px;"/>
                    <p class="mb-4">© <?=date("Y")?> ArtWork. <br class="d-none d-lg-block" />All rights reserved.</p>

                    <nav class="nav social social-white">
                        <a href="#"><i class="uil uil-twitter"></i></a>
                        <a href="#"><i class="uil uil-facebook-f"></i></a>
                        <a href="#"><i class="uil uil-dribbble"></i></a>
                        <a href="#"><i class="uil uil-instagram"></i></a>
                        <a href="#"><i class="uil uil-youtube"></i></a>
                    </nav>
                    <!-- /.social -->
                </div>
                <!-- /.widget -->
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Address</h4>
                    <address class="pe-xl-15 pe-xxl-17">14/05 Light City, United States</address>
                    <a href="mailto:#">info@email.com</a><br /> +00 (000) 000 00 00
                </div>
                <!-- /.widget -->
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Links</h4>
                    <ul class="list-unstyled footer-links mb-0">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Embroidery Digitizing</a></li>
                        <li><a href="#">Art Services</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <!--<li><span>Art Services</span>
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Vector Art</a></li>
                                <li><a href="#">My Designer</a></li>
                                <li><a href="#">Logo Creation</a></li>
                            </ul>
                        </li>-->

                    </ul>
                </div>
                <!-- /.widget -->
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <h4 class="widget-title text-white mb-3">Links</h4>
                    <ul class="list-unstyled footer-links mb-0">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <!--<li><span>Art Services</span>
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Vector Art</a></li>
                                <li><a href="#">My Designer</a></li>
                                <li><a href="#">Logo Creation</a></li>
                            </ul>
                        </li>-->

                    </ul>
                </div>
                <!-- /.widget -->
            </div>

            <!--<div class="col-md-4 col-lg-3">
                <div class="widget">
                    <ul class="list-unstyled footer-links mb-0">
                        <li><span>Embroidered Patches</span>
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Request a Quote</a></li>
                                <li><a href="#">Thread Chart</a></li>
                                <li><a href="#">Fabric Colors</a></li>
                                <li><a href="#">Patch Pricing</a></li>
                            </ul>
                        </li>
                        <li><span>My Designer</span>
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Pricing</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="widget">
                    <ul class="list-unstyled footer-links mb-0">
                        <li><span>Woven Patches</span>
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Request a Quote</a></li>
                                <li><a href="#">Pricing</a></li>
                                <li><a href="#">Colors Chart</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>-->

        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</footer>
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<div class="modal fade" id="modal-forgot-password" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content text-center">
            <div class="modal-body">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <h3 class="mb-4">Forgot Password?</h3>
                <form action="{{route('forget.password.post')}}" method="post" class="text-start mb-3">
                    @csrf
                    <div class="form-label-group form-group mb-4">
                        <input type="email" class="form-control" name="email" placeholder="Enter email address" />
                        <label> Email Address</label>
                    </div>
                    @include('admin.auth.flash-message')
					@yield('content')
                    <button type="submit" class="btn btn-primary rounded-pill btn-fp w-100 mb-2">Reset Password</button>
                </form>
                <p class="mb-0"><a data-bs-dismiss="modal" data-toggle="modal" data-target="#modal-login" href="javascript:void(0);" class="hover">Back to login</a></p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-logout" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content text-center">
            <div class="modal-body">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <h3 class="mb-4">Are you sure do you want to logout?</h3>

                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <a data-bs-dismiss="modal" href="javascript:void(0);" class="btn btn-danger rounded-pill w-15 mb-2">No</a> &nbsp; &nbsp;
                        <a href="{{route('user-logout')}}" class="btn btn-primary rounded-pill w-15 mb-2">Yes</a>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-login" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content text-center">
            <div class="modal-body">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <h3 class="mb-4">Login to ArtWork</h3>

                <form action="post" data-ajax="action/login" data-target-button=".btn-login" data-allow-success class="text-start mb-3">
                    <div class="form-label-group form-group mb-4">
                        <input type="email" class="form-control" name="username" placeholder="Email" required data-error="Please enter valid email address." />
                        <label for="loginEmail">Username / Email Address</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-label-group form-group mb-4">
                        <input type="password" class="form-control" name="password" placeholder="Password" required data-error="Please enter password." />
                        <label for="loginPassword">Password</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="messages"></div>
                    <button class="btn btn-primary rounded-pill btn-login w-100 mb-2">Log In</button>
                </form>

                <p class="mb-1"><a data-bs-dismiss="modal" data-toggle="modal" data-target="#modal-forgot-password" href="javascript:void(0);" class="hover">Forgot Password?</a></p>
                <p class="mb-0">Don't have an account? <a data-bs-dismiss="modal" data-toggle="modal" data-target="#modal-register" href="javascript:void(0);" class="hover">Sign up</a></p>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-register" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content text-center">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h3 class="mb-4">Register</h3>
                <form action="{{route('user-register')}}" method="POST" class="text-start mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-label-group form-group mb-4">
                                <input type="text" class="form-control" name="first_name" placeholder="Enter first name" required data-error="Please enter first name." />
                                <label for="reg_fname">First Name</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group form-group mb-4">
                                <input type="text" class="form-control" name="last_name" placeholder="Enter last name" required data-error="Please enter last name." />
                                <label for="reg_lname">Last Name</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-label-group form-group mb-4">
                                <input type="text" class="form-control" name="username" placeholder="Enter username" required data-error="Please enter username." />
                                <label for="reg_username">Username</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group form-group mb-4">
                                <input type="email" class="form-control" name="email" placeholder="Enter email address" required data-error="Please enter valid email address." />
                                <label for="reg_email">Email Address</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-label-group form-group mb-4">
                                <input type="phone" class="form-control" name="phone" placeholder="Enter phone number" required data-error="Please enter phone number." />
                                <label for="reg_phone">Phone Number</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group form-group mb-4">
                                <input type="text" class="form-control" name="promo_code" placeholder="Enter promo code" />
                                <label for="reg_password">Promo Code(Optional)</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-label-group form-group mb-4">
                                <input type="password" class="form-control" name="password" placeholder="Enter password" required data-error="Please enter password." />
                                <label for="reg_password">Password</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group form-group mb-4">
                                <input type="password" class="form-control" name="conf_password" placeholder="Enter confirm password" required data-error="Please enter confirm password." />
                                <label for="reg_conf_password">Confirm Password</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('front.auth.flash-message')
                            @yield('content')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <p class="mb-0 cv">Already have an account? <a data-bs-dismiss="modal" data-toggle="modal" data-target="#modal-login" href="javascript:void(0);" class="hover">Login</a></p>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary rounded-pill w-100 mb-2">Register</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>

   /*function ajax_success(target,response_json){
        if(target=="action/login"){
            window.location.href=response_json.data.redirect;
        }else if(target=="create-digitizing-order"){
            $("select[name='required_file_format']").val("").trigger("change");
            $("select[name='fabric_name']").val("").trigger("change");
            $("select[name='garment_placement']").val("").trigger("change");
        }else if(target=="action/reset-password"){
            setTimeout(function(){
				window.location.href="/login.php";
			}, 3000);
        }
    }*/

</script>
