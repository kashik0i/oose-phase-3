<?php

class ProfileView extends View
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    protected function getTitle(): string
    {
        return $this->user->getFirstName() . ' ' . $this->user->getLastName();
    }

    protected function getContent(): string
    {
        return '<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">

        <div class="input-group mb-3">
            <span class="input-group-text">First Name</span>
            <input type="text" class="form-control" value="' . $this->user->getFirstName() . '" readonly>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Last Name</span>
            <input type="text" class="form-control" value="' . $this->user->getLastName() . '" readonly>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">E-Mail</span>
            <input type="text" class="form-control" value="' . $this->user->getEmail() . '" readonly>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Phone Number</span>
            <input type="text" class="form-control" value="' . $this->user->getPhoneNumber() . '" readonly>
        </div>
        
                <div class="input-group mb-3">
            <span class="input-group-text">Birthdate</span>
            <input type="text" class="form-control" value="' . $this->user->getBirthDate() . '" readonly>
        </div>

    </div>
    <div class="col-sm-4"></div>
</div>';
    }
}