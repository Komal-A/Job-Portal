<?php

namespace Ijdb\Controllers;

class Clients
{
    private $UsersTable;
    private $categoryTable;
    private $jobTable;
    // constructor
    public function __construct($UsersTable, $categoryTable, $jobTable,)
    {
        // database table
        $this->UsersTable = $UsersTable;
        $this->categoryTable = $categoryTable;
        $this->jobTable = $jobTable;
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
                    // and will take the client to client Area page 
                    header('Location: /Clients/clientArea');
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
    public function login()
    {
        return [
            'template' => '/clientlogin.html.php',
            'title' => 'Jo\'s Jobs - Client Login',
            'variables' => []
        ];
    }

    // returning template
    public function clientArea()
    {
        return [
            'template' => '/clientArea.html.php',
            'title' => 'Jo\'s Jobs - Client Login',
            'variables' => []
        ];
    }
}
