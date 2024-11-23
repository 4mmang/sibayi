<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12" id="article-create">
                <h3 class="mb-4">Buat Artikel</h3>
                <form action="{{ route('upload-article') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="text" name="judul" class="form-control" id=""
                        placeholder="Judul artikel">
                    <input type="file" name="sampul" class="form-control mb-3 mt-3" id="">
                    <textarea name="deskripsi" id="description" cols="30" rows="5" class="form-control mt-3"
                        placeholder="description"></textarea>
                    <button class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
            <div class="col-md-12 d-none" id="article-edit">
                <h3 class="mb-4">Edit Artikel</h3>
                <form enctype="multipart/form-data" method="post" id="form-edit">
                    @csrf
                    @method('put')
                    <input type="text" name="judul" class="form-control" id="judul"
                        placeholder="Judul artikel">
                    <input type="file" name="sampul" class="form-control mb-3 mt-3" id="">
                    <textarea name="deskripsi" id="description-edit" cols="30" rows="5" class="form-control mt-3"
                        placeholder="description"></textarea>
                        <button type="submit" class="btn btn-danger mt-3">Simpan</button>
                        <a href="" class="btn btn-warning mt-3">Batal</a>
                </form>
            </div>
            <div class="col-md-12 mt-3">
                <div class="table-responsive">
                    <table class="table table-sm text-center table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $article->judul }}</td>
                                    <td>
                                        <form action="{{ url('article/delete/' . $article->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#" onclick="edit({{ $article->id }})"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $('#description').summernote({
            placeholder: 'Deskripsi artikel',
            tabsize: 2,
            height: 160,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
            ]
        });
    </script>
    <script>
        function edit(id) {
            document.getElementById('article-create').classList.add('d-none')
            document.getElementById('article-edit').classList.remove('d-none')
            $('#description-edit').summernote({
                placeholder: 'Deskripsi artikel',
                tabsize: 2,
                height: 160,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                ]
            });

            fetch(`/get-article/${id}`)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then((result) => {
                    document.getElementById('judul').value = result.data.judul
                    $('#description-edit').summernote('code', result.data.deskripsi);
                })
                .catch((err) => {
                    console.error('Fetch error:', err);
                });

            const form = document.getElementById('form-edit');
            form.setAttribute('action', `/article/edit/${id}`);


        }
    </script>
</body>

</html>
