@extends('welcome')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">All Books List</h1>
            <div class="container">
                <div class="row">
                    <!-- Column for Add New and Bulk Delete buttons -->
                    <div class="col-md-8">
                        <a class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="bi bi-plus-circle"></i> Add
                        </a>
                        <button id="bulk-delete" class="btn btn-danger" onclick="bulkDelete()">
                            <i class="bi bi-trash"></i> Delete All
                        </button>
                        <a href="{{ route('books.export') }}" class="btn btn-primary">
                            <i class="bi bi-file-earmark-arrow-down"></i> Export
                        </a>

                    </div>


                    <!-- Column for Import Books form -->
                    <div class="col-md-4">
                        <div class="row">
                            <!-- <div class="col-md-3">
                                <h6 class="mb-3">
                                    <i class="bi bi-file-earmark-arrow-up"></i> Import Books
                                </h6>
                            </div> -->
                            <!-- <div class="col-md-6"> -->
                            <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                                @csrf

                                <div class="mb-3 d-flex flex-column flex-sm-row w-100">
                                    
                                    <div class="input-group">
                                        <label class="input-group-text mb-4" for="file">
                                            <i class="bi bi-upload"></i>
                                        </label>
                                        <input type="file" id="file" class="form-control me-2 mb-4" name="file"  accept=".csv" required>
                                    </div>
                                    <button type="submit" class="btn btn-success mb-4">
                                        Import
                                    </button>
                                </div>

                            </form>
                            <!-- </div> -->
                        </div>

                    </div>
                </div>
            </div>


            <table class="table table-bordered table-striped">
                <tr>
                    <th><input type="checkbox" id="select-all"></th> <!-- Select all checkbox -->
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Published Date</th>
                    <th>View</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                @foreach ($data as $id => $book)
                <tr>
                    <td><input type="checkbox" class="select-item" value="{{ $book->id }}"></td> <!-- Checkbox for each item -->
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->description }}</td>
                    <td>{{ $book->published_date }}</td>
                    <td><button type="button" class="btn btn-primary"
                            onclick="updateData({{ $book->id }},'view')">View</button></td>
                    <td><button type="button" class="btn btn-primary"
                            onclick="updateData({{ $book->id }},'update')">update</button>
                    </td>
                    <td>
                        <!-- Delete Form -->
                        <form action="{{ route('delete.user', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="text-center mt-5">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Books</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-10">
                            <h3>Add New Book Details</h3>
                            <form method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">title :</label>
                                    <input type="text" class="form-control" name="title" id="title">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">author :</label>
                                    <input type="text" id="author" class="form-control" name="author"
                                        id="author">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">description :</label>
                                    <input type="text" id="description" class="form-control" name="description"
                                        id="description">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="create()" class="btn btn-success">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateModalLabel">Books</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">

                        <div class="col-10">
                            <h3>Existing Book Details</h3>
                            <form method="POST">
                                @csrf
                                <input type="hidden" id="id">
                                <div class="mb-3">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <label class="form-label">title :</label>
                                    <input type="text" class="form-control" name="utitle" id="utitle">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">author :</label>
                                    <input type="text" id="uauthor" class="form-control" name="uauthor">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">description :</label>
                                    <input type="text" id="udescription" class="form-control" name="udescription">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="updatebtn" onclick="update()" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Select all checkboxes functionality
    $('#select-all').click(function() {
        $('.select-item').prop('checked', this.checked);
    });

    // Bulk delete function
    function bulkDelete() {
        var selectedIds = [];
        $('.select-item:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: 'Please select at least one item to delete.',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (!confirm('Are you sure you want to delete selected books?')) {
            return;
        }

        $.ajax({
            url: '/bulkDeleteBooks', // Define your route here
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Add CSRF token
                ids: selectedIds
            },
            success: function(response) {
                if (response.success) {
                    location.reload(); // Reload the page after successful deletion
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: 'Something went wrong. Please try again.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    }


    function updateData(userId, param) {
        $.ajax({
            url: '/updatePage/' + userId,
            type: 'GET',
            dataType: 'json',

            success: function(response) {
                if (response != '') {
                    if (param == 'view') {
                        $("#updatebtn").hide();
                        $("#closebtn").hide();
                    } else {
                        $("#updatebtn").show();
                        $("#closebtn").show();
                    }
                    $('#updateModal').modal('show');
                    var updatedata = response;
                    $("#id").val(response.id)
                    $("#utitle").val(response.title)
                    $("#uauthor").val(response.author)
                    $("#udescription").val(response.description)
                } else {
                    show_snack("no data found");
                }
                // debugger;
                console.log(response);
                // Handle the success response
            },
            error: function(error) {
                console.log(error);
                // Handle the error response
            }
        });
    }

    function update() {
        $("#msg1").html("");
        var id = document.getElementById("id").value;
        var title = document.getElementById("utitle").value;
        var author = document.getElementById("uauthor").value;
        var description = document.getElementById("udescription").value;
        var data = {
            id,
            title,
            author,
            author,
            description
        };
        $.ajax({
            url: '/updateData/' + id,
            method: "POST",
            timeout: 0,
            headers: {
                "Content-Type": "application/json",
            },
            data: JSON.stringify(data),
            success: function(res) {
                if (res != '') {
                    $('#updateModal').modal('hide');
                    location.reload();
                }
                $("#msg").html(res);

            },
        });
    }

    function create() {
        var title = document.getElementById("title").value;
        var author = document.getElementById("author").value;
        var description = document.getElementById("description").value;
        var data = {
            title,
            author,
            description
        };
        $.ajax({
            url: '/addBooks',
            method: "POST",
            timeout: 0,
            headers: {
                "Content-Type": "application/json",
            },
            data: JSON.stringify(data),
            success: function(res) {
                if (res != '') {
                    $('#updateModal').modal('hide');
                    location.reload();
                }
                $("#msg").html(res);

            },
        });
    }
</script>
@endpush