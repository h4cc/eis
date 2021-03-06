<?php

namespace Teclliure\InvoiceBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Teclliure\InvoiceBundle\Form\Type\CommonType;

class DeliveryNoteSubType extends CommonType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('footnote');
        $builder->add('contact_name');
        $builder->add('contact_email');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Teclliure\InvoiceBundle\Entity\DeliveryNote'
        ));
    }

    public function getName()
    {
        return 'deliveryNoteSub';
    }
}
