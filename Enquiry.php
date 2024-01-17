<?php

namespace Ijdb\Controllers;

class Enquiry
{
    private $EnquiryTable;
    // constructor
    public function __construct($EnquiryTable)
    {
        // database table
        $this->EnquiryTable = $EnquiryTable;
    }

    // contact function is returning template file
    public function contact()
    {
        return [
            'template' => '/contact.html.php',
            'title' => 'Jo\'s Jobs -Contact Us',
            'variables' => []
        ];
    }

    // this contactSubmit function is used to save enquiries into database through POST request 
    public function contactSubmit()
    {
        if (isset($_POST['submit'])) {

            $enquiry = $_POST['enquiry'];

            if ($enquiry['id'] == '') {
                $enquiry['id'] = null;
            }
            $this->EnquiryTable->save($enquiry);

            // echo var_dump($enquiry);
            header('location: /Enquiry/enquiry_submit');
        }
    }


    //  this function is displaying all enquiries which are not responded    
    public function enquiries()
    {
        $enquiry = $this->EnquiryTable->find('response', 0);

        return [
            'template' => '/enquiries.html.php',
            'title' => 'Jo\'s Jobs - Enquiry',
            'variables' => [
                'enquiry' => $enquiry
            ]
        ];
    }


    // returning template file
    public function enquiry_submit()
    {
        return [
            'template' => '/enquiry_submit.html.php',
            'title' => 'Jo\'s Jobs - Enquiry Submit',
            'variables' => []
        ];
    }


    //  this function displays responded enquiries on the site
    public function response()
    {
        $enquiry = $this->EnquiryTable->find('response', 1);

        return [
            'template' => '/response.html.php',
            'title' => 'Responded enquiries',
            'variables' => [
                'enquiry' => $enquiry
            ]
        ];
    }

    //   this function is used to response enquiries
    public function responseSubmit()
    {
        if (isset($_SESSION['logged_user_id'])) {
            $user_id = $_SESSION['logged_user_id'];
        }

        $enquiry_id = '';
        $mode = '';

        if (isset($_POST['response'])) {
            $enquiry_id = $_POST['enquiry_id'];
            $mode = $_POST['mode'];
        }
        // saved variable enquiries into an array
        $enquiries = array();
        $enquiries['id'] = $enquiry_id;
        $enquiries['userId'] = $user_id;
        //    if and else statements to check if the mode is yes or no
        if ($mode == 'yes')
            $enquiries['response'] = 1;
        else if ($mode == 'no')
            $enquiries['response'] = 0;
        //    saved function used to save enquiries
        $this->EnquiryTable->save($enquiries);
        if ($mode == 'yes')
            header('Location: /Enquiry/enquiries');
        else if ($mode == 'no')
            header('Location: /Enquiry/response');
    }
}
