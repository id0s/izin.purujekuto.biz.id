<?php namespace App\Models;

use CodeIgniter\Model;

class IzinModel extends Model {
    protected $table = 'izin';
    protected $allowedFields = ['nis', 'nama', 'jenis_izin', 'alasan', 'status', 'jam_mulai', 'jam_selesai','nama_guru'];
}