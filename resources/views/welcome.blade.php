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
            <div class="col-md-12">
                <h3 class="mb-2">Create Recipe</h3>
                <form action="{{ route('upload-recipe') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="nama_resep" class="form-control" id="" placeholder="Nama resep">
                            <input type="file" name="gambar" class="form-control mb-3 mt-3" id="">
                            <input type="number" class="form-control mt-3" placeholder="Nilai energi" name="energi" id="">
                            <input type="number" class="form-control mt-3" step="0.01" step="0.01" placeholder="Nilai protein" name="protein" id="">
                            <input type="number" class="form-control mt-3 mb-3" step="0.01" placeholder="Nilai lemak" name="lemak" id="">
                            <button class="btn btn-primary mt-3">Save</button>
                        </div>
                        <div class="col-md-6">
                            <textarea name="deskripsi" id="description" cols="30" rows="5" class="form-control mt-3" placeholder="description"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $('#description').summernote({
            placeholder: 'Deskripsi resep',
            tabsize: 2,
            height: 160,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ]
          });
    </script>
</body>

</html>
