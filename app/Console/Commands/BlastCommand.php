<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\License;
use App\Mail\RenewEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class BlastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:blast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Blast email setiap jam 9 pagi';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tanggalSekarang = Carbon::now();
        $tanggalMendekati = $tanggalSekarang->copy()->addDays(60);
        $tanggalTerlewat = $tanggalSekarang->copy()->subDays(365);
        
        $licenses = License::where(function ($query) use ($tanggalSekarang, $tanggalMendekati, $tanggalTerlewat) {
            $query->whereBetween('expired_date', [$tanggalSekarang, $tanggalMendekati])
                  ->orWhereBetween('expired_date', [$tanggalTerlewat, $tanggalSekarang]);
        })->get();

        foreach ($licenses as $license) {
            $user = User::where('id', $license->user_id)->first();
            if(!$user){
                continue;
            }
            Mail::to($user->email)->queue(new RenewEmail($license,$user));
        }

    }
}
