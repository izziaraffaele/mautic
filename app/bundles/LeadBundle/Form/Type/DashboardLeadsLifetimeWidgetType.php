<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\LeadBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Mautic\CoreBundle\Factory\MauticFactory;

/**
 * Class DashboardLeadsInTimeWidgetType
 *
 * @package Mautic\LeadBundle\Form\Type
 */
class DashboardLeadsLifetimeWidgetType extends AbstractType
{
    /**
     * @var MauticFactory
     */
    private $factory;

    public function __construct(MauticFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $model  = $this->factory->getModel('lead.list');

        $lists = $model->getUserLists();
        $segments = array();
        $segments[0]= $this->factory->getTranslator()->trans('mautic.lead.all.leads');
        foreach ($lists as $list) {
            $segments[$list['id']] = $list['name'];
        }

        $builder->add('flag', 'choice', array(
                'label'   => 'mautic.lead.list.filter',
                'multiple'   => true,
                'choices' => $segments,
                'label_attr' => array('class' => 'control-label'),
                'attr'       => array('class' => 'form-control'),
                'required'   => false
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "lead_dashboard_leads_lifetime_widget";
    }
}
