<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateRepository extends Command
{
    // protected $signature = "generate:repository {name} {-b|--base} {--module=}";

    protected function configure()
    {
        $this
            ->setName("generate:repository")
            ->setDescription("Generate repository and interface files")
            ->addArgument("name", InputArgument::OPTIONAL, "The name of the class")
            ->addOption("module", "m", InputOption::VALUE_OPTIONAL, "The module of this class")
            ->addOption("base", "b", null, "To extend base class");
    }

    public function handle()
    {
        $className = $this->argument("name");
        $moduleName = $this->option("module");
        $baseName = $this->option("base");

        $baseInterfaceImport = $baseName ? "use App\\Contracts\\BaseRepositoryInterface;\n\n" : "";
        $baseInterfaceExtend = $baseName ? " extends BaseRepositoryInterface": "";
        $baseRepositoryImport = $baseName ? "use App\\Repositories\\BaseRepository;\n" : "";
        $baseRepositoryExtend = $baseName ? " extends BaseRepository": "";

        if ($moduleName) {
            $contractLocation = "Modules/{$moduleName}/Contracts";
            if (!file_exists($contractLocation)) {
                mkdir($contractLocation, 0755, true);
            }
            $contractFileName = "{$className}RepositoryInterface.php";
            $contractContent = "<?php\n\nnamespace Modules\\{$moduleName}\\Contracts;\n\n{$baseInterfaceImport}interface {$className}RepositoryInterface{$baseInterfaceExtend}\n{\n    //\n}\n";
            file_put_contents("$contractLocation/$contractFileName", $contractContent);

            $repositoryLocation = "Modules/{$moduleName}/Repositories";
            if (!file_exists($repositoryLocation)) {
                mkdir($repositoryLocation, 0755, true);
            }
            $repositoryFileName = "{$className}Repository.php";
            $repositoryContent = "<?php\n\nnamespace Modules\\{$moduleName}\\Repositories;\n\n{$baseRepositoryImport}use Modules\\{$moduleName}\\Contracts\\{$className}RepositoryInterface;\n\nclass {$className}Repository{$baseRepositoryExtend} implements {$className}RepositoryInterface\n{\n    //\n}\n";
            file_put_contents($repositoryLocation . "/" . $repositoryFileName, $repositoryContent);
        } else {
            $contractLocation = "app/Contracts";
            if (!file_exists($contractLocation)) {
                mkdir($contractLocation, 0755, true);
            }
            $contractFileName = $className . "RepositoryInterface.php";
            $contractContent = "<?php\n\nnamespace App\\Contracts;\n\n{$baseInterfaceImport}interface {$className}RepositoryInterface{$baseInterfaceExtend}\n{\n    //\n}\n";
            file_put_contents($contractLocation . "/" . $contractFileName, $contractContent);

            $repositoryLocation = "app/Repositories";
            if (!file_exists($repositoryLocation)) {
                mkdir($repositoryLocation, 0755, true);
            }
            $repositoryFileName = "{$className}Repository.php";
            $repositoryContent = "<?php\n\nnamespace App\\Repositories;\n\n{$baseRepositoryImport}use App\\Contracts\\{$className}RepositoryInterface;\n\nclass {$className}Repository{$baseRepositoryExtend} implements {$className}RepositoryInterface\n{\n    //\n}\n";
            file_put_contents("$repositoryLocation/$repositoryFileName", $repositoryContent);
        }

        $this->info("Interface created: {$contractLocation}/$contractFileName");
        $this->info("Repository created: {$repositoryLocation}/$repositoryFileName");
    }
}
