<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class IpController extends Controller
{
    public function index()
    {
        $ips = Ip::all();
        return view('ips.index', compact('ips'));
    }

    public function ping(Ip $ip)
    {
        // Jalankan perintah ping
        $process = new Process(["ping", "-c", "1", $ip->ip_address]);
        try {
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            // Jika berhasil, set timeout ke false
            $ip->update(['is_timeout' => false]);
        } catch (ProcessFailedException $e) {
            // Jika gagal, set timeout ke true
            $ip->update(['is_timeout' => true]);
        }
        return redirect()->route('ips.index');
    }
}
