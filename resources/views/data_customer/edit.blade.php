@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5">
        <div class="container mt-5 card card-body">
            <h1>Edit User</h1>

            <form action="{{ route('data_customer.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        required>
                </div>


                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</main>
@endsection