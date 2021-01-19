<?php

class RegisterView extends View
{
    protected function getTitle(): string
    {
        return "Register";
    }

    protected function getContent(): string
    {
        $html = '<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <form method="post" action="UserController.php?action=postRegister">

            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="first_name">
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="last_name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password">
            </div>

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" name="phone_number">
            </div>

            <div class="mb-3">
                <label for="birthDate" class="form-label">Birthdate</label>
                <input type="date" class="form-control" id="birthDate" name="birth_date">
            </div>

            <button type="submit" class="btn btn-primary">Register</button>

        </form>
    </div>
    <div class="col-sm-4"></div>
</div>';

        return $html;
    }
}