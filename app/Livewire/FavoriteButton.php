<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class FavoriteButton extends Component
{
    public $bookId;
    public $isFavorite;
    public $favoriteCount;
    public $isProcessing = false;
    public $book; // Declare the book as a public property

    public function mount($bookId, $isFavorite)
    {
        $this->bookId = $bookId;
        $this->isFavorite = $isFavorite;

        // Fetch the book once and store it as a public property
        $this->book = Book::find($this->bookId);
        $this->favoriteCount = $this->book->favoritedByUsers()->count();
    }

    public function toggleFavorite()
    {
        $this->isProcessing = true;

        // Now you can directly use the $this->book property
        if ($this->isFavorite) {
            $this->book->favoritedByUsers()->detach(Auth::user());
        } else {
            $this->book->favoritedByUsers()->attach(Auth::user());
        }

        // Update favorite status
        $this->isFavorite = !$this->isFavorite;

        // Recalculate the favorite count dynamically to ensure it's accurate
        $this->favoriteCount = $this->book->favoritedByUsers()->count();

        $this->isProcessing = false;
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}
