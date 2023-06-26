<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

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
        $name = $this->argument('name');
        $className = $name . 'Service';
        $fileName = $className . '.php';
        $directory = app_path('Services');

        if (!File::exists($directory)) {
            File::makeDirectory($directory);
        }

        $path = $directory . '/' . $fileName;

        if (File::exists($path)) {
            $this->error('Service class already exists!');
            return;
        }

        $content = <<<EOD
<?php

namespace App\Services;

class $className
{
    // Service methods and logic go here
}
EOD;

        File::put($path, $content);

        $this->info('Service class created successfully!');
    }
}
