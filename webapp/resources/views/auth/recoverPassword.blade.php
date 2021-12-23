@extends('layouts.app')

@section('content')
<section class="vh-100 bg-image" style="background: rgb(0,0,0); background: rgba(0,0,0,0.4);">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Recover Password</h2>

              <form>
                <div  class="text-secondary text-center pb-2">
                    <p>Introduce your email adress.</p>
                    <p> We will send you an email with your password.</p>
                </div>
                
                <div class="form-outline mb-2">
                  <input type="email" id="formEmail" class="form-control form-control-lg" placeholder="Email"/>
                </div>

                
                <div class="form-check d-flex justify-content-center mb-5">
                  <!-- <input
                    class="form-check-input me-2"
                    type="checkbox"
                    value=""
                    id="form2Example3cg"
                  />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label> -->
                </div>

                <div class="d-flex justify-content-center">
                  <button type="button" class="btn btn btn-outline-secondary btn-block btn-lg bg-dark text-white">Send Email</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Go back to <a href="#!" class="fw-bold text-body"><u>Login</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection