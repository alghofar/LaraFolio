@section('title', 'Profile of ' . $user->fullName . trans('main.website.separator') . trans('main.website.title'))

@section('content')
    <div class="row">
        <h1>Profile of {{ $user->fullName }}</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Group</th>
                        <th>Suspended?</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="{{ $user->avatar }}" class="img-rounded avatar"></td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->fullName }}</td>
                        <td>{{ $user->location }}</td>
                        <td>{{ $user->description }}</td>
                        <td>{{ $user->group }}</td>
                        <td>{{ $user->suspended }}</td>
                        <td>{{ $user->createdAt }}</td>
                     </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
