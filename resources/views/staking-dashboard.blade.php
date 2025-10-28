<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dope Credits - Staking Dashboard</title>
    <!-- Same header includes as home.blade.php -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/c1d440b87551df56c26f7e478436b8ce?family=ParalucentW00-Heavy" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/dope.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/staking-dashboard.css') }}">
</head>

<body>
    <!-- Navbar -->
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
                            <li><a href="{{ url('https://stellar.expert/explorer/public/asset/DOPE-GA6XXNKX5LYLZGZ2QM5CHLZ4R66P4OC6UD7APNLRWRHSILUNIVZ7B4YB') }}">Token explorer</a></li>
                            <li><a href="{{ url('#') }}">About</a></li>
                        </ul>
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
        </div>
    </section>

    <!-- Main Dashboard Section -->
    <section style="background: white" class="staking-dashboard">
        <div class="container">
            <!-- Staking Stats -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="stats-card">
                        <h2 class="section-title">Staking Stats</h2>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <h3>Total Stakers</h3>
                                <p class="stat-value">1,234</p>
                            </div>
                            <div class="stat-item">
                                <h3>Total Staked</h3>
                                <p class="stat-value">500,000 DOPE</p>
                            </div>
                            <div class="stat-item">
                                <h3>DOPE Unlocked</h3>
                                <p class="stat-value">25K / 700M</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Your Stats -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="your-stats-card">
                        <h2 class="section-title">Your Stats</h2>
                        <div class="your-stats-content">
                            <div class="stat-group">
                                <h3>Staked:</h3>
                                <p class="stat-value">10,000 DOPE</p>
                                <a href="#" class="view-link">View trx on explorer</a>
                            </div>
                            <div class="stat-group">
                                <h3>Total reward received</h3>
                                <p class="stat-value">52 DOPE</p>
                            </div>
                            <div class="action-group">
                                <button class="btn btn-danger stop-staking">Stop Staking</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Transactions -->
            <div class="row">
                <div class="col-12">
                    <div class="transactions-card">
                        <h2 class="section-title">Latest Transactions</h2>
                        <div class="table-responsive">
                            <table id="transactionsTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Wallet address</th>
                                        <th>DOPE staked</th>
                                        <th>Staking reward</th>
                                        <th>Explorer link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>GAB4.....XYT</td>
                                        <td>1000 DOPE</td>
                                        <td>5 DOPE <span style="font-size:12px; color:gray">(5 minutes ago)</span></td>
                                        <td><a href="#" class="view-link">View on Stellar.expert</a></td>
                                    </tr>
                                    <tr>
                                        <td>HJK7.....LMN</td>
                                        <td>2000 DOPE</td>
                                        <td>10 DOPE <span style="font-size:12px; color:gray">(10 minutes ago)</span></td>
                                        <td><a href="#" class="view-link">View on Stellar.expert</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="innerFooter">
                        <div class="leftFooter">
                            <a href="#">How it works</a>
                            <a href="#">Faqs</a>
                            <a href="https://stellar.expert/explorer/public/asset/DOPE-GA6XXNKX5LYLZGZ2QM5CHLZ4R66P4OC6UD7APNLRWRHSILUNIVZ7B4YB">Explorer</a>
                            <a href="#">Distribution</a>
                        </div>
                        <div class="rightFooter">
                            <div class="socialLinks">
                                <a href="#"><img src="{{ asset('images/Twitter.png') }}" alt=""></a>
                                <a href="#"><img src="{{ asset('images/medium-m.png') }}" alt=""></a>
                            </div>
                            <div class="powerd">
                                <p>Powered by <span>@Stellarorg</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#transactionsTable').DataTable({
                responsive: true,
                pageLength: 10
            });

            $('.stop-staking').on('click', function() {
                alert('Stop staking functionality will be implemented here');
            });
        });
    </script>
</body>
</html>
