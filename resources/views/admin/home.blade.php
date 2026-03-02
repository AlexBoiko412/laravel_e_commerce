@extends("layouts.admin")

@section('title', 'Admin')

@section('content')
    <div id="admin-gate" style="display: none;">
        <h1>Адмін</h1>
    </div>

    <div id="access-denied" style="display: none;" class="text-center">
        <h2>403 Access denied</h2>
        <p>Ви не маєте прав на перегляд</p>
    </div>
@endsection
