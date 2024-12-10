<div>
    <!-- Search Input -->
    <input type="text" class="form-control mb-4" placeholder="Search books..." wire:model.live="search">

    
    <!-- Books List -->
    <div class="row">
        @forelse ($books as $book)
            <div class="col-md-4 mb-4" wire:key="book-{{ $book->id }}">
                <div class="card h-100">
                    <!-- Display book cover -->
                    <img src="{{ $book->coverImage ? $book->coverImage->url : 'https://via.placeholder.com/150' }}"
                         class="card-img-top" alt="{{ $book->name }}" style="height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $book->name }}</h5>
                        <p class="card-text text-muted">by {{ $book->author }}</p>
                        <p class="card-text">{{ $book->description }}</p>
                    </div>

                    <div class="card-footer pb-1 d-flex justify-content-between align-items-center">
                        <a wire:navigate.hover href="{{ route('bookDetail', ['id' => $book->id]) }}" class="btn btn-outline-dark">Read More</a>
                        <livewire:favorite-button :wire:key="'favorite-button-' . $book->id" :bookId="$book->id" :isFavorite="auth()->user()->favoriteBooks->contains($book->id)" />
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">
                No books found.
            </div>
        @endforelse
    </div>

    <!-- Load More Button -->
    @if ($books->hasMorePages())
        <div class="d-flex justify-content-center mt-4">
            <button wire:click="loadMore" class="btn btn-primary">
                Load More
            </button>
        </div>
    @endif
</div>
