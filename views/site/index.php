<?php

/** @var yii\web\View $this */

$this->title = 'OneNumber | OneFax';
use yii\bootstrap4\Dropdown;
?>
<div class="site-index">














    <div class="row justify-content-center dropdown">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Wyślij Fax</h1>
                                </div>
                                <form class="user">
                                    <div class="form-group">
                                        <input data-toggle="dropdown" type="tel" class="form-control form-control-user dropdown-toggle caret" id="calling_number" placeholder="Nadawca" required>
                                    </div>
                                    <div class="form-group">
                                        <input data-toggle="dropdown" type="tel" class="form-control form-control-user dropdown-toggle caret" id="calling_number" placeholder="Odbiorca" required>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-user">Załącz plik</a>
                                    </div>
                                    <input type="submit" value="Wyślij" class="btn btn-primary btn-user btn-block">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="dropdown-menu">
          <form class="px-4 py-3">
            <div class="form-group">
              <label for="exampleDropdownFormEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
            </div>
            <div class="form-group">
              <label for="exampleDropdownFormPassword1">Password</label>
              <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="dropdownCheck">
              <label class="form-check-label" for="dropdownCheck">
                Remember me
              </label>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
          </form>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">New around here? Sign up</a>
          <a class="dropdown-item" href="#">Forgot password?</a>
        </div>

    </div>

</div>
