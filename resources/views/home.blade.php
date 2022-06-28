<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Staking.answerly</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('css/bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- top section -->
    <div class="main-section">
        <img src="{{ asset('images/Shape 1.png') }}" class="top-shape" alt="">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ url('/') }}"><img
                                src="{{ asset('images/white-logo.png') }}" class="logo" alt=""></a>
                    </div>
                </nav>
            </div>
            <div class="main-div">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="main-content">
                            <h2 class="first-h2"><span class="purple">Built on Stellar</span></h2>
                            <h1>The future of Staking is here</h1>
                            <h2 class="Sec-h2"><span class="blue">2%</span> Monthly intrest in $ANSR</h2>
                            <a href="{{ url('/staking') }}" class="mt-4 stak-btn"><span class="stak-btns">Start
                                    Staking</span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <img src="{{ asset('images/main-img.png') }}" class="img-fluid main-img" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top section -->

    <!-- information section -->
    <div class="information">
        <div class="container">
            <div class="inform-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <img src="{{ asset('images/inform-wallet.png') }}" class="img-fluid wallet-img"
                            alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="inform-left">
                            <h2 class="purple mb-4">About Answerly Staking</h2>
                            {{-- <h1>Information</h1> --}}
                            <p>Answerly staking allow the token holders to earn 2% monthly interest just by locking
                                their tokens for 1 month. The entire staking module is running decentrally on the
                                Stellar blockchain. Moreover, Answerly Staking is open to everyone, no matter if you are
                                an Answerly platform user or not</p>
                            <a href="{{ url('/staking') }}" class="mt-4 stak-btn"><span class="stak-btns">Start
                                    Staking</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- information section -->

    <!-- footer -->
    <footer>
        <div class="container">
            <div class="footer-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="footer-content">
                            <h2 class="purple mb-4">Support System</h2>
                            {{-- <h1>Contact</h1> --}}
                            <p>Get in touch with our support team if you have any questions regarding Answerly Staking
                            </p>
                            <a href="{{ url('/staking') }}" class="mt-4 stak-btn"><span class="stak-btns">Start
                                    Staking</span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-div">
                            <form id="contact-form" class="row g-3 needs-validation" novalidate>
                                <div class="col-12">
                                    <input name="name" type="text" class="form-control" id="validationCustom01"
                                        placeholder="Name" required>
                                </div>
                                <div class="col-12">
                                    <div class="input-group has-validation">
                                        <input name="email" type="email" class="form-control"
                                            id="validationCustomUsername" aria-describedby="inputGroupPrepend"
                                            placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" rows="4" class="form-control" id="validationTextarea" placeholder="Message" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="mt-4 stak-btn form-sub"><span
                                            class="stak-btns form-btn">Send Message</span></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom">
                            <p>&copy; 2022 Answerly Inc.<br class="resevrd-mob"> All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </footer>
    <!-- footer -->

    <!-- bootstarp 5 js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js -->
    <script>
        var base_url = "@php echo url('/') @endphp";
    </script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
