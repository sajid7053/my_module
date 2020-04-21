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
    $list = array(0 => 'Select' , 1 => 'Article' , 2 => 'Basic page');
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->nid->value;
    $form['NODES'] = array(
      '#title' => t('Enter the number'),
      '#type' => 'number',
      '#required' => TRUE,
    );
	$form['contenttypes'] = array(
	  '#type' => 'select',
	  '#title' => t('Select the content types'),
	  '#options' => $list,
	 '#required' => TRUE,
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
	$x=1;
	while($x <= $value {
	  $node = Node::create(array(
          'type' => 'your_content_type',
          'title' => 'your title',
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
   
