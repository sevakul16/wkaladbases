<?php
require 'vendor/autoload.php';
$app = new \atk4\ui\App ('Lol');
$app->initLayout('Centered');

$db = new \atk4\data\Persistence_SQL('mysql:dbname=party;host=localhost;','root','');

Class Friends extends \atk4\data\Model {
public $table = 'friends';
function init() {
  parent::init();
  $this-> addField('name');
  $this-> addField('surname');
  $this-> addField('phone');
  $this->hasMany('Guests',new Guests);
}
}

Class Guests extends \atk4\data\Model {
  public $table = 'guests';
  function init() {
    parent::init();
    $this -> addField('name');
    $this -> addField ('surname');
    $this -> addField('time',['type'=>'time']);
    $this-> hasOne('friends_id',new Friends);
  }
}

$image =$app->add(['Image','https://d2v9y0dukr6mq2.cloudfront.net/video/thumbnail/HyHN52ecxizn4mx5k/videoblocks-hookah-hot-coals-on-shisha-bowl-making-clouds-of-steam-at-arabian-interior-oriental-ornament-on-the-carpet-stylish-oriental-shisha-in-dark-with-backlight-shisha-on-rotating-display-slider-shot_si0p1nk5f_thumbnail-small01.jpg']);

$form = $app ->layout->add('Form');
$form->setModel(new Friends($db));

$form->onSubmit(function($form) {
  $form->model->save();
  return $form->success ('Congrats');
});

$grid = $app->add('Grid');
$grid->setModel(new Friends($db));
$form2 = $app->layout ->add('Form');
$form2 ->setModel(new Guests($db));
