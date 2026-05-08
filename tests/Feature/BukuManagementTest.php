<?php

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;

test('guests are redirected when accessing buku page', function () {
    $response = $this->get(route('buku.index'));

    $response->assertRedirect(route('login'));
});

test('authenticated users can create update and delete buku', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $kategori = Kategori::query()->create([
        'nama_kategori' => 'Novel',
    ]);

    $this->actingAs($user);

    $this->post(route('buku.store'), [
        'kategori_id' => $kategori->id,
        'judul' => 'Laskar Pelangi',
        'pengarang' => 'Andrea Hirata',
        'tahun_terbit' => 2005,
        'stok' => 8,
    ])->assertRedirect(route('buku.index'));

    $this->assertDatabaseHas('buku', [
        'judul' => 'Laskar Pelangi',
        'pengarang' => 'Andrea Hirata',
        'tahun_terbit' => 2005,
        'stok' => 8,
    ]);

    $buku = Buku::query()->firstOrFail();

    $this->put(route('buku.update', $buku), [
        'kategori_id' => $kategori->id,
        'judul' => 'Laskar Pelangi Edisi Revisi',
        'pengarang' => 'Andrea Hirata',
        'tahun_terbit' => 2006,
        'stok' => 10,
    ])->assertRedirect(route('buku.index'));

    $this->assertDatabaseHas('buku', [
        'id' => $buku->id,
        'judul' => 'Laskar Pelangi Edisi Revisi',
        'tahun_terbit' => 2006,
        'stok' => 10,
    ]);

    $this->delete(route('buku.destroy', $buku))
        ->assertRedirect(route('buku.index'));

    $this->assertDatabaseMissing('buku', [
        'id' => $buku->id,
    ]);
});

test('buku form validation is enforced', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($user)->from(route('buku.create'))->post(route('buku.store'), [
        'kategori_id' => '',
        'judul' => '',
        'pengarang' => '',
        'tahun_terbit' => 12,
        'stok' => -1,
    ]);

    $response->assertRedirect(route('buku.create'));
    $response->assertSessionHasErrors([
        'kategori_id',
        'judul',
        'pengarang',
        'tahun_terbit',
        'stok',
    ]);
});
