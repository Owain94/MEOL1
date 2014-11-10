<?

/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 09/11/14
 * Time: 19:50
 * @property mixed method
 * @property mixed command
 * @property mixed id
 */
class REST
{
    /**
     * @var
     */
    private $command;
    /**
     * @var
     */
    private $id;

    /**
     * @param $command
     * @param $id
     */
    public function __construct($command, $id)
    {
        $this->command = $command;
        $this->id = $id;
    }

    /**
     * @param $name
     * @return mixed|string
     */
    public function __get($name)
    {
        switch ($name) {
            case 'method':
                return $this->getMethod();

            case 'command':
                return $this->getCommand();

            case 'id':
                return $this->getId();

        }
        return 'Not valid';
    }

    /**
     * @return string
     */
    private function getMethod()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return mixed
     */
    private function getCommand()
    {
        return $this->command;
    }

    /**
     * @return mixed
     */
    private function getId()
    {
        return $this->id;
    }
}