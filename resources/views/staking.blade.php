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

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6D0Y0V0JD5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-6D0Y0V0JD5');
    </script>

</head>

<body>

    <div class="staking-main">
        <img src="{{ asset('images/Shape 1.png') }}" class="top-shape" alt="">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ url('/') }}"><img
                                src="{{ asset('images/white-logo.png') }}" class="logo" alt=""></a>
                        <div class="btn-group">
                            <div style="cursor: pointer" class="e-wallet dropdown-toggle" data-bs-toggle="dropdown"
                                data-bs-auto-close="inside" aria-expanded="false">
                                {{-- onclick="$('#ConnectWallet').modal('show');" --}}
                                <span class="e-wallInner">
                                    @if (isset($_COOKIE['wallet']))
                                        <img id='walletImage'
                                            src="{{ asset('images/' . $_COOKIE['wallet'] . '.png') }}" alt="">
                                    @else
                                        <img id='walletImage' alt="">
                                    @endif

                                    <p id="topWallet">
                                        {{ isset($_COOKIE['public']) ? substr($_COOKIE['public'], 0, 4) . '...' . substr($_COOKIE['public'], -5) : 'Connect Wallet' }}
                                    </p>
                                </span>
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableOutside">
                                <li><a class="dropdown-item" onclick="$('#ConnectWallet').modal('show');"
                                        href="javascript::void(0)">Change</a></li>
                                <li><a class="dropdown-item" href="{{ url('wallet/disconnect') }}">Disconnect</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="main-div Smain">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="main-content stak-content">
                            <h2 class="first-h2"><span class="purple">Built on Stellar</span></h2>
                            <h1>Staking your tokens
                                with answerly</h1>
                            <h2 class="Sec-h2"><span class="blue">2%</span> Monthly interest in $ANSR</h2>
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
                                                <p><span
                                                        id="accountBalance">{{ isset($_COOKIE['public']) ? number_format_short(ansrBalance($_COOKIE['public'])) : 0 }}</span>&nbsp;&nbsp;<span
                                                        class="blue">$ANSR</span></p>
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
                                                @if (isset($_COOKIE['public']))
                                                    @if (ansrBalance($_COOKIE['public']) >= env('MIN_AMOUNT'))
                                                        <p id="maxRange">
                                                            {{ number_format_short(ansrBalance($_COOKIE['public'])) }}
                                                            token</p>
                                                    @else
                                                        <p id="maxRange">Below 10k</p>
                                                    @endif
                                                @else
                                                    <p id="maxRange">Not Connected!</p>
                                                @endif
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="col-12">
                                        <div class="range-wrap">
                                            <div class="rangeback"></div>
                                            <p class="rangeP">
                                                @if (isset($_COOKIE['public']))
                                                    @if (ansrBalance($_COOKIE['public']) >= env('MIN_AMOUNT'))
                                                        {{ number_format_short(ansrBalance($_COOKIE['public'])) }}
                                                    @else
                                                        Below 10k
                                                    @endif
                                                @endif
                                            </p>
                                            <div class="range-value" id="rangeV"></div>
                                            <input id="slider_single" type="range" min="10"
                                                @if (isset($_COOKIE['public'])) @if (ansrBalance($_COOKIE['public']) >= env('MIN_AMOUNT'))
                                                max="{{ floor(ansrBalance($_COOKIE['public']) / 1000) }}"
                                            @else
                                                disabled @endif
                                                @endif

                                            value="10" step="1">
                                        </div>
                                        {{-- <div class="bar-slider">
                                            <input type="hidden" value="10" id="slider_single"
                                                class="flat-slider" />
                                        </div> --}}
                                    </div>
                                    <fieldset>
                                        <div class="balance-div mt-2">
                                            <div class="leftBalance">
                                                <p>After 30 Days</p>
                                            </div>
                                            <div class="rightBalance ">
                                                <p class=""><span class="blue"><span
                                                            id="stakAmount">0</span>+<span id="bonusAmount">0</span>
                                                </p>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="col-12">
                                        @if (isset($_COOKIE['public']))
                                            <button onclick="staking()"
                                                {{ ansrBalance($_COOKIE['public']) >= env('MIN_AMOUNT') ? '' : 'disabled' }}
                                                id="btnStaking" type="button" class=" mt-3 stak-btn form-sub"><span
                                                    class="stak-btns form-btn">Start Staking</span></button>
                                        @else
                                            <button onclick="staking()" id="btnStaking" type="button"
                                                class=" mt-3 stak-btn form-sub"><span class="stak-btns form-btn">Start
                                                    Staking</span></button>
                                        @endif
                                        <button style="display: none" id="loadStaking" type="button"
                                            class=" mt-3 loader-btn"><span class="form-btn">
                                                <div class="spinner-border text-light" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <p>Processing</p>
                                            </span></button>

                                    </div>

                                    <div class="col-12 text-center">
                                        @if (isset($_COOKIE['public']))
                                            <h5 id="eligibleError"
                                                {{ ansrBalance($_COOKIE['public']) >= env('MIN_AMOUNT') ? 'hidden' : '' }}
                                                class="text-danger">Not eligible</h5>
                                        @else
                                            <h5 id="eligibleError" hidden class="text-danger">Not eligible</h5>
                                        @endif
                                    </div>

                                </form>
                            </div>
                        </div>
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

        @include('components.connectWallet')

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
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
    const
        range = document.getElementById('slider_single'),
        rangeV = document.getElementById('rangeV'),
        setValue = () => {
            const
                newValue = Number((range.value - range.min) * 100 / (range.max - range.min)),
                newPosition = 10 - (newValue * 0.2);
            if (newValue > 90) {
                $('.rangeP').hide();
            } else {
                $('.rangeP').show();
            }
            rangeSlider();
            rangeV.innerHTML = `<span>${number_format_short(parseInt((range.value).replace(',', '')*1000))}</span>`;
            rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
        };
    document.addEventListener("DOMContentLoaded", setValue);
    range.addEventListener('input', setValue);

    @if (!isset($_COOKIE['public']))
        $(window).load(function() {
            $('#ConnectWallet').modal('show');
        });
    @endif
</script>

</html>
