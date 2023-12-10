<x-app-layout>
    <x-slot name="title">
        dashboard
    </x-slot>

    
    @foreach($wisatas as $wisata)
        <div class="col-lg-12 col-xl-6" data-toggle="modal" data-target="#editModal{{ $wisata->id }}">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $wisata->nama }}</h5>
                    <span>{{ $wisata->tempat }}</span>
                </div>
                <div class="card-block">
                    <div id="basic-map" class="">
                        <img class="set-map" src="{{ asset($wisata->gambar) }}" alt="Wisata">
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit Wisata -->
        <div class="modal fade" id="editModal{{ $wisata->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $wisata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <!-- Isi Form -->
                <form action="{{ route('wisatas.update', $wisata->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $wisata->id }}">Edit Wisata</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- Input Form -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $wisata->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <input type="text" class="form-control" id="tempat" name="tempat" value="{{ $wisata->tempat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $wisata->id }}">Delete</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete Wisata -->
        <div class="modal fade" id="deleteModal{{ $wisata->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $wisata->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Isi Form -->
                    <form action="{{ route('wisatas.destroy', $wisata->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $wisata->id }}">Hapus Wisata</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Delete confirmation message -->
                            <p>Anda yakin ingin menghapus data wisata ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endforeach
    
    <!-- Modal Tambah Wisata -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <!-- Isi Form -->
        <form action="{{ route('wisatas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Wisata</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <!-- Input Form -->
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="tempat">Tempat</label>
                <input type="text" class="form-control" id="tempat" name="tempat" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" required>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    


</x-app-layout>
