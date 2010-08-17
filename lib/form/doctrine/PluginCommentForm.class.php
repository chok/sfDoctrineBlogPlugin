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

    $this->widgetSchema->setLabels(array(
      'content' => 'Message',
      'title'   => 'Titre'
      ));

    unset($this['created_at'], $this['updated_at']);
  }

  public function doUpdateObject($values)
  {
    parent::doUpdateObject($values);

    $this->object->setUser($this->user);
    $this->object->setPostId($this->post->getId());

  }
}
