<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseToRevisorRequest;
use Algolia\AlgoliaSearch\Http\Psr7\Response;

class MakeUserRevisor extends Command
{
 
    protected $signature = 'app:make-user-revisor {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Rende un utente revisore';

    /**
     * Execute the console command.
     */
    // public function handle()
    // {
    //     $user =User::where('email', $this->argument('email'))->first();
    //     if (!$user) {
    //         $this->error('Utente non trovato.');
    //         return;
    //     }
    //     $user->is_revisor = true;
    //     $user->save();
    //     $this->info("l'utente {$user->name} è ora un revisore");
    // }

    
    protected $description = 'Rende un utente esistente un revisore e gli invia una notifica via email';

        public function handle()
        {
            $user = User::where('email', $this->argument('email'))->first();

            if (!$user) {
                $this->error('Utente non trovato con questa email.');
                return 1;
            }

            if ($user->is_revisor) {
                $this->warn("L'utente {$user->name} è già un revisore.");
                return 0;
            }

            $user->is_revisor = true;
            $user->save();
            $this->info("L'utente {$user->name} è ora un revisore.");

            try {
                Mail::to($user->email)->send(new ResponseToRevisorRequest ($user));
                $this->info("Email di conferma inviata con successo a {$user->email}.");
            } catch (\Exception $e) {
                $this->error("Non è stato possibile inviare l'email di conferma: " . $e->getMessage());
            }
            
            return 0;
        }
}
