<!DOCTYPE html>
<html lang="zxx">
    

@include('layouts.head')
    
    <body>
        
        <!-- Start: Header Section -->
        @include('layouts.header')
        <!-- End: Header Section -->
        
        <!-- Start: Slider Section -->
        <div data-ride="carousel" class="carousel slide" id="home-v1-header-carousel">
            
            <!-- Carousel slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <figure>
                        <img alt="Home Slide" src="images/header-slider/home-v1/header-slide.jpg" />
                    </figure>
                    <div class="container">
                        <div class="carousel-caption">
                            <h3>Online Learning Anytime, Anywhere!</h3>
                            <h2>Discover Your Roots</h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humor, or randomized words.</p>
                            <div class="slide-buttons hidden-sm hidden-xs">    
                                <a href="#" class="btn btn-primary">Read More</a>
                                <a href="#" class="btn btn-default">Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <figure>
                        <img alt="Home Slide" src="images/header-slider/home-v1/header-slide.jpg" />
                    </figure>
                    <div class="container">
                        <div class="carousel-caption">
                            <h3>Online Learning Anytime, Anywhere!</h3>
                            <h2>Discover Your Roots</h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humor, or randomized words.</p>
                            <div class="slide-buttons hidden-sm hidden-xs">    
                                <a href="#" class="btn btn-primary">Read More</a>
                                <a href="#" class="btn btn-default">Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <figure>
                        <img alt="Home Slide" src="images/header-slider/home-v1/header-slide.jpg" />
                    </figure>
                    <div class="container">
                        <div class="carousel-caption">
                            <h3>Online Learning Anytime, Anywhere!</h3>
                            <h2>Discover Your Roots</h2>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humor, or randomized words.</p>
                            <div class="slide-buttons hidden-sm hidden-xs">    
                                <a href="#" class="btn btn-primary">Read More</a>
                                <a href="#" class="btn btn-default">Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Controls -->
            <a class="left carousel-control" href="#home-v1-header-carousel" data-slide="prev"></a>
            <a class="right carousel-control" href="#home-v1-header-carousel" data-slide="next"></a>
        </div>
        <!-- End: Slider Section -->
        
        <!-- Start: Search Section -->
        <section class="search-filters">
            <div class="container">
                <div class="filter-box">
                    <h3>What are you looking for at the library?</h3>
                    <form action="http://libraria.demo.presstigers.com/index.html" method="get">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <label class="sr-only" for="keywords">Search by Keyword</label>
                                <input class="form-control" placeholder="Search by Keyword" id="keywords" name="keywords" type="text">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <select name="catalog" id="catalog" class="form-control">
                                    <option>Search the Catalog</option>
                                    <option>Catalog 01</option>
                                    <option>Catalog 02</option>
                                    <option>Catalog 03</option>
                                    <option>Catalog 04</option>
                                    <option>Catalog 05</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <select name="category" id="category" class="form-control">
                                    <option>All Categories</option>
                                    <option>Category 01</option>
                                    <option>Category 02</option>
                                    <option>Category 03</option>
                                    <option>Category 04</option>
                                    <option>Category 05</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <div class="form-group">
                                <input class="form-control" type="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- End: Search Section -->
        
        <!-- Start: Category Filter -->
        @include('layouts.category-filter')
        <!-- Start: Category Filter -->
        
        <!-- Start: Footer -->
        @include('layouts.footer')
        <!-- End: Footer -->
        
        @include('layouts.js')
        
    </body>


</html>