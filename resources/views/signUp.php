<?php $this->layout('layout', ['title' => 'sign Up']) ?>

<?php foreach ($session->getFlashBag()->all() as $type => $messages) : ?>
    <?php foreach ($messages as $mess) : ?>
        <div class="alert alert-<?= $type ?>">
            <?= $mess ?>
        </div>
    <?php endforeach ?>
<?php endforeach ?>


<div class="shadow-lg card text-dark bg-light mb-3 mx-auto" style="width: 80%;">
    <div class="card-header bg-primary text-white font-weight-bolder">Sign Up</div>
    <div class="card-body">
        <fieldset class="card-text p-3">
            <form action="/fc/public<?= $this->e($this->uri()) ?>" method='POST' class="form needs-validation" novalidate>
                <div class="form-group row input-group">
                    <div class="input-group-prepend">
                        <label for="userName" class="input-group-text">Name</label>
                    </div>
                    <input type="text" class="form-control" id="userName" placeholder="Name" name='userName' required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        you must enter a name
                    </div>
                </div>
                <div class="form-group row input-group">
                    <div class="input-group-prepend">
                        <label for="userEmail" class="input-group-text">Email</label>
                        <span class='input-group-text'>@</span>
                    </div>
                    <input type="email" class="form-control" id="userEmail" placeholder="Email" name='userEmail' required>
                </div>
                <div class="form-group row input-group">
                    <div class="input-group-prepend">
                        <span class='input-group-text'>@</span>
                    </div>
                    <input type="text" class="form-control" id="userSn" placeholder="login name" name='userSn' required>
                </div>
                <div class="form-group row input-group">
                    <div class="input-group-prepend">
                        <label for="password" class="input-group-text ">Password</label>
                    </div>
                    <input type="password" class="form-control password" id="password" placeholder="Password" aria-describedby="showPass" required>
                    <div class="input-group-prepend">
                        <button type='button' class="btn btn-primary" id='showPass' name="userPass">
                            &Omega;
                        </button>
                    </div>
                    <div class="valid-feedback" style="display:block">
                        <p id="passwordHelpBlock" class="form-text text-muted">password must be 7 chars long</p>
                    </div>
                    <div class="invalid-feedback">
                        you must enter a password
                    </div>
                </div>
                <div class="form-group row input-group">
                    <div class="input-group-prepend">
                        <label for="confPassword" class="input-group-text ">Confirm Password</label>
                    </div>
                    <input type="password" class="form-control password" id="confPassword" placeholder="Confirm Password" aria-describedby="showPass2" name="confPass" required>
                    <div class="valid-feedback">
                        password matched
                    </div>
                    <div class="invalid-feedback">
                        password not matched
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary btn-r submit">
                            Sign Up
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <span class="text-secondary">
                            Or already have an accout logIn from
                            <a class="shadow btn btn-outline-info btn-r" href='logIn'>Here</a>
                        </span>
                    </div>
                </div>
                <?= $this->_method('post') ?>
                <?= $this->csrf() ?>
            </form>
        </fieldset>
    </div>
</div>