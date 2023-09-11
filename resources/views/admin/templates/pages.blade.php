<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <title>@yield('title')</title>
    <!-- CSS files -->
    <link href="{{ asset('admin/tabler/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/tabler/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/tabler/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/tabler/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/tabler/dist/css/demo.min.css?1684106062') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/jquery-plugin-for-animated-stackable-toast-messages-toast/dist/jquery.toast.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    @stack('stylesheets')
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
      ::-webkit-resizer{
        display: none;
      }
    </style>
  </head>
  <body >
    <script src="{{ asset('admin/tabler/dist/js/demo-theme.min.js?1684106062') }}"></script>
    <div class="page">
      <!-- Sidebar -->
      @include('admin.templates.subtemplates.sidebar')
      <!-- Navbar -->
      @include('admin.templates.subtemplates.header')
      <div class="page-wrapper">
        
        @yield('content')

        @include('admin.templates.subtemplates.footer')
      </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('admin/tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('admin/tabler/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('admin/tabler/dist/libs/jsvectormap/dist/maps/world.js?1684106062') }}" defer></script>
    <script src="{{ asset('admin/tabler/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062') }}" defer></script>
    <!-- Tabler Core -->
    <script src="{{ asset('admin/tabler/dist/js/tabler.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('admin/tabler/dist/js/demo.min.js?1684106062') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/jquery-plugin-for-animated-stackable-toast-messages-toast/dist/jquery.toast.min.js') }}" defer></script>
    <script src="{{ asset('admin/jquery-plugin-for-animated-stackable-toast-messages-toast/src/jquery.toast.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @stack('scripts')

    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function(){
        @if (session('success'))
          $.toast({
            text: "{{ session('success') }}",
            position: "top-right",
            bgColor:'#2fb344',
            hideAfter : 5000,
            allowToastClose : false,
          });
        @endif
      });
    </script>

    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function(){
        @if (session('error'))
          $.toast({
            text: "{{ session('error') }}",
            position: "top-right",
            bgColor:'#d63939',
            hideAfter : 5000,
            allowToastClose : false,
          });
        @endif
      });
    </script>
    
    <script type="text/javascript">
      $('.delete').click(function(){
        Swal.fire({
          title: "Are you sure?",
          text: "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus amet dolore ex saepe, incidunt accusamus distinctio voluptatum esse recusandae. Beatae dicta tempora culpa libero suscipit quam vero ad, corporis soluta.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it",
          closeOnConfirm: false
        }).then((result) => {
          if(result.isConfirmed){
            Swal.fire({
              title: "Are you sure?",
            text: "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus amet dolore ex saepe, incidunt accusamus distinctio voluptatum esse recusandae. Beatae dicta tempora culpa libero suscipit quam vero ad, corporis soluta.",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it",
            }).then((result) => {
              if(result.isConfirmed){
                $(this).closest("form").submit();
                Swal.fire(
                  'Deleted',
                  'You have successfully deleted',
                  'success',
                );
              }
            });
          }else if(result.dismiss === Swal.DismissReason.cancel){
            Swal.fire('Cancelled', 'Your action has been cancelled.', 'error');
          }
        });
      });
    </script>

  </body>
</html>