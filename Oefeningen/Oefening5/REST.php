<?
/**
 * Created by PhpStorm.
 * User: Owain
 * Date: 09/11/14
 * Time: 19:50
 */

class REST {
    /**
     * @var
     */
    public $method;

    /**
     *
     */
    public function REST() {
        // Lees de HTTP method
        $this->method = $this->getMethod();
    }

    /**
     * @return string
     */
    private function getMethod() {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }
}