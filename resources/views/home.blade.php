<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dope Credits</title>
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- paralucemnt font use -->
    <link href="//db.onlinewebfonts.com/c/c1d440b87551df56c26f7e478436b8ce?family=ParalucentW00-Heavy" rel="stylesheet"
        type="text/css" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custome style -->
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/dope.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/staking-dashboard.css') }}">
</head>

<body>

    <!-- mainSection -->
    <section class="bg-main">
        <div style="color: black !important" class="container">
            <!-- navbar -->
            <div class="row">
                <div class="mainNavbar">
                    <nav>
                        <div class="logo">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo Image">
                        </div>
                        <div class="hamburger">
                            <div class="line1"></div>
                            <div class="line2"></div>
                            <div class="line3"></div>
                        </div>
                        <ul class="nav-links">
                            <li><a href="{{ url('#') }}">Stakers</a></li>
                            <li><a href="{{ url('#') }}">Whitepaper</a></li>
                            <li><a href="{{ url('#') }}">Token explorer</a></li>
                            <li><a href="{{ url('#') }}">About</a></li>
                        </ul>
                        {{-- <div class="wallet-btn">
                                <a href="{{ url('#') }}" class="btn dope mt-0" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('images/key.png') }}" alt=""> {{ isset($_COOKIE['public']) ? substr($_COOKIE['public'], 0, 4) . '...' . substr($_COOKIE['public'], -5) : 'Connect Wallet' }}</a>

                                <!-- modal wallet -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <h3>Please Connect Your
                                                            Account to Wallet</h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <label class="drop">
                                                            <input type="checkbox" id="target-drop-example">
                                                            <!-- Toggle Drop -->
                                                            <span class="control">Choose your wallet</span>
                                                            <!-- Fake button -->

                                                            <!-- Items -->
                                                            <ul class="drop-items">
                                                                <li class="item-drop">
                                                                    <a href="javascript:void(0);" onclick="rabbetWallet()">
                                                                        <img class="rabet" src="{{ asset('images/rabit.png') }}" alt="">Rabet
                                                                    </a>
                                                                </li>
                                                                <li class="item-drop">
                                                                    <a href="javascript:void(0);" onclick="frighterWallet()">
                                                                        <img class="rabet" src="{{ asset('images/fre.png') }}" alt="">Freighter
                                                                    </a>
                                                                </li>
                                                                <li class="item-drop">
                                                                    <a href="javascript:void(0);" onclick="xbullWallet()">
                                                                        <img class="rabet" src="{{ asset('images/xbull.png') }}" alt="">Xbull
                                                                    </a>
                                                                </li>
                                                            </ul>

                                                            <!-- Alternative to close dropdown with click out -->
                                                            <label for="target-drop-example"
                                                                class="overlay-close"></label>

                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="cont-btn">
                                                            <a href="{{ url('#') }}" class="btn dope mt-0">Connectasd Wallet</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal wallet -->

                        </div> --}}
                        <div class="wallet-btn">
                            <div style="cursor: pointer" class="btn dope mt-0" data-bs-toggle="dropdown"
                                data-bs-auto-close="inside" aria-expanded="false">
                                <span class="e-wallInner">
                                    @if (isset($_COOKIE['wallet']))
                                        <img id='walletImage' src="{{ asset('images/' . $_COOKIE['wallet'] . '.png') }}"
                                            alt="">
                                    @else
                                        <img id='walletImage' alt="">
                                    @endif

                                    <p id="topWallet"
                                    @if (!isset($_COOKIE['public']))
                                        onclick="$('#ConnectWallet').modal('show');"
                                    @endif>
                                        {{ isset($_COOKIE['public']) ? substr($_COOKIE['public'], 0, 4) . '...' . substr($_COOKIE['public'], -5) : 'Connect Wallet' }}
                                    </p>

                                </span>
                            </div>
                            @if (isset($_COOKIE['wallet']))
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableOutside">
                                <li><a class="dropdown-item" onclick="$('#ConnectWallet').modal('show');"
                                        href="javascript::void(0)">Change</a></li>
                                <li><a class="dropdown-item" href="{{ url('wallet/disconnect') }}">Disconnect</a></li>
                            </ul>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
            <!-- navbar -->
            <div class="row text-center dopeRange">
                <div class="col-12">
                    <div class="mainRange">
                        <div class="rangeBal">
                            <div class="balLeft">
                                <p>Balance - <span>125,000 $Dope</span></p>
                            </div>
                            <div class="balRight">
                                <p>Minimun Staking = <span>1000 $Dope</span></p>
                            </div>
                        </div>
                        <h1>How many $DOPE do you want to stake?</h1>
                    </div>
                    <div class="range2nd">
                        <div class="center">
                            <div class="dual-range" id="slider_single" data-min="1000" data-max="125000" data-value="1000">
                                <span class="handle left"></span>
                                <span class="highlight"></span>
                                <span class="handle right"></span>
                            </div>
                        </div>
                    </div>
                    <h2>12,000 $DOPE</h2>
                    <p> <span class="demo2"><input type="checkbox" id="checkbox-2-1" class="regular-checkbox big-checkbox" /><label for="checkbox-2-1"></label></span> Read
                        the <a href="{{ url('#') }}">Terms and conditions</a></p>
                    {{-- <a href="{{ url('#') }}" class="btn dope mt-0">Stake</a> --}}

                        @if (isset($_COOKIE['public']))
                            <button style="background-image: linear-gradient(to right, #80c931, #08a6c3);"
                            onclick="invest()"
                                {{ dopeBalance($_COOKIE['public']) >= env('MIN_AMOUNT') ? '' : 'disabled' }}
                                id="btnStaking" type="button" class="btn dope mt-0"><span
                                    class="">Stake</span></button>
                        @else
                            {{-- <button style="background-image: linear-gradient(to right, #80c931, #08a6c3);" onclick="invest()" id="btnStaking" type="button"
                                class="btn dope mt-0"><span class="">Start
                                    Stake</span></button> --}}
                            <a style="background-image: linear-gradient(to right, #80c931, #08a6c3);" class="btn dope mt-0" onclick="$('#ConnectWallet').modal('show');"
                                href="javascript::void(0)">Connect Walet</a>
                        @endif
                        <button id="loadStaking" type="button" class="loader-btn" style="display: none;">
                            <span class="form-btn">
                                <div class="spinner-border text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p>Processing</p>
                            </span>
                        </button>

                </div>
            </div>
            <div class="row main2nd">
                <div class="col-12">
                    <!-- Title -->
                    <h3 class="text-center">Staking Rewards</h3>
                    <!-- DataTable -->
                    <div class="table-responsive">
                        <table id="stakingRewardsTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Wallet Address</th>
                                    <th>Transaction ID</th>
                                    <th>Reward</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="row main2nd">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <div class="mainleft">
                        <div class="emojiDiv">
                            <h6>hi everyone</h6>
                            <img src="{{ asset('images/hiemo.png') }}" alt="">
                        </div>

                        <h1><div class="stat-value">0.1% Daily | 36% Annual</div> <br> Interest for staking $Dope</h1>
                        <p>Dope Credit offers 2% monthly (26.28% <br> annually) interest for staking $DOPE. The <br>
                        annuall return for $DOPE is among the highest <br> in the crypto market</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="dopeBtn">
                                    <a href="{{ url('#') }}" class="btn dope">Buy $Dope</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="mainRight">
                        <img src="{{ asset('images/mainRight.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- mainSection -->

    <!-- 2nd section -->
    <section class="Section2nd">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inner2nd">
                        <div class="emojiDiv">
                            <h6>video intro</h6>
                            <img src="{{ asset('images/filma.png') }}" alt="">
                        </div>
                    </div>
                    <h3 style="font-family:'ParalucentW00-Heavy';" class="text-center">Here's how it works</h3>
                    <div class="playVideo">
                        <img style="width: 100%;" src="{{ asset('images/play.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 2nd section -->

    <!-- 3rd section -->
    <section class="Section3rd">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="left3rd">
                        <img src="{{ asset('images/left3rdImg.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="right3rd">
                        <div class="emojiDiv">
                            <h6>dope credits</h6>
                            <img src="{{ asset('images/dopeIcon.png') }}" alt="">
                        </div>
                        <h3 style="font-family:'ParalucentW00-Heavy';" class="">Token Details</h3>
                        <div style="color:#85ca2a;">Contract Address</div>
                        <div class="d-flex gap-2">
                            DOPE-GA6XXNKX5LYLZGZ2QM5CHLZ4R66P4OCHSILUNIVZ7B4YB <a class="text-primary">Copy</a>
                        </div>
                        <br>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form, by injected humour, or randomised.</p>
                        <a href="{{ url('#') }}" class="btn dope">$Dope</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 3rd section -->

    <!-- 4rd Section -->
    <section class="Section4rd">
        <div class="container">
            <div style="align-items: flex-end" class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="left4">
                        <div class="emojiDiv">
                            <h6>Distribution</h6>
                            <img src="{{ asset('images/gift.png') }}" alt="">
                        </div>
                        <h3 style="font-family:'ParalucentW00-Heavy';">Token Distribution</h3>
                        <ul>
                            <li><img src="{{ asset('images/points.png') }}" alt="">Staking rewards -
                                700,000,000 (70%)</li>
                            <li><img src="{{ asset('images/points.png') }}" alt="">Presale - 200,000,000
                                (20%)</li>
                            <li><img src="{{ asset('images/points.png') }}" alt="">Partnerships - 50,000,000 (10%)
                            </li>
                            <li><img src="{{ asset('images/points.png') }}" alt="">Team
                                - 50,000,000 (5%)</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="">
                        <img style="width: 100%" src="{{ asset('images/PieChart1.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 4rd Section -->

    <!-- 5th Section -->
    <section class="Section5th">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inner5th text-center">
                        <div class="emojiDiv">
                            <h6>Timeline</h6>
                            <img class="time" src="{{ asset('images/time.png') }}" alt="">
                        </div>
                        <h3 style="font-family:'ParalucentW00-Heavy';">Timeline</h3>
                        <p>There are many variations of passages.</p>
                    </div>
                </div>
            </div>

            <div class="row desktoptime">
                <div class="col-lg-3 col-md-3">
                    <div class="step1">
                        <img src="{{ asset('images/step1.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="step1">
                        <img src="{{ asset('images/Step3.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="step1">
                        <img src="{{ asset('images/step5.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="step1">
                        <img src="{{ asset('images/step7.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-12">
                    <img class="w-100" src="{{ asset('images/timearrow.png') }}" alt="">
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="step2">
                        <img src="{{ asset('images/step2.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="step2">
                        <img src="{{ asset('images/Step4.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="step2">
                        <img src="{{ asset('images/step6.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="step2">
                        <img src="{{ asset('images/step8.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
            </div>
            <div class="row mobileTime">
                <div class="col-6">
                    <div class="step1">
                        <img src="{{ asset('images/step1.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="step1">
                        <img src="{{ asset('images/step2.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="step1">
                        <img src="{{ asset('images/step1.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="step1">
                        <img src="{{ asset('images/step2.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="step1">
                        <img src="{{ asset('images/step1.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="step1">
                        <img src="{{ asset('images/step2.png') }}" alt="">
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- 5th Section -->

    <!-- 6th Section -->
    <section class="Section6th">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <div class="emojiDiv">
                        <h6>about team</h6>
                        <img src="{{ asset('images/team.png') }}" alt="">
                    </div>
                    <h3 style="font-family:'ParalucentW00-Heavy';">About the team</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                        alteration in some form, by injected humour, or randomised</p>
                </div>
            </div>

            {{-- <div class="teamImgs">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="leftTeam">
                            <div class="firstTeam">
                                <div class="mobilehearts">
                                    <img src="{{ asset('images/heart.png') }}" alt="">
                                    <img src="{{ asset('images/heart.png') }}" alt="">
                                </div>
                                <img src="{{ asset('images/person2.png') }}" class="personImg" alt="">
                                <img src="{{ asset('images/person1.png') }}" class="personImg" alt="">
                            </div>
                            <div class="SecndTeam SecndOne">
                                <img src="{{ asset('images/person2.png') }}" class="personImg" alt="">
                                <img src="{{ asset('images/person1.png') }}" class="personImg" alt="">
                                <div class="desktophearts">
                                    <img src="{{ asset('images/heart.png') }}" alt="">
                                    <img src="{{ asset('images/heart.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 dopeImg">
                        <img src="{{ asset('images/dopeImg.png') }}" alt="">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="rightTeam">
                            <div class="firstTeam">
                                <div class="desktophearts">
                                    <img src="{{ asset('images/heart.png') }}" alt="">
                                    <img src="{{ asset('images/heart.png') }}" alt="">
                                </div>
                                <img src="{{ asset('images/person2.png') }}" class="personImg" alt="">
                                <img src="{{ asset('images/person1.png') }}" class="personImg" alt="">
                            </div>
                            <div class="SecndTeam SecndTwo">
                                <img src="{{ asset('images/person2.png') }}" class="personImg" alt="">
                                <img src="{{ asset('images/person1.png') }}" class="personImg" alt="">
                                <div class="mobilehearts">
                                    <img src="{{ asset('images/heart.png') }}" alt="">
                                    <img src="{{ asset('images/heart.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- 6th Section -->

    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="innerFooter">
                        <div class="leftFooter">
                            <a href="{{ url('#') }}">How it works</a>
                            <a href="{{ url('#') }}">Faqs</a>
                            <a href="{{ url('#') }}">Token details</a>
                            <a href="{{ url('#') }}">Distributuion</a>
                        </div>
                        <div class="rightFooter">
                            <div class="socialLinks">
                                <a href="{{ url('#') }}">
                                    <img src="{{ asset('images/Twitter.png') }}" alt="">
                                </a>
                                <a href="{{ url('#') }}">
                                    <img src="{{ asset('images/medium-m.png') }}" alt="">
                                </a>
                            </div>
                            <div class="powerd">
                                <p>Powerd by <span>@Stellarorg</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer -->

    @include('components.connectWallet')

</body>
<!-- bootstrap 5 js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

<!-- custome js -->
@include('components.scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/stellar-freighter-api/3.0.0/index.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/dope.js') }}"></script>
<script src="{{ asset('js/wallet.js') }}"></script>
<script type="text/javascript">

$(document).ready(function () {

    $('#stakingRewardsTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: base_url + '/fetching_staking_data',
            type: 'GET',
            error: function (xhr, error, thrown) {
                console.error('Error fetching data:', error);
                $('#stakingRewardsTable').html('<tr><td colspan="3">Error loading data</td></tr>');
            }
        },
        columns: [
            { data: 'wallet_address', title: 'Wallet Address' },
            { data: 'trxid', title: 'Transaction ID' },
            { data: 'reward', title: 'Reward' }
        ],
        responsive: true,
        pageLength: 10,
        language: {
            emptyTable: "No staking rewards available yet."
        }
    });


    // Drag and update handle
    $('.handle.left').on('mousedown', function (event) {
        $(document).on('mousemove', function (e) {

            let slider = $('#slider_single');
            let span = slider.find('span'); // Finds the first <span>
            let spanClass = span.attr('class'); // Gets the class attribute
            let dataValue = span.attr('data-value'); // Gets the data-value attribute
            slider.attr('data-value', dataValue);

        });

        $(document).on('mouseup', function () {
            $(document).off('mousemove');
        });
    });
});



// @if (!isset($_COOKIE['public']))
//     $(window).load(function() {
//         $('#ConnectWallet').modal('show');
//     });
// @endif
</script>

</html>
