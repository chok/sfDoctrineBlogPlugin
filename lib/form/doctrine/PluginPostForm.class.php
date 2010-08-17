<?php

/**
 * PluginPost form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginPostForm extends BasePostForm
{
  public function setup()
  {
    parent::setup();

    if(class_exists('sfWidgetFormTextareaTinyMCE'))
    {
      $this->widgetSchema['content'] = new sfWidgetFormTextareaTinyMCE(array(
                                                                              'width'  => 550,
                                                                              'height' => 350,
                                                                              //'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
                                                                            ));
    }


    if(class_exists('sfWidgetFormJQueryDate'))
    {
      $this->widgetSchema['created_at'] = new sfWidgetFormJQueryDate();
      $this->widgetSchema['updated_at'] = new sfWidgetFormJQueryDate();

      $this->validatorSchema['created_at'] = new sfValidatorDateTime(array('required' => false));
      $this->validatorSchema['updated_at'] = new sfValidatorDateTime(array('required' => false));
    }
  }

  public function configure()
  {

  }
}
