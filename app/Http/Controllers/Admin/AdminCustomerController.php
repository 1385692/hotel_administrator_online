<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::get();
        return view('admin.customer', compact('customers'));
    }

    public function change_status($id)
    {
        $customer_data = Customer::where('id', $id)->first();
        echo $customer_data->status;
        if ($customer_data->status == 1) {
            $customer_data->status = 0;
        } else {
            $customer_data->status = 1;
        }
        $customer_data->update();
        return redirect()->back()->with('success', 'Status is change successfully.');
    }
}
