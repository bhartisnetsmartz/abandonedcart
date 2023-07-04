<?php
namespace Ntz\AbandonedCart\Model\Config\Source\Email;

use Magento\Framework\View\Element\Template\Context as TemplateContext;
class Template extends \Magento\Config\Model\Config\Source\Email\Template
{

    public function toOptionArray()
    {
        $options = parent::toOptionArray();
        $filteredOptions = [];
        foreach ($options as $option) {
            
            if (str_contains($option['label'], 'Abandoned')) {
                //str_contains($option['label'], 'Abandoned');
                $filteredOptions[] = $option;
            }
        }
     
        return $filteredOptions;
    }
}

