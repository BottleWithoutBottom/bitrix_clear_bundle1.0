<?php

namespace App\FileGenerator\Stubs;

class BitrixInfoblockStub extends BitrixModelStub
{
    public function generateStub(): string
    {
        return
'<?php

namespace {{namespace}};
use {{parentNamespace}};

class {{class}} extends {{parentClass}}
{
    /** PROPERTIES */
    {{bitrixProperties}}
    /** END PROPERTIES */
    
    protected $symbolCode = {{symbolCode}};
    protected $infoblockId = {{infoblockId}};
}
';
    }
}