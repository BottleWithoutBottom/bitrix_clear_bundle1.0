<?

namespace App\FileGenerator\GenetratorCommand;

use App\FileGenerator\Prototypes\AbstractPrototype;
use App\FileGenerator\Stubs\AbstractStub;

abstract class AbstractGeneratorCommand
{
    protected $prototype;
    protected $stub;

    public function __construct(
        AbstractStub $stub,
        AbstractPrototype $prototype
    )
    {
        $this->prototype = $prototype;
        $this->stub = $stub;
    }

    abstract public function execute($params);
}