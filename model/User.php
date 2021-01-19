<?php

class User extends Model
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private string $phone_number;
    private string $birth_date;
    private int $activity_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    public function getActivityId(): int
    {
        return $this->activity_id;
    }

    public static function validate(array $args): array
    {
        $errors = self::validateExistence($args, ['first_name', 'last_name', 'email', 'password',
                                                  'confirm_password', 'phone_number', 'birth_date']);
        if (sizeof($errors) == 0) {
            if (strcmp($args['password'], $args['confirm_password']) != 0) {
                array_push($errors, "Password does not match confirmation");
            }
        }
        return $errors;
    }
//    private static function validate(string $arg, )
}