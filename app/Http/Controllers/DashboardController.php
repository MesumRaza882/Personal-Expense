<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $search = $request->input('search');

        // $books = $this->getBooks($search);

        return view('dashboard');
    }

    public function bookDetail($id)
    {
        // Fetch the book details by ID (or you could use a slug for SEO-friendly URLs)
        $book = Book::where('id', $id)->with(['coverImage', 'images'])->first();

        // Pass the book data to the view
        return view('book_detail', compact('book'));
    }
    public function favourite_books(Request $request)
    {
        $search = $request->input('search');

        // Call the generalized function to get only favorite books
        $books = $this->getBooks($search, true);

        return view('favourite_books', compact('books'));
    }

    private function getBooks($search = null, $favoritesOnly = false)
    {
        $query = Book::with(['coverImage'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereif('name', 'LIKE',  $search)
                        ->orWhereif('description', 'LIKE',  $search);
                });
            });

        // Filter by favorites if requested
        if ($favoritesOnly) {
            $query->whereHas('favoritedByUsers', function ($q) {
                $q->where('user_id', Auth::id());
            })->withCount('favoritedByUsers');
        }

        return $query->get();
    }
}
