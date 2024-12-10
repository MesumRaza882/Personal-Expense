<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;
use Livewire\Attributes\On;


class BooksDashboard extends Component
{
    use WithPagination;

    public $search;  // Search input value
    public $perPage = 3;  // Number of books per load
    protected $queryString = ['search'];  // Keep search query in the URL

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('loadMore')]
    public function loadMore()
    {
        // Increase the number of items to load
        $this->perPage += 3;
    }


    public function render()
    {
        $books = Book::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $this->search . '%');
            })
            ->with('coverImage')  // Eager load relationships if required
            ->paginate($this->perPage);

        return view('livewire.books-dashboard', compact('books'));
    }
}
