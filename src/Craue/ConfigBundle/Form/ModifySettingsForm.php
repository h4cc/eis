<?php

namespace Craue\ConfigBundle\Form;

use Craue\ConfigBundle\Form\Type\SettingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class ModifySettingsForm extends AbstractType {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

	/**
	 * {@inheritDoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('settings', 'collection', array(
			'type' => new SettingType($this->em),
		));
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName() {
		return 'craue_config_modifySettings';
	}

}
