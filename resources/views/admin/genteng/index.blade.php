@extends('layouts.app')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-3xl font-bold text-orange-900">
            <i class="fa-solid fa-layer-group text-center mr-1"></i> Data Genteng
        </h1>
        <p class="text-gray-500 mt-1">
            Kelola data genteng
        </p>
    </div>

    <button onclick="openModal('tambahModal')" 
        class="bg-gradient-to-r from-orange-700 to-red-700 hover:from-orange-800 hover:to-red-800 text-white px-4 py-2 rounded-xl shadow-lg transition">
        <i class="fas fa-plus-square mr-1"></i> Tambah Genteng
    </button>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<!-- TABLE -->
<div class="bg-white rounded-3xl shadow-xl border border-orange-100 p-4">
    <div class="overflow-x-auto">
        <table id="dataTable" class="min-w-full text-sm">
            <thead>
                <tr>
                    <th class="p-4">No</th>
                    <th class="p-4">Genteng</th>
                    <th class="p-4">Jenis</th>
                    <th class="p-4">Harga</th>
                    <th class="p-4">Stok</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $d)
                <tr class="border-b border-orange-100">
                    <td class="px-4 py-2">{{ $i+1 }}</td>
                    <td class="px-4 py-2">{{ $d->nama }}</td>
                    <td class="px-4 py-2">{{ $d->jenis }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($d->harga) }}</td>
                    <td class="px-4 py-2">{{ $d->stok }}</td>
                    <td class="px-4 py-2">
                        <div class="flex items-center gap-2">
                            <button onclick='openEditModal(@json($d))'
                                class="w-8 h-8 flex items-center justify-center bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl transition shadow">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button onclick="openDeleteModal({{ $d->id }})"
                                class="w-8 h-8 flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded-xl transition shadow">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div id="tambahModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded w-96">
        <h2 class="text-xl font-bold mb-4">Tambah Genteng</h2>

        <form method="POST" action="/admin/genteng/store">
            @csrf
            <input type="text" name="nama" placeholder="Nama" class="w-full border p-2 mb-3" required>
            <input type="text" name="jenis" placeholder="Jenis" class="w-full border p-2 mb-3">
            <input type="number" name="harga" placeholder="Harga" class="w-full border p-2 mb-3">
            <input type="number" name="stok" placeholder="Stok" class="w-full border p-2 mb-3">
            <textarea name="deskripsi" placeholder="Deskripsi" class="w-full border p-2 mb-3"></textarea>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('tambahModal')" class="bg-gray-400 px-3 py-1 text-white rounded">Batal</button>
                <button class="bg-blue-600 px-3 py-1 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded w-96">
        <h2 class="text-xl font-bold mb-4">Edit Genteng</h2>

        <form id="editForm" method="POST">
            @csrf
            <input type="text" name="nama" id="editNama" class="w-full border p-2 mb-3">
            <input type="text" name="jenis" id="editJenis" class="w-full border p-2 mb-3">
            <input type="number" name="harga" id="editHarga" class="w-full border p-2 mb-3">
            <input type="number" name="stok" id="editStok" class="w-full border p-2 mb-3">
            <textarea name="deskripsi" id="editDeskripsi" class="w-full border p-2 mb-3"></textarea>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('editModal')" class="bg-gray-400 px-3 py-1 text-white rounded">Batal</button>
                <button class="bg-yellow-500 px-3 py-1 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL DELETE -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded text-center">
        <h2 class="mb-4">Yakin hapus data?</h2>

        <a id="deleteLink" class="bg-red-500 px-4 py-2 text-white rounded">Hapus</a>
        <button onclick="closeModal('deleteModal')" class="ml-2 bg-gray-400 px-4 py-2 text-white rounded">Batal</button>
    </div>
</div>

<script>
    function openModal(id){ 
        document.getElementById(id).classList.remove('hidden'); 
    }

    function closeModal(id){ 
        document.getElementById(id).classList.add('hidden'); 
    }

    function openEditModal(data){
        document.getElementById('editNama').value = data.nama;
        document.getElementById('editJenis').value = data.jenis;
        document.getElementById('editHarga').value = data.harga;
        document.getElementById('editStok').value = data.stok;
        document.getElementById('editDeskripsi').value = data.deskripsi;
        document.getElementById('editForm').action = '/admin/genteng/update/' + data.id;
        openModal('editModal');
    }

    function openDeleteModal(id){
        document.getElementById('deleteLink').href = '/admin/genteng/delete/' + id;
        openModal('deleteModal');
    }
</script>

@endsection