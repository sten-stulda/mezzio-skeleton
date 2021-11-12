<?php

declare(strict_types=1);

namespace User\Model\Table;

use Laminas\Crypt\Password\Bcrypt;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;
use Laminas\Filter;
use Laminas\I18n;
use Laminas\InputFilter;
use Laminas\Validator;

class UsersTable extends AbstractTableGateway
{
    protected $table = 'users';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    # next i want us to create a method that will help us filter and validate our registerform data
    public function getRegisterFormFilter()
    {
        $inputFilter = new InputFilter\InputFilter();
        $factory = new InputFilter\Factory();

        # filter and validate username field
        $inputFilter->add($factory->createInput([
            'name' => 'username',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class],
                ['name' => I18n\Filter\Alnum::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name' => I18n\Validator\Alnum::class,
                    'options' => [
                        'messages' => [
                            I18n\Validator\Alnum::NOT_ALNUM => 'Username must consist of alphanumeric characters only'
                        ]
                    ]
                ],
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 25,
                        'messages' => [
                            Validator\StringLength::TOO_SHORT => 'Username must have at least 2 characters',
                            Validator\StringLength::TOO_LONG => 'Username must have at most 25 characters'
                        ]
                    ]
                ],
                [
                    'name' => Validator\Db\NoRecordExists::class,
                    'options' => [
                        'table' => $this->table,
                        'field' => 'username',
                        'adapter' => $this->adapter
                    ]
                ]
            ]
        ]));

        # filter and validate gender select field
        $inputFilter->add($factory->createInput([
            'name' => 'gender',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name' => Validator\InArray::class,
                    'options' => [
                        'haystack' => ['Female', 'Male', 'Other']
                    ]
                ]
            ]
        ]));

        # filter and validate email field
        $inputFilter->add($factory->createInput([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                ['name' => Validator\EmailAddress::class],
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 6, # e.g. o@m.uk == 6 characters
                        'max' => 128,
                        'messages' => [
                            Validator\StringLength::TOO_SHORT => 'Email address must have at least 6 characters',
                            Validator\StringLength::TOO_LONG => 'Email address must have at most 128 characters'
                        ]
                    ]
                ],
                [
                    'name' => Validator\Db\NoRecordExists::class,
                    'options' => [
                        'table' => $this->table,
                        'field' => 'email',
                        'adapter' => $this->adapter
                    ]
                ]
            ]
        ]));

        # filter and validate birthdate field
        $inputFilter->add($factory->createInput([
            'name' => 'birthdate',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class],
                ['name' => Filter\DateSelect::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name' => Validator\Date::class,
                    'options' => [
                        'format' => 'Y-m-d', # will check to confirm
                    ]
                ]
            ]
        ]));

        #filter and validate password field
        $inputFilter->add($factory->createInput([
            'name' => 'password',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 8,
                        'max' => 25,
                        'messages' => [
                            Validator\StringLength::TOO_SHORT => 'Password must have at least 8 characters',
                            Validator\StringLength::TOO_LONG => 'Password must have at most 25 characters'
                        ]
                    ]
                ]
            ]
        ]));

        #filter and validate confirm_password field
        $inputFilter->add($factory->createInput([
            'name' => 'confirm_password',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 8,
                        'max' => 25,
                        'messages' => [
                            Validator\StringLength::TOO_SHORT => 'Password must have at least 8 characters',
                            Validator\StringLength::TOO_LONG => 'Password must have at most 25 characters'
                        ]
                    ]
                ],
                [
                    'name' => Validator\Identical::class,
                    'options' => [
                        'token' => 'password', # here we simply name a field we want to compare against
                        'messages' => [
                            Validator\Identical::NOT_SAME => 'Passwords do not match. Make sure they match!'
                        ]
                    ]
                ]
            ]
        ]));

        return $inputFilter;
    }

    public function insertAccount(array $data)
    {
        $values = [
            'username' => ucfirst(mb_strtolower($data['username'])),
            'email'    => mb_strtolower($data['email']),
            'password' => (new Bcrypt())->create($data['password']),
            'gender'  => $data['gender'],
            'birthdate' => $data['birthdate'],
            'role_id' => $this->assignRoleId(),
            'created' => date('Y-m-d H:i:s')
        ];

        $sqlQuery = $this->sql->insert()->values($values);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);

        return $sqlStmt->execute();
    }

    private function assignRoleId()
    {
        $sqlQuery = $this->sql->select()->where(['role_id' => 1]);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
        $result   = $sqlStmt->execute()->current();

        # here we are simply checking if the role_id 1 exists.
        # if it does not we return a value of 1. If it does we return a value of 2 which is member role
        return (!$result) ? 1 : 2;
    }
}
