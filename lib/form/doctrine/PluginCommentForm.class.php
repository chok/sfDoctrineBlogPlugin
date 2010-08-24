<?php

/**
 * PluginComment form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginCommentForm extends BaseCommentForm
{
  protected $user;
  protected $post;

  public function __construct($post = NULL,$user = NULL,$object = null, $options = array(), $CSRFSecret = null)
  {
    $this->post = $post;
    $this->user = $user;

    parent::__construct($object,$options,$CSRFSecret);
  }

  public function setup()
  {
    parent::setup();

    $this->validatorSchema['username']->setOption('required', true);
    $this->validatorSchema['mail'] = new sfValidatorEmail(array('required' => true));
    $this->validatorSchema['website'] = new sfValidatorUrl(array('required' => false));
    $this->validatorSchema['content']->setOption('required', true);

    $this->widgetSchema->setLabels(array(
      'content' => 'Message',
      'title'   => 'Titre',
      'username' => 'Name (required)',
      'mail'    => 'Mail (required not published)',
      'website' => 'Website'
      ));

    if($this->user)
    {
      unset($this['username']);
    }

    unset($this['created_at'], $this['updated_at']);
  }

  public function doUpdateObject($values)
  {
    parent::doUpdateObject($values);

    if($this->user)
    {
      $this->object->setUser($this->user);
      $this->object->setUsername($this->user->getUsername());
    }

    $this->object->setPostId($this->post->getId());
  }
}
