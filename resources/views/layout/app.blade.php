
<!DOCTYPE html>
<html lang="vi">

@include('partials.head')

<body class="bg-surface font-body-md text-on-surface antialiased">

    @include('partials.sidebar')

    <div class="pl-72">

        @include('partials.header')

        <main class="w-full pt-20 bg-surface">
            @yield('content')
        </main>

    </div>

    @include('components.notification-toast')

</body>
</html>
