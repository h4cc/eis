<?php

namespace Craue\ConfigBundle\Form\Type;

use Craue\ConfigBundle\Entity\Setting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Craue\ConfigBundle\Form\DataTransformer\ObjectToNumberTransformer;
use Doctrine\ORM\EntityManager;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class SettingType extends AbstractType {
	/**
	 * {@inheritDoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('name', 'hidden');
		$builder->add('section', 'hidden');

//        $factory = $builder->getFormFactory();

        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) use ($builder) {
            $form = $event->getForm();
            $data = $event->getData();

            if ($data) {
                if ($data->getType() == 'entity') {
                    $form->add(
                        'value', 'entity_object', array_merge(
                            $data->getTypeOptions(),
                            array('required'=>false)
                        )
                    );
                }
                else {
                    $form->add('value', $data->getType(), array_merge(
                        $data->getTypeOptions(),
                        array('required'=>false)
                    ));
                }
            }
            else {
                $form->add('value', null, array(
                        'required'=>false
                ));
            }


        });

	}

	/**
	 * {@inheritDoc}
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => get_class(new Setting()),
		));
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName() {
		return 'craue_config_setting';
	}

}
