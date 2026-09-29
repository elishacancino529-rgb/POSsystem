<?php

namespace App\Controllers;

use App\Models\CustomerModel;

// Customers controller handles the Customer Accounts page (/customers).
class Customers extends BaseController
{
    public function index()
    {
          // Retrieve all customer records from the database through the Model.
        $model = new CustomerModel();
        $customers = $model->findAll();
    
        // Pass the array to the view as 'customers' so the view can loop over it.
        return view('customers', ['customers' => $customers]);
    }

    public function new()
    {
        return view('customer_form', ['customer' => null, 'formTitle' => 'New customer', 'formAction' => site_url('customers')]);
    }

    public function create()
    {
        $rules = [
            'full_name' => 'required|min_length[2]',
            'email'     => 'required|valid_email',
            'phone'     => 'permit_empty|max_length[30]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new CustomerModel())->insert([
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ]);

        return redirect()->to(site_url('customers'))->with('message', 'Customer account created.');
    }

    public function edit(int $id)
    {
        $customer = (new CustomerModel())->find($id);
        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Customer not found.');
        }

        return view('customer_form', ['customer' => $customer, 'formTitle' => 'Edit customer', 'formAction' => site_url('customers/update/' . $id)]);
    }

    public function update(int $id)
    {
        $model = new CustomerModel();
        if (! $model->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Customer not found.');
        }

        $rules = [
            'full_name' => 'required|min_length[2]',
            'email'     => 'required|valid_email',
            'phone'     => 'permit_empty|max_length[30]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($id, [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ]);

        return redirect()->to(site_url('customers'))->with('message', 'Customer account updated.');
    }
}
