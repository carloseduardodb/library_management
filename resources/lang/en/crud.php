<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'books' => [
        'name' => 'Books',
        'index_title' => 'Books List',
        'new_title' => 'New Book',
        'create_title' => 'Create Book',
        'edit_title' => 'Edit Book',
        'show_title' => 'Show Book',
        'inputs' => [
            'name' => 'Name',
            'pagecount' => 'Pagecount',
            'category' => 'Category',
            'authors' => 'Authors',
        ],
    ],

    'borrows' => [
        'name' => 'Borrows',
        'index_title' => 'Borrows List',
        'new_title' => 'New Borrow',
        'create_title' => 'Create Borrow',
        'edit_title' => 'Edit Borrow',
        'show_title' => 'Show Borrow',
        'inputs' => [
            'book_id' => 'Book',
            'student_id' => 'Student',
        ],
    ],

    'categories' => [
        'name' => 'Categories',
        'index_title' => 'Categories List',
        'new_title' => 'New Category',
        'create_title' => 'Create Category',
        'edit_title' => 'Edit Category',
        'show_title' => 'Show Category',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'students' => [
        'name' => 'Students',
        'index_title' => 'Students List',
        'new_title' => 'New Student',
        'create_title' => 'Create Student',
        'edit_title' => 'Edit Student',
        'show_title' => 'Show Student',
        'inputs' => [
            'name' => 'Name',
            'surname' => 'Surname',
            'birth_date' => 'Birth Date',
            'gender' => 'Gender',
        ],
    ],

    'authors' => [
        'name' => 'Authors',
        'index_title' => 'Authors List',
        'new_title' => 'New Author',
        'create_title' => 'Create Author',
        'edit_title' => 'Edit Author',
        'show_title' => 'Show Author',
        'inputs' => [
            'name' => 'Name',
            'age' => 'Age',
            'gender' => 'Gender',
        ],
    ],
];
