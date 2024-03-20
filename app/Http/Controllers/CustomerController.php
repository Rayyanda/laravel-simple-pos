<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * data customer
     * 
     */

    public function index()
    {
        $customers = Customer::all();

        return view('Pages.customer.index_customer',['customers'=>$customers]);
    }
}
