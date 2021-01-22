<?php

class LoginView extends View
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
        <form method="post" action="UserController.php?action=postLogin">

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            
            <button type="submit" class="btn btn-primary">Login</button>
            
        </form>
    </div>
    <div class="col-sm-4"></div>
</div>';

        return $html;
    }
}