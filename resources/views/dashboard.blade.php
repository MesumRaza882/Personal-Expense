@extends('layouts.app')

@section('content')
    <!-- Books Section -->
    {{-- <x-search-bar-component route="dashboard" /> --}}
    <livewire:books-dashboard />


    {{-- <div class="row">
        @forelse ($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <!-- Display cover image if available -->
                    <img src="{{ $book->coverImage ? $book->coverImage->url : 'https://via.placeholder.com/150' }}"
                        class="card-img-top" alt="{{ $book->name }}" style="height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $book->name }}</h5>
                        <p class="card-text text-muted">by {{ $book->author }}</p>
                        <p class="card-text">{{ $book->description }}</p>
                    </div>

                    <div class="card-footer pb-1 d-flex justify-content-between align-items-center">
                        <a href="{{ route('bookDetail', ['id' => $book->id]) }}" class="btn btn-outline-dark">Read
                            More</a>
                        <!-- Livewire Favorite Button Component -->
                        <livewire:favorite-button :bookId="$book->id" :isFavorite="auth()
                            ->user()
                            ->favoriteBooks->contains($book->id)" :wire:key="'favorite-' . $book->id" />
                    </div>
                </div>
            </div>

        @empty

            <div class="alert alert-warning">
                No record available.
            </div>
        @endforelse
    </div> --}}
@endsection


@push('script')
    <script>
        document.addEventListener('scroll', function() {
            let bottomOfWindow = window.innerHeight + window.scrollY >= document.body.offsetHeight;
            if (bottomOfWindow) {
                Livewire.dispatch('loadMore');

                // Livewire.hook('message.processed', () => {
                //     Livewire.rescan();
                // });
            }
        });
    </script>
@endpush
