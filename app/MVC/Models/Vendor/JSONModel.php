<?

namespace App\MVC\Models\Vendor;

class JSONModel extends Response
{
    private $status = false;
    private $data = [];

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getAsString()
    {
        return json_encode([
            'status' => $this->getStatus(),
            'data' => $this->getData(),
        ]);
    }
}