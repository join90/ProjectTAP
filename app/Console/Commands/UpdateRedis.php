<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
class UpdateRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Database Redis';

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
     * @return mixed
     */
    public function handle()
    {
        
        ProductController::UpdateProductRedis();
        SellerController::UpdateShopsRedis();

        Log::info('Aggiornamento Redis@'.\Carbon\Carbon::now());
    }
}