<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Staking.answerly</title>
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('css/bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="staking-main">
        <img src="{{ asset('images/Shape 1.png') }}" class="top-shape" alt="">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('images/white-logo.png') }}"
                                class="img-fluid" alt=""></a>
                        <div class="e-wallet">
                            <span class="e-wallInner"><img src="{{ asset('images/frighter.png') }}" alt="">
                                <p>GEXTHJUT...LXKHM</p>
                            </span>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="main-div Smain">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="main-content stak-content">
                            <h2 class="first-h2"><span class="purple">Build on Stellar</span></h2>
                            <h1>Staking your coins
                                with answerly</h1>
                            <h2 class="Sec-h2"><span class="blue">2%</span> Monthly intrest in $ANSR</h2>
                            <a href="" class="mt-4 stak-btn"><span class="stak-btns">Know More</span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="staking-barBackground">
                            <div class="staking-barform">
                                <p class="text-center">Staking For <Span class="blue">30 Days</Span></p>
                                <form class="row g-3 needs-validation" novalidate>
                                    <fieldset>
                                        <div class="balance-div">
                                            <div class="leftBalance">
                                                <p>Current Balance</p>
                                            </div>
                                            <div class="rightBalance">
                                                <p>16,000&nbsp;&nbsp;<span class="blue">$ANSR</span></p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="balance-div">
                                            <div class="leftBalance">
                                                <p>Min</p>
                                            </div>
                                            <div class="rightBalance">
                                                <p>10k token</p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="balance-div">
                                            <div class="leftBalance">
                                                <p>Max</p>
                                            </div>
                                            <div class="rightBalance">
                                                <p>10k token</p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="col-12">
                                        <div class="bar-slider">
                                            <input type="hidden" id="slider_single" class="flat-slider" />
                                        </div>
                                    </div>
                                    <fieldset>
                                        <div class="balance-div mt-2">
                                            <div class="leftBalance">
                                                <p>After 30 Days</p>
                                            </div>
                                            <div class="rightBalance ">
                                                <p class=""><span class="blue">12,000+240</span></p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="col-12">
                                        <button type="submit" class=" mt-3 stak-btn form-sub"><span
                                                class="stak-btns form-btn">Start Staking</span></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.connectWallet')

</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<!-- custom js -->
@include('components.scripts')
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/wallet.js') }}"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('#ConnectWallet').modal('show');
    });
</script>

</html>