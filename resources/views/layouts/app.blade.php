<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Custom Styles -->
    @stack('style')

</head>

<body>
    @include('layouts.navigation')

    <!-- Content Area -->
    <div id="content">
        <div class="conatiner p-3">
            @yield('content')
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>



    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // Function to show SweetAlert Toast
        function showToast(type, message) {
            Swal.fire({
                toast: true,
                icon: type,
                title: message,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }

        $(document).ready(function() {
            $('.sidebarToggle').on('click', function() {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('full-width');
            });
        });

        // Display success or error messages
        @if (session('success'))
            showToast('success', '{{ session('success') }}');
        @elseif (session('error'))
            showToast('error', '{{ session('error') }}');
        @endif

        document.addEventListener('livewire:init', () => {
            let cleanup = Livewire.on('showToast', (event) => {
                showToast(event[0], event[1]);
            });
        });
    </script>

    <!-- Custom Scripts -->
    @stack('script')
</body>

</html>
