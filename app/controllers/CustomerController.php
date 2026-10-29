<?php
require_once __DIR__ . '/../models/Customer.php';

class CustomerController extends Controller {
    public function index() {
        $customers = Customer::getAll();
        $this->view('customer/index', ['customers' => $customers]);
    }
}