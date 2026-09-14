<?php

namespace App\Controllers;

// Customers controller handles the Customer Accounts page (/customers).
class Customers extends BaseController
{
    public function index()
    {
        // Temporary static data source, standing in for a database table.
        // Each element is an associative array representing one customer record.
        $customers = [
            ['name' => 'Elisha Cancino',  'email' => 'ebcancino@email.com',  'phone' => '09171234567'],
            ['name' => 'Elijah Cancino',  'email' => 'ejcancino@email.com',  'phone' => '09182345678'],
            ['name' => 'Henrich Doroteo', 'email' => 'JhDoroteo@email.com', 'phone' => '09193456789'],
            ['name' => 'Ana Lopez',       'email' => 'alopez@email.com',       'phone' => '09204567890'],
            ['name' => 'Carlos Garcia',   'email' => 'cbgarcia@email.com',   'phone' => '09215678901'],
        ];

        // Pass the array to the view as 'customers' so the view can loop over it.
        return view('customers', ['customers' => $customers]);
    }
}