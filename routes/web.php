<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserBookController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $books = Book::all();
    return view('index', ['books' => $books]);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:MANAGER'])->group(function () {
    Route::get('/users', [UserController::class, 'show'])->name('users');
    Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users', [UserController::class, 'info'])->name('users.info');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/update-role', [UserController::class, 'updateRole'])->name('users.update_role');
    Route::get('/users/{id}', [UserController::class, 'updateStatus'])->name('users.update_status');
    Route::post('/users/search', [UserController::class, 'search'])->name('users.search');
});

Route::middleware(['auth', 'verified', 'role:MANAGER|ADMIN'])->group(function () {
    Route::get('/books', [BookController::class, 'show'])->name('books');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/create', [BookController::class, 'save'])->name('books.save');
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/edit/{id}', [BookController::class, 'editBook'])->name('books.editBook');
    Route::delete('/books/delete/{id}', [BookController::class, 'delete'])->name('books.delete');
    Route::get('/books/updateStatus/{id}', [BookController::class, 'updateStatus'])->name('books.updateStatus');
    Route::post('/books/search', [BookController::class, 'search'])->name('books.search');

    Route::get('/tag_category', function (Request $request): \Illuminate\View\View {
        $cates = Category::query();
        $tags = Tag::query();

        $sortCats = $request->query('sort_cates');

        switch ($sortCats) {
            case 'name':
                $cates = $cates->orderBy('name', 'asc')->paginate(10);
                break;
            case 'date':
                $cates = $cates->orderBy('created_at', 'asc')->paginate(10);
                break;
            default:
                $cates = $cates->paginate(10);
        }

        $sortTags = $request->query('sort_tags');

        switch ($sortTags) {
            case 'name':
                $tags = $tags->orderBy('name', 'asc')->paginate(10);
                break;
            case 'date':
                $tags = $tags->orderBy('created_at', 'asc')->paginate(10);
                break;
            default:
                $tags = $tags->paginate(10);
        }

        return view('dashboard.tag_category', ['cates' => $cates, 'tags' => $tags]);
    })->name('tag_category');

    Route::post('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::get('/tags/getTags', [TagController::class, 'getTags'])->name('tags.get_tags');
    Route::get('/tags/updateStatus/{id}', [TagController::class, 'updateStatus'])->name('tags.updateStatus');
    Route::get('/tags/getInfo/{id}', [TagController::class, 'getInfo'])->name('tags.getInfo');
    Route::post('/tags/update', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/delete/{id}', [TagController::class, 'delete'])->name('tags.delete');
    Route::post('/tags/search', [TagController::class, 'search'])->name('tags.search');

    Route::post('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/getCates', [CategoryController::class, 'getCates'])->name('categories.getCates');
    Route::get('/categories/updateStatus/{id}', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');
    Route::get('/categories/getInfo/{id}', [CategoryController::class, 'getInfo'])->name('categories.getInfo');
    Route::post('/categories/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::post('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
});

Route::middleware(['auth', 'verified', 'role:USER'])->group(function () {
    Route::get('/cart/create/{id}', [UserBookController::class, 'create'])->name('cart.create');
    Route::get('/cart', [UserBookController::class, 'show'])->name('cart');
    Route::post('/cart/update', [UserBookController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [UserBookController::class, 'delete'])->name('cart.delete');
    Route::put('/cart/paid/{id}', [UserBookController::class, 'paid'])->name('cart.paid');
    Route::get('/paids', [UserBookController::class, 'paids'])->name('paids');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
