<?php
namespace Ntz\AbandonedCart\Block\Adminhtml\Form\Field;

use \Ntz\AbandonedCart\Block\Adminhtml\Form\Field\Renderer\SenderRenderer;
use \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use \Magento\Framework\DataObject;

class EmailSetting extends AbstractFieldArray
{
    protected $optionField;

    protected function _prepareToRender()
    {
        $this->addColumn('custom_option', ['label' => __('Send After'), 'class' => 'required-entry']);
        
        $this->addColumn('sender_option', [
            'label' => __('Sender'),
            'renderer' => $this->getOptionField(),
            // 'renderer' => \Ntz\AbandonedCart\Block\Adminhtml\Form\Field\Renderer\SenderRenderer::class,  
        ]);
        $this->addColumn('email_temp', [
            'label' => __('Email Temptate'),
            'renderer' => $this->getOptionField(),
        ]);
        $this->addColumn('has_coupon', [
            'label' => __('Has Coupon'),
            'renderer' => $this->getOptionField(),
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
    /**
     * @return \SR\MagentoCommunity\Block\Adminhtml\Form\Field\OptionField
     */
    protected function getOptionField()
    {
        if (!$this->optionField) {
            $this->optionField = $this->getLayout()->createBlock(
                OptionField::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }

        return $this->optionField;
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @return void
     */
    protected function _prepareArrayRow(DataObject $row)
    {
        $availabilityOption = $row->getAvailabilityOption();
        $options = [];
        if ($availabilityOption) {
            $options['option_' . $this->getOptionField()->calcOptionHash($availabilityOption)]
                = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }
}
