<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function show(Request $request): View
    {
        $books = Book::query();
        $sort = $request->query('sort_by');

        switch ($sort) {
            case 'name':
                $books = $books->orderBy('name', 'asc')->paginate(10);
                break;
            case 'date':
                $books = $books->orderBy('created_at', 'asc')->paginate(10);
                break;
            default:
                $books = $books->paginate(10);
        }

        return view('dashboard.book.books', ['books' => $books]);
    }

    public function save(BookRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();
        $file = $validated['image'];
        $book = new Book();

        if (isset($file)) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/books', $filename, 'public');
            $book->image = $path;
        }

        $book->name = $validated['name'];
        $book->author = $validated['author'];
        $book->available = $validated['available'];
        $book->price = $validated['price'];
        $book->pages = $validated['pages'];
        $book->description = $validated['description'];
        $book->image = $path;

        $user->books()->save($book);
        $tags = [];
        $cates = [];

        $rtags = json_decode($request->get('tags'));
        $rcats = json_decode($request->get('cats'));

        if (isset($rtags)) {
            foreach ($rtags as $tag) {
                $tag_id = Tag::where('name', '=', $tag->value)->first()->id;
                array_push($tags, $tag_id);
            }
        }
        
        if (isset($rcats)) {
            foreach ($rcats as $cat) {
                $cat_id = Category::where('name', '=', $cat->value)->first()->id;
                array_push($cates, $cat_id);
            }
        }

        $book->tags()->attach($tags);
        $book->categories()->attach($cates);

        return to_route('books');
    }

    public function create(): View
    {
        return view('dashboard.book.create');
    }

    public function edit($id): View
    {
        $book = Book::find($id);
        return view('dashboard.book.edit', ['book' => $book]);
    }

    public function editBook(BookRequest $request, $id)
    {
        $validated = $request->validated();
        $book = Book::find($id);

        $file = isset($validated['image']) ? $validated['image'] : null;
        if (isset($file)) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/books', $filename, 'public');
            $book->image = $path;
        }

        $book->name = $validated['name'];
        $book->author = $validated['author'];
        $book->available = $validated['available'];
        $book->price = $validated['price'];
        $book->pages = $validated['pages'];
        $book->description = $validated['description'];

        $book->update();
        return to_route('books');
    }

    public function updateStatus($id): array
    {
        $book = Book::find($id);

        $book->update([
            'status' => $book->status ? 0 : 1
        ]);

        return ['message' => 'وضعیت کتاب باموفقیت تغییریافت'];
    }

    public function delete($id): array
    {
        $book = Book::where('id', '=', $id)->first();
        $book->delete();

        return ['id' => $id];
    }

    public function search(Request $request): array
    {
        $sbooks = Book::where('name', 'like', $request->get('name') . '%')->get();
        return ['books' => $sbooks, 'editLink' => route('books.edit', '')];
    }
}

