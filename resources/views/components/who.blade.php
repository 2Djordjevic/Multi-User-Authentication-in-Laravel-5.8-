@if (Auth::guard('web')->check())

    <p class="text-success">
        You are logged in as USER!
    </p>

@else

    <p class="text-danger">
        You are logged out as USER!.
    </p>

@endif

@if (Auth::guard('admin')->check())

    <p class="text-success">
        You are logged in as ADMIN!
    </p>

@else

    <p class="text-danger">
        You are logged out as ADMIN!.
    </p>

@endif