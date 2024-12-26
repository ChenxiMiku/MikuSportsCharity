<?php

class VolunteerController extends Controller {
    public function volunteer() {
        $title = $this->config('app')['title'];
        $email = $this->config('app')['email'];
        $phone = $this->config('app')['phone'];
        $address = $this->config('app')['address'];
        $addressLink = $this->config('app')['addressLink'];
        $description = $this->config('app')['description'];

        $volunteerEventModel = $this->model('VolunteerEvent');

        $this->view('pages/volunteer', [
            'webTitle' => "Volunteer - ". $title,
            'title' => $title,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'addressLink' => $addressLink,
            'description' => $description,
            'volunteerEvents' => $volunteerEventModel->getUpcomingEvents(),
        ]);

    }
}

?>