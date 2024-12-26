<?php

class DonateController extends Controller {
    public function donation() {
        $title = $this->config('app')['title'];
        $email = $this->config('app')['email'];
        $phone = $this->config('app')['phone'];
        $address = $this->config('app')['address'];
        $addressLink = $this->config('app')['addressLink'];
        $description = $this->config('app')['description'];
        //$charity = new Charity();
        //$charities = $charity->getAllCharities();
        //$totalCharities = $charity->getTotalCharities();

        $this->view('pages/donation', [
            'webTitle' => "Donation - " . "$title",
            'title' => $title,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'addressLink' => $addressLink,
            'description' => $description,
//'charities' => $charities,
            //'totalCharities' => $totalCharities,
        ]);
    }
}