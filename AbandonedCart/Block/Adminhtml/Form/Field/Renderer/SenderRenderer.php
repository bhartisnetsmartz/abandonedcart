<?php
namespace Ntz\AbandonedCart\Block\Adminhtml\Form\Field\Renderer;

use Magento\Framework\View\Element\Html\Select;
use Magento\Config\Block\System\Config\Form\Field;

class SenderRenderer extends Select
{
    /**
     * @var \Magento\Config\Model\Config\Source\Email\Identity
     */
    protected $identitySource;

    /**
     * SenderRenderer constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Config\Model\Config\Source\Email\Identity $identitySource
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Config\Model\Config\Source\Email\Identity $identitySource,
        array $data = []
    ) {
        $this->identitySource = $identitySource;
        parent::__construct($context, $data);
    }

    /**
     * Render select HTML
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     *
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $options = $this->identitySource->toOptionArray();
        $element->setValues($options);
        return parent::render($element);
    }
}
