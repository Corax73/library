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
        <div class="row">  
        <div class="col-md-9 col-md-push-3">
        <div class="books-list">
        <article>
        <div class="single-book-box">
            <div class="post-thumbnail">
                <div class="book-list-icon yellow-icon"></div>
                <a href="{{ route('showBook', $book->id) }}"><img alt="Book" src="{{ Storage::url('covers/' . $book->cover) }}" /></a>
                <div class="post-detail">
                    <div class="books-social-sharing">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="optional-links">
                        <ul>
                            <li>
                                <a href="#" target="_blank" data-toggle="blog-tags" data-placement="top" title="Add TO CART">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" data-toggle="blog-tags" data-placement="top" title="Like">
                                    <i class="fa fa-heart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank" data-toggle="blog-tags" data-placement="top" title="Mail"><i class="fa fa-envelope"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank" data-toggle="blog-tags" data-placement="top" title="Search">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank" data-toggle="blog-tags" data-placement="top" title="Print">
                                <i class="fa fa-print"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <header class="entry-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="entry-title">
                                <a href="{{ route('showBook', $book->id) }}">{{ $book->title }}</a>
                            </h3>
                            <ul>
                                <li><strong>Author:</strong>{{ $book->author }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul>
                                <li><strong>Edition:</strong> First editio</li>
                                <li><strong>Local Availability:</strong> 0 (of 1)</li>
                                <li>
                                    <div class="rating">
                                        <strong>Rating: {{ $book->rating ? $book->rating : 'no set' }}</strong>
                                        <span>☆</span>
                                        <span>☆</span>
                                        <span>☆</span>
                                        <span>☆</span>
                                        <span>☆</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
                <div class="entry-content">
                    <p>{{ $book->description }}</p>
                </div>
                <footer class="entry-footer">
                    <a class="btn btn-dark-gray" href="{{ route('showBook', $book->id) }}">Read More</a>
                </footer>
            </div>
            <div class="clear"></div>
        </div>
        </article>
        </div>
        </div>
        </div>
        <!-- Start: Footer -->
        @include('layouts.footer')
        <!-- End: Footer -->
        
        @include('layouts.js')
        
    </body>


</html>