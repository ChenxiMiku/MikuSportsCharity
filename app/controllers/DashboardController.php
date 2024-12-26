<?php

class DashboardController extends Controller {
    public function dashboard() {
        $title = $this->config('app')['title'];
        $email = $this->config('app')['email'];
        $phone = $this->config('app')['phone'];
        $address = $this->config('app')['address'];
        $addressLink = $this->config('app')['addressLink'];
        $description = $this->config('app')['description'];

        $this->view('pages/dashboard', [
            'webTitle' => "Dashboard - " . $title,
            'title' => $title,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'addressLink' => $addressLink,
            'description' => $description,
        ]);

    }
}
?>