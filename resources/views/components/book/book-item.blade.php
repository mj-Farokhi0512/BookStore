{{--<div class="swiper-slide">--}}
<div class="col-md-6 col-lg-4 col-xl-3 mb-5">
    <div
        class="books-card style-1 wow fadeInUp"
        data-wow-delay="0.1s"
    >
        <div class="dz-media">
            <img src="{{$book->image ? asset('storage/'.$book->image) : asset('images/book-placeholder.jpg')}}"
                 alt="book" class="book-item"/>
        </div>
        <div class="dz-content">
            <h4 class="title">{{$book->name}}</h4>
            <p class="title">{{$book->author}}</p>
            <span class="price">{{$book->price}} تومان</span>
            @role('MANAGER|ADMIN')
            @else
                <div>
                    <button data-id="{{ $book->id }}" class="btn btn-secondary btnhover btnhover2 book-order">
                        <i class="flaticon-shopping-cart-1 m-r10"></i>
                        افزودن به سبد‌خرید
                    </button>
                    <i class="fa-regular fa-heart float-end fs-5 py-3 me-3"></i>
                </div>
                @endrole
        </div>
    </div>
</div>
