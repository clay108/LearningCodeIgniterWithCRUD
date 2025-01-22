<?php

namespace App\Controllers;

use App\Models\AdminModel;


class Home extends BaseController
{
    public function index()
    {
       // echo $_POST['email'] . "<br>";
        helper('form');
        $data = [];
        
        
        // If the request method is POST
        //echo $this->request->getMethod();
        if ($this->request->getMethod() == 'POST') {

            // Validation rules for form inputs
            //echo $_POST['email'] . "<br>";
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]|max_length[255]'
            ];

            if (!$this->validate($rules)) {
                // Pass validation errors to the view
                $data['validation'] = $this->validator;
            } else {
                // Get the user email and password from the form
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');


                // echo $email . "<br>";
                // echo $password . "<br>";


                // Initialize the model and check the user credentials
                $model = new AdminModel();

                // Try to find the user by email
                $user = $model->where('email', $email)->first();

                // If user exists and the password matches
                if ($user && password_verify($password, $user['password'])) {
                    // Start the session (if necessary)
                    $session = session();
                    $session->set('user_id', $user['id']);
                    $session->set('email', $user['email']);
                    $session->set('logged_in', true);

                    // Redirect to the dashboard (or any protected area)
                    return redirect()->to('/dashboard');
                } else {
                    // If the email or password is incorrect, show an error
                    //echo "either email or password is wrong"." <br>";
                    $data['error'] = 'Invalid email or password';
                }
            }
        }


        return view('login',$data);
    }

   


    public function signup()
    {
        $data = [];
        helper('form');
        
        if ($this->request->getMethod() == 'POST') {
            
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|valid_email|is_unique[admin.email]',  // Ensure the correct table name is used
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                // Pass validation errors to the view
                $data['validation'] = $this->validator;
            } else {
                // Collect form data

                $newData = [
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),  // Password will be hashed in the model
                ];

                //echo $_POST['firstname']."<br>";
                //echo  $newData['password'];

                // Use the AdminModel to insert the user data
                $model = new AdminModel();

                // Call the model's createUser() method to hash password and insert data
                //$model->save($newData);

                if ($model->createAdmin($newData)) {
                    // Successfully created user, redirect to login page
                    return redirect()->to('/login')->with('message', 'Registration successful. Please log in.');
                } else {
                    // Handle failed user creation, maybe show an error message
                    $data['error'] = 'There was an issue with your registration. Please try again.';
                }
            }
        }

        return view('signup', $data);  // Pass data (including validation errors) to the view
    }

    public function dashboard()
    {
        $model = new AdminModel();
        $data['userdata'] = $model->findAll();
        //print_r($data);
        return view('dashboard',$data);
    }



    public function logout()
    {
        // Destroy the session to log the user out
        $session = session();
        $session->destroy();

        // Redirect to login page after logout
        return redirect()->to('/login');
    }

    public function editUser($id){
        $model = new AdminModel();
        $data['userdata'] = $model->find($id);

        if ($this->request->getMethod() == 'POST') {
            $updatedData = [
                'firstname' => $this->request->getVar('firstname'),
                'lastname' => $this->request->getVar('lastname'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];

            $model->update($id, $updatedData);
            return redirect()->to('/dashboard')->with('message', 'User updated successfully.');
        }

        return view('editUser', $data);
    }

    public function deleteUser($id)
    {
        $model = new AdminModel();
        $model->delete($id);
        return redirect()->to('/dashboard')->with('message', 'User deleted successfully.');
    }
}
