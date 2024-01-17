<?php

namespace Ijdb\Controllers;

class Site
{
   private $SiteTable;
   private $categoryTable;
   // constructor
   public function __construct($SiteTable, $categoryTable)
   {
      // database table
      $this->SiteTable = $SiteTable;
      $this->categoryTable = $categoryTable;
   }

   // this function is to display all jobs on the site
   public function home()
   {
      $category = $this->categoryTable->findAll();

      return [
         'template' => '/index.html.php',
         'title' => 'Jo\'s Jobs - Home',
         'variables' => [
            'cats' => $category
         ]
      ];
   }

   // returning template
   public function about()
   {
      $cats = $this->categoryTable->findAll();

      return [
         'template' => '/about.html.php',
         'title' => 'Jo\'s Jobs -About Us',
         'variables' => [
            'cats' => $cats
         ]
      ];
   }

   public function FAQ()
   {
      return [
         'template' => '/FAQ.html.php',
         'title' => 'Jo\'s jobs -FAQ\'s',
         'variables' => []
      ];
   }
}
