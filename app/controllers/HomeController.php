<?php

class HomeController extends Controller {
    public function index() {
        $charityModel = $this->model('Charity');
        $donationModel = $this->model('Donation');
        $volunteerEventModel = $this->model('VolunteerEvent');

        $title = $this->config('app')['title'];
        $email = $this->config('app')['email'];
        $phone = $this->config('app')['phone'];
        $address = $this->config('app')['address'];
        $addressLink = $this->config('app')['addressLink'];
        $description = $this->config('app')['description'];
        $contactName = $this->config('app')['contactName'];

        $this->view('pages/index', [
            'webTitle' => "Home - " . $title,
            'title' => $title,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'addressLink' => $addressLink,
            'description' => $description,
            'charities' => $charityModel->getAllCharities(),
            'contactName' => $contactName,
            'donations' => $donationModel->getLatestDonations(),
            'volunteerEvents' => $volunteerEventModel->getUpcomingEvents(),
            'eventsTotal' => $donationModel->getTotalDonations() + $volunteerEventModel->getTotalVolunteerEvents(),
            'charitiesTotal' => $charityModel->getTotalCharities(),
        ]);

    }
}
?>