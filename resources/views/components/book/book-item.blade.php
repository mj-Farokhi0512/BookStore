{{-- <div class="swiper-slide"> --}}
<div class="col-md-6 col-lg-4 col-xl-3 mb-5">
    <div class="books-card style-1 wow fadeInUp" data-wow-delay="0.1s">
        <a href="{{ route('books.detail', $book->id) }}">
            <div class="dz-media">
                <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/book-placeholder.jpg') }}"
                    alt="book" class="book-item" />
            </div>
        </a>
        <div class="dz-content">
            <a href="{{ route('books.detail', $book->id) }}">
                <h4 class="title">{{ $book->name }}</h4>
                <p class="title">{{ $book->author }}</p>
                <span class="price">{{ $book->price }} تومان</span>
            </a>
            @role('MANAGER|ADMIN')
            @else
                <div data-id="{{ $book->id }}">
                    <button class="btn btn-secondary btnhover btnhover2 book-order">
                        <i class="flaticon-shopping-cart-1 m-r10"></i>
                        افزودن به سبد‌خرید
                    </button>
                    <i
                        class="{{ isset(auth()->user()->id) && $book->user_id == auth()->user()->id ? 'fa-solid' : 'fa-regular' }} fa-bookmark float-end fs-5 py-3 me-3 bookmark-btn"></i>
                </div>
            @endrole
        </div>

    </div>
</div>
