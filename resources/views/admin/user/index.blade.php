@extends('layouts.app')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
    <div>
        <h1 class="text-3xl font-bold text-orange-900">
            <i class="fa-solid fa-users text-center mr-1"></i> Manajemen User
        </h1>
        <p class="text-gray-500 mt-1">
            Kelola data administrator sistem
        </p>
    </div>

    <button onclick="openModal('tambahModal')" 
        class="bg-gradient-to-r from-orange-700 to-red-700 hover:from-orange-800 hover:to-red-800 text-white px-4 py-2 rounded-xl shadow-lg transition">
        <i class="fas fa-user-plus mr-1"></i> Tambah User
    </button>
</div>

<!-- ALERT -->
@if(session('success'))
<div id="alert-message"
    class="mb-2 p-2 rounded-lg bg-green-100 text-green-800 border border-green-300">
    <strong>Sukses!</strong> {{ session('success') }}
</div>
@endif

<!-- TABLE -->
<div class="bg-white rounded-3xl shadow-xl border border-orange-100 p-4">
    <div class="overflow-x-auto">
        <table id="dataTable" class="min-w-full text-sm">
            <thead>
                <tr>
                    <th class="p-4">No</th>
                    <th class="p-4">User</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $u)
                <tr class="border-b border-orange-100">
                    <td class="px-4 py-2">{{ $i+1 }}</td>
                    <td class="px-4 py-2">
                        <div class="flex items-center gap-3">
                            @if($u->foto)
                                <img src="{{ asset('uploads/user/' . $u->foto) }}"
                                    class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-orange-200 text-orange-800 flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($u->nama,0,1)) }}
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-gray-800">{{ $u->nama }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-2 text-gray-600">{{ $u->email }}</td>
                    <td class="px-4 py-2">
                        <div class="flex items-center gap-2">
                            <button onclick='openEditModal(@json($u))'
                                class="w-8 h-8 flex items-center justify-center bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl transition shadow">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button onclick="openDeleteModal({{ $u->id }})"
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

<!-- ================= MODAL TAMBAH ================= -->
<div id="tambahModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded w-96">
        <h2 class="text-xl font-bold mb-4">Tambah User</h2>

        <form method="POST" action="/admin/user/store" enctype="multipart/form-data">
            @csrf
            <input type="text" name="nama" placeholder="Nama" class="w-full border p-2 mb-3" required>
            <input type="email" name="email" placeholder="Email" class="w-full border p-2 mb-3" required>
            <input type="password" name="password" placeholder="Password" class="w-full border p-2 mb-3" required>
            <input type="file" name="foto" class="w-full border border-orange-200 rounded-xl p-2 mb-3">

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('tambahModal')" class="px-3 py-1 bg-gray-400 text-white rounded">Batal</button>
                <button class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded w-96">
        <h2 class="text-xl font-bold mb-4">Edit User</h2>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="nama" id="editNama" class="w-full border p-2 mb-3" required>
            <input type="email" name="email" id="editEmail" class="w-full border p-2 mb-3" required>
            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" class="w-full border p-2 mb-3">
            <input type="file" name="foto" class="w-full border border-orange-200 rounded-xl p-2 mb-3">

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('editModal')" class="px-3 py-1 bg-gray-400 text-white rounded">Batal</button>
                <button class="px-3 py-1 bg-yellow-500 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL DELETE ================= -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded w-80 text-center">
        <h2 class="text-lg mb-4">Yakin hapus user?</h2>

        <a id="deleteLink" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</a>
        <button onclick="closeModal('deleteModal')" class="ml-2 px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
    </div>
</div>

<script>
    function openModal(id){
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id){
        document.getElementById(id).classList.add('hidden');
    }

    function openEditModal(user){
        document.getElementById('editNama').value = user.nama;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editForm').action = '/admin/user/update/' + user.id;

        openModal('editModal');
    }

    function openDeleteModal(id){
        document.getElementById('deleteLink').href = '/admin/user/delete/' + id;
        openModal('deleteModal');
    }

    // waktu pesan alert
    setTimeout(function () {
        const alert = document.getElementById('alert-message');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 5000); // 5 detik
</script>

@endsection