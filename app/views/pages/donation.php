<?php include '../app/views/layouts/head.php'; ?>

<body>
    <?php include '../app/views/layouts/header.php'; ?>
    <?php include '../app/views/layouts/navbar.php'; ?>
    <main>

        <section class="donate-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="get" role="form">
                            <h3 class="mb-4">Make a donation</h3>
                            <div id="event-info" class="alert alert-info">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img id="event-image" src="" alt="Event Image" class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="fs-5">Charity: <span id="charity-name"></span></h5>
                                        <h5 class="fs-5">Event: <span id="event-name"></span></h5>
                                        <p><strong class="fs-5">Goal:</strong> $<span id="event-goal"></span> | <strong
                                                class="fs-5">Raised:</strong> $<span id="event-raised"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <h5 class="mb-3">Donation Frequency</h5>
                                </div>

                                <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="DonationFrequency"
                                            id="DonationFrequencyOne" checked>

                                        <label class="form-check-label" for="DonationFrequencyOne">
                                            One Time
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="DonationFrequency"
                                            id="DonationFrequencyMonthly">

                                        <label class="form-check-label" for="DonationFrequencyMonthly">
                                            Monthly
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <h5 class="mt-2 mb-3">Select an amount</h5>
                                </div>

                                <div class="col-lg-3 col-md-6 col-6 form-check-group">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            $10
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-6 form-check-group">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            $15
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-6 form-check-group">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            $20
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-6 form-check-group">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            $30
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-6 form-check-group">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault5">
                                        <label class="form-check-label" for="flexRadioDefault5">
                                            $45
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-6 form-check-group">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault6">
                                        <label class="form-check-label" for="flexRadioDefault6">
                                            $50
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 form-check-group">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" placeholder="Custom amount"
                                            aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>


                                <div class="col-lg-12 col-12">
                                    <h5 class="mt-1">Personal Info</h5>
                                </div>

                                <div class="col-lg-6 col-12 mt-2">
                                    <input type="text" name="donation-name" id="donation-name" class="form-control"
                                        placeholder="Hatsune Miku" required>
                                </div>

                                <div class="col-lg-6 col-12 mt-2">
                                    <input type="email" name="donation-email" id="donation-email"
                                        pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Jackdoe@gmail.com"
                                        required>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <h5 class="mt-2 pt-1">Choose Payment</h5>
                                </div>

                                <div class="col-lg-12 col-12 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="DonationPayment"
                                            id="flexRadioDefault9">
                                        <label class="form-check-label" for="flexRadioDefault9">
                                            <i class="bi-credit-card custom-icon ms-1"></i>
                                            Debit or Credit card
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="DonationPayment"
                                            id="flexRadioDefault10">
                                        <label class="form-check-label" for="flexRadioDefault10">
                                            <i class="bi-paypal custom-icon ms-1"></i>
                                            Paypal
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="DonationPayment"
                                            id="flexRadioDefault10">
                                        <label class="form-check-label" for="flexRadioDefault10">
                                            <i class="bi-currency-bitcoin custom-icon ms-1"></i>
                                            BTC
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="DonationPayment"
                                            id="flexRadioDefault10">
                                        <label class="form-check-label" for="flexRadioDefault10">
                                            <i class="bi-wechat custom-icon ms-1"></i>
                                            Wechat Pay
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="DonationPayment"
                                            id="flexRadioDefault10">
                                        <label class="form-check-label" for="flexRadioDefault10">
                                            <i class="bi-alipay custom-icon ms-1"></i>
                                            Alipay
                                        </label>
                                    </div>

                                    <button type="submit" class="form-control mt-4" id="submit-btn">Submit
                                        Donation</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php include '../app/views/layouts/footer.php'; ?>
    <?php include '../app/views/layouts/cookies.php'; ?>
    <?php include '../app/views/layouts/scroll.php'; ?>
</body>

</html>