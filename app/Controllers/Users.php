<?php

namespace App\Controllers;

// Users controller handles the User (staff) Accounts page (/users).
class Users extends BaseController
{
    public function index()
    {
        // Temporary static data source, standing in for a database table.
        // Each element is an associative array representing one staff account.
        $users = [
            ['username' => 'ebcancino1',   'name' => 'Elisha Cancino',    'role' => 'Admin'],
            ['username' => 'ejcancino', 'name' => 'Elijah Cancino', 'role' => 'Cashier'],
            ['username' => 'JhDoroteo',  'name' => 'Henrich Doroteo',  'role' => 'Manager'],
            ['username' => 'alopez',  'name' => 'Ana Lopez',    'role' => 'Cashier'],
            ['username' => 'cbgarcia', 'name' => 'Carlos Garcia','role' => 'Stock Clerk'],
        ];

        // Pass the array to the view as 'users' so the view can loop over it.
        return view('users', ['users' => $users]);
    }
}