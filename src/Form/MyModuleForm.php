<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\Formbase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;


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
     $form['NODES'] = array(
       '#title' => t('Enter the number'),
       '#type' => 'number',
       '#required' => TRUE,
    );
	$form['contenttypes'] = array(
	  '#title' => t('Select any of the content types'),
	  '#type' => 'select',
	  '#options' => $options,
	);
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    $form['nid'] = array(
      '#type' => 'hidden',
      '#value' => $nid,
    );
    return $form;
  }
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message(t('This is working.'));
	
    $value = $form_state->getValue('NODES');
	$x=0;
	while($x<$value){
	  $node = Node::create(array(
              'type' => 'Article',
              'title' => 'My Node',
              'langcode' => 'en',
              'uid' => '1',
              'status' => 1,
              'field_fields' => array(),
            ));
			$node->save();
	  $x++; 
            

	
    }
  }
}
   
