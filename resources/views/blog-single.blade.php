<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>      - Dope Credits</title>
    <!-- Include all the same styles as newhomepage.blade.php -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/c1d440b87551df56c26f7e478436b8ce?family=ParalucentW00-Heavy" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/dope.css') }}">
    <!-- Add jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <style>
        /* Modern Blog Single Page Styles */
        :root {
            --primary-color: #80c931;
            --secondary-color: #08a6c3;
            --text-color: #2d3748;
            --light-gray: #f7fafc;
            --dark-gray: #4a5568;
            --link-color: #3182ce;
            --link-hover: #2c5282;
        }

        body {
            color: var(--text-color);
            line-height: 1.6;
        }

        .bg-main {
            background: linear-gradient(to right, rgba(128, 201, 49, 0.1), rgba(8, 166, 195, 0.1));
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .mainNavbar nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-color);
            background: rgba(128, 201, 49, 0.1);
        }

        .nav-links a.active {
            color: var(--primary-color);
            background: rgba(128, 201, 49, 0.15);
        }

        .blog-single-section {
            padding: 80px 0;
            background: white;
        }

        .back-to-blogs {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--link-color);
            text-decoration: none;
            margin-bottom: 48px;
            padding: 12px 24px;
            background: var(--light-gray);
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-to-blogs:hover {
            color: var(--link-hover);
            background: #edf2f7;
            transform: translateX(-5px);
        }

        .blog-header-image {
            width: 100%;
            max-height: 600px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 32px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
        }

        .blog-category {
            padding: 8px 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 30px;
            font-size: 14px;
            color: white;
            font-weight: 500;
        }

        .blog-date {
            font-size: 15px;
            color: var(--dark-gray);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .blog-date i {
            color: var(--primary-color);
        }

        .blog-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--text-color);
            margin-bottom: 40px;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .blog-author {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 40px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .author-image {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info h4 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .author-info p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .blog-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: var(--text-color);
            max-width: 800px;
            margin: 0 auto;
        }

        .blog-content p {
            margin-bottom: 28px;
        }

        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 40px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .blog-content h2 {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-color);
            margin: 56px 0 24px;
            letter-spacing: -0.01em;
        }

        .blog-content h3 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--text-color);
            margin: 40px 0 20px;
        }

        .blog-content a {
            color: var(--link-color);
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .blog-content a:hover {
            color: var(--link-hover);
            border-bottom-color: var(--link-hover);
        }

        .blog-content ul, .blog-content ol {
            margin: 24px 0;
            padding-left: 24px;
        }

        .blog-content li {
            margin-bottom: 12px;
        }

        .blog-content blockquote {
            margin: 40px 0;
            padding: 32px;
            background: var(--light-gray);
            border-left: 6px solid var(--primary-color);
            border-radius: 12px;
            font-style: italic;
            font-size: 1.25rem;
            color: var(--dark-gray);
        }

        /* Mobile Menu Styles */
        .hamburger {
            display: none;
            cursor: pointer;
            z-index: 100;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background: var(--primary-color);
            margin: 5px;
            transition: all 0.3s ease;
        }

        @media (max-width: 1024px) {
            .blog-title {
                font-size: 2.75rem;
            }

            .blog-content {
                font-size: 1.1rem;
                padding: 0 20px;
            }
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            .nav-links {
                position: fixed;
                right: -100%;
                top: 0;
                height: 100vh;
                width: 100%;
                background: white;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 2rem;
                transition: right 0.5s ease;
                z-index: 99;
            }

            .nav-links.open {
                right: 0;
            }

            .nav-links li {
                opacity: 0;
                transform: translateX(50px);
                transition: all 0.5s ease;
            }

            .nav-links li.fade {
                opacity: 1;
                transform: translateX(0);
            }

            .blog-single-section {
                padding: 40px 0;
            }

            .blog-title {
                font-size: 2rem;
            }

            .blog-content {
                font-size: 1rem;
            }

            .blog-header-image {
                max-height: 400px;
            }

            .blog-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

        /* Animation Classes */
        .toggle .line1 {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .toggle .line2 {
            opacity: 0;
        }

        .toggle .line3 {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        /* Enhanced Footer Styles */
        footer {
            background: var(--light-gray);
            padding: 60px 0;
            margin-top: 80px;
        }

        .innerFooter {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .leftFooter a {
            color: var(--text-color);
            text-decoration: none;
            margin-right: 24px;
            transition: color 0.3s ease;
        }

        .leftFooter a:hover {
            color: var(--primary-color);
        }

        .socialLinks a {
            margin-left: 16px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .socialLinks a:hover {
            opacity: 1;
        }

        .powerd p {
            margin: 0;
            color: var(--dark-gray);
        }

        .powerd span {
            color: var(--primary-color);
            font-weight: 500;
        }
    </style>
</head>

<body>
    <!-- Include the same navigation as newhomepage.blade.php -->
    <section class="bg-main">
        <div class="container">
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
                            <li><a href="{{ asset('images/DOPE Credits Whitepaper.pdf') }}" target="_blank">Whitepaper</a></li>
                            <li><a href="{{ url('https://stellar.expert/explorer/public/asset/DOPE-GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B') }}" target="_blank" rel="noopener noreferrer">Token explorer</a></li>
                            <li><a href="{{ url('#') }}">About</a></li>
                            <li><a href="{{ url('/') }}#buy-dope">Buy DOPE</a></li>
                            <li><a href="{{ url('/blogs') }}" class="active">Blogs</a></li>
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
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Single Section -->
    <section class="blog-single-section">
        <div class="container">
            <a href="{{ url('/blogs') }}" class="back-to-blogs">
                <i class="fa fa-arrow-left"></i>
                Back to Blogs
            </a>

            <div id="blogContent">
                <div class="text-center py-5" id="loadingSpinner">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading blog post...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Include the same footer as newhomepage.blade.php -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="innerFooter">
                        <div class="leftFooter">
                            <a href="{{ url('#') }}">How it works</a>
                            <a href="{{ url('#') }}">Faqs</a>
                            <a href="{{ url('#') }}">Token details</a>
                            <a href="{{ url('#') }}">Distribution</a>
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
                                <p>Powered by <span>@Stellarorg</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @include('components.connectWallet')

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/wallet.js') }}"></script>
    <script>
        // Blog fetching logic
        const organizationSlug = 'dopecredits';
        const baseUrl = 'https://defioutreach.com/api';
        const blogSlug = window.location.pathname.split('/').pop();

        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        async function fetchBlog() {
            const loadingSpinner = document.getElementById('loadingSpinner');
            const blogContent = document.getElementById('blogContent');

            loadingSpinner.style.display = 'block';

            try {
                // First, fetch the blog list to find the specific blog
                const response = await fetch(`${baseUrl}/organizations/${organizationSlug}/blogs`);

                if (!response.ok) {
                    throw new Error(`Failed to fetch blog: ${response.status}`);
                }

                const data = await response.json();
                console.log('API Response:', data);

                // Find the specific blog post from the data array
                const blog = data.data.find(post => post.slug === blogSlug);

                if (!blog) {
                    throw new Error('Blog post not found');
                }

                const content = `
                    <img src="${blog.featured_image || 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&auto=format&fit=crop&w=3603&q=80'}"
                         alt="${blog.title}"
                         class="blog-header-image">

                    <div class="blog-meta">
                        <span class="blog-category">Dope Credits</span>
                        <time datetime="${blog.published_at || blog.created_at}" class="blog-date">
                            <i class="fa fa-calendar"></i>
                            ${formatDate(blog.published_at || blog.created_at)}
                        </time>
                    </div>

                    <h1 class="blog-title">${blog.title}</h1>

                    <div class="blog-content">
                        ${blog.content || ''}
                    </div>
                `;

                blogContent.innerHTML = content;
                document.title = `${blog.title} - Dope Credits`;

            } catch (error) {
                console.error('Error fetching blog:', error);
                blogContent.innerHTML = `
                    <div class="alert alert-danger text-center">
                        <p class="mb-3">Unable to load blog post at this time. Please try again later.</p>
                        <button onclick="fetchBlog()" class="btn btn-outline-danger">Try Again</button>
                    </div>
                `;
            } finally {
                loadingSpinner.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchBlog();
        });

        // Hamburger Menu JavaScript
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");
        const links = document.querySelectorAll(".nav-links li");

        hamburger.addEventListener("click", () => {
            navLinks.classList.toggle("open");
            links.forEach(link => {
                link.classList.toggle("fade");
            });
            hamburger.classList.toggle("toggle");
        });
    </script>
</body>
</html>
