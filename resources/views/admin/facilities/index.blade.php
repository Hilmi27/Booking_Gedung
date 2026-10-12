@extends('layouts.admin')

@section('title', 'Manajemen Fasilitas')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Daftar Fasilitas</h2>
        <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Tambah Fasilitas
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($facilities as $facility)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $facility->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <i class="fas {{ $facility->icon }} text-primary-600"></i>
                                <span class="text-sm text-gray-500 ml-2">{{ $facility->icon }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $facility->description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.facilities.edit', $facility) }}"
                                    class="text-primary-600 hover:text-primary-900 mr-3">Edit</a>
                                <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada fasilitas yang tersedia. <a href="{{ route('admin.facilities.create') }}"
                                    class="text-primary-600 hover:text-primary-900">Tambah fasilitas baru</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
