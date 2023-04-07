@extends('layouts.app')

@section('content')
    <section class="content-inner-1 bg-grey reccomend">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3 text-center">
                    <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/book-placeholder.jpg') }}"
                        alt="Book Image" class="rounded">
                </div>
                <div class="col-md-8 col-lg-9">
                    <h3>{{ $book->name }}</h3>
                    <h5>{{ $book->author }}</h5>
                    <p>{{ $book->description }}</p>
                    <div><span>قیمت: {{ $book->price }} تومان</span><br /><span>تغداد صفحات: {{ $book->pages }}</span>
                    </div>
                    <div class="d-flex flex-row-reverse justify-content-end py-2">
                        <i class="fa-regular fa-bookmark float-end fs-5 py-3 me-3 bookmark-btn"></i>

                        <button data-id="{{ $book->id }}" class="btn btn-secondary btnhover btnhover2 book-order">
                            <i class="flaticon-shopping-cart-1 m-r10"></i>
                            افزودن به سبد‌خرید
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/order-controller.js') }}"></script>
@endpush
