<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    // Define the table and primary key
    protected $table = 'admin';
    protected $primaryKey = 'id';

    // Define the allowed fields for mass assignment
    protected $allowedFields = ['firstname', 'lastname', 'email','phone' , 'password', 'created_at', 'updated_at'];

    // Validation rules
    protected $validationRules = [
        'firstname' => 'required|min_length[3]|max_length[50]',
        'lastname' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email|is_unique[admin.email]',
        'password' => 'required|min_length[8]|max_length[255]',
        'password_confirm' => 'required|matches[password]'
    ];

    // Validation messages
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already taken.'
        ],
        'password_confirm' => [
            'matches' => 'Password confirmation does not match the password.'
        ]
    ];

    // Before insert, add the created_at timestamp
    protected function beforeInsert(array $data)
    {
        // Add the current timestamp when a new record is created
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    // Before update, add the updated_at timestamp
    protected function beforeUpdate(array $data)
    {
        // Update the timestamp when an existing record is updated
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    // Function to hash the password before storing it
    protected function beforeInsertPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }
        return $data;
    }

    // You may call this manually if needed before calling save()
    public function createAdmin(array $data)
    {
        // // Hash the password before saving
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        // Save the new admin to the database
        $db = \Config\Database::connect();
        $builder = $db->table('admin');  // Table name

        // Insert the data manually
        $builder->insert($data);
    }
}
