<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subir archivo CSV</div>

                <div class="card-body">
                    <form action="{{ route('cargar.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="csv_file">Archivo CSV:</label>
                            <input type="file" name="csv_file" id="csv_file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Subir y Procesar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

