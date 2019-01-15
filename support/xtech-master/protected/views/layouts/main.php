<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/scripts.js',CClientScript::POS_HEAD);?>
	<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/styles.css');?>

    <?php
        $sfOptions = '{delay:300,speed:"fast"}';
        Yii::app()->clientScript->registerScript('sf-menu',
            '$("ul.sf-menu").superfish('.$sfOptions.');',
            CClientScript::POS_READY);
    ?>
</head>

<body>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

    <div id="m-menu">
        <?php
        $this->widget('ext.CDropDownMenu.CDropDownMenu',array(
                'style' => 'default', // or default or navbar
                'items'=>array(
                    array(
                        'label'=>'Головна',
                        'url'=>array('/'),
                        'visible'=>Yii::app()->user->isGuest,
                    ),
                    array(
                        'label'=>'Звіти',
                        //'url'=>array('//reports/index'),
                        'url'=>array('#'),
                        'visible'=>Yii::app()->user->isGuest,
                        'items' => array(
                            array(
                                'label'=>'Конструктор',
                                'url'=>array('//reports/construct'),
                            ),
                            array(
                                'label'=>'Картки',
                                'url'=>array('site/underconstruct'),
                            ),
                        ),
                    ),
                    array(
                        'label'=>'Довідники',
                        //'url'=>array('//directory/index'),
                        'url'=>array('#'),
                        'visible'=>Yii::app()->user->isGuest,
                        'items' => array(
                            array(
                                'label'=>'Працівники',
                                'url'=>array('//employee/admin'),
								'items'=>array(
									array(
										'label'=>'Додати працівника',
										'url'=>array('//employee/create&parent='),
									)
								)
                            ),
                            array(
                                'label'=>'Типи пристроїв',
                                'url'=>array('//deviceType/admin'),
								'items'=>array(
									array(
										'label'=>'Додати тип пристроїв',
										'url'=>array('//deviceType/create'),
									)
								)
                            )
                        ),
                    ),
                    array(
                        'label'=>'Адміністрування',
                        'visible'=>Yii::app()->user->isGuest,
                        //'url'=>array('admin/index'),
                        'url'=>array('site/underconstruct'),
                    ),
                    array(
                        'label'=>'Вхід',
                        'url'=>array('/login'),
                        'visible'=>Yii::app()->user->isGuest,
                    ),
                    array('label'=>'Вихід ('.Yii::app()->user->name.')',
                         'url'=>array('/logout'),
                         'visible'=>!Yii::app()->user->isGuest,
                    ),
                    )
                )
             );
        ?>
    </div>

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <a href="mailto:sinelnikovodima@mail.ru">JazzzDima</a><br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
