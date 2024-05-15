<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ config('app.name') }} @if (isset($pageTitle))
      &mdash; {{ $pageTitle }}
    @endif
  </title>
  <link rel="shortcut icon" href="https://dinsos.jatimprov.go.id/web/public/jatim.ico" />

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  @stack('css-libraries')

  <!-- Template -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  {{-- <link rel="stylesheet" href="{{ asset('/build/assets/app-4ef9e656.css') }}">
  <script src="{{ asset('/build/assets/app-5bf375eb.js') }}"></script> --}}


</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <x-navbar />
      <div class="main-sidebar sidebar-style-2">
        <x-sidebar />
      </div>

      <div class="main-content">
        @yield('content')
      </div>

      <x-footer />
    </div>
  </div>

  @routes
  <!-- General JS Scripts -->

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- JS Libraries -->
  @stack('js-libraries')
  @stack('script')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js"></script>


  @if (@session('success') || $errors->any())
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      @if (@session('success'))
        Toast.fire({
          icon: 'success',
          title: '{{ @session('success') }}'
        })
      @endif

      @if ($errors->any())
        Toast.fire({
          icon: 'error',
          title: '{{ @session('error') ?? 'Gagal Melakukan Aksi' }}'
        })
      @endif
    </script>
  @endif

  <script src="{{ asset('/js/scripts.js') }}"></script>


  <!-- Template JS File -->
</body>

</html>
