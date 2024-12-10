@extends('layouts.app')

@section('content')
    <livewire:category.category-list />
@endsection


@push('script')
    <script>
        // document.addEventListener('livewire:initialized', () => {
        //     Livewire.on('categoryDeleted', (categoryId) => {
        //         // Find the row with the specific category ID
        //         const row = document.querySelector(`#category-row-${categoryId}`);
        //         if (row) {
        //             row.remove();
        //         }
        //     });
        // });

        function confirmDelete(categoryId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('delete-category', {
                        categoryId
                    });
                }
            });
        }
    </script>
@endpush
