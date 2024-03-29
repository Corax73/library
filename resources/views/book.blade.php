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
                <a href="{{ route('showBook', ['id' => $book->id, 'slug' => $book->slug]) }}"><img alt="Book" src="{{ Storage::url('covers/' . $book->cover) }}" /></a>
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
                                <a href="{{ route('showBook', ['id' => $book->id, 'slug' => $book->slug]) }}">{{ $book->title }}</a>
                            </h3>
                            <ul>
                                <li><strong>Author:</strong>{{ $book->author }}</li>
                                <li><strong>Category:</strong>{{ $book->category?->title }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul>
                                <li><strong>Edition:</strong> First editio</li>
                                <li><strong>Local Availability:</strong> 0 (of 1)</li>
                                <li>
                                <div class="rating-area">
                                                                    <strong>Rating: {{ $book->rating ? $book->rating : 'no set' }}</strong>
                                                                    <form id="rating" action="{{ route('setRating', $book->id) }}" method="post">
                                                                    @csrf
                                                                        <input type="radio" name="rating" value="1">
                                                                        <label for="star-1" title="Оценка «1»">1☆</label>
                                                                        <input type="radio" name="rating" value="2">
                                                                        <label for="star-2" title="Оценка «2»">2☆</label>
                                                                        <input type="radio" name="rating" value="3">
                                                                        <label for="star-3" title="Оценка «3»">3☆</label>
                                                                        <input type="radio" name="rating" value="4">
                                                                        <label for="star-4" title="Оценка «4»">4☆</label>
                                                                        <input type="radio" name="rating" value="5">
                                                                        <label for="star-5" title="Оценка «5»">5☆</label>
                                                                        <input type="submit" id="btnRating" name="Submit" value="Submit" class="submit_btn"/>
                                                                    </form>
                                                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
                <div class="entry-content">
                    <p class="post">{{ $book->description }}</p>
                </div>
                <footer class="entry-footer">
                    <a class="btn btn-dark-gray" href="{{ route('showBook', ['id' => $book->id, 'slug' => $book->slug]) }}">Read More</a>
                </footer>
            </div>
            <div class="clear"></div>
            <div class="row">
            <div class="col-sm-6">
            <div id="comment_form">
                    <h3>Leave a comment</h3>
                    <form action="{{ route('createComment', ['id' => $book->id, 'slug' => $book->slug]) }}" method="post">
                      @csrf
                        <div class="form_row">
                            <label><strong>Name</strong> (required)</label>
           					<br />
                            <input type="text" name="author" />
                        </div>
                        @if ($errors->has('author'))
                        <span class="text-danger">{{ $errors->first('author') }}</span>
                        @endif
                        <div class="form_row">
                            <label><strong>Comment</strong></label>
           					<br />
                            <textarea  name="text" rows="" cols=""></textarea>
                        </div>
                        @if ($errors->has('text'))
                        <span class="text-danger">{{ $errors->first('text') }}</span>
                        @endif
                        <input type="submit" name="Submit" value="Submit" class="submit_btn" />
                    </form>
                 </div>   
                </div>
                </div>
                <div class="col-sm-6">
                @if ($comments)
                <div id="comment_section">
                    <ol class="comments first_level">
                        @foreach($comments as $comment)
                        <li>
                            <div class="comment_box">
                                <div class="comment_text">
                                    <div class="comment_author">{{ $comment->author }}</div>
                                    <p>{{ $comment->created_at }}</p>
                                    <p class="post">{{ $comment->text }}</p>
                                </div>
                                <div class="cleaner"></div>
                            </div>
                        </li>                     
                        @endforeach
                    </ol>
                </div>
            @endif
        </div>
    </div>
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