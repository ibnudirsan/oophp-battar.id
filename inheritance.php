<?php

class Produk {
    public  $judul,
            $penulis,
            $penerbit,
            $harga,
            $jmlHalaman, // Properti Untuk Komik
            $waktuMain; // Properti Untuk Game
            // $tipe; // Properti Untuk Pembeda antara Komik dan Game. //Tidak digunakan karena memakai inheritance.

    public function __construct($judul ="Judul",$penulis ="penulis",$penerbit ="penerbit",$harga =0,$jmlHalaman=0,$waktuMain=0){
        // Construct merupakan sebuah method spesial (khusus) karena method yang otomatis di jalankan ketika sebuah class di Instantiasi (Objek) nya,
        // ketika kita membuat objek dengan keyword new , pada saat itu juga ada sebuah method yang di jalankan yaitu constructor.
        // echo "Assalamu'alaikum";
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->penerbit = $penerbit;
        $this->harga = $harga;
        $this->jmlHalaman = $jmlHalaman;
        $this->waktuMain = $waktuMain;
        // $this->tipe = $tipe;  //Tidak digunakan karena memakai inheritance.
    }

    public function getLable(){
        return "$this->penulis, $this->penerbit";
        //fungsi $this untuk mengambil property yang ada di dalam class yang bersangkutan ketika di buat Instant.
        // jika tidak ada $this maka akan error karena pada PHP Lingkup variable (scope variabel 
        // -- tata cara penulisan property sama dengan tata cara penulisan variable)
        // menulis variable di dalam function artinya untuk variable di function tersebut saja, bukan mengambil dari luar, untuk mengambil
        // isi dari property di dalam kelas harus menambahkan $this.
    }
    
    public function getInfoProduk(){
        // Komik : Naruto | Masashi Kishimoto, Shonen Jump (Rp. 30000) - 100 Halaman.
        $str = "{$this->judul} | {$this->getLable()} (Rp. {$this->harga}";

        //=========Sudah di gantikan dengan Child Class (Komik dan Game)=============
        // if($this->tipe == "Komik"){
        //     $str .= " - ($this->jmlHalaman) Halaman.";
        // }elseif ($this->tipe == "Game"){
        //     $str .= " ~ ($this->waktuMain) Jam.";
        // }
        //=========Sudah di gantikan dengan Child Class (Komik dan Game)=============

        return $str;
    }
    // Rumusan Masalah inheritance problem:
    // Lebih Komplek jika ketentuannya lebih banyak (kondisi if).
}

class CetakInfoProduk {
    public function cetak(Produk $produk) {
        // Agar supaya fungsi cetak ini menerima spesifik dari class produk sehingga 
        // Produk adalah (type nya) di gunakan untuk indetifikasi class produk yang di Instantiasi.
        // $produk adalah parameter (variabel) dari object ($produk1,$produk2 dan seterusnya).
        $str = "{$produk->judul} | {$produk->getLable()} (Rp. {$produk->harga})";
        return $str;
    }
}

// Instantiasi class Produk
$produk1 = new Komik("Naruto","Masashi Kishimoto","Shonen Jump",30000,100,0);
$produk2 = new Game("Uncharted","Neil Druckman","Sony Computer",250000,0,50);
// Catatan : 
// Value 0 mewakili nilai yang tidak ada pada Produk. Karena semua nilai di parsing ke construct.
// Sedangkan "Komik" dan "Game" untuk pembeda antara Produk (Properti Tipe).
// Kompleksitas semakin rumit ketika ketentuannya lebih banyak (100,0 untuk Komik dan 0,50 untuk Game dan seterusnya).
// Jika ketentuannya bertambah membuat codingan semakin rumit.
// Solusi : dengan inheritance (pewarisan pada class).

// ========================================================================================Object-Type===============
// echo "<br>";
// echo "Komik : " .$produk1->getLable();
// echo "<br>";
// echo "Game :  " .$produk2->getLable();
// echo "<br>";

// buat $infoproduk1 variabel baru untuk Instantiasi Class CetakInfoProduk.
// $infoproduk1 = new CetakInfoProduk();
// panggil $infoproduk1 variabel untuk menjalankan method cetak dengan memasukan parameter variabel dari object.
// echo $infoproduk1->cetak($produk1);
// ========================================================================================Object-Type===============

// ========================================================================================inheritance problem===============
// Studi Kasus : menampilkan 2 Produk yang beda ( - 100 Halaman untuk Komik dan ~ 50 Jam Untuk Game).
// Komik : Naruto | Masashi Kishimoto, Shonen Jump (Rp. 30000) - 100 Halaman.
// Game : Uncharted | Neil Druckman, Sony Computer (Rp. 250000) ~ 50 Jam.

echo $produk1->getInfoProduk();
echo "<br>";
echo $produk2->getInfoProduk();

// ========================================================================================inheritance problem===============

class Komik extends Produk {
    public function getInfoProduk(){
        $str = "Komik : {$this->judul} | {$this->getLable()} (Rp. {$this->harga}) - {$this->jmlHalaman} Halaman.";
        return $str;
    }
}

class Game extends Produk {
    public function getInfoProduk(){
        $str = "Game : {$this->judul} | {$this->getLable()} (Rp. {$this->harga}) ~ {$this->waktuMain} Jam.";
        return $str;
    }
}
// Catatan : 
// Class Child bisa menggunakan semua properti dan method pada class Perent.
// Jika kita memanggil sebuah method atau properti pada class Child maka akan cari dulu didalam class Child tersebut (ada atau tidak ada method yang dijalankan/dipanggil).
// Jika tidak ada maka otomatis akan mencari di class Perent nya.