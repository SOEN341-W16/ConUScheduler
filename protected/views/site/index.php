<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>
    Welcome to
    <?php
    echo CHtml::encode(Yii::app()->name);
    if(Yii::app()->user->isGuest == false)
        echo(", ".Yii::app()->user->name);
    ?>!
</h1>
<?php if(Yii::app()->user->isGuest) {?>
    <div class="login">Please
        <?php echo(CHtml::link('click here',array('site/login'))); ?>
        to log in.
    </div>
<?php }
else
    echo("Click the 'Schedule Planner' tab to get started.");
?>
<?php if(isset($_GET["logout"]) && $_GET["logout"]==1)
{?>
    <div class="logoutSuccess">You have successfully logged out!</div>
<?php } ?>

<div id="logo"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/logo.jpg', "logo"); ?></div>

<!--
<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p> -->
