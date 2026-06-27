<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        return view('test_form');
    }

  public function login()
{
    $email = $this->request->getPost('email');

    $db = \Config\Database::connect();

    // 🔥 kita bungkus query biar tidak error
    try {
        $query = $db->query("SELECT * FROM user WHERE useremail='$email'");
        $user = $query->getRow();

        if ($user) {
            echo "Login Berhasil (RENTAN SQL INJECTION)";
        } else {
            echo "Login Gagal";
        }

    } catch (\Exception $e) {
        echo "ERROR QUERY (ini bukti sistem tidak aman)";
    }
}
}