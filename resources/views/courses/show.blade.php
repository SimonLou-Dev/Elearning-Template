@extends('layouts.app')

@section('content')

<section class="blog-hero-section set-bg pb-5" data-setbg="https://blog.hyperiondev.com/wp-content/uploads/2019/02/Blog-Types-of-Web-Dev.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bh-text">
                    <h2>{{$course->title}}</h2>
                    <ul>
                        <li><span>Par <strong>{{$course->user->name}}</strong></span></li>
                        <li>{{date('d/m/Y', strtotime($course->created_at))}}</li>
                        <li>Mis à jour le {{date('d/m/Y', strtotime($course->updated_at))}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-details-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="bd-text">
                    <div class="bd-title text-center">
                        <h3>{{$course->title}}</h3>
                        <div class="bd-tag-share">
                            <div class="tag d-flex justify-content-center">
                                <a href="#">{{$course->category->name}}</a>
                            </div>
                        </div>
                        <h4 class="my-5">{{$course->subtitle}}</h4>
                    </div>
                    <div class="bd-more-text">
                        <p>{{$course->description}}</p>
                    </div>
                    <div class="bd-more-pic">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="/storage/courses/{{$course->user_id}}/{{$course->image}}" alt="Course img">
                            </div>
                            <div class="col-md-6">
                                    <div class="price-item top-rated">
                                        <div class="tr-tag">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="pi-price mt-5">
                                            <h2><span>€</span>{{$course->price}}</h2>
                                        </div>
                                        <a href="#" class="price-btn">M'inscrire <i class="fas fa-arrow-right"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>


<section class="related-post-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Ces cours peuvent vous intéresser</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($recommendations as $recommendation)
            <div class="col-md-4">
                <div class="blog-item set-bg" data-setbg="/storage/courses/{{$recommendation->user_id}}/{{$recommendation->image}}">
                    <div class="bi-tag bg-gradient">{{$recommendation->category->name}}</div>
                    <div class="bi-text">
                        <h5><a href="#">{{$recommendation->title}}</a></h5>
                        <span><i class="fa fa-clock-o"></i>{{date('d/m/Y', strtotime($recommendation->created_at))}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection