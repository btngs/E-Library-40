<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminAnggotaController extends Controller
{
    public function index(Request $request): View
    {
        $pending = User::query()
            ->where('role', 'siswa')
            ->where('registration_status', User::REGISTRATION_PENDING)
            ->latest()
            ->paginate(10, ['*'], 'pending_page');

        $anggota = User::query()
            ->where('role', 'siswa')
            ->where('registration_status', User::REGISTRATION_APPROVED)
            ->latest()
            ->paginate(10, ['*'], 'approved_page');

        return view('admin.anggota.index', [
            'anggota' => $anggota,
            'pending' => $pending,
            'totalPending' => User::query()
                ->where('role', 'siswa')
                ->where('registration_status', User::REGISTRATION_PENDING)
                ->count(),
        ]);
    }

    public function create(): View
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'siswa',
            'registration_status' => User::REGISTRATION_APPROVED,
        ]);

        return to_route('admin.anggota.index')->with('status', [
            'message' => 'Anggota berhasil ditambahkan.',
        ]);
    }

    public function edit(User $anggotum): View
    {
        abort_unless($anggotum->role === 'siswa', 404);

        return view('admin.anggota.edit', [
            'anggota' => $anggotum,
        ]);
    }

    public function update(Request $request, User $anggotum): RedirectResponse
    {
        abort_unless($anggotum->role === 'siswa', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($anggotum->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $anggotum->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            ...($validated['password'] ?? false ? ['password' => $validated['password']] : []),
        ]);

        return to_route('admin.anggota.index')->with('status', [
            'message' => 'Anggota berhasil diperbarui.',
        ]);
    }

    public function destroy(User $anggotum): RedirectResponse
    {
        abort_unless($anggotum->role === 'siswa', 404);

        $anggotum->delete();

        return to_route('admin.anggota.index')->with('status', [
            'message' => 'Anggota berhasil dihapus.',
        ]);
    }

    public function approve(User $anggota): RedirectResponse
    {
        abort_unless($anggota->role === 'siswa', 404);
        abort_unless($anggota->registration_status === User::REGISTRATION_PENDING, 404);

        $anggota->update([
            'registration_status' => User::REGISTRATION_APPROVED,
        ]);

        return to_route('admin.anggota.index')->with('status', [
            'message' => 'Pendaftaran anggota berhasil disetujui.',
        ]);
    }

    public function reject(User $anggota): RedirectResponse
    {
        abort_unless($anggota->role === 'siswa', 404);
        abort_unless($anggota->registration_status === User::REGISTRATION_PENDING, 404);

        $anggota->delete();

        return to_route('admin.anggota.index')->with('status', [
            'message' => 'Pendaftaran anggota ditolak.',
        ]);
    }
}
