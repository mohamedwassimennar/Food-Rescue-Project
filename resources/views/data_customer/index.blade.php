@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5 card card-body">
        <div class="container mt-4">
            <h2>List of Users</h2>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone number</th>
                        <th>Date of birth</th>
                        <th>Email </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @for($index = 0; $index < count($data_customer); $index++) @php $user=$data_customer[$index];
                        @endphp @if($user->role === 'customer')
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->no_hp }}</td>
                            <td>{{ $user->tanggal_lahir }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('data_customer.destroy', $user->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete ?')">DELETE</button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection