<?

namespace App\FileGenerator\GenetratorCommand;

use App\FileGenerator\Generator\AbstractGenerator;
use App\FileGenerator\Prototypes\AbstractPrototype;
use App\FileGenerator\Stubs\AbstractStub;

abstract class AbstractGeneratorCommand
{
    protected $prototype;
    protected $stub;
    protected $generator;

    public function __construct(
        AbstractStub $stub,
        AbstractPrototype $prototype,
        string $generatorClassName
    )
    {
        $this->prototype = $prototype;
        $this->stub = $stub;
        $this->generator = new $generatorClassName($prototype, $stub);
    }

    abstract public function execute($params);
}