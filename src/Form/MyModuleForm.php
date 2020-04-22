<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Form\Formbase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\Messenger\MessengerTrait;

class MyModuleForm extends FormBase {
  public function getFormId() {
    return 'my_module_new_form';
  }
    
  public function buildForm(array $form, FormStateInterface $form_state) { 
    $node_types = \Drupal\node\Entity\NodeType::loadMultiple();
    $options = [];
    foreach ($node_types as $node_type) {
      $options[$node_type->id()] = $node_type->label();
    }
    $form['mynodes'] = [
      '#title' => t('Enter the number'),
      '#type' => 'number',
      '#required' => TRUE,
    ];
	$form['contenttypes'] = [
	  '#title' => t('Select any of the content types'),
	  '#type' => 'select',
	  '#options' => $options,
	  '#required' => TRUE,
	];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit'),
    ];
    $form['nid'] = [
      '#type' => 'hidden',
      '#value' => $nid,
    ];
    return $form;
  }
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $value = $form_state->getValue('mynodes');
	$x=0;
	while($x<$value){
	  $node = Node::create([
              'type' => 'Article',
              'title' => 'My Node',
              'langcode' => 'en',
              'uid' => '1',
              'status' => 1,
              'field_fields' => array(),
            ]);
			$node->save();
	  $x++; 
    }
	$this->messenger()->addMessage('Success');
  }
}
   
