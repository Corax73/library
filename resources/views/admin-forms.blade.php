<!DOCTYPE html>
<html lang="zxx">
    

@include('layouts.head')

    <body>

        <!-- Start: Header Section -->
        @include('layouts.header')
        <!-- End: Header Section -->
                
        <!-- Start: Page Banner -->
        <section class="page-banner services-banner">
            <div class="container">
                <div class="banner-header">
                    <h2>Books & Media Listing</h2>
                    <span class="underline center"></span>
                    <p class="lead">Proin ac eros pellentesque dolor pharetra tempo.</p>
                </div>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>Books & Media</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End: Page Banner -->
        
        <!-- Start: Book & Media Section -->
        <div id="content" class="site-content">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="books-media-list">
                        <div class="container">
                            <div class="row">
                                <!-- Start: Search Section -->
                                <section class="search-filters">
                                @yield('form')
                                </section>
                                <!-- End: Search Section -->
                            </div>
                        </div>

        <!-- Start: Footer -->
        @include('layouts.footer')
        <!-- End: Footer -->

        @include('layouts.js')

    </body>


</html>