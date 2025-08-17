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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
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
    <style>
        #termsModal .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        #termsModal .modal-dialog {
            max-width: 800px;
        }

        #termsModal .modal-header {
            background: linear-gradient(to right, #80c931, #08a6c3);
            padding: 15px 20px;
            border: none;
            border-radius: 12px 12px 0 0;
            position: relative;
        }

        #termsModal .modal-title {
            color: white;
            font-weight: 600;
            font-size: 20px;
            width: 100%;
            text-align: left;
        }

        #termsModal .close {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            opacity: 1;
            font-size: 28px;
            font-weight: 300;
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            width: 24px;
            height: 24px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #termsModal .close:hover {
            opacity: 0.8;
        }

        #termsModal .modal-body {
            padding: 20px;
            max-height: 60vh;
            overflow-y: auto;
            color: #333;
        }

        #termsModal .terms-subtitle {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
        }

        #termsModal .terms-section {
            margin-bottom: 20px;
        }

        #termsModal .terms-section h6,
        #termsModal .terms-content .para {
            font-weight: 400;
            font-size: 15px;
            margin-bottom: 8px;
            color: #333;
        }

        #termsModal .terms-section p,
        #termsModal .terms-section li {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 5px;
        }

        #termsModal .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        #termsModal .terms-sectionlist h6 {
            font-size: 14px;
            color: #000000;
            line-height: 1.5;
            margin-bottom: 5px;
        }

        #termsModal .terms-sectionlist .para {
            font-size: 14px;
            color: #656565;
            line-height: 1.5;
            margin-bottom: 5px;
        }


        #termsModal .btn {
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            min-width: 100px;
            transition: all 0.3s ease;
        }

        #termsModal .btn-secondary {
            background: #6B7280;
            border: none;
            color: white;
        }

        #termsModal .btn-secondary:hover {
            background: #4B5563;
        }

        #termsModal .btn-primary {
            background: linear-gradient(to right, #80c931, #08a6c3);
            border: none;
            color: white;
        }

        #termsModal .btn-primary:hover {
            opacity: 0.9;
        }

        /* Custom scrollbar for modal body */
        #termsModal .modal-body::-webkit-scrollbar {
            width: 8px;
        }

        #termsModal .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        #termsModal .modal-body::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        #termsModal .modal-body::-webkit-scrollbar-thumb:hover {
            background: #666;
        }

        #termsModal .modal-body::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #termsModal .modal-body {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .range-container {
            padding: 20px 0;
            position: relative;
        }

        /* .noUi-target {
            height: 6px;
            border: none;
            background: #e9ecef;
            box-shadow: none;
            margin-top: 30px;
        }

        .noUi-connect {
            background: #80c931;
        } */

        /* .noUi-handle {
            width: 24px !important;
            height: 24px !important;
            border-radius: 50%;
            background: white;
            box-shadow: 0 1px 5px rgba(0,0,0,0.2);
            border: 2px solid #80c931;
            cursor: pointer;
            right: -12px !important;
        } */

        /* .noUi-handle:before, .noUi-handle:after {
            display: none;
        } */

        .range-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            color: #666;
            font-size: 14px;
            padding: 0 10px;
        }

        .noUi-tooltip::after {
            border-top: 8px solid white !important;
        }

        .selected-value-container {
            text-align: center;
            margin-top: 20px;
            position: relative;
        }

        .value-input-group {
            display: inline-flex;
            align-items: center;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
        }

        .value-input-group:focus-within {
            border-color: #80c931;
            box-shadow: 0 0 0 3px rgba(128, 201, 49, 0.1);

        }

        .value-input {
            background: transparent;
            border: none;
            font-size: 24px;
            font-weight: 600;
            color: #333;
            width: 150px;
            text-align: left;
            padding-right: 10px;
            outline: none;
            color: #3ba908;
            font-weight: 700;
            width: 200px;
        }

        .currency-label {
            font-size: 18px;
            color: #666;
            font-weight: 500;
            margin-left: 5px;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            min-height: 20px;
            font-weight: 500;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
        }

        /* Custom tooltip */
        .noUi-tooltip {
            display: block !important;
            position: absolute;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 8px 12px;
            text-align: center;
            white-space: nowrap;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            bottom: 40px !important;
            transform: translate(-50%, 0);
            left: 50% !important;
        }

        /* Arrow for tooltip */
        .noUi-tooltip:after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 12px;
            height: 12px;
            background: white;
            border-right: 1px solid #e9ecef;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-content {
            border: none;
            border-radius: 0.5rem;
            position: relative;
        }

        .modal-content-wrapper {
            position: relative;
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.25rem 1rem;
            text-align: left;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Rest of your existing modal styles */
    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-K0NR81GJ2F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-K0NR81GJ2F');
    </script>
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
                            <img style="object-fit: contain;" src="{{ asset('images/logo.png') }}" alt="Logo Image">
                        </div>
                        <div class="hamburger">
                            <div class="line1"></div>
                            <div class="line2"></div>
                            <div class="line3"></div>
                        </div>
                        <ul class="nav-links">
                            <li><a href="{{ asset('images/DOPE Credits Whitepaper.pdf') }}"
                                    target="_blank">Whitepaper</a></li>
                            <li><a href="{{ url('https://stellar.expert/explorer/public/asset/DOPE-GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B') }}"
                                    target="_blank" rel="noopener noreferrer">Token explorer</a></li>
                            <li><a href="{{ url('#') }}">About</a></li>
                            <li><a href="{{ url('#buy-dope') }}">Buy DOPE</a></li>
                        </ul>
                        <div class="wallet-btn">
                            <div style="cursor: pointer" class="btn dope mt-0" data-bs-toggle="dropdown"
                                data-bs-auto-close="inside" aria-expanded="false">
                                <span class="e-wallInner">
                                    @if (isset($_COOKIE['wallet']))
                                        <img id='walletImage'
                                            src="{{ asset('images/' . $_COOKIE['wallet'] . '.png') }}" alt="">
                                    @else
                                        <img id='walletImage' alt="">
                                    @endif

                                    <p id="topWallet"
                                        @if (!isset($_COOKIE['public'])) onclick="$('#ConnectWallet').modal('show');" @endif>
                                        {{ isset($_COOKIE['public']) ? substr($_COOKIE['public'], 0, 4) . '...' . substr($_COOKIE['public'], -5) : 'Connect Wallet' }}
                                    </p>

                                </span>
                            </div>
                            @if (isset($_COOKIE['wallet']))
                                <ul class="dropdown-menu modern-dropdown"
                                    aria-labelledby="dropdownMenuClickableOutside">
                                    <li class="dropdown-header">
                                        <span
                                            class="wallet-address">{{ substr($_COOKIE['public'], 0, 4) . '...' . substr($_COOKIE['public'], -5) }}</span>
                                    </li>
                                    <div class="dropdown-divider"></div>
                                    <li>
                                        <a class="dropdown-item modern-action"
                                            onclick="$('#ConnectWallet').modal('show');" href="javascript::void(0)">
                                            <span class="action-icon">
                                                <i class="fa fa-exchange"></i>
                                            </span>
                                            <span class="action-text">Change Wallet</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item modern-action danger-action"
                                            href="{{ url('wallet/disconnect') }}">
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
                    <div class="balRight">
                        <p>Your Balance: <span
                                class="highlight-value">{{ isset($_COOKIE['public']) ? dopeBalance($_COOKIE['public']) : '0' }}
                                $DOPE</span></p>
                    </div>
                </div>
                <div style="margin-bottom: 80px" id="buy-dope" class="container">
                    <h2 class="buy-dope-heading">Buy DOPE Links</h2>
                    <div class="buy-options-container">
                        <div class="buy-options-flex">
                            <div class="buy-option-card">
                                <a target="_blank" rel="noopener noreferrer"
                                    href="https://lobstr.co/trade/native/DOPE:GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B"
                                    class="d-flex align-items-center justify-content-start gap-3">
                                    <div class="platform-icon">
                                        <img src="https://images.builderservices.io/s/cdn/v1.0/i/m?url=https%3A%2F%2Fstorage.googleapis.com%2Fproduction-domaincom-v1-0-7%2F037%2F1100037%2FMs0ri0pf%2Fa55c99f2652b4466932d9b74893f232e&methods=resize%2C900%2C5000"
                                            alt="LOBSTR">
                                    </div>
                                    <h4>LOBSTR</h4>
                                </a>
                            </div>
                            <div class="buy-option-card">
                                <a target="_blank" rel="noopener noreferrer"
                                    href="https://www.stellarx.com/swap/native/DOPE:GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B"
                                    class="d-flex align-items-center justify-content-start gap-3">
                                    <div class="platform-icon">
                                        <img src="https://images.builderservices.io/s/cdn/v1.0/i/m?url=https%3A%2F%2Fstorage.googleapis.com%2Fproduction-domaincom-v1-0-7%2F037%2F1100037%2FMs0ri0pf%2F2ddf9bd39f4d4f8ba2e475921f51c8db&methods=resize%2C900%2C5000"
                                            alt="StellarX">
                                    </div>
                                    <h4>StellarX</h4>
                                </a>
                            </div>
                            <div class="buy-option-card">
                                <a target="_blank" rel="noopener noreferrer"
                                    href="https://obm.lumenswap.io/spot/DOPE-GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B/XLM"
                                    class="d-flex align-items-center justify-content-start gap-3">
                                    <div class="platform-icon">
                                        <img src="https://images.builderservices.io/s/cdn/v1.0/i/m?url=https%3A%2F%2Fstorage.googleapis.com%2Fproduction-domaincom-v1-0-7%2F037%2F1100037%2FMs0ri0pf%2Fa89a4e078c9f4a5d99d874ed8ebb2002&methods=resize%2C900%2C5000"
                                            alt="Lumenswap">
                                    </div>
                                    <h4>Lumenswap</h4>
                                </a>
                            </div>
                            <div class="buy-option-card">
                                <a target="_blank" rel="noopener noreferrer"
                                    href="https://dogstar.io/trade/DOPE-GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B/XLM"
                                    class="d-flex align-items-center justify-content-start gap-3">
                                    <div class="platform-icon">
                                        <img src="https://images.builderservices.io/s/cdn/v1.0/i/m?url=https%3A%2F%2Fstorage.googleapis.com%2Fproduction-domaincom-v1-0-7%2F037%2F1100037%2FMs0ri0pf%2Fa8a31ad8d5854309a51aad3debba9251&methods=resize%2C900%2C5000"
                                            alt="Dogstar">
                                    </div>
                                    <h4>Dogstar</h4>
                                </a>
                            </div>
                            <div class="buy-option-card">
                                <a target="_blank" rel="noopener noreferrer"
                                    href="https://scopuly.com/swap/XLM-DOPE/native/GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B/?amount=1000.0000000&destination="
                                    class="d-flex align-items-center justify-content-start gap-3">
                                    <div class="platform-icon">
                                        <img src="https://images.builderservices.io/s/cdn/v1.0/i/m?url=https%3A%2F%2Fstorage.googleapis.com%2Fproduction-domaincom-v1-0-7%2F037%2F1100037%2FMs0ri0pf%2F67b01d5df65d41ff83afc4dc53b82178&methods=resize%2C900%2C5000"
                                            alt="Scopuly">
                                    </div>
                                    <h4>Scopuly</h4>
                                </a>
                            </div>
                            <div class="buy-option-card">
                                <a target="_blank" rel="noopener noreferrer"
                                    href="https://stellarterm.com/exchange/DOPE-GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B/XLM-native"
                                    class="d-flex align-items-center justify-content-start gap-3">
                                    <div class="platform-icon">
                                        <img src="https://images.builderservices.io/s/cdn/v1.0/i/m?url=https%3A%2F%2Fstorage.googleapis.com%2Fproduction-domaincom-v1-0-7%2F037%2F1100037%2FMs0ri0pf%2F67af86ffd80d470eb75ca76b632067cd&methods=resize%2C900%2C5000"
                                            alt="StellarTerm">
                                    </div>
                                    <h4>StellarTerm</h4>
                                </a>
                            </div>
                            <div class="buy-option-card">
                                <a target="_blank" rel="noopener noreferrer"
                                    href="https://interstellar.exchange/app/#/trade/guest/DOPE/GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B/XLM/native"
                                    class="d-flex align-items-center justify-content-start gap-3">
                                    <div class="platform-icon">
                                        <img src="https://images.builderservices.io/s/cdn/v1.0/i/m?url=https%3A%2F%2Fstorage.googleapis.com%2Fproduction-domaincom-v1-0-7%2F037%2F1100037%2FMs0ri0pf%2F357b2e0801d347ba9af61d487eca2e91&methods=resize%2C900%2C5000"
                                            alt="Interstellar">
                                    </div>
                                    <h4>Interstellar</h4>
                                </a>
                            </div>
                            <div class="buy-option-card">
                                <a target="_blank" rel="noopener noreferrer"
                                    href="https://stellarport.io/exchange/GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B/DOPE"
                                    class="d-flex align-items-center justify-content-start gap-3">
                                    <div class="platform-icon">
                                        <img src="https://images.builderservices.io/s/cdn/v1.0/i/m?url=https%3A%2F%2Fstorage.googleapis.com%2Fproduction-domaincom-v1-0-7%2F037%2F1100037%2FMs0ri0pf%2F260e959279a740ae8fcafe15cbe529bc&methods=resize%2C900%2C5000"
                                            alt="XSTAR">
                                    </div>
                                    <h4>Stellarport</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $balance = isset($_COOKIE['public']) ? dopeBalance($_COOKIE['public']) : 0;
                $maxValue = $balance > 0 ? $balance : 10000000;
                ?>
                @if (!isset($_COOKIE['public']))
                    <div class="mainRange">
                        <a style="background-image: linear-gradient(to right, #80c931, #08a6c3);" class="stake-btn"
                            onclick="$('#ConnectWallet').modal('show');" href="javascript:void(0)">
                            Connect Wallet
                        </a>
                    </div>
                @else
                    @if ($balance >= 1000)
                        <!-- Scrollbar Section -->
                        <div class="mainRange">
                            <h1>How many $DOPE do you want to stake?</h1>
                            <div class="range-container">
                                <div id="dope-slider" data-min="1000" data-max="<?= $maxValue ?>"></div>
                                <div class="range-labels">
                                    <span class="min-value">1,000</span>
                                    <div class="balRight">
                                        <p>Minimum: <span class="highlight-value">1,000 $DOPE</span></p>
                                    </div>
                                    <span class="max-value"><?= number_format($maxValue) ?></span>
                                </div>
                                <div class="selected-value-container">
                                    <div class="value-input-group">
                                        <input type="text" id="value-input" class="value-input" value="1,000">
                                        <span class="currency-label">$DOPE</span>
                                    </div>
                                    <div class="error-message" id="value-error"></div>
                                </div>
                            </div>
                            <div class="terms-section">
                                <label class="custom-checkbox">
                                    <input type="checkbox" id="agree-checkbox" class="regular-checkbox big-checkbox">
                                    <span class="checkmark"></span>
                                    <span class="terms-text">Read the <a href="javascript:void(0)"
                                            onclick="$('#termsModal').modal('show')" class="terms-link">Terms and
                                            conditions</a></span>
                                </label>
                            </div>

                            @if (isset($_COOKIE['public']))
                                <button style="background-image: linear-gradient(to right, #80c931, #08a6c3);"
                                    id="btnStaking" type="button" class="stake-btn">
                                    <span>Stake Now</span>
                                </button>
                            @else
                                <a style="background-image: linear-gradient(to right, #80c931, #08a6c3);"
                                    class="stake-btn" onclick="$('#ConnectWallet').modal('show');"
                                    href="javascript:void(0)">
                                    Connect Wallet
                                </a>
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
                    @else
                        <div class="insufficient-dope">
                            <div class="insufficient-content">
                                <div class="insufficient-icon">
                                    <i class="fa fa-exclamation-circle"></i>
                                </div>
                                <h2>Not Enough DOPE</h2>
                                <p>You need at least 1,000 DOPE tokens to start staking.</p>
                                <div class="insufficient-actions">
                                    <p class="current-balance">Current Balance: <span>{{ $balance }} DOPE</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Scrollbar Section -->
                @endif
            </div>
        </div>
        </div>
        </div>
    </section>

    <!-- Main Dashboard Section -->
    <section style="background: white" class="staking-dashboard">
        <div class="container">
            <!-- Stats Row -->
            <div class="row mb-4">
                <!-- DOPE Asset Stats -->
                <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                    <div class="stats-card asset-stats-card">
                        <div class="card-header">
                            <h3 class="section-title">DOPE Asset Stats</h3>
                            <span class="update-badge">Live Data</span>
                        </div>
                        <div class="asset-stats-content">
                            <div class="main-stats">
                                <div class="stat-row">
                                    <div class="stat-item">
                                        <div class="stat-label">
                                            <i class="fa fa-line-chart"></i>
                                            <span>Price</span>
                                        </div>
                                        <div class="stat-value" id="dope-price"></div>
                                    </div>
                                </div>
                                <div class="stat-row">
                                    <div class="stat-item">
                                        <div class="stat-label">
                                            <i class="fa fa-random"></i>
                                            <span>Trustlines</span>
                                        </div>
                                        <div class="stat-value" id="trustlines"></div>
                                    </div>
                                </div>
                                <div class="stat-row">
                                    <div class="stat-item">
                                        <div class="stat-label">
                                            <i class="fa fa-star"></i>
                                            <span>Stellar Asset Rating</span>
                                        </div>
                                        <div class="stat-value" id="rating">4.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="liquidity-pool-section">
                                <div class="section-header">
                                    <div class="pool-title">
                                        <i class="fa fa-water"></i>
                                        <h6>DOPE/XLM Liquidity Pool</h6>
                                    </div>
                                    <div class="pool-badge">Active</div>
                                </div>
                                <div class="pool-stats">
                                    <div class="pool-stat-item">
                                        <div class="stat-icon-wrapper">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                        <div class="stat-info">
                                            <span style="font-size: 12px;" class="label">Value Locked</span>
                                            <span style="color: #4a9e1c;" class="value"
                                                id="liquidity_pools_amount"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staking Stats -->
                <div class="col-lg-6 col-md-12">
                    <div class="stats-card staking-stats-card">
                        <div class="card-header">
                            <h3 class="section-title">DOPE Staking Stats</h3>
                            <span class="update-badge">Live Data</span>
                        </div>
                        <div class="staking-stats-content">
                            <div style="margin-top: 20px" class="stat-item">
                                <div class="stat-label">
                                    <i class="fa fa-lock"></i>
                                    <span>DOPE Staked</span>
                                </div>
                                <div class="stat-value highlight-value" id="total-staked">Loading...</div>
                            </div>
                            <div style="margin-top: 20px" class="stat-item">
                                <div class="stat-label">
                                    <i class="fa fa-users"></i>
                                    <span>Stakers</span>
                                </div>
                                <div class="stat-value" id="total-stakers">Loading...</div>
                            </div>
                            <div style="margin-top: 20px;flex-direction: column; align-items: start;"
                                class="stat-item unlocked-section">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center;width: 100%;">
                                    <div class="stat-label">
                                        <i class="fa fa-unlock"></i>
                                        <span>DOPE Unlocked</span>
                                    </div>
                                    <div class="stat-value" id="unlocked-tokens">Loading...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Table Card -->
            @if (isset($_COOKIE['public']))
                <div class="row">
                    <div class="col-12">
                        <div class="activity-card">
                            <div style="width: 100%;" class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;width: 100%;"
                                    class="header-content">
                                    <div class="title-section">
                                        <h2 class="section-title">My Activity</h2>
                                    </div>
                                    <div class="simple-stats">
                                        <div class="simple-stat">
                                            Staked: <strong id="wallet-total-staked"
                                                style="color: #4a9e1c; white-space: nowrap;">Loading...</strong>
                                        </div>
                                        <div class="simple-stat">
                                            Rewards: <strong id="total_reward_received"
                                                style="color: #4a9e1c; white-space: nowrap;">Loading...</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="activity-table-wrapper">
                                <table class="activity-table">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Transaction</th>
                                        </tr>
                                    </thead>
                                    <tbody id="activity-table-body">
                                        <!-- Dynamic Content Will Be Inserted Here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="action-group">
                                <button class="btn btn-danger stop-staking">Stop Staking</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Latest Transactions -->
            <div style="margin-top: 40px;" class="row">
                <div class="col-12">
                    <div style="padding: 25px !important;" class="transactions-card">
                        <h2 class="section-title">Latest Transactions</h2>
                        <div style="border-top: 1px solid rgba(128, 201, 49, 0.15);padding-top: 10px;"
                            class="table-responsive">
                            <div class="seg-wrap" role="tablist" aria-label="Transaction filter">
                                <button class="seg-btn is-active" data-filter="all" aria-selected="true">All
                                    Transactions</button>
                                <button class="seg-btn" data-filter="staked" aria-selected="false">DOPE
                                    Staked</button>
                                <button class="seg-btn" data-filter="reward" aria-selected="false">Reward
                                    Received</button>
                            </div>
                            <table id="transactionsTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Wallet address</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Explorer link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be dynamically populated -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="enhanced-staking-section">
        <div class="container">
            <div style="align-items: center" class="row staking-info-section">
                <div class="col-lg-6 col-md-12">
                    <div class="staking-info-card">
                        <div class="emoji-header">
                            <h6>Hi Everyone</h6>
                            <img src="{{ asset('images/hiemo.png') }}" alt="emoji">
                        </div>
                        <div class="staking-content">
                            <h1>Earn 0.1% Daily, Watch Your Wealth Grow</h1>
                            <div class="staking-description">
                                <p>Why settle for low returns when you can earn 0.1% daily, 3% monthly, and a staggering
                                    36.5% annually? With DOPE Credits, your tokens work for you every single day,
                                    providing consistent, straightforward rewards that outshine traditional investments.
                                </p>
                            </div>
                            <div class="action-buttons">
                                <div class="stats-pill">
                                    <span class="stats-label">APY</span>
                                    <span class="stats-value">36.5%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: flex; align-items:center;" class="col-lg-6 col-md-12">
                    <div class="staking-chart">
                        <img src="{{ asset('images/mainRight1.png') }}" alt="Staking Chart" class="img-fluid">
                        <div class="floating-badges">
                            <div class="badge-item">
                                <span class="badge-value">3%</span>
                                <span class="badge-label">Monthly</span>
                            </div>
                            <div class="badge-item">
                                <span class="badge-value">36.5%</span>
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
                    <img src="{{ asset('images/filma.png') }}" alt="Video Icon" class="badge-icon">
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
                            <video id="dopeVideo" controls playsinline style="width: 100%; border-radius: 12px;">
                                <source src="{{ asset('images/DOPE explainer vid.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="play-button" onclick="playVideo()">
                                <div class="play-icon">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 5v14l11-7z" fill="currentColor" />
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
                        <img src="{{ asset('images/Group2.png') }}" alt="Token Details" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="token-info-card">
                        <div class="token-header">
                            <div class="brand-tag">
                                <span>DOPE CREDITS</span>
                                <img src="{{ asset('images/dopeIcon.png') }}" alt="Dope Credits Logo"
                                    class="logo-icon">
                            </div>
                        </div>
                        <div class="token-content">
                            <h2>Token Details <span style="font-size:14px !important"> Built for Performance</span>
                            </h2>
                            <div class="token-details">
                                <div class="detail-item">
                                    <span class="label">Contract Address</span>
                                    <div class="address-box">
                                        <span style="font-size: 12px;word-break: break-all;" class="value"
                                            id="myInput">GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B</span>
                                        <button class="copy-btn" onclick="myFunction()">Copy</button>
                                    </div>
                                </div>
                                <div class="token-description">
                                    <p>
                                        DOPE Credits leverages the Stellar Blockchain for lightning-fast transactions
                                        and minimal fees, ensuring seamless and efficient staking. Whether you're
                                        earning rewards or transferring tokens, Stellar's advanced infrastructure makes
                                        DOPE Credits a powerhouse of performance and reliability. 🚀✨
                                    </p>
                                </div>
                                <div class="token-action">
                                    <a style="margin-top: 0px"
                                        href="https://stellar.expert/explorer/public/asset/DOPE-GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B-1"
                                        target="_blank" class="btn dope">DOPE Explorer</a>
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
                                <img src="{{ asset('images/gift.png') }}" alt="Distribution Icon"
                                    class="feature-icon">
                            </div>
                        </div>
                        <div class="distribution-content">
                            <h2>Token Distribution</h2>
                            <div class="distribution-list">
                                <div class="distribution-item">
                                    <div class="item-header">
                                        <div class="indicator" style="background: #08a6c3"></div>
                                        <h4>Staking rewards - 850,000,000 (85%)</h4>
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
                                    <circle class="donut-ring" cx="60" cy="60" r="50"
                                        fill="transparent" stroke="#eee" stroke-width="10" />
                                    <circle class="donut-segment staking" cx="60" cy="60" r="50"
                                        fill="transparent" stroke="#08a6c3" stroke-width="10"
                                        stroke-dasharray="70 30" stroke-dashoffset="25" />
                                    <circle class="donut-segment presale" cx="60" cy="60" r="50"
                                        fill="transparent" stroke="#80c931" stroke-width="10"
                                        stroke-dasharray="20 80" stroke-dashoffset="-45" />
                                    <circle class="donut-segment partnerships" cx="60" cy="60" r="50"
                                        fill="transparent" stroke="#4a9e1c" stroke-width="10"
                                        stroke-dasharray="5 95" stroke-dashoffset="-65" />
                                    <circle class="donut-segment team" cx="60" cy="60" r="50"
                                        fill="transparent" stroke="#378016" stroke-width="10"
                                        stroke-dasharray="5 95" stroke-dashoffset="-70" />
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
                    <img src="{{ asset('images/time.png') }}" alt="Roadmap Icon" style="width: 20px;">
                </div>
                <h2>Our Journey Ahead</h2>
            </div>
            <div class="timeline-container">
                <div class="timeline-track">
                    <div class="timeline-item active">
                        <div class="timeline-icon">
                            <img src="https://cdn-icons-png.flaticon.com/512/762/762658.png" alt="Launch Icon">
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
                            <img src="https://www.pngitem.com/pimgs/m/320-3203784_growth-icon-png-transparent-png.png"
                                alt="Growth Icon">
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
                            <img src="https://cdn-icons-png.flaticon.com/512/3557/3557601.png" alt="Expansion Icon">
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
                                <p>Stellar's network offers transaction costs of just fractions of a cent, ensuring
                                    cost-efficiency.</p>
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
                                <p>Stellar's speed allows for immediate staking, withdrawal, and rewards distribution.
                                </p>
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
                                <p>With 70% of the token supply dedicated to staking rewards, DOPE Credits ensures a
                                    long-term and self-sustaining ecosystem.</p>
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
                                <p>The platform's infrastructure is built to accommodate a growing user base and
                                    expanding features.</p>
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
                            {{-- <a href="{{ url('#') }}">How it works</a>
                            <a href="{{ url('#') }}">Faqs</a>
                            <a href="{{ url('#') }}">Token details</a>
                            <a href="{{ url('#') }}">Distributuion</a> --}}
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

    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">DOPE Credits Staking Terms & Conditions</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="terms-content">
                        <p class="terms-subtitle">Acceptance of Terms:</p>
                        <p class="para">By staking your DOPE tokens, you agree to these Terms & Conditions. If you do
                            not agree, please do not participate.</p>

                        <div class="terms-sectionlist">
                            <h6>1. Eligibility:</h6>
                            <ul class="para">
                                <li>Minimum stake: 1,000 DOPE tokens.</li>
                                <li>Use a supported Stellar wallet (e.g., Lobstr, Rabet, Freighter, Xbull).</li>
                            </ul>
                        </div>

                        <div class="terms-sectionlist">
                            <h6>2. Staking Rewards:</h6>
                            <ul class="para">
                                <li>Earn 0.1% daily rewards (36.5% annually).</li>
                                <li>Rewards are calculated and added every 24 hours.</li>
                            </ul>
                        </div>

                        <div class="terms-sectionlist">
                            <h6>3. Token Locking & Withdrawal:</h6>
                            <ul class="para">
                                <li>Staked tokens are locked but can be withdrawn anytime without penalties.</li>
                                <li>Withdrawals may incur network transaction fees.</li>
                            </ul>
                        </div>

                        <div class="terms-sectionlist">
                            <h6>4. Platform Rights:</h6>
                            <p class="para">DOPE Credits may modify or suspend the staking program with prior notice.
                                Your staked tokens and rewards remain secure.</p>
                        </div>

                        <div class="terms-sectionlist">
                            <h6>5. Wallet Control:</h6>
                            <p class="para">DOPE Credits does not hold your keys. Stakers retain full control over
                                their wallets and funds.</p>
                        </div>

                        <div class="terms-sectionlist">
                            <h6>6. Risks:</h6>
                            <ul class="para">
                                <li>Market fluctuations and technical issues may impact token value.</li>
                                <li>Ensure your wallet and private keys are secure.</li>
                            </ul>
                        </div>

                        <div class="terms-sectionlist">
                            <h6>7. Compliance:</h6>
                            <p class="para">Stakers must adhere to applicable laws and regulations in their
                                jurisdiction.</p>
                        </div>

                        <div class="terms-sectionlist">
                            <h6>8. Amendments:</h6>
                            <p class="para">These terms may be updated. Significant changes will be communicated.</p>
                        </div>

                        <div class="terms-sectionlist">
                            <h6>9. Acknowledgment:</h6>
                            <p class="para">By staking, you confirm that you understand and agree to these Terms &
                                Conditions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@if (isset($_COOKIE['wallet']))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if wallet public key is set
            const walletAddress = "{{ $_COOKIE['public'] ?? '' }}";

            if (walletAddress) {
                // Make an AJAX request to fetch wallet data
                fetch(`/fetch_wallet_data/${walletAddress}`)
                    .then(response => response.json()) // Parse JSON
                    .then(data => {
                        // Update UI with fetched data
                        $('#wallet-total-staked').text(data.staked +
                            ' DOPE'); // Assuming data.staked for staked value
                        $('#total_reward_received').text(data.total_reward_received +
                            ' DOPE'); // Assuming data.total_reward_received
                    })
                    .catch(error => {
                        // Handle error gracefully
                        console.error('Error fetching wallet data:', error);
                    });
            }
        });
    </script>
@endif
<script>
    function acceptTerms() {
        // document.getElementById('agree-checkbox').checked = true;
        // $('#termsModal').modal('hide');
        const checkbox = document.getElementById('agree-checkbox');
        if (checkbox) {
            checkbox.checked = true;
        }
        $('#termsModal').modal('hide');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('agree-checkbox');
        const termsLink = document.querySelector('.terms-link');

        if (checkbox) {
            checkbox.addEventListener('click', function(e) {
                if (!this.checked) {
                    e.preventDefault();
                    $('#termsModal').modal('show');
                }
            });
        }
        if (termsLink) {
            termsLink.addEventListener('click', function(e) {
                e.preventDefault();
                $('#termsModal').modal('show');
            });
        }

        $('#termsModal').on('hidden.bs.modal', function() {
            if (!checkbox.checked) {
                checkbox.checked = false;
            }
        });
    });

    function myFunction() {
        var copyText = document.getElementById("myInput");

        // Create a temporary text area to select the text
        var tempTextArea = document.createElement("textarea");
        tempTextArea.value = copyText.textContent; // Get the text to copy
        document.body.appendChild(tempTextArea); // Append it to the body

        tempTextArea.select(); // Select the text
        tempTextArea.setSelectionRange(0, 99999); // For mobile devices

        // Execute the copy command
        var successful = document.execCommand("copy");
        // Copy the text inside the text area
        document.execCommand("copy");

        // Remove the temporary text area
        document.body.removeChild(tempTextArea);

        // If copy was successful, update button text to "Copied!"
        if (successful) {
            const button = document.querySelector(".copy-btn");
            button.textContent = "Copied!";

            // Reset the button text to "Copy" after 2 seconds
            setTimeout(function() {
                button.textContent = "Copy";
            }, 2000);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('dope-slider');
        const valueDisplay = document.querySelector('.selected-value .value');
        const minValue = parseInt(slider.dataset.min);
        const maxValue = parseInt(slider.dataset.max);
        const stakeButton = document.getElementById('btnStaking');
        let currentValue = minValue;
        const agreeCheckbox = document.getElementById('agree-checkbox');
        const valueInput = document.getElementById('value-input');
        const errorMessage = document.getElementById('value-error');

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

        // Update input when slider changes
        slider.noUiSlider.on('update', function(values, handle) {
            const value = Math.round(values[handle]);
            currentValue = value; // Update currentValue
            valueInput.value = formatNumber(value);
            validateAndUpdateValue(valueInput.value);
        });
        // Format number with commas
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Parse number removing commas
        function parseFormattedNumber(str) {
            return parseInt(str.replace(/,/g, ''));
        }

        // Validate and update value
        function validateAndUpdateValue(value) {
            const numValue = parseFormattedNumber(value);

            if (isNaN(numValue)) {
                errorMessage.textContent = "Please enter a valid number";
                return false;
            }

            if (numValue < minValue) {
                errorMessage.textContent = `Minimum value is ${formatNumber(minValue)} $DOPE`;
                return false;
            }

            if (numValue > maxValue) {
                errorMessage.textContent = `Maximum value is ${formatNumber(maxValue)} $DOPE`;
                return false;
            }

            errorMessage.textContent = "";
            return true;
        }



        // Update slider when input changes
        valueInput.addEventListener('input', function(e) {
            let value = e.target.value;

            // Remove any non-digit characters except commas
            value = value.replace(/[^\d,]/g, '');

            // Format the number
            const numValue = parseFormattedNumber(value);
            if (!isNaN(numValue)) {
                e.target.value = formatNumber(numValue);

                // Only update slider if value is valid
                if (validateAndUpdateValue(value)) {
                    slider.noUiSlider.set(numValue);
                    currentValue = numValue; // Update currentValue
                }
            }
        });

        // Validate on blur
        valueInput.addEventListener('blur', function(e) {
            const value = e.target.value;
            const numValue = parseFormattedNumber(value);

            if (validateAndUpdateValue(value)) {
                e.target.value = formatNumber(numValue);
                slider.noUiSlider.set(numValue);
                currentValue = numValue; // Update currentValue
            } else {
                // Reset to valid value if invalid
                const validValue = slider.noUiSlider.get();
                e.target.value = formatNumber(Math.round(validValue));
                currentValue = Math.round(validValue); // Reset currentValue
            }
        });
        if (stakeButton && agreeCheckbox) {
            stakeButton.addEventListener('click', function(e) {
                if (!agreeCheckbox.checked) {
                    e.preventDefault(); // Prevent default action
                    toastr.error('Please accept terms and conditions');
                } else {
                    invest(currentValue);
                }
            });
        }
    });

    // Handle clicking outside dropdown
    document.addEventListener('click', function(event) {
        const dropdown = document.querySelector('.modern-dropdown');
        const walletBtn = document.querySelector('.wallet-btn');

        if (dropdown && !walletBtn.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });

    // Video playback functionality
    const video = document.getElementById('dopeVideo');
    const playButton = document.querySelector('.play-button');

    window.playVideo = function() {
        if (video.paused) {
            video.play();
            playButton.style.opacity = '0';
            playButton.style.pointerEvents = 'none';
        } else {
            video.pause();
            playButton.style.opacity = '1';
            playButton.style.pointerEvents = 'auto';
        }
    }

    video.addEventListener('ended', function() {
        playButton.style.opacity = '1';
        playButton.style.pointerEvents = 'auto';
    });

    video.addEventListener('pause', function() {
        playButton.style.opacity = '1';
        playButton.style.pointerEvents = 'auto';
    });


    function formatUnlockedTokens(unlockedTokens) {
        // Round to two decimal places first
        unlockedTokens = parseFloat(unlockedTokens.toFixed(2));

        if (unlockedTokens >= 1000000) {
            // If more than 1 million, append 'M'
            let result = (unlockedTokens / 1000000).toFixed(1);
            // Remove decimal if the result is a whole number
            return result % 1 === 0 ? result.split('.')[0] + 'M' : result + 'M';
        } else if (unlockedTokens >= 10000) {
            // If more than 10,000, append 'K'
            let result = (unlockedTokens / 1000).toFixed(1);
            // Remove decimal if the result is a whole number
            return result % 1 === 0 ? result.split('.')[0] + 'K' : result + 'K';
        } else {
            // Otherwise, display the number as is
            return unlockedTokens;
        }
    }


    $(document).ready(function() {

        $(function() {
            let currentFilter = 'all';

            const table = $('#transactionsTable').DataTable({
                processing: true,
                serverSide: false,
                autoWidth: false,
                scrollX: true,
                responsive: false,
                ajax: {
                    url: base_url + '/transactions',
                    type: 'GET',
                    data: d => {
                        d.filter = currentFilter;
                        d.from = 'home';
                    },
                    dataSrc: 'data'
                },
                columns: [{
                        data: 'wallet_address'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'explorer_link',
                        render: d => d ?
                            `<a href="https://stellar.expert/explorer/public/tx/${d}" target="_blank" rel="noopener"><i class="fa fa-external-link"></i></a>` :
                            'N/A'
                    },
                    {
                        data: 'occurred_at',
                        visible: false
                    }
                ],
                order: [
                    [4, 'desc']
                ],
                pageLength: 10
            });


            // filters (your .seg-btn buttons)
            $('.seg-wrap').on('click', '.seg-btn', function() {
                $('.seg-btn').removeClass('is-active').attr('aria-selected', 'false');
                $(this).addClass('is-active').attr('aria-selected', 'true');

                currentFilter = $(this).data('filter'); // all | staked | reward
                table.ajax.reload(null, false);
            });
        });

        $('#dope-price').text('Loading...');
        // $('#holders').text('Loading...');
        $('#trustlines').text('Loading...');
        $('#rating').text('Loading...');
        $('#liquidity_pools_amount').text('Loading...');

        // Fetch dashboard data when the page loads
        $.ajax({
            url: '/fetch_dashboard_data', // URL for your route
            type: 'GET',
            success: function(response) {
                // Populate the stats with the response data
                $('#total-stakers').text(response.total_stakers);
                const n = +response.price; // e.g. 1.7004687693726915e-7
                const mantissa = parseFloat(n.toExponential(20).split('e')[
                0]); // "1.70046876937269150000"
                const shown = Math.trunc(mantissa * 1e6) / 1e6; // 1.700468 (truncate)
                $('#dope-price').text('$' + shown.toFixed(6));
                // $('#holders').text(response.holders);
                $('#trustlines').text(response.trustline);
                $('#rating').text(response.rating);
                $('#liquidity_pools_amount').text(response.liquidity_pools_amount);
                $('#total-staked').text(response.total_staked + ' DOPE');
                $('#unlocked-tokens').text(formatUnlockedTokens(response.unlocked_tokens) +
                    ' / 850M');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching dashboard data:', error);
                // Display error messages or fallback values
                $('#total-stakers').text('Error');
                $('#total-staked').text('Error');
                $('#unlocked-tokens').text('Error');
            }
        });

        $('.stop-staking').on('click', function() {
            const walletAddress = "{{ $_COOKIE['public'] ?? '' }}";
            const button = $(this); // Reference to the clicked button

            // Show SweetAlert2 confirmation popup
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to stop staking?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, stop staking!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.text('Processing...').prop('disabled',
                        true); // Disable the button to prevent multiple clicks

                    $.ajax({
                        url: `/stop_staking/${walletAddress}`, // Corrected: use backticks for string interpolation
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}" // For CSRF protection
                        },
                        success: function(response) {
                            // Check if the response has the status
                            if (response.status === 1) {
                                Swal.fire(
                                    'Stopped!',
                                    'Dope Tokens Successfully Sent to your wallet.',
                                    'success'
                                );

                                // Reload the page after 3 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            } else {
                                // If status is 0, wallet was not found or error occurred
                                Swal.fire(
                                    'Error!',
                                    response.msg ||
                                    'An error occurred while processing the request.',
                                    'error'
                                );
                                button.text('Stop Staking').prop('disabled', false);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors that occur during the AJAX request
                            Swal.fire(
                                'Error!',
                                'An unexpected error occurred: ' + error,
                                'error'
                            );
                            button.text('Stop Staking').prop('disabled', false);
                        }
                    });
                }
            });
        });

        const walletAddress = "{{ $_COOKIE['public'] ?? '' }}";

        if (walletAddress) {
            $.ajax({
                url: `/wallet_activity/${walletAddress}`,
                type: "GET",
                success: function(response) {
                    const tableBody = $("#activity-table-body");
                    tableBody.empty();

                    let totalStaked = 0;
                    let totalRewards = 0;

                    // Mapping activity types to badge classes
                    const badgeClassMap = {
                        "Staked": "badge-staked",
                        "Unstaked": "badge-unstaked",
                        "Staking reward": "badge-reward"
                    };

                    response.activities.forEach(activity => {
                        // Update total staked and rewards
                        if (activity.type === "Staked") {
                            totalStaked += parseFloat(activity.amount);
                        } else if (activity.type === "Staking reward") {
                            totalRewards += parseFloat(activity.amount);
                        }

                        const badgeClass = badgeClassMap[activity.type] || "badge-default";

                        // Append activity row to the table
                        tableBody.append(`
                            <tr>
                                <td>${activity.time}</td>
                                <td><span class="badge ${badgeClass}">${activity.type}</span></td>
                                <td>${activity.amount}</td>
                                <td><a href="https://stellar.expert/explorer/public/tx/${activity.transaction}" target="_blank" class="transaction-link"><i class="fa fa-external-link"></i></a></td>
                            </tr>
                        `);
                    });

                    // Update staked and reward stats
                    $("#wallet-total-staked").text(`${totalStaked.toFixed(2)} DOPE`);
                    $("#total_reward_received").text(`${totalRewards.toFixed(2)} DOPE`);
                },
                error: function() {
                    alert("Failed to load wallet activity.");
                }
            });
        }
    });

    $('#walltetList li a').click(function(e) {
        wallet = $(this).attr('wallet');
        if (wallet == 'privatekey') {
            $('#walletPrivateKey').show()
        } else {
            $('#walletPrivateKey').hide()
        }
        $('#selectedWallet').html($(this).html());
        $('#mainWalletList').prop("checked", false);
    });

    function connectWallet() {
        $('.walletconnect-btn').hide();
        $('.connectLoading-btn').show();
        switch (wallet) {
            case 'rabet':
                rabbetWallet();
                break;
            case 'freighter':
                frighterWallet();
                break;
            case 'ledger':
                break;
            case 'albeto':
                albedoWallet();
                break;
            case 'xbull':
                xbullWallet();
                break;
            case 'privatekey':
                storePublic($('#walletPrivateKey').val())
                break;
            default:
                displayWalletButtons();
                toastr.warning('Please select Wallet', 'Selection');
        }
    }


    async function frighterWallet() {
        // Step 1: Check if Freighter is connected
        try {
            const connected = await window.freighterApi.isConnected();

            if (!connected) {
                toastr.error('Freighter wallet is not connected.', 'Freighter Wallet');
                displayWalletButtons();
                return;
            }
        } catch (error) {
            toastr.error('Please install or connect the Freighter Extension!', 'Freighter Wallet');
            displayWalletButtons();
            return;
        }

        // Step 2: Retrieve the Public Key
        try {
            const publicKeyObject = await window.freighterApi.requestAccess();

            // Access the 'address' property of the object
            const publicKey = publicKeyObject.address;

            if (publicKey === 'User declined access') {
                toastr.error('Access declined by user.', 'Freighter Wallet');
                displayWalletButtons();
                return;
            }

            // Handle the public key (e.g., store it)
            storeWalletPublic(publicKey, 'freighter');
        } catch (error) {
            toastr.error('An error occurred while retrieving the public key.', 'Freighter Wallet');
            displayWalletButtons();
        }
    }


    function rabbetWallet() {
        if (!window.rabet) {
            toastr.error('Please install Rabet Extension!', 'Rabbet Wallet');
            displayWalletButtons();
        }
        rabet.connect()
            .then(function(result) {
                storeWalletPublic(result.publicKey, 'rabet');
            })
            .catch(function(error) {
                toastr.error(`Wallet Connection Rejected!`, 'Rabbet Wallet');
                displayWalletButtons();
            });
    }

    function xbullWallet() {
        if (typeof xBullSDK == "undefined") {
            toastr.error('Please install Xbull Extension!', 'Xbull Wallet');
            displayWalletButtons();
        }
        xBullSDK.connect({
                canRequestPublicKey: true,
                canRequestSign: true
            }).then(function() {
                xBullSDK.getPublicKey().then(function(key) {
                    storeWalletPublic(key, 'xbull');
                })
            })
            .catch(function(error) {
                toastr.error(`Error Occured`, 'Xbull Wallet');
                displayWalletButtons();
            });
    }

    function albedoWallet() {
        albedo.publicKey()
            .then(function(res) {
                storeWalletPublic(res.pubkey, 'albeto');
            })
            .catch(function(error) {
                toastr.error(`Connection Rejected`, 'Albedo Wallet');
                displayWalletButtons();
            });
    }

    function kFormatter(num) {
        return Math.abs(num) > 999 ? Math.sign(num) * ((Math.abs(num) / 1000).toFixed(1)) : Math.sign(num) * Math.abs(
            num)
    }

    function number_format_short(n) {
        var n_format = 0;
        var suffix = '';
        if (n < 900) {
            // 0 - 900
            n_format = (n);
            suffix = '';
        } else if (n < 900000) {
            // 0.9k-850k
            n_format = (n / 1000);
            suffix = 'K';
        } else if (n < 900000000) {
            // 0.9m-850m
            n_format = (n / 1000000);
            suffix = 'M';
        } else if (n < 900000000000) {
            // 0.9b-850b
            n_format = (n / 1000000000);
            suffix = 'B';
        } else {
            // 0.9t+
            n_format = (n / 1000000000000);
            suffix = 'T';
        }
        return Math.floor(n_format).toString() + suffix;
    }

    //Storing wallets connecting from extensions like rabet etc
    function storeWalletPublic(public, wallet) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: base_url + '/wallet/store',
            type: "post",
            data: {
                public: public,
                wallet: wallet
            },
            success: function(response) {
                if (response.status == 1) {

                    $('#slider_single').val(10);
                    $('.range-value').css('left', 'calc(0% + 10px)');
                    $('.range-value').html('<span>10k</span>');

                    if (response.lowAmount) {
                        $('#btnStaking').attr('disabled', true);
                        $('#slider_single').attr('disabled', true);
                        $('#eligibleError').removeAttr('hidden');
                        $('.rangeP').text('Below 10k');
                        $('#maxRange').text('Below 10k');
                    } else {
                        $('#btnStaking').removeAttr('disabled');
                        $('#slider_single').removeAttr('disabled');
                        $('#eligibleError').attr('hidden', true);
                        // var accVal = Math.round((parseInt((response.balance).replace(/,/g, '')) / 1000));
                        var accVal = kFormatter(parseInt((response.balance).replace(/,/g, '')));
                        $('#slider_single').attr('max', Math.floor(accVal));
                        $('.rangeP').text(number_format_short(parseInt((response.balance).replace(/,/g,
                            ''))));
                        $('#maxRange').text(number_format_short(parseInt((response.balance).replace(/,/g,
                            ''))) + ' token');
                    }
                    $('.remove-btn').show();

                    $('#topWallet').text((response.public).substring(0, 4) + '...' + (response.public)
                        .slice(-5));
                    $('#accountBalance').text(number_format_short(parseInt((response.balance).replace(/,/g,
                        ''))));
                    $('#walletImage').attr('src', base_url + '/images/' + wallet + '.png');

                    toastr.success('Wallet Successfully Conneceted', 'Wallet Connection')
                    displayWalletButtons();
                    $('#ConnectWallet').modal('hide');
                    location.reload();
                } else {
                    toastr.error(`Error: ${response.msg}`, 'Connections')
                    displayWalletButtons();
                }
            },
            error: function(xhr, status, error) {
                toastr.error("Deposit 5 XLM lumens into your wallet!", "Wallet Error");
                displayWalletButtons();
            }
        });
    }

    function displayWalletButtons() {
        $('.walletconnect-btn').show();
        $('.connectLoading-btn').hide();
    }

    //Storing wallets connecting from secret key
    function storePublic(key) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: base_url + '/wallet/secret',
            type: "post",
            data: {
                key: key,
            },
            success: function(response) {
                if (response.status == 1) {
                    $('#topWallet').text((response.public).substring(0, 4) + '...' + (response.public)
                        .slice(-5));
                    $('#accountBalance').text(number_format_short(parseInt((response.balance).replace(/,/g,
                        ''))));

                    $('#slider_single').val(10);
                    $('.range-value').css('left', 'calc(0% + 10px)');
                    $('.range-value').html('<span>10k</span>');

                    if (response.lowAmount) {
                        $('#btnStaking').attr('disabled', true);
                        $('#slider_single').attr('disabled', true);
                        $('#eligibleError').removeAttr('hidden');
                        $('.rangeP').text('Below 10k');
                        $('#maxRange').text('Below 10k');
                    } else {
                        $('#btnStaking').removeAttr('disabled');
                        $('#slider_single').removeAttr('disabled');
                        $('#eligibleError').attr('hidden', true);
                        var accVal = kFormatter(parseInt((response.balance).replace(/,/g, '')));
                        $('#slider_single').attr('max', Math.floor(accVal));
                        $('.rangeP').text(number_format_short(parseInt((response.balance).replace(/,/g,
                            ''))));
                        $('#maxRange').text(number_format_short(parseInt((response.balance).replace(/,/g,
                            ''))) + ' token');
                    }
                    $('.remove-btn').show();


                    $('#walletImage').attr('src', base_url + '/images/' + wallet + '.png');

                    toastr.success('Wallet Successfully Conneceted', 'Wallet Connection')
                    displayWalletButtons();
                    $('#ConnectWallet').modal('hide');
                } else {
                    toastr.error(`Error: ${response.msg}`, 'Connection')
                    displayWalletButtons();
                }
            },
            error: function(xhr, status, error) {
                toastr.error("Deposit 5 XLM lumens into your wallet", "Wallet Error");
                displayWalletButtons();
            }
        });
    }

    function btnLoaderHide() {
        $('#btnStaking').show();
        $('#loadStaking').hide();
    }

    function invest(currentValue) {
        $('#btnStaking').hide();
        $('#loadStaking').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: base_url + '/wallet/invest',
            type: "post",
            data: {
                amount: currentValue,
            },
            success: function(response) {
                if (response.status == 1) {
                    signXdr(response.xdr, response.staking_id);
                } else {
                    btnLoaderHide();
                    toastr.error(response.msg, "Staking Error");
                }
            },
            error: function(xhr, status, error) {
                btnLoaderHide();
                toastr.error('Something went wrong!', "Staking Error");
            }
        });
    }

    function signXdr(xdr, staking_id) {
        switch (wallet) {
            case 'rabet':
                rabet.sign(xdr, testnet ? 'testnet' : 'mainnet')
                    .then(function(result) {
                        const xdr = result.xdr;
                        submitStakingXdr(xdr, staking_id);
                    }).catch(function(error) {
                        btnLoaderHide();
                        toastr.error('Rejected!', "Rabbet Wallet");
                    });
                break;

            case 'freighter':
                window.freighterApi.signTransaction(xdr, testnet ? 'TESTNET' : 'PUBLIC').then(function(result) {
                    const xdr = result.signedTxXdr;
                    submitStakingXdr(xdr, staking_id);
                }).catch(function(error) {
                    btnLoaderHide();
                    toastr.error('Rejected!', "Freighter Wallet");
                });
                break;

            case 'albeto':
                albedo.tx({
                        xdr: xdr,
                        network: 'public'
                    })
                    .then(function(result) {
                        console.log('Albedo signed XDR:', result);
                        const xdr = result.signed_envelope_xdr;
                        if (!xdr) {
                            console.error('Albedo did not return a signed XDR');
                            return;
                        }
                        submitStakingXdr(xdr, staking_id);
                    }).catch(function(error) {
                        btnLoaderHide();
                        console.error('Albedo Wallet Error:', error);
                        toastr.error('Rejected!', "Albeto Wallet");
                    });

                break;
            case 'xbull':
                xBullSDK.signXDR(xdr).then(function(result) {
                    const xdr = result;
                    submitStakingXdr(xdr, staking_id);
                }).catch(function(error) {
                    btnLoaderHide();
                    toastr.error('Rejected!', "xBull Wallet");
                });
                break;
            default:
                submitStakingXdr(xdr, staking_id);
        }
    }

    function submitStakingXdr(xdr, staking_id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: base_url + '/wallet/submitXdr',
            type: "post",
            data: {
                xdr: xdr,
                staking_id: staking_id
            },
            success: function(response) {
                if (response.status == 1) {
                    toastr.success("Successful", "Staking");
                    setTimeout(function() {
                        location.reload(true); // Force reload
                    }, 1000);
                } else {
                    toastr.error(response.msg, "Staking Error");
                }
                btnLoaderHide();
            },
            error: function(xhr, status, error) {
                btnLoaderHide();
                toastr.error('Something went wrong!', "Staking Error");
            }
        });
    }
</script>

</html>
