<?php

namespace Ijdb\Controllers;

class Job
{
   private $jobTable;
   private $categoryTable;
   private $applicantTable;

   // constructor
   public function __construct($jobTable, $categoryTable, $applicantTable)
   {
      // database tables
      $this->jobTable = $jobTable;
      $this->categoryTable = $categoryTable;
      $this->applicantTable = $applicantTable;
   }

   public function Jobs()
   {
      $cats = $this->categoryTable->findAll();

      if (isset($_GET['category_id']))

         $jobs = $this->jobTable->find('categoryId', $_GET['category_id']);

      else if (isset($_GET['search']))

         $jobs = $this->jobTable->find('location', $_GET['search']);

      else
         $jobs = $this->jobTable->findAll();

      $date = new \DateTime();

      // the foreach loop is to removing Archived jobs from main job list
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


   public function Job()
   {
      $cats = $this->categoryTable->findAll();

      if (isset($_GET['id']))

         $applicants = $this->applicantTable->find('jobId', $_GET['id']);

      else
         $applicants = $this->applicantTable->findAll();


      if (isset($_GET['category_id']))

         $jobs = $this->jobTable->find('categoryId', $_GET['category_id']);
      else
         $jobs = $this->jobTable->findAll();
      // the foreach loop is to removing Archived jobs from main job list
      foreach ($jobs as $key => $job) {
         if ($job->archive == 1)
            unset($jobs[$key]);
      }
      //  returning a template file
      return [
         'template' => '/job.html.php',
         'title' => 'Jo\'s jobs - All jobs',
         'variables' => [
            'job' => $jobs,
            'cats' => $cats,
            'applicants' => $applicants
         ]
      ];
   }

   //    this function is used to add the Jobs
   public function editSubmit()
   {
      if (isset($_SESSION['logged_user_id'])) {
         $user_id = $_SESSION['logged_user_id'];
      }
      //    getting job's details through POST request to add and edit Jobs 
      if (isset($_POST['submit'])) {

         $job = $_POST['job'];

         if ($job['id'] == '') {
            $job['id'] = null;
         }
         $date = new \DateTime();

         $this->jobTable->save($job);

         header('Location: /Job/Jobs');
      }
   }

   //    this function edits job's details
   public function edit()
   {
      if (isset($_GET['id'])) {
         $result = $this->jobTable->find('id', $_GET['id']);
         $job = $result[0];
         $job->mode = 'edit';
      } else {
         $job = false;
      }
      $cats = $this->categoryTable->findAll();

      return [
         'template' => 'addeditjob.html.php',
         'title' => 'Edit Job',
         'variables' => [
            'job' => $job,
            'cats' => $cats
         ]
      ];
   }


   public function applySubmit()
   {
      if (isset($_POST['submit'])) {

         $applicants = $_POST['applicants'];

         if ($applicants['id'] == '') {
            $applicants['id'] = null;
         }

         if ($_FILES['cv']['error'] == 0) {

            $parts = explode('.', $_FILES['cv']['name']);

            $extension = end($parts);

            $fileName = uniqid() . '.' . $extension;

            move_uploaded_file($_FILES['cv']['tmp_name'], 'cvs/' . $fileName);

            $applicants['cv'] = $fileName;

            $this->applicantTable->save($applicants);

            // echo 'Your application is complete. We will contact you after the closing date.'; 

         } else {
            // echo 'There was an error uploading your CV';
         }
         header('Location: /Job/message');
      }
   }

   public function message()
   {
      return [
         'template' => 'message.html.php',
         'title' => 'Apply',
         'variables' => []
      ];
   }


   public function apply()
   {
      if (isset($_GET['id']))
         $job = $this->jobTable->find('id', $_GET['id']);

      else {
         $job = $this->jobTable->findAll();
      }
      return [
         'template' => 'apply.html.php',
         'title' => 'Apply',
         'variables' => [
            'job' => $job
         ]
      ];
   }

   //    this function is used to show archived jobs
   public function archive()
   {
      $job = $this->jobTable->find('archive', 1);

      return [
         'template' => 'archiveJobs.html.php',
         'title' => 'Archived Jobs',
         'variables' => [
            'jobs' => $job
         ]
      ];
   }


   //    this function is used to archive the jobs
   public function archiveJobSubmit()
   {
      $job_id = '';
      $mode = '';
      if (isset($_POST['archive_job'])) {
         $job_id = $_POST['job_id'];
         $mode = $_POST['mode'];
      }
      // saved variable jobs into an array
      $jobs = array();
      $jobs['id'] = $job_id;
      //    if and else statements to check if the mode is yes or no
      if ($mode == 'yes')
         $jobs['archive'] = 1;
      else if ($mode == 'no')
         $jobs['archive'] = 0;
      //    saved function used to save job's details
      $this->jobTable->save($jobs);
      if ($mode == 'yes')
         header('Location: /Job/Job');
      else if ($mode == 'no')
         header('Location: /Job/archive');
   }


   //    function to delete the jobs
   public function deletejobSubmit()
   {
      $this->jobTable->delete($_POST['id']);

      header('Location: /Job/Job');

   }
}
