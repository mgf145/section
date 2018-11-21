<?php

namespace Sedehi\Section\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class SectionView extends Command
{

    use DetectsApplicationNamespace, SectionsTrait;

    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'section:view {section : The name of the section} {name : The name of the folder} {title : The title of the views} {controller : The name of controller} {--upload}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Create admin views in section';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct(){

        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle(){

        $viewPath = 'views/admin/'.strtolower($this->argument('name')).'/';
        $this->makeDirectory($this->argument('section'), $viewPath);
        if($this->option('upload')) {
            foreach(File::files(__DIR__.'/Template/View/Admin-upload') as $templateFile) {
                if(File::exists(app_path('Http/Controllers/'.ucfirst($this->argument('section')).'/views/admin/'.strtolower($this->argument('name')).'/'.File::name($templateFile).'.blade.php'))) {
                    $this->error('Admin '.File::name($templateFile).' view already exists.');
                }else {
                    $data = File::get(__DIR__.'/Template/View/Admin-upload/'.File::name($templateFile));
                    $data = str_replace('{{{section}}}', ucfirst($this->argument('section')), $data);
                    $data = str_replace('{{{controller}}}', ucfirst($this->argument('controller')), $data);
                    $data = str_replace('{{{title}}}', $this->argument('title'), $data);
                    $data = str_replace('{{{name}}}', strtolower($this->argument('name')), $data);
                    File::put(app_path('Http/Controllers/'.ucfirst($this->argument('section')).'/views/admin/'.strtolower($this->argument('name')).'/'.File::name($templateFile).'.blade.php'), $data);
                    $this->info('Admin '.File::name($templateFile).' view created successfully.');
                }
            }
        }else {
            foreach(File::files(__DIR__.'/Template/View/Admin') as $templateFile) {
                if(File::exists(app_path('Http/Controllers/'.ucfirst($this->argument('section')).'/views/admin/'.strtolower($this->argument('name')).'/'.File::name($templateFile).'.blade.php'))) {
                    $this->error('Admin '.File::name($templateFile).' view already exists.');
                }else {
                    $data = File::get(__DIR__.'/Template/View/Admin/'.File::name($templateFile));
                    $data = str_replace('{{{section}}}', ucfirst($this->argument('section')), $data);
                    $data = str_replace('{{{name}}}', strtolower($this->argument('name')), $data);
                    $data = str_replace('{{{controller}}}', ucfirst($this->argument('controller')), $data);
                    $data = str_replace('{{{title}}}', $this->argument('title'), $data);
                    File::put(app_path('Http/Controllers/'.ucfirst($this->argument('section')).'/views/admin/'.strtolower($this->argument('name')).'/'.File::name($templateFile).'.blade.php'), $data);
                    $this->info('Admin '.File::name($templateFile).' view created successfully.');
                }
            }
        }
    }
}
