<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-block;
            text-align: center;
            line-height: 30px;
            color: white;
            font-weight: bold;
        }
        .avatar-jd { background-color: #c3e6cb; color: #155724; }
        .avatar-g { background-color: #d6d8db; color: #383d41; }
        .avatar-dd { background-color: #f5c6cb; color: #721c24; }
        .avatar-a { background-color: #f8d7da; color: #721c24; }
        .badge-verified { color: red; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <select class="form-control mr-2" style="width: auto;">
                    <option>10</option>
                    <option>20</option>
                    <option>30</option>
                </select>
                <input type="text" class="form-control" placeholder="Search..">
            </div>
            <!-- <button class="btn btn-primary">Export</button> -->
            <a href="../menu" class="btn btn-primary ml-2">Create New Post</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <!-- <th>User</th> -->
                    <th>Title</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <!-- <td>
                        <div class="user-avatar avatar-g">G</div>
                        {{ $username }}
                    </td> -->
                    <td>{{ $post->title }}</td>
                    <td><i class="">{{ $post->created_at }}</i></td>
                    <td><i>{{ $post->updated_at }}</i></td>
                    <td class="flex flex-col">
                        <form action="/blog/edit/menu/{{ $post->id }}" method="GET" class="d-inline">
                            <button class="btn btn-sm btn-outline-primary">✎</button>
                        </form>
                        <form action="/blog/{{ $post->id }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">🗑</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    if (confirm('Apakah anda ingin menghapus postingan ini?')) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
