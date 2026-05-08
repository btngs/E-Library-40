<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="page-eyebrow">Manajemen Anggota</p>
            <h2 class="page-title">Data Anggota</h2>
            <p class="page-subtitle">Kelola user dengan role siswa.</p>
        </div>
    </x-slot>

    <div class="page-section">
        <div class="page-wrapper space-y-6">
            @if (session('status'))
                <div class="status-banner">
                    {{ session('status.message') }}
                </div>
            @endif

            @if ($totalPending > 0)
                <div class="status-banner status-banner-error flex items-center justify-between gap-3">
                    <span>Ada {{ $totalPending }} pendaftaran anggota menunggu verifikasi.</span>
                    <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-rose-700">Pending</span>
                </div>
            @endif

            <div class="table-card">
                <div class="table-toolbar">
                    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('admin.anggota.create') }}" class="button-brand">
                                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Anggota
                            </a>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="table-toolbar-title font-bold">Daftar Anggota</h3>
                        <p class="table-toolbar-copy">Hanya user dengan role siswa yang sudah disetujui yang ditampilkan.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="table-head">
                            <tr>
                                <th class="w-16 px-6 py-5">No</th>
                                <th class="px-6 py-5 text-left">Nama</th>
                                <th class="px-6 py-5 text-left">Email</th>
                                <th class="w-24 px-6 py-5 text-center">Role</th>
                                <th class="w-36 px-6 py-5">Tanggal Dibuat</th>
                                <th class="w-56 px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                            @forelse ($anggota as $item)
                                <tr class="table-row">
                                    <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 font-bold text-slate-900">{{ $item->name }}</td>
                                    <td class="px-6 py-4">{{ $item->email }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex rounded-lg bg-sky-50 px-2.5 py-1 text-xs font-bold text-sky-700">siswa</span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">{{ $item->created_at?->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.anggota.edit', $item) }}" class="button-brand-soft">Edit</a>
                                            <form method="POST" action="{{ route('admin.anggota.destroy', $item) }}" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-danger-soft">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        Belum ada data anggota.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-card">
                <div class="table-toolbar">
                    <h3 class="table-toolbar-title font-bold">Pendaftaran Menunggu Verifikasi</h3>
                    <p class="table-toolbar-copy">Siswa yang baru register akan muncul di antrian ini.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="table-head">
                            <tr>
                                <th class="w-16 px-6 py-5">No</th>
                                <th class="px-6 py-5 text-left">Nama</th>
                                <th class="px-6 py-5 text-left">Email</th>
                                <th class="w-36 px-6 py-5">Dibuat</th>
                                <th class="w-56 px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                            @forelse ($pending as $item)
                                <tr class="table-row">
                                    <td class="px-6 py-4 font-medium text-slate-400">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 font-bold text-slate-900">{{ $item->name }}</td>
                                    <td class="px-6 py-4">{{ $item->email }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $item->created_at?->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <form method="POST" action="{{ route('admin.anggota.approve', $item) }}">
                                                @csrf
                                                <button type="submit" class="button-brand-soft">Terima</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.anggota.reject', $item) }}" onsubmit="return confirm('Tolak pendaftaran anggota ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-danger-soft">Tolak</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        Tidak ada pendaftaran baru yang menunggu verifikasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
