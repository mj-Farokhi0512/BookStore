<!--Recommend Section Start-->
<section class="content-inner-1 bg-grey reccomend">
    <div class="container">
        <div class="section-head text-center">
            <h2 class="title">لیست کتاب ها</h2>
        </div>
        <div class="container">
            <div class="row">
                @foreach($books as $book)
                    <x-book.book-item :book="$book"/>
                @endforeach
            </div>
        </div>
    </div>
</section>
