<?php

namespace App\FileGenerator\Stubs;

class BitrixInfoblockStub extends BitrixModelStub
{
    protected string $biitrixPropertiesStub = '
    
    /** PROPERTIES */
    {{bitrixProperties}}
    /** END PROPERTIES */
    
    ';

    public function generateStub(): string
    {
        return
"<?php

namespace {{namespace}};
use {{parentNamespace}};

class {{class}} extends {{parentClass}}
{
" .
    $this->getBitrixProperiesStub()
    
    . "\n\tprotected" . ' $symbolCode = {{symbolCode}};
    protected $infoblockId = {{infoblockId}};
}';
    }

    public function getBitrixProperiesStub(): string
    {
        return $this->biitrixPropertiesStub;
    }
}