<?php

namespace App\Console\Commands;

use App\Library\ModuleGenerator\ModuleGenerator;
use Illuminate\Console\Command;

class createCustomModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:createCustomModule {moduleName} {tableName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Custom Module';

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
        $moduleName = $this->argument('moduleName');
        $tableName  = $this->argument('tableName');

        if(!isset($moduleName) || !isset($tableName))
        {
            $this->error("Module Name or table Name missing!");
            return;
        }

        $module = new ModuleGenerator($moduleName);
        $module->setTableName($tableName);

        // Generate Route
        $routeStatus = $module->generateRoute();
        $routeStatus ? $this->info("Routes Generated Successfully !") : $this->error("Ops, Something went wrong in Routes.");

        // Generate Model
        $modelStatus = $module->generateModel();
        $modelStatus ? $this->info("Model File Generated Successfully !") : $this->error("Ops, Something went wrong in Model.");

        // Generate Controller
        $controllerStatus = $module->generateController();
        $controllerStatus ? $this->info("Controller File Generated Successfully !") : $this->error("Ops, Something went wrong in Controller.");

        // Generate Eloquent
        $eloquentStatus = $module->generateEloquent();
        $eloquentStatus ? $this->info("Eloquent File Generated Successfully !") : $this->error("Ops, Something went wrong in Eloquent.");

        // Generate View
        $viewStatus = $module->generateModuleView();
        $viewStatus ? $this->info("View Files Generated Successfully !") : $this->error("Ops, Something went wrong in View.");

        // Generate API Routes
        $apiRouteStatus = $module->generateAPIRoute();
        $apiRouteStatus ? $this->info("API Routes Files Generated Successfully !") : $this->error("Ops, Something went wrong in API Routes.");

        // Generate API Controller
        $apiControllerStatus = $module->generateAPIController();
        $apiControllerStatus ? $this->info("API Controller Files Generated Successfully !") : $this->error("Ops, Something went wrong in API Controller.");

        // Generate API Transformer
        $apiTransformerStatus = $module->generateAPITransformer();
        $apiTransformerStatus ? $this->info("API Transformer Files Generated Successfully !") : $this->error("Ops, Something went wrong in API Transformer .");

        $this->comment("Process Completed !");
    }
}

