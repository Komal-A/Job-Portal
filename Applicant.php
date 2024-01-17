<?php

namespace Ijdb\Controllers;

class Applicant
{
    private $applicantTable;
    private $jobTable;


    // constructor
    public function __construct($applicantTable, $jobTable)
    {
        // database tables
        $this->applicantTable = $applicantTable;
        $this->jobTable = $jobTable;
    }

    public function applicants()
    {
        if (isset($_GET['id']))

            $job = $this->jobTable->find('id', $_GET['id']);
        else
            $job = $this->jobTable->findAll();

        if (isset($_GET['id']))

            $applicantCount = $this->applicantTable->find('jobId', $_GET['id']);
        else
            $applicantCount = $this->applicantTable->findAll();

        return [
            'template' => '/applicants.html.php',
            'title' => 'Jo\'s Jobs - Applicants',
            'variables' => [
                'applicantCount' => $applicantCount,
                'job' => $job
            ]
        ];
    }
}
