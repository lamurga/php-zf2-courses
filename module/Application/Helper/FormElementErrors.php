<?php
// http://stackoverflow.com/questions/13765662/add-class-attribute-to-form-errors
namespace Application\Helper;
 
use Zend\Form\View\Helper\FormElementErrors as OriginalFormElementErrors;

class FormElementErrors extends OriginalFormElementErrors  
{
    protected $messageCloseString     = '</label>';
    protected $messageOpenFormat      = '<label class="error">';
    protected $messageSeparatorString = '</label><label class="error">';
}