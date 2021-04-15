<?php

namespace App\FileGenerator\Stubs;

class BitrixInfoblockStub extends BitrixModelStub
{
    public function generateStub()
    {
        return
'<?php

namespace {{namespaceStub}};
use {{parentClassNamespaceStub}};

class {{classNameStub}} extends {{parentClassStub}}
{
    /** PROPERTIES */
    {{propertiesStub}}
    /** END PROPERTIES */
    
    protected $symbolCode = {{symbolCodeStub}};
    protected $infoblockId = {{infoblockIdStub}};
}
';
    }
}