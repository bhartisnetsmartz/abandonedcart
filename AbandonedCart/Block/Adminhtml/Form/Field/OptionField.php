<?php
namespace Ntz\AbandonedCart\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;

class OptionField extends Select
{
    /**
     * {@inheritdoc}
     */
    protected function _toHtml()
    {
        if (!$this->getOptions()) {

            $options = [
                [
                    'value' => 1,
                    'label' => 'General Contact'
                ],
                [
                    'value' => 2,
                    'label' => 'Sales Representative'
                ],
                [
                    'value' => 3,
                    'label' => 'Customer Support'
                ],
                [
                    'value' => 4,
                    'label' => 'Custom Email 1'
                ],
                [
                    'value' => 5,
                    'label' => 'Custom Email 2'
                ]

            ];
            $this->setOptions($options);
        }

        return parent::_toHtml();
    }

    /**
     * Sets name for input element
     *
     * @param string $value
     * @return $this
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }
}
