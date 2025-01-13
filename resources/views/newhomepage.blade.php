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
    <link rel="stylesheet" href="{{ asset('css/staking-portal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/staking-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/range-slider.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css">
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
                            <ul class="dropdown-menu modern-dropdown" aria-labelledby="dropdownMenuClickableOutside">
                                <li class="dropdown-header">
                                    <span class="wallet-address">{{ substr($_COOKIE['public'], 0, 4) . '...' . substr($_COOKIE['public'], -5) }}</span>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <a class="dropdown-item modern-action" onclick="$('#ConnectWallet').modal('show');" href="javascript::void(0)">
                                        <span class="action-icon">
                                            <i class="fa fa-exchange"></i>
                                        </span>
                                        <span class="action-text">Change Wallet</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item modern-action danger-action" href="{{ url('wallet/disconnect') }}">
                                        <span class="action-icon">
                                            <i class="fa fa-power-off"></i>
                                        </span>
                                        <span class="action-text">Disconnect</span>
                                    </a>
                                </li>
                            </ul>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
            <!-- navbar -->
            <div class="dopeRange">
                <div class="rangeBal">
                    <div class="balLeft">
                        <p>Your Balance: <span class="highlight-value">{{ isset($_COOKIE['public']) ? dopeBalance($_COOKIE['public']) : '0' }} $DOPE</span></p>
                    </div>
                    <div class="balRight">
                        <p>Minimum Staking: <span class="highlight-value">1,000 $DOPE</span></p>
                    </div>
                </div>
                <div class="mainRange">
                    <h1>How many $DOPE do you want to stake?</h1>
                    <div class="range-container">
                        <div id="dope-slider" data-min="1000" data-max="500000"></div>
                        <div class="range-labels">
                            <span class="min-value">1000</span>
                            <span class="max-value">500000</span>
                        </div>
                        <div class="selected-value">
                            <span class="value">1,000</span>
                            <span class="currency">$DOPE</span>
                        </div>
                    </div>
                    <div class="terms-section">
                        <label class="custom-checkbox">
                            <input type="checkbox" id="checkbox-2-1" class="regular-checkbox big-checkbox">
                            <span class="checkmark"></span>
                            <span class="terms-text">Read the <a href="{{ url('#') }}" class="terms-link">Terms and conditions</a></span>
                        </label>
                    </div>
                    @if (isset($_COOKIE['public']))
                        <button style="background-image: linear-gradient(to right, #80c931, #08a6c3);"
                            id="btnStaking" type="button" class="stake-btn">
                            {{ dopeBalance($_COOKIE['public']) >= env('MIN_AMOUNT') ? '' : 'disabled' }}
                            <span class="">Stake Now</span>
                        </button>
                    @else
                        <a style="background-image: linear-gradient(to right, #80c931, #08a6c3);"
                           class="stake-btn"
                           onclick="$('#ConnectWallet').modal('show');"
                           href="javascript::void(0)">Connect Wallet</a>
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
    <!-- mainSection -->
    <section class="enhanced-staking-section">
        <div class="container">
            <div class="row staking-info-section">
                <div class="col-lg-6 col-md-12">
                    <div class="staking-info-card">
                        <div class="emoji-header">
                            <h6>Hi Everyone</h6>
                            <img src="{{ asset('images/hiemo.png') }}" alt="emoji">
                        </div>
                        <div class="staking-content">
                            <h1>0.1% Daily | 36% Annual<br>Interest for staking $Dope</h1>
                            <div class="staking-description">
                                <p>Dope Credit offers 2% monthly (26.28% annually) interest for staking $DOPE. The annual return for $DOPE is among the highest in the crypto market, providing secure and reliable staking options for our users.</p>
                            </div>
                            <div class="action-buttons">
                                <a href="#" class="btn dope">Buy $Dope</a>
                                <div class="stats-pill">
                                    <span class="stats-label">APY</span>
                                    <span class="stats-value">36%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="staking-chart">
                        <img src="{{ asset('images/mainRight.png') }}" alt="Staking Chart" class="img-fluid">
                        <div class="floating-badges">
                            <div class="badge-item">
                                <span class="badge-value">2%</span>
                                <span class="badge-label">Monthly</span>
                            </div>
                            <div class="badge-item">
                                <span class="badge-value">26.28%</span>
                                <span class="badge-label">Annually</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Intro Section -->
    <section class="video-intro-section">
        <div class="container">
            <div class="section-header text-center">
                <div class="title-badge">
                    <span class="badge-dot"></span>
                    <span class="badge-text">VIDEO INTRO</span>
                    <img src="{{ asset('images/video-icon.png') }}" alt="Video Icon" class="badge-icon">
                </div>
                <h2>Here's how it works</h2>
            </div>
            <div class="video-container">
                <div class="video-frame">
                    <div class="frame-decoration top-left"></div>
                    <div class="frame-decoration top-right"></div>
                    <div class="frame-decoration bottom-left"></div>
                    <div class="frame-decoration bottom-right"></div>
                    <div class="video-wrapper">
                        <div class="video-thumbnail">
                            <img src="https://www.youtube.com/watch?v=c3vnledCR64&ab_channel=FaisalShabbir" alt="Video Thumbnail">
                            <div class="play-button">
                                <div class="play-icon">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 5v14l11-7z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="button-ring"></div>
                            </div>
                        </div>
                        <div class="video-overlay">
                            <div class="overlay-decoration">
                                <div class="deco-circle circle-1"></div>
                                <div class="deco-circle circle-2"></div>
                                <div class="deco-line line-1"></div>
                                <div class="deco-line line-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Token Details Section -->
    <section class="token-details-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="token-chart">
                        <img src="{{ asset('images/left3rdImg.png') }}" alt="Token Details" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="token-info-card">
                        <div class="token-header">
                            <div class="brand-tag">
                                <span>DOPE CREDITS</span>
                                <img src="{{ asset('images/dopeIcon.png') }}" alt="Dope Credits Logo" class="logo-icon">
                            </div>
                        </div>
                        <div class="token-content">
                            <h2>Token Details</h2>
                            <div class="token-details">
                                <div class="detail-item">
                                    <span class="label">Contract Address</span>
                                    <div class="address-box">
                                        <span class="value">DOPE-GA6XXNKX5LYLZG2ZQM5CHLZ4R66P4OCHSILUNVZ7B4YB</span>
                                        <button class="copy-btn">Copy</button>
                                    </div>
                                </div>
                                <div class="token-description">
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised.</p>
                                </div>
                                <div class="token-action">
                                    <a href="#" class="btn dope">$Dope</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Token Distribution Section -->
    <section class="token-distribution-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="distribution-info-card">
                        <div class="distribution-header">
                            <div class="feature-tag">
                                <span>DISTRIBUTION</span>
                                <img src="{{ asset('images/gift.png') }}" alt="Distribution Icon" class="feature-icon">
                            </div>
                        </div>
                        <div class="distribution-content">
                            <h2>Token Distribution</h2>
                            <div class="distribution-list">
                                <div class="distribution-item">
                                    <div class="item-header">
                                        <div class="indicator" style="background: #08a6c3"></div>
                                        <h4>Staking rewards - 700,000,000 (70%)</h4>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 70%; background: #08a6c3"></div>
                                    </div>
                                </div>
                                <div class="distribution-item">
                                    <div class="item-header">
                                        <div class="indicator" style="background: #80c931"></div>
                                        <h4>Presale - 200,000,000 (20%)</h4>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 20%; background: #80c931"></div>
                                    </div>
                                </div>
                                <div class="distribution-item">
                                    <div class="item-header">
                                        <div class="indicator" style="background: #4a9e1c"></div>
                                        <h4>Partnerships - 50,000,000 (5%)</h4>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 5%; background: #4a9e1c"></div>
                                    </div>
                                </div>
                                <div class="distribution-item">
                                    <div class="item-header">
                                        <div class="indicator" style="background: #378016"></div>
                                        <h4>Team - 50,000,000 (5%)</h4>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 5%; background: #378016"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="total-supply">
                                <div class="supply-info">
                                    <span class="label">Total Supply:</span>
                                    <span class="value">1,000,000,000</span>
                                </div>
                                <div class="supply-note">(1 Billion)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="distribution-chart">
                        <div class="chart-container">
                            <div class="donut-chart">
                                <svg viewBox="0 0 120 120" class="donut">
                                    <circle class="donut-ring" cx="60" cy="60" r="50" fill="transparent" stroke="#eee" stroke-width="10"/>
                                    <circle class="donut-segment staking" cx="60" cy="60" r="50" fill="transparent" stroke="#08a6c3" stroke-width="10" stroke-dasharray="70 30" stroke-dashoffset="25"/>
                                    <circle class="donut-segment presale" cx="60" cy="60" r="50" fill="transparent" stroke="#80c931" stroke-width="10" stroke-dasharray="20 80" stroke-dashoffset="-45"/>
                                    <circle class="donut-segment partnerships" cx="60" cy="60" r="50" fill="transparent" stroke="#4a9e1c" stroke-width="10" stroke-dasharray="5 95" stroke-dashoffset="-65"/>
                                    <circle class="donut-segment team" cx="60" cy="60" r="50" fill="transparent" stroke="#378016" stroke-width="10" stroke-dasharray="5 95" stroke-dashoffset="-70"/>
                                </svg>
                                <div class="chart-center">
                                    <span class="chart-value">100%</span>
                                    <span class="chart-label">Total</span>
                                </div>
                            </div>
                            <div class="floating-labels">
                                <div class="label-item" style="top: 20%; right: 10%">
                                    <span class="percentage">70%</span>
                                    <span class="label">Staking</span>
                                </div>
                                <div class="label-item" style="top: 40%; left: 10%">
                                    <span class="percentage">20%</span>
                                    <span class="label">Presale</span>
                                </div>
                                <div class="label-item" style="bottom: 20%; left: 20%">
                                    <span class="percentage">5%</span>
                                    <span class="label">Team</span>
                                </div>
                                <div class="label-item" style="bottom: 30%; right: 15%">
                                    <span class="percentage">5%</span>
                                    <span class="label">Partnerships</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="container">
            <div class="section-header">
                <div class="feature-tag">
                    <span>ROADMAP</span>
                    <img src="{{ asset('images/time.png') }}" alt="Roadmap Icon" class="feature-icon">
                </div>
                <h2>Our Journey Ahead</h2>
            </div>
            <div class="timeline-container">
                <div class="timeline-track">
                    <div class="timeline-item active">
                        <div class="timeline-icon">
                            <img src="{{ asset('images/launch.png') }}" alt="Launch Icon">
                        </div>
                        <div class="timeline-content">
                            <div class="phase-tag">Phase 1</div>
                            <h3>Launch and Presale</h3>
                            <span class="timeline-date">Q1 2025</span>
                            <ul class="timeline-list">
                                <li>Launch DOPE Credits platform</li>
                                <li>Conduct presale from January 20 to January 31, 2025</li>
                                <li>Onboard initial community of stakers</li>
                            </ul>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <img src="{{ asset('images/growth.png') }}" alt="Growth Icon">
                        </div>
                        <div class="timeline-content">
                            <div class="phase-tag">Phase 2</div>
                            <h3>Growth and Listings</h3>
                            <span class="timeline-date">Q2-Q3 2025</span>
                            <ul class="timeline-list">
                                <li>Secure listing on a centralized exchange (CEX)</li>
                                <li>Achieve listing on CoinGecko</li>
                                <li>Expand liquidity pools on Stellar DEX</li>
                            </ul>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <img src="{{ asset('images/expansion.png') }}" alt="Expansion Icon">
                        </div>
                        <div class="timeline-content">
                            <div class="phase-tag">Phase 3</div>
                            <h3>Expansion</h3>
                            <span class="timeline-date">Q4 2025</span>
                            <ul class="timeline-list">
                                <li>Reach 10,000 total stakers</li>
                                <li>Introduce additional use cases for DOPE Credits</li>
                                <li>Explore multi-chain capabilities</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why DOPE Credits Section -->
    <section class="why-dope-section">
        <div class="container">
            <div class="section-header">
                <div class="title-wrapper">
                    <div class="title-badge">
                        <span class="badge-dot"></span>
                        <span class="badge-text">Features</span>
                    </div>
                    <h2>Why DOPE Credits?</h2>
                </div>
            </div>
            <div class="features-container">
                <div class="feature-line">
                    <div class="line-glow"></div>
                </div>
                <div class="feature-items">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <div class="icon-circle">
                                <div class="icon-shape speed-icon"></div>
                            </div>
                        </div>
                        <div class="feature-content">
                            <div class="content-wrapper">
                                <h3>Low Fees</h3>
                                <p>Stellar's network offers transaction costs of just fractions of a cent, ensuring cost-efficiency.</p>
                                <div class="hover-indicator"></div>
                            </div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <div class="icon-circle">
                                <div class="icon-shape speed-icon"></div>
                            </div>
                        </div>
                        <div class="feature-content">
                            <div class="content-wrapper">
                                <h3>Instant Transactions</h3>
                                <p>Stellar's speed allows for immediate staking, withdrawal, and rewards distribution.</p>
                                <div class="hover-indicator"></div>
                            </div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <div class="icon-circle">
                                <div class="icon-shape speed-icon"></div>
                            </div>
                        </div>
                        <div class="feature-content">
                            <div class="content-wrapper">
                                <h3>Sustainability</h3>
                                <p>With 70% of the token supply dedicated to staking rewards, DOPE Credits ensures a long-term and self-sustaining ecosystem.</p>
                                <div class="hover-indicator"></div>
                            </div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <div class="icon-circle">
                                <div class="icon-shape speed-icon"></div>
                            </div>
                        </div>
                        <div class="feature-content">
                            <div class="content-wrapper">
                                <h3>Scalability</h3>
                                <p>The platform's infrastructure is built to accommodate a growing user base and expanding features.</p>
                                <div class="hover-indicator"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-bg-elements">
            <div class="bg-circle circle-1"></div>
            <div class="bg-circle circle-2"></div>
            <div class="bg-circle circle-3"></div>
        </div>
    </section>

    <!-- Join Us Section -->
    <section class="join-us-section">
        <div class="container">
            <div class="join-us-card">
                <div class="join-us-content">
                    <h2>Join Us</h2>
                    <p>Be part of the future with DOPE Credits.<br>Stake, earn, and grow with us!</p>
                    <div class="social-links">
                        <a href="https://dopecredits.com" class="social-link website-link">
                            <i class="fa fa-globe"></i>
                            <span>dopecredits.com</span>
                            <div class="link-hover"></div>
                        </a>
                        <a href="https://twitter.com/Dopecredits" class="social-link twitter-link">
                            <i class="fa fa-twitter"></i>
                            <span>@Dopecredits</span>
                            <div class="link-hover"></div>
                        </a>
                    </div>
                </div>
                <div class="decoration-elements">
                    <div class="deco-circle circle-1"></div>
                    <div class="deco-circle circle-2"></div>
                    <div class="deco-line line-1"></div>
                    <div class="deco-line line-2"></div>
                </div>
            </div>
        </div>
    </section>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('dope-slider');
    const valueDisplay = document.querySelector('.selected-value .value');
    const minValue = parseInt(slider.dataset.min);
    const maxValue = parseInt(slider.dataset.max);
    const stakeButton = document.getElementById('btnStaking');
    let currentValue = 1000;

    noUiSlider.create(slider, {
        start: currentValue,
        connect: 'lower',
        range: {
            'min': minValue,
            'max': maxValue
        },
        tooltips: {
            to: function(value) {
                return Number(value).toLocaleString();
            }
        },
        format: {
            to: function(value) {
                return Math.round(value);
            },
            from: function(value) {
                return Number(value);
            }
        }
    });

    slider.noUiSlider.on('update', function(values, handle) {
        currentValue = Math.round(values[handle]);
        valueDisplay.textContent = Number(currentValue).toLocaleString();
        stakeButton.setAttribute('onclick', `invest(${currentValue})`);
    });

    // Staking functionality
    // window.invest = function() {
    //     if (!document.getElementById('checkbox-2-1').checked) {
    //         toastr.error('Please accept terms and conditions');
    //         return false;
    //     }

    //     $('#btnStaking').hide();
    //     $('#loadStaking').show();

    //     $.ajax({
    //         url: base_url + '/wallet/invest',
    //         type: 'POST',
    //         data: {
    //             _token: $('meta[name="csrf-token"]').attr('content'),
    //             amount: currentValue
    //         },
    //         success: function(response) {
    //             if (response.status) {
    //                 toastr.success(response.message);
    //                 signXdr(response.xdr, response.staking_id);
    //                 setTimeout(function() {
    //                     window.location.reload();
    //                 }, 2000);
    //             } else {
    //                 toastr.error(response.message);
    //                 $('#btnStaking').show();
    //                 $('#loadStaking').hide();
    //             }
    //         },
    //         error: function(xhr) {
    //             toastr.error('Something went wrong!');
    //             $('#btnStaking').show();
    //             $('#loadStaking').hide();
    //         }
    //     });
    // }

    // Handle clicking outside dropdown
    document.addEventListener('click', function(event) {
        const dropdown = document.querySelector('.modern-dropdown');
        const walletBtn = document.querySelector('.wallet-btn');

        if (dropdown && !walletBtn.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
});
</script>

</html>
