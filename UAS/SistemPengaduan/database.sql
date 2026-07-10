CREATE DATABASE IF NOT EXISTS db_sp
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE db_sp;
CREATE TABLE IF NOT EXISTS users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    role        ENUM('admin','user') NOT NULL DEFAULT 'user',
    nama_enc    TEXT NULL,
    nik_enc     TEXT NULL,
    email       VARCHAR(100) NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)   ENGINE=InnoDB;

CREATE TABLE laporan (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL,
    judul           VARCHAR(255) NOT NULL,
    kategori        VARCHAR(50) NOT NULL,
    isi_laporan_enc TEXT NOT NULL,
    status          ENUM ('Pending', 'Proses', 'Selesai') NOT NULL DEFAULT 'Pending',
    is_anonim       TINYINT(1) NOT NULL DEFAULT 0,
    is_flagged      TINYINT(1) NOT NULL DEFAULT 0,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_laporan_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)   ENGINE=InnoDB;

CREATE TABLE tanggapan (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    laporan_id      INT NOT NULL,
    admin_id        INT NOT NULL,
    isi_tanggapan   TEXT NOT NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_tanggapan_laporan FOREIGN KEY (laporan_id) REFERENCES laporan(id) ON DELETE CASCADE,
    CONSTRAINT fk_tanggapan_admin FOREIGN KEY (admin_id) REFERENCES users(id)
)   ENGINE=InnoDB;

CREATE INDEX idx_laporan_status ON laporan (status);
CREATE INDEX idx_laporan_user ON laporan (user_id);
CREATE INDEX idx_tanggapan_laporan ON tanggapan (laporan_id);

INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$jRwlpB8OsMQiAS2LbEv.1uc8Z1f8WMRFTp7P8LQILte9hZc4.pffy', 'admin');
