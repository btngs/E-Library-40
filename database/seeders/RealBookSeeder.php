<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealBookSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data to avoid confusion
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('peminjaman')->truncate();
        DB::table('buku_kategori')->truncate();
        DB::table('buku')->truncate();
        DB::table('kategori')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Create Categories
        $categoriesData = [
            ['nama_kategori' => 'Fiksi'],
            ['nama_kategori' => 'Sastra'],
            ['nama_kategori' => 'Sejarah'],
            ['nama_kategori' => 'Fantasi'],
            ['nama_kategori' => 'Klasik'],
            ['nama_kategori' => 'Sci-Fi'],
            ['nama_kategori' => 'Misteri'],
            ['nama_kategori' => 'Romance'],
            ['nama_kategori' => 'Religi'],
            ['nama_kategori' => 'Pengembangan Diri'],
            ['nama_kategori' => 'Budaya'],
            ['nama_kategori' => 'Thriller'],
            ['nama_kategori' => 'Petualangan'],
            ['nama_kategori' => 'Filosofi'],
            ['nama_kategori' => 'Inspiratif'],
            ['nama_kategori' => 'Anak-anak'],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['nama_kategori']] = Kategori::create($cat);
        }

        // 2. Create Books
        $books = [
            // Indonesia
            [
                'judul' => 'Laskar Pelangi',
                'pengarang' => 'Andrea Hirata',
                'tahun_terbit' => 2005,
                'deskripsi' => 'Kisah perjuangan 10 anak di Belitung yang bersekolah di sebuah sekolah dasar yang kondisinya sangat memprihatinkan namun penuh semangat.',
                'stok' => 15,
                'kategori' => ['Fiksi', 'Inspiratif']
            ],
            [
                'judul' => 'Bumi Manusia',
                'pengarang' => 'Pramoedya Ananta Toer',
                'tahun_terbit' => 1980,
                'deskripsi' => 'Roman sejarah yang mengisahkan perjuangan Minke, seorang pribumi cerdas di era kolonial Belanda, di tengah pergolakan sosial dan cinta.',
                'stok' => 10,
                'kategori' => ['Sastra', 'Sejarah']
            ],
            [
                'judul' => 'Laut Bercerita',
                'pengarang' => 'Leila S. Chudori',
                'tahun_terbit' => 2017,
                'deskripsi' => 'Novel yang mengangkat tema aktivis 1998 yang hilang, tentang persahabatan, cinta, dan kehilangan di era Orde Baru.',
                'stok' => 12,
                'kategori' => ['Fiksi', 'Sejarah']
            ],
            [
                'judul' => 'Cantik Itu Luka',
                'pengarang' => 'Eka Kurniawan',
                'tahun_terbit' => 2002,
                'deskripsi' => 'Kisah epik keluarga Dewi Ayu yang menggabungkan sejarah Indonesia dengan elemen realisme magis dan sindiran sosial.',
                'stok' => 8,
                'kategori' => ['Sastra', 'Fiksi']
            ],
            [
                'judul' => 'Negeri 5 Menara',
                'pengarang' => 'Ahmad Fuadi',
                'tahun_terbit' => 2009,
                'deskripsi' => 'Perjalanan 6 santri dari berbagai daerah di Indonesia yang menuntut ilmu di Pondok Madani dengan semboyan Man Jadda Wajada.',
                'stok' => 20,
                'kategori' => ['Fiksi', 'Religi']
            ],
            [
                'judul' => 'Pulang',
                'pengarang' => 'Leila S. Chudori',
                'tahun_terbit' => 2012,
                'deskripsi' => 'Kisah eksil politik Indonesia di Paris setelah peristiwa 1965 dan kerinduan mereka akan tanah air.',
                'stok' => 9,
                'kategori' => ['Fiksi', 'Sejarah']
            ],
            [
                'judul' => 'Ayat-Ayat Cinta',
                'pengarang' => 'Habiburrahman El Shirazy',
                'tahun_terbit' => 2004,
                'deskripsi' => 'Kisah cinta yang religius dan penuh makna dari seorang mahasiswa Indonesia di Al-Azhar, Kairo.',
                'stok' => 15,
                'kategori' => ['Romance', 'Religi']
            ],
            [
                'judul' => 'Perahu Kertas',
                'pengarang' => 'Dee Lestari',
                'tahun_terbit' => 2009,
                'deskripsi' => 'Kisah tentang impian dan cinta antara Kugy, sang agen Neptunus, dan Keenan, sang pelukis berbakat.',
                'stok' => 14,
                'kategori' => ['Romance', 'Fiksi']
            ],
            [
                'judul' => 'Ronggeng Dukuh Paruh',
                'pengarang' => 'Ahmad Tohari',
                'tahun_terbit' => 1982,
                'deskripsi' => 'Kisah tentang Srintil, seorang ronggeng, dan Rasus, teman masa kecilnya, dengan latar belakang tragedi politik 1965 di pedesaan.',
                'stok' => 7,
                'kategori' => ['Sastra', 'Budaya']
            ],
            [
                'judul' => 'Gadis Kretek',
                'pengarang' => 'Ratih Kumala',
                'tahun_terbit' => 2012,
                'deskripsi' => 'Penelusuran sejarah industri kretek di Indonesia melalui perjalanan mencari sosok Jeng Yah di masa lalu.',
                'stok' => 11,
                'kategori' => ['Fiksi', 'Budaya']
            ],

            // Dunia
            [
                'judul' => 'Harry Potter and the Sorcerer\'s Stone',
                'pengarang' => 'J.K. Rowling',
                'tahun_terbit' => 1997,
                'deskripsi' => 'Kisah petualangan Harry Potter, seorang anak yatim piatu yang ternyata adalah seorang penyihir terkenal.',
                'stok' => 25,
                'kategori' => ['Fantasi', 'Petualangan']
            ],
            [
                'judul' => 'The Hobbit',
                'pengarang' => 'J.R.R. Tolkien',
                'tahun_terbit' => 1937,
                'deskripsi' => 'Bilbo Baggins, seorang hobbit yang menyukai kenyamanan, tiba-tiba terseret dalam petualangan besar mencari harta karun naga.',
                'stok' => 15,
                'kategori' => ['Fantasi', 'Klasik']
            ],
            [
                'judul' => 'To Kill a Mockingbird',
                'pengarang' => 'Harper Lee',
                'tahun_terbit' => 1960,
                'deskripsi' => 'Melalui mata Scout Finch, kita melihat perjuangan ayahnya, Atticus Finch, membela keadilan di tengah rasisme di Amerika Selatan.',
                'stok' => 10,
                'kategori' => ['Klasik']
            ],
            [
                'judul' => 'The Great Gatsby',
                'pengarang' => 'F. Scott Fitzgerald',
                'tahun_terbit' => 1925,
                'deskripsi' => 'Kisah Jay Gatsby yang kaya raya namun kesepian, dan obsesinya pada masa lalu serta cinta yang tak sampai.',
                'stok' => 10,
                'kategori' => ['Klasik', 'Sastra']
            ],
            [
                'judul' => '1984',
                'pengarang' => 'George Orwell',
                'tahun_terbit' => 1949,
                'deskripsi' => 'Novel dystopian tentang masyarakat yang diawasi ketat oleh Big Brother, di mana kebebasan berpikir adalah kejahatan.',
                'stok' => 12,
                'kategori' => ['Sci-Fi', 'Klasik']
            ],
            [
                'judul' => 'The Alchemist',
                'pengarang' => 'Paulo Coelho',
                'tahun_terbit' => 1988,
                'deskripsi' => 'Perjalanan Santiago, seorang gembala muda, mencari harta karun di piramida Mesir dan menemukan takdir sejatinya.',
                'stok' => 20,
                'kategori' => ['Fiksi', 'Filosofi']
            ],
            [
                'judul' => 'The Da Vinci Code',
                'pengarang' => 'Dan Brown',
                'tahun_terbit' => 2003,
                'deskripsi' => 'Simbolis Robert Langdon harus memecahkan misteri pembunuhan di Louvre yang melibatkan rahasia besar gereja.',
                'stok' => 18,
                'kategori' => ['Misteri', 'Thriller']
            ],
            [
                'judul' => 'Pride and Prejudice',
                'pengarang' => 'Jane Austen',
                'tahun_terbit' => 1813,
                'deskripsi' => 'Kisah Elizabeth Bennet yang cerdas menghadapi tekanan sosial, keluarga, dan kesalahpahaman cintanya pada Mr. Darcy.',
                'stok' => 12,
                'kategori' => ['Klasik', 'Romance']
            ],
            [
                'judul' => 'The Little Prince',
                'pengarang' => 'Antoine de Saint-Exupéry',
                'tahun_terbit' => 1943,
                'deskripsi' => 'Sebuah fabel tentang seorang pangeran kecil yang mengunjungi berbagai planet di alam semesta, membawa pesan mendalam tentang kehidupan.',
                'stok' => 20,
                'kategori' => ['Klasik', 'Anak-anak']
            ],
            [
                'judul' => 'Atomic Habits',
                'pengarang' => 'James Clear',
                'tahun_terbit' => 2018,
                'deskripsi' => 'Panduan praktis untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk melalui perubahan-perubahan kecil yang konsisten.',
                'stok' => 30,
                'kategori' => ['Pengembangan Diri']
            ],
        ];

        foreach ($books as $bookData) {
            $catNames = $bookData['kategori'];
            unset($bookData['kategori']);

            $book = Buku::create($bookData);

            $catIds = [];
            foreach ($catNames as $name) {
                if (isset($categories[$name])) {
                    $catIds[] = $categories[$name]->id;
                }
            }

            if (!empty($catIds)) {
                $book->kategori()->attach($catIds);
            }
        }
    }
}
