<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dope Credits - Blogs</title>
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
        /* Add custom styles for blog page */
        .blog-section {
            padding: 80px 0;
            background: white;
        }

        .blog-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .blog-header h1 {
            font-size: 48px;
            font-weight: bold;
            color: #333;
            margin-bottom: 16px;
        }

        .blog-header p {
            font-size: 18px;
            color: #666;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .blog-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-5px);
        }

        .blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-content {
            padding: 20px;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .blog-date {
            font-size: 14px;
            color: #666;
        }

        .blog-category {
            padding: 4px 12px;
            background: #f3f4f6;
            border-radius: 20px;
            font-size: 14px;
            color: #333;
        }

        .blog-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .blog-description {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .pagination {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .pagination .page-link {
            padding: 8px 16px;
            border-radius: 6px;
            color: #333;
            background: #f3f4f6;
            border: none;
        }

        .pagination .page-link:hover {
            background: #e5e7eb;
        }

        .pagination .active .page-link {
            background: linear-gradient(to right, #80c931, #08a6c3);
            color: white;
        }

        @media (max-width: 1024px) {
            .blog-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .blog-grid {
                grid-template-columns: 1fr;
            }

            .blog-header h1 {
                font-size: 36px;
            }
        }

        /* Mobile Menu Styles */
        @media screen and (max-width: 768px) {
            .nav-links {
                position: fixed;
                background: #1d1d1d;
                height: 100vh;
                width: 100%;
                top: 0;
                left: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-evenly;
                clip-path: circle(100px at 90% -20%);
                -webkit-clip-path: circle(100px at 90% -20%);
                transition: all 1s ease-out;
                pointer-events: none;
                z-index: 1000;
            }

            .nav-links.open {
                clip-path: circle(1500px at 90% -10%);
                -webkit-clip-path: circle(1500px at 90% -10%);
                pointer-events: all;
            }

            .nav-links li {
                opacity: 0;
            }

            .nav-links li.fade {
                opacity: 1;
            }

            .hamburger {
                position: relative;
                cursor: pointer;
                z-index: 1001;
            }

            .hamburger div {
                width: 25px;
                height: 3px;
                background: #80c931;
                margin: 5px;
                transition: all 0.3s ease;
            }

            .toggle .line1 {
                transform: rotate(-45deg) translate(-5px, 6px);
            }

            .toggle .line2 {
                opacity: 0;
            }

            .toggle .line3 {
                transform: rotate(45deg) translate(-5px, -6px);
            }
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

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="container">
            <div class="blog-header">
                <h1>
                    <span>From </span>
                    <span>the</span>
                    <span style="color: #80c931;">Blogs</span>
                </h1>
                <p>Learn how to grow your business with our expert advice.</p>
            </div>

            <div id="blogContent">
                <div class="text-center py-5" id="loadingSpinner">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading blog posts...</p>
                </div>
            </div>

            <!-- Pagination -->
            <div id="paginationContainer" class="mt-16 flex items-center justify-between px-4 py-3 sm:px-6" style="display: none;">
                <div class="flex justify-center w-100 gap-2">
                    <button id="prevPage" class="page-link" style="display: none;">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                    <div id="pageNumbers" class="d-flex gap-2">
                    </div>
                    <button id="nextPage" class="page-link" style="display: none;">
                        <i class="fa fa-chevron-right"></i>
                    </button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/wallet.js') }}"></script>
    <script>
        // Blog fetching logic
        let currentPage = 1;
        let totalPages = 1;
        const organizationSlug = 'dopecredits';
        const baseUrl = 'https://defioutreach.com/api';

        function formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        function createBlogCard(blog) {
            return `
                <article class="blog-card">
                    <img src="${blog.featured_image || 'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&auto=format&fit=crop&w=3603&q=80'}"
                         alt="${blog.title}" class="blog-image">
                    <div class="blog-content">
                        <div class="blog-meta">
                            <time datetime="${blog.published_at || blog.created_at}" class="blog-date">
                                ${formatDate(blog.published_at || blog.created_at)}
                            </time>
                            <span class="blog-category">${blog.organization?.name || 'General'}</span>
                        </div>
                        <h3 class="blog-title">
                            <a style="color: #80c931;" href="/blogs/${blog.slug}">${blog.title}</a>
                        </h3>
                        <p style="word-break: break-word;" class="blog-description">
                            ${blog.excerpt || (blog.content ? blog.content.substring(0, 150).replace(/<[^>]*>/g, '') + '...' : '')}
                        </p>
                    </div>
                </article>
            `;
        }

        function updatePagination() {
            const paginationContainer = document.getElementById('paginationContainer');
            const pageNumbers = document.getElementById('pageNumbers');
            const prevButton = document.getElementById('prevPage');
            const nextButton = document.getElementById('nextPage');

            // Show/hide pagination container
            paginationContainer.style.display = totalPages > 1 ? 'flex' : 'none';

            // Show/hide prev/next buttons
            prevButton.style.display = currentPage > 1 ? 'block' : 'none';
            nextButton.style.display = currentPage < totalPages ? 'block' : 'none';

            // Generate page numbers
            let paginationHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `
                    <button class="page-link ${i === currentPage ? 'active' : ''}"
                            onclick="goToPage(${i})">${i}</button>
                `;
            }
            pageNumbers.innerHTML = paginationHTML;
        }

        async function fetchBlogs(page = 1) {
            const loadingSpinner = document.getElementById('loadingSpinner');
            const blogContent = document.getElementById('blogContent');

            loadingSpinner.style.display = 'block';

            try {
                const response = await fetch(`${baseUrl}/organizations/${organizationSlug}/blogs?page=${page}`);

                if (!response.ok) {
                    throw new Error(`Failed to fetch blogs: ${response.status}`);
                }

                const data = await response.json();
                console.log('API Response:', data);

                // Update total pages
                totalPages = data.meta?.last_page || 1;
                currentPage = page;

                // Create blog grid
                let blogsHTML = '<div class="blog-grid">';
                if (data.data && data.data.length > 0) {
                    data.data.forEach(blog => {
                        blogsHTML += createBlogCard(blog);
                    });
                } else {
                    blogsHTML = '<div class="col-12 text-center"><p>No blog posts found.</p></div>';
                }
                blogsHTML += '</div>';

                // Update content
                blogContent.innerHTML = blogsHTML;

                // Update pagination
                updatePagination();

            } catch (error) {
                console.error('Error fetching blogs:', error);
                blogContent.innerHTML = `
                    <div class="alert alert-danger text-center">
                        Unable to load blog posts at this time. Please try again later.
                        <button onclick="fetchBlogs()" class="btn btn-outline-danger mt-3">Try Again</button>
                    </div>
                `;
            } finally {
                loadingSpinner.style.display = 'none';
            }
        }

        function prevPage() {
            if (currentPage > 1) {
                fetchBlogs(currentPage - 1);
            }
        }

        function nextPage() {
            if (currentPage < totalPages) {
                fetchBlogs(currentPage + 1);
            }
        }

        function goToPage(page) {
            if (page !== currentPage) {
                fetchBlogs(page);
            }
        }

        // Add event listeners for pagination
        document.getElementById('prevPage').addEventListener('click', prevPage);
        document.getElementById('nextPage').addEventListener('click', nextPage);

        // Initial fetch
        document.addEventListener('DOMContentLoaded', () => {
            fetchBlogs();
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
