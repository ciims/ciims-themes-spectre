<div class="login-container">
	<h1 class="content-subhead"><?php echo Yii::t('SpectreTheme', 'Login to Your Account'); ?></h1>
		<?php $form=$this->beginWidget('CActiveForm', array(
				'id'					=>	'login-form',
				'focus'					=>'	input[type="text"]:first',
				'enableAjaxValidation'	=>	true,
				'htmlOptions' => array(
					'class' => 'pure-form pure-form-stacked'
				)
			)); ?>
		<fieldset>
			<div class="login-form-container">
				<?php if (!Yii::app()->user->isGuest): ?>
					<div class="alert alert-info" style="margin-top: 20px;">
					  	<?php echo Yii::t('SpectreTheme', "{{headsup}} Looks like you're already logged in as {{email}}. You should {{logout}} before logging in to another account.", array(
						  		'{{headsup}}' => CHtml::tag('strong', array(), Yii::t('SpectreTheme', 'Heads Up!')),
						  		'{{email}}'   => CHtml::tag('strong', array(), Yii::app()->user->email),
						  		'{{logout}}'  => CHtml::tag('strong', array(), CHtml::link(Yii::t('SpectreTheme', 'logout'), $this->createUrl('/logout')))
						  	)); ?>
					 </div>
				<?php else: ?>
					<?php if ($model->hasErrors()): ?>
						<div class="alert alert-error" style="margin-bottom: -5px;">
						  	<?php echo Yii::t('SpectreTheme', "{{oops}} We weren't able to log you in using the provided credentials.", array(
						  		'{{oops}}' => CHtml::tag('strong', array(), Yii::t('SpectreTheme', 'Oops!'))
						  	)); ?>
						</div>
					<?php endif; ?>
					<?php echo $form->TextField($model, 'username', array('id'=>'email', 'placeholder'=>Yii::t('SpectreTheme', 'Email Address'))); ?>
					<?php echo $form->PasswordField($model, 'password', array('id'=>'password', 'placeholder'=>Yii::t('SpectreTheme', 'Password'))); ?>
				</div>

				<div class="login-form-footer">
					<?php echo CHtml::link(Yii::t('SpectreTheme', 'register'), Yii::app()->createUrl('/register'), array('class' => 'login-form-links')); ?>
					<span class="login-form-links"> | </span>
					<?php echo CHtml::link(Yii::t('SpectreTheme', 'forgot'), Yii::app()->createUrl('/forgot'), array('class' => 'login-form-links')); ?>
					<?php echo CHtml::tag('button', array('type' => 'submit', 'id' => 'submit-comment', 'class' => 'pure-button pure-button-primary pure-button-xsmall pull-right'), Yii::t('SpectreTheme', 'Submit')); ?>
	            <?php endif; ?>

	            <?php if (Yii::app()->user->isGuest): ?>
	            	<?php $numberOfEnabledProviders = 0; ?>
	            	<?php foreach (Cii::getHybridAuthProviders() as $k=>$v): ?>
	            		<?php if (Cii::get($v, 'enabled', false) == 1): ?>
	            			<?php $numberOfEnabledProviders++; ?>
	            		<?php endif; ?>
	            	<?php endforeach; ?>
		            <?php if (count(Cii::getHybridAuthProviders()) >= 1 && $numberOfEnabledProviders > 0): ?>
		            <div class="clearfix" style="border-bottom: 1px solid #aaa; margin: 15px;"></div>
						<span class="login-form-links"><?php echo Yii::t('SpectreTheme', 'Or sign in with one of these social networks'); ?></span>
		        	<?php endif; ?>
		        	<div class="clearfix"></div>
		        	<div class="social-buttons">
	    	            <?php foreach (Cii::getHybridAuthProviders() as $k=>$v): ?>
							<?php if (Cii::get($v, 'enabled', false) == 1): ?>
								<?php echo CHtml::link(NULL, $this->createUrl('/hybridauth/'.$k), array('class' => 'social-icons ' . strtolower($k))); ?>
							<?php endif; ?>
	    	        	<?php endforeach; ?>
	    	        </div>
	    	    <?php endif; ?>
			</div>
		</fieldset>
	<?php $this->endWidget(); ?>
</div>