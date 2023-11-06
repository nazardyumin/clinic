<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use PDO;
use PDOException;

class DBCreateController extends Controller
{
    public function create_db()
    {
        try {
            $db_username = config("database.connections.mysql.username");
            $db_pass = config("database.connections.mysql.password");
            $db_name = config("database.connections.mysql.database");
            $conn = new PDO("mysql:host=localhost", $db_username, $db_pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $databases = $conn->query('show databases')->fetchAll(PDO::FETCH_COLUMN);
            if (!in_array($db_name, $databases)) {
                Artisan::call('db:create ' . $db_name);
                Artisan::call('cache:clear');
                Artisan::call('config:clear');
                Artisan::call('config:cache');
                Artisan::call('route:clear');
                Artisan::call('route:cache');
                Artisan::call('migrate');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return view('home.home');
    }
}
