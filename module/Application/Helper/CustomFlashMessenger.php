<?php
namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Controller\Plugin\FlashMessenger as FlashMessenger;

/**
 * @author Macks <@macks_>
 * @company Dtp Groovy Web Solutions
 */

class CustomFlashMessenger extends AbstractHelper
{
    /**
     * @var FlashMessenger
     */
    protected $flashMessenger;
 
    public function setFlashMessenger(FlashMessenger $flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;
    }

    public function __invoke( )
    {
        $namespaces = array('error' ,'success', 'info','warning');

         // messages as string
         $messageString = '';
         foreach ($namespaces as $ns) {
            $this->flashMessenger->setNamespace($ns);
            $messages = $this->flashMessenger->getCurrentMessages();
            if ($messages){
                foreach ($messages as $message) {
                    $messageString .= "<div id = 'msg' class='container'><div class='$ns'>".$message."</div></div>";
                }
            }
        }

        //var_dump($messageString);
        return $messageString ;
    }
}
?>