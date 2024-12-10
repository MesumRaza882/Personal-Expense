@extends('layouts.app')

@push('style')
    <style>
        .book-image {
            height: 60px;
            width: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .table td,
        .table th {
            vertical-align: middle;
            text-align: center;
        }

        .description {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
@endpush

@section('content')
    <x-search-bar-component route="favourite" placeholder="Search your favorite books..." />

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Book</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="favoriteBooksTable">
                @forelse ($books as $book)
                    <tr wire:key="book-{{ $book->id }}" id="book-row-{{ $book->id }}">
                        <td><img src="{{ $book->coverImage ? $book->coverImage->url : 'https://via.placeholder.com/150' }}"
                                alt="Book Image" class="book-image img-thumbnail"></td>
                        <td>
                            <div><strong>{{ $book->name }}</strong></div>
                            <div class="description">{{ $book->description }}</div>
                        </td>
                        <td>{{ $book->author }}</td>
                        <td>
                            <div class="btn-group gap-2">
                                <a class="btn btn-sm btn-outline-dark"
                                    href="{{ route('bookDetail', ['id' => $book->id]) }}">
                                    View
                                </a>
                                <livewire:unfavorite-button :bookId="$book->id" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-warning m-0">
                                No record available.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('script')
    <script>
        window.addEventListener('bookUnfavorited', (event) => {
            console.log("Event received for book ID:", event.detail.bookId);
            const row = document.getElementById(`book-row-${event.detail.bookId}`);
            if (row) {
                console.log("Row found and removed:", row);
                row.remove();
            } else {
                console.log("Row not found for book ID:", event.detail.bookId);
            }
        });
    </script>
@endpush
