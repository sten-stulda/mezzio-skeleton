<?php

declare(strict_types=1);

namespace User\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class RegisterForm extends Form
{
    public function init()
    {
        parent::init();
        $this->setName('new_account');
        $this->setAttribute('method', 'post');

        # add the username text field
        $this->add([
            'type' => Element\Text::class,
            'name' => 'username',
            'options' => [
                'label' => 'Username'
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 25,
                'pattern' => '^[a-zA-Z0-9]+$',
                'placeholder' => 'Enter Your Username',
                'title' => 'Username must consist of alphanumeric characters only',
                'class' => 'form-control'
            ]
        ]);

        # add the gender select field
        $this->add([
            'type' => Element\Select::class,
            'name' => 'gender',
            'options' => [
                'label' => 'Gender',
                'empty_option' => 'Select...',
                'value_options' => [
                    'Female' => 'Female',
                    'Male' => 'Male',
                    'Other' => 'Other'
                ]
            ],
            'attributes' => [
                'required' => true,
                'class' => 'custom-select'
            ]
        ]);

        # add the email field
        $this->add([
            'type' => Element\Email::class,
            'name' => 'email',
            'options' => [
                'label' => 'Email Address'
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 128,
                'pattern' => '^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$',
                'placeholder' => 'Enter Your Email Address',
                'title' => 'Provide a valid and working email address',
                'class' => 'form-control'
            ]
        ]);

        # add the birthdate dateSelect field
        $this->add([
            'type' => Element\DateSelect::class,
            'name' => 'birthdate',
            'options' => [
                'label' => 'Select Your Date of Birth',
                'create_empty_option' => true,
                'render_delimiters' => false,
                'max_year' => date('Y') - 13,
                'day_attributes' => [
                    'class' => 'custom-select w-30 mr-2 ml-2',
                    'id' => 'day'
                ],
                'month_attributes' => [
                    'class' => 'custom-select w-30',
                    'id' => 'month'
                ],
                'year_attributes' => [
                    'class' => 'custom-select w-30',
                    'id' => 'year'
                ]
            ],
            'atrributes' => [
                'required' => true
            ]
        ]);

        # add the password field
        $this->add([
            'type' => Element\Password::class,
            'name' => 'password',
            'options' => [
                'label' => 'Password'
            ],
            'attributes' => [
                'required' => true,
                'maxlength' => 25,
                'placeholder' => 'Enter Your Password',
                'title' => 'Password must have between 8 and 25 characters',
                'class' => 'form-control'
            ]
        ]);

        # add the confirm_password field
        $this->add([
            'type' => Element\Password::class,
            'name' => 'confirm_password',
            'options' => [
                'label' => 'Verify Password'
            ],
            'attributes' => [
                'required' => true,
                'placeholder' => 'Enter Your Password Again',
                'maxlength' => 25,
                'title' => 'Password must match that provided above',
                'class' => 'form-control'
            ]
        ]);

        # I will explain further on this. We will use Laminas\Session to generate csrf value
        # for our signup form as opposed to using the CsrfMiddleware class that comes with Mezzio
        # I will however show how to use the CsrfMiddleware class when creating the LoginForm class
        # Just wanted to teach the two separate ways of creating the form.
        $this->add([
            'type' => Element\Csrf::class,
            'name' => 'signup_csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 1400
                ]
            ]
        ]);

        # add the submit button
        $this->add([
            'type' => Element\Submit::class,
            'name' => 'create_account',
            'attributes' => [
                'value' => 'Create Account',
                'class' => 'btn btn-primary btn-lg btn-block'
            ]
        ]);
    }
}
