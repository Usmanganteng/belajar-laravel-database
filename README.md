<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

>
---
<b>requirement/persyaratan</b>
---
> #### Php versi 8
>> - Cara menginstal php dalam bahasa indonesia : https://youtu.be/Uw3ZGIMvIdA?si=mBVZ-lBnoCilASzo
>> - Cara menginstal php dalam bahasa inggris : https://youtu.be/MPRLUd8Pmyo?si=FqN54nVr4duH4Keg
---
> #### Laravel versi 10.0.3
>> - cara menginstal laravel yang versi yang sama 
```
   Composer Create-project laravel\laravel=v10.0.3 nama-folder
```
>> - Cara tahu laravel sekarang versi berapa : https://packagist.org/packages/laravel/laravel
---
<b>Cara menjalankannya</b>
---
> - langkah pertaman : lakukan git clone seperti di bawah ini :
```
 git clone https://github.com/Usmanganteng/belajar-laravel-database.git
```
> - langkah kedua : copy file .env.example dan ganti namanya menjadi .env seperti perintah di bawah ini ketika sudah kalian lakukan, kalian bisa tulis perintah setelah nya yaitu composer install 
```
 cp .env.example .env
 composer install
```
> - langkah ketiga : lakukan perintah seperti di bawah ini :
```
php artisan key:generate
```
> - langkah keempat : kalian bisa buat database dengan nama belajar_laravel_database lalu ganti nama database yang ada di .env dengan nama database yang sudah kalian buat lalu lakukan perintah :
```
php artisan migrate
```
> - langkah terakhir : kailan bisa langsung jalankan atau run dengan menulilskan perintah :
```
php artisan serve
```
---
<b>materi</b>
---
> #### Debug Query
> - Debug Query dalam Laravel Database adalah proses memantau dan menganalisis query SQL yang dihasilkan oleh aplikasi Anda saat berinteraksi dengan database. Ini membantu dalam mengoptimalkan kinerja aplikasi dan menemukan masalah dalam kueri-kueri yang dieksekusi. Dengan menggunakan metode `DB::enableQueryLog()` untuk mengaktifkan pencatatan query dan `DB::getQueryLog()` untuk mengakses log query, Anda dapat melihat dan menganalisis query yang dieksekusi oleh aplikasi Anda.
> - berikut adalah contoh sintaksnya:
```
// Aktifkan pencatatan query
DB::enableQueryLog();

// Eksekusi query Anda di sini
$users = User::where('status', 'active')->get();

// Dapatkan log query
$queries = DB::getQueryLog();

// Sekarang Anda dapat menampilkan atau menganalisis log query
dd($queries);
```
---
> #### Database Transaction
> - Database Transaction dalam Laravel adalah cara untuk menjamin konsistensi data dalam database saat menjalankan beberapa operasi database secara bersamaan. Ini memastikan bahwa entitas data tetap konsisten bahkan jika terjadi kegagalan dalam proses pengolahan data. Dalam Laravel, Anda dapat mengelompokkan serangkaian operasi database ke dalam satu transaksi. Jika satu operasi gagal, maka seluruh transaksi akan dibatalkan (rollback), sementara jika semua operasi berhasil, maka transaksi akan di-commit, dan perubahan akan diterapkan ke database.
> - berikut adalah contoh sintaksnya :
```
DB::transaction(function () {
    // Lakukan operasi database di dalam transaksi
    $user = User::create([...]);
    $profile = Profile::create([...]);

    // Lakukan operasi lainnya

    // Jika semua operasi berhasil, transaksi akan di-commit secara otomatis
});
```
---
> #### Query Builder Insert
> - Query Builder Insert dalam Laravel digunakan untuk menyisipkan data baru ke dalam tabel database tanpa menulis kueri SQL mentah.
> - berikut adalah contoh sintaks nya :
```
// Contoh: Menyisipkan data baru ke dalam tabel 'users'
DB::table('users')->insert([
    'name' => 'Aldizar Ilham',
    'email' => 'ilham@lulu.com',
    'password' => bcrypt('secret'),
    'created_at' => now(),
    'updated_at' => now()
]);
```
---
> #### Query Builder Select
> - query SELECT dengan sintaks PHP yang mudah dibaca dan diekspresikan. Ini memungkinkan pembuatan query dinamis menggunakan metode chaining untuk menambahkan klausa seperti SELECT, WHERE, JOIN, ORDER BY, dsb.
> - berikut adalah contoh sintaksnya :
```
$users = DB::table('users')
            ->select('id', 'name', 'email')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

```
---
> #### Chunk Result
> - Chunk Result dalam Laravel Query Builder memungkinkan Anda untuk membagi hasil query menjadi beberapa bagian (chunk) yang lebih kecil untuk diproses secara terpisah. Ini berguna ketika Anda perlu memproses jumlah data besar tanpa membebani memori server secara berlebihan.
> - Berikut adalah contoh sintaksnya :
```
DB::table('users')->orderBy('id')->chunk(100, function ($users) {
    foreach ($users as $user) {
        // Proses setiap pengguna
    }
});
```
> - Dalam contoh di atas, hasil query untuk tabel 'users' akan dibagi menjadi bagian-bagian sebesar 100 baris, dan setiap bagian tersebut akan diproses dalam fungsi callback. Ini memungkinkan pengolahan data secara efisien dalam jumlah besar tanpa membebani memori secara berlebihan.
---
> #### Lazy
> - Dalam Laravel Database, "lazy" berarti menunda eksekusi query sampai hasilnya diperlukan, membantu mengoptimalkan kinerja aplikasi dengan menghindari penggunaan sumber daya yang tidak perlu.
----
> #### Cursor
> - Dalam Laravel, "cursor" memungkinkan Anda untuk membaca dan memproses data secara efisien, satu baris pada satu waktu, tanpa memuat seluruh hasil query ke dalam memori pada satu waktu.
> - Berikut adalah contoh sintaks nya :
```
User::cursor()->each(function ($user) {
    // Proses setiap pengguna di sini
});
```
> - Dalam contoh ini, `User::cursor()` menghasilkan cursor untuk membaca data pengguna secara efisien dari database, dan kemudian setiap pengguna diproses satu per satu di dalam fungsi `each()`.
---
> #### Query Builder Aggregate
> - Query Builder Aggregate dalam Laravel memungkinkan Anda untuk melakukan operasi agregasi seperti count, max, min, atau avg pada data dalam tabel database.
> - berikut adalah contoh sintaks nya :
```
$totalUsers = DB::table('users')->count();

$highestSalary = DB::table('employees')->max('salary');

$averageScore = DB::table('students')->avg('score');
```
> -Dalam contoh ini, kita menggunakan `count()` untuk menghitung jumlah baris dalam tabel 'users', `max()` untuk mencari nilai gaji tertinggi dalam tabel 'employees', dan `avg()` untuk mencari rata-rata nilai skor dalam tabel 'students'.
---
> #### Query Builder Raw
> - Query Builder Raw dalam Laravel memungkinkan Anda mengeksekusi query SQL langsung ke database tanpa menggunakan metode chaining standar.
> - berikut adalah contoh sintaks nya:
```
$results = DB::select('SELECT * FROM users WHERE age > ?', [18]);
```
> - Dalam contoh ini, `DB::select()` digunakan untuk mengeksekusi query SQL langsung ke database dengan parameter umur lebih dari 18.
---
> #### Query Builder Grouping
> - Query Builder Grouping dalam Laravel memungkinkan Anda untuk mengelompokkan hasil query berdasarkan nilai tertentu dari kolom.
> - berikut adalah contoh sintaksnya:
```
$results = DB::table('orders')
            ->select('category', DB::raw('SUM(total_amount) as total_sales'))
            ->groupBy('category')
            ->get();
```
> - Dalam contoh ini, kita mengelompokkan hasil query berdasarkan kolom 'category' dan menghitung total penjualan untuk setiap kategori menggunakan fungsi agregasi SUM.
---
> #### Pagination
> - Pagination dalam Laravel memungkinkan Anda untuk membagi hasil query menjadi beberapa halaman untuk ditampilkan kepada pengguna secara terpisah.
> - berikut adalah contoh sintaksnya:
```
$users = DB::table('users')->paginate(10);
```
> - Dalam contoh ini, hasil query pengguna dibagi menjadi halaman-halaman dengan masing-masing berisi 10 pengguna.
---
> #### Cursor Pagination
> - Cursor Pagination dalam Laravel menggunakan pointer (biasanya ID atau nilai unik) untuk menentukan posisi mulai dari mana data berikutnya diambil.
> - berikut adalah contoh sintaksnya :
```
$users = User::orderBy('id')->cursorPaginate(10);
```
> - Dalam contoh ini, `cursorPaginate(10)` digunakan untuk mendapatkan 10 pengguna pada setiap halaman menggunakan teknik Cursor Pagination.
---
> #### Database Migration
> - Database Migration dalam Laravel memungkinkan Anda untuk mengelola struktur database menggunakan kode PHP daripada SQL mentah. Contohnya, Anda dapat membuat migrasi baru untuk tabel pengguna dengan perintah:
```
php artisan make:migration create_users_table
```
> - Setelah itu, Anda bisa mendefinisikan struktur tabel di dalamnya dan menjalankan migrasi dengan perintah:
```
php artisan migrate
```
> - Ini akan menerapkan perubahan-perubahan tersebut pada database Anda. Migrasi membantu mempertahankan konsistensi struktur database di seluruh lingkungan dan memungkinkan pengembang untuk bekerja secara kolaboratif menggunakan kontrol versi seperti Git.
---
> #### Database Seeding
> - Database Seeding dalam Laravel adalah proses untuk memasukkan data awal ke dalam tabel database Anda. Ini berguna saat Anda ingin mengisi database dengan data contoh atau data yang dibutuhkan untuk pengujian atau pengembangan.
> - Contoh penggunaan Database Seeding dalam Laravel:
> > 1. Buat seeder baru dengan perintah artisan:
> ```
> php artisan make:seeder UsersTableSeeder
> ```
> > 2. Isi seeder dengan data yang ingin Anda masukkan ke dalam tabel. Misalnya:
> ```
> use Illuminate\Database\Seeder;
> use App\Models\User;
>
> class UsersTableSeeder extends Seeder
> {
>    public function run()
>    {
>        User::create([
>            'name' => 'Aldizar Ilham',
>            'email' => 'aldizar@lulu.com',
>            'password' => bcrypt('secret'),
>        ]);
>    }
>}
>```
> > 3. Panggil seeder tersebut dari dalam metode `run` di dalam file `DatabaseSeeder.php`:
> ```
> use Illuminate\Database\Seeder;
>
> class DatabaseSeeder extends Seeder
> {
>    public function run()
>    {
>        $this->call(UsersTableSeeder::class);
>    }
> }
>```
> > 4. Jalankan perintah artisan untuk menjalankan semua seeder:
> ```
> php artisan db:seed
> ```
> - Ini akan memasukkan data yang ditentukan ke dalam tabel yang sesuai dalam database Anda. Database Seeding memungkinkan Anda untuk mempersiapkan lingkungan pengembangan atau pengujian dengan cepat dan efisien.
---
<b>Terima kasih</b>
---
