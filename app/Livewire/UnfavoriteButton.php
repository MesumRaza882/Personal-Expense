<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class UnfavoriteButton extends Component
{
    public $bookId;


    public function mount($bookId)
    {
        $this->bookId = $bookId;
    }

    public function toggleFavorite()
    {
        $book = Book::find($this->bookId);
        $book->favoritedByUsers()->detach(Auth::user());

        // Dispatch browser event in Livewire 3.5 to remove the book's row
        $this->dispatch('bookUnfavorited', bookId: $this->bookId);
    }

    public function render()
    {
        return view('livewire.unfavorite-button');
    }
}
