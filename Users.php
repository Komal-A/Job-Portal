<?php

namespace Ijdb\Controllers;

class Users
{
    private $UsersTable;
    private $categoryTable;
    private $jobTable;
    // constructor
    public function __construct($UsersTable, $categoryTable, $jobTable)
    {
        // database table
        $this->UsersTable = $UsersTable;
        $this->categoryTable = $categoryTable;
        $this->jobTable = $jobTable;
    }


    // returning template
    public function register()
    {
        return [
            'template' => '/register.html.php',
            'title' => 'Jo\'s Jobs - Registration',
            'variables' => []
        ];
    }


    // this code is to register users and saving their details into database
    public function registerSubmit()
    {
        if (isset($_POST['submit'])) {
            $user = $_POST['user'];
            // this code will save encrypted password into database
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

            header('Location: /Users/registeredUsers');

            if ($user['id'] == '') {
                $user['id'] = null;
            }
            $this->UsersTable->save($user);
        }
    }


    // this function will display all users on site
    public function registeredUsers()
    {
        $users = $this->UsersTable->findAll();

        return [
            'template' => '/registerUser.html.php',
            'title' => 'Jo\'s Jobs - Registered User',
            'variables' => [
                'users' => $users
            ]
        ];
    }

    // returning template
    public function login()
    {
        return [
            'template' => '/login.html.php',
            'title' => 'Jo\'s Jobs - Login',
            'variables' => []
        ];
    }


    // this function will match the login details from database and allow/deny the request to login accordingly
    public function loginSubmit()
    {
        if (isset($_POST['submit'])) {
            // $email = $_POST['email'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            // $db_response = $this->UsersTable->find('email', $email);
            $db_response = $this->UsersTable->find('name', $name);

            // if variable db_response is not empty 
            if (!empty($db_response)) {
                // this if statement will look for hashed password which is already in databse and match this
                if (password_verify($password, $db_response[0]->password)) {
                    // if it matches the save details it will return true
                    $_SESSION['loggedin'] = true;
                    $_SESSION['logged_user_id'] = $db_response[0]->id;
                    $_SESSION['logged_user_name'] = $db_response[0]->name;
                    $_SESSION['logged_user_email'] = $db_response[0]->email;
                    $_SESSION['logged_user_account_type'] = $db_response[0]->account_type;
                    // and will take the user to dashboard page 
                    if ($_SESSION['logged_user_account_type'] == "client")
                        header('Location: /Users/clientArea');
                    else
                        header('Location: /Users/dashboard');
                } else {
                    return [
                        'template' => '/warning.html.php',
                        'title' => 'Jo\'s Jobs - Warning',
                        'variables' => []
                    ];
                }
            } else {
                return [
                    'template' => '/warning.html.php',
                    'title' => 'Jo\'s Jobs - Warning',
                    'variables' => []
                ];
            }
        }
    }


    // returning template
    public function clientArea()
    {
        return [
            'template' => '/clientArea.html.php',
            'title' => 'Jo\'s Jobs - Client Login',
            'variables' => [
            ]
        ];
    }

    // returning template
    public function dashboard()
    {
        return [
            'template' => '/dashboard.html.php',
            'title' => 'Jo\'s Jobs - Login',
            'variables' => [
            ]
        ];
    }

    public function Jobs()
    {
        $cats = $this->categoryTable->findAll();

        if (isset($_GET['category_id']))

            $jobs = $this->jobTable->find('categoryId', $_GET['category_id']);
        else
            $jobs = $this->jobTable->findAll();
        // foreach loop is to removing Archived jobs from main Job list
        foreach ($jobs as $key => $job) {
            if ($job->archive == 1)
                unset($jobs[$key]);
        }
        // returning a template file
        return [
            'template' => '/jobs.html.php',
            'title' => 'Jo\'s jobs - All jobs',
            'variables' => [
                'job' => $jobs,
                'cats' => $cats
            ]
        ];
    }

    // logout function is unsettng the session and returning template 
    public function logout()
    {
        unset($_SESSION['loggedin']);

        return [
            'template' => '/logout.html.php',
            'title' => 'Jo\'s Jobs - Logout',
            'variables' => []
        ];
    }

    //    function to delete the users from website
    public function deleteuserSubmit()
    {
        $this->UsersTable->delete($_POST['id']);

        header('Location: /Users/registeredUsers');

    }
}
