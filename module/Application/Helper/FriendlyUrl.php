<?php
namespace Application\Helper;
use Zend\View\Helper\AbstractHelper;

class FriendlyUrl extends AbstractHelper
{
    public function __invoke($string, $seperator='-')
    {   
        $slug = strtolower($string);
        $find = array('Ã¡', 'Ã©', 'Ã­', 'Ã³', 'Ãº', 'Ã±', 'Ã�', 'Ã‰' , 'Ã“', 'ú', 'á', 'é', 'í', 'ó', 'ñ');
        $repl = array('a', 'e', 'i', 'o', 'u', 'n' , 'a', 'e', 'o', 'u', 'a', 'e', 'i', 'o','n');
        $slug = str_replace ($find, $repl, $slug);
        $find = array(' ', '&', '\r\n', '\n', '+', ':');
        $slug = str_replace ($find, $seperator, $slug);
        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
        $repl = array('', $seperator, '');
        $slug = preg_replace ($find, $repl, $slug);
        return $slug;
    }
}
