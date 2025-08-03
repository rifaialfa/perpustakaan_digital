1. Langkah pertama bisa menggunakan xammp atau laragon (disini saya menggunakan xampp)
2. create database dengan skrip SQL seperti dibawah ini.

CREATE DATABASE IF NOT EXISTS perpustakaan_digital;
USE perpustakaan_digital;

DROP TABLE IF EXISTS `buku`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'user') NOT NULL DEFAULT 'user',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `buku` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `judul` VARCHAR(255) NOT NULL,
  `penulis` VARCHAR(255) NOT NULL,
  `penerbit` VARCHAR(255) NOT NULL,
  `isbn` VARCHAR(20) DEFAULT NULL,
  `deskripsi` TEXT,
  `file_buku` VARCHAR(255) DEFAULT NULL,
  `user_id` INT(11) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$hbncYm.SbhFAIwZqRL47j.juYz.PCFxn7zj7oFjbEp63yvOD6qgiG', 'admin'),
(2, 'user', 'user@example.com', '$2y$10$g5H.nyz9.5BMtMFg4hQXtOwDufZSOR6yiByQrwhjWIQE8rdN18ymu', 'user');


3. buat directory folder pada C:\xampp\htdocs\ "perpustakaan_digital".
4. Download CodeIgniter 4 via Composer (Disarankan) Syarat: Composer harus sudah terinstall. Jika belum, unduh dari: https://getcomposer.org/ lalu install.
5. jalankan cmd lalu targetkan ke "cd C:\xampp\htdocs\perpustakaan_digital" download codeigniter terbaru dengan cara "composer create-project codeigniter4/appstarter perpustakaan_digital"
6. ketik "php spark serve" untuk menjalankan http://localhost:8080
7. copy dan replace file zip yang telah didownload pada C:\xampp\htdocs\perpustakaan_digital
8. buka browser lalu akses http://localhost:8080/login
9. login dengan akun yang terdapat pada database tadi
10. perpustakaan digital sudah bisa digunakan
