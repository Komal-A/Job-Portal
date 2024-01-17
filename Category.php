<?php

namespace Ijdb\Controllers;

class Category
{
    private $CategoryTable;
    // constructor
    public function __construct($CategoryTable)
    {
    // database table
        $this->CategoryTable = $CategoryTable;
    }

    // this function is to display all categories
    public function category()
    {
        $category = $this->CategoryTable->findAll();

        return [
            'template' => '/category.html.php',
            'title' => 'Jo\'s Jobs - Categories',
            'variables' => [
                'categories' => $category
            ]
        ];
    }

    //  this function edits categories
    public function edit()
    {
        if (isset($_GET['id'])) {
            $result = $this->CategoryTable->find('id', $_GET['id']);
            $cats = $result[0];
        } else {
            $cats = false;
        }
        return [
            'template' => 'addeditcategory.html.php',
            'title' => 'Edit Category',
            'variables' => [
                'cats' => $cats
            ]
        ];
    }


    //   this function is used to add the categories
    public function editSubmit()
    {
    //   getting categories'details through POST request to save in to the database
        if (isset($_POST['cats'])) {
            $cats = $_POST['cats'];

            if ($cats['id'] == '') {
                $cats['id'] = null;
            }
            $this->CategoryTable->save($cats);

            header('Location: /Category/category');
        }
    }


    // This delete function is used to delete categories
    public function deletecategorySubmit()
    {
        $cats = $this->CategoryTable->delete($_POST['id']);

        return [
            'template' => 'deletecategory.html.php',
            'title' => 'delete category',
            'variables' => [
                'cats' => $cats
            ]
        ];
    }
}
