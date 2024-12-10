@extends('layouts.app')

@section('content')

    <x-search-bar-component route="dashboard" />

    <div class="row">
        <!-- Book Cover Image and Details -->
        <div class="col-md-6">
            <!-- Cover Image -->
            <img src="{{ $book->coverImage ? $book->coverImage->url : 'https://via.placeholder.com/150' }}"
                style="height: 400px; width:100%;" class="img-fluid mb-4" alt="Cover Image">
        </div>

        <!-- Book Details -->
        <div class="col-md-6">
            <h3 class="book-title">{{ $book->name }}</h3>
            <p class="text-muted">by {{ $book->author }}</p>
            <div class="mb-3">
                <i
                    class="{{ auth()->user()->favoriteBooks->contains($book->id)? 'fa-solid fa-heart': 'fa-regular fa-heart' }}"></i>
                <span class="text-muted">{{ $book->likes }} Favorites</span>
            </div>
            <p class="book-description">{{ $book->description }}</p>
            <p><strong>Published:</strong> {{ $book->created_at->format('F j, Y') }}</p>
            <button class="btn btn-outline-dark mt-3"><i class="fas fa-bookmark"></i> Add to Favorites</button>
        </div>

        <!-- Scrollable Image Gallery -->
        @if ($book->images->isNotEmpty())
            <div class="col-md-12 mt-4">
                <div style="display: flex; overflow-x: auto; gap: 1rem;">
                    @foreach ($book->images as $image)
                        <div style="flex: 0 0 auto;">
                            <img src="{{ $image->url }}" alt="Book Image" class="img-fluid"
                                onclick="openModal('{{ $image->url }}')"
                                style="height: 200px; max-width: 100%; cursor: pointer;">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Modal for Full Image View -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img id="modalImage" src="" alt="Full Book Image" class="w-100">
                </div>
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
            myModal.show();
        }
    </script>
@endpush
