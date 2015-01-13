<div class="content pure-u-1 about-container">

	<?php 
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>";
    }
    ?>
	<?php if (!Yii::app()->user->isGuest): ?>
		<div class="pure-menu-open pure-menu-horizontal pull-right">
		    <ul>
		        <li><?php echo CHtml::link(Yii::t('themes.spectre.main', 'edit'), $this->createUrl('profile/edit')); ?></li>
		    </ul>
		</div>
		
		<div class="clearfix"></div>
		<hr />
	<?php endif; ?>

	<div class="post pure-u-1-2 pull-left container-50">
		<div class="post-inner">
			<h2><?php echo $model->name; ?></h2>
			<div class=" pure-u-1-2 pull-left photo-container">
				
				<?php echo CHtml::image($model->gravatarImage(100), NULL, array('class' => 'about-photo')); ?>
			</div>
			<div class=" pure-u-1-2 pull-left">
				<dl>
					<div class="dl-container">
						<dt><?php echo Yii::t('themes.spectre.main', 'Display Name'); ?></dt>
						<dd><?php echo $model->displayName; ?></dd>
					</div>

					<div class="dl-container">
						<dt><?php echo Yii::t('themes.spectre.main', 'Reputation'); ?></dt>
						<dd><?php echo $model->getReputation(); ?></dd>
					</div>

					<div class="dl-container">
						<dt><?php echo Yii::t('themes.spectre.main', 'Registered'); ?></dt>
						<dd><?php echo Cii::timeago($model->created); ?></dd>
					</div>			
				</dl>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="post pure-u-1-2 pull-right container-50">
		<div class="post-inner">
			<h2><?php echo Yii::t('themes.spectre.main', 'About'); ?></h2>
			<?php if ($model->about == ''): ?>
				<p class="alert alert-info"><?php echo Yii::t('themes.spectre.main', 'This user has not provided any information for themselves.'); ?></p>
			<?php else: ?>
				<?php echo $md->safeTransform(strip_tags($model->about)); ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<!-- Content Generated by the user -->
<div class="content pure-u-1  about-container">
	<?php $contentCount = Content::model()->countByAttributes(array('author_id' => $model->id)); ?>

	<?php if ($contentCount > 0): ?>
		<!-- Display Recent Posts by this User -->
		<div class="post pure-u-1-2 pull-left container-50">
			<div class="post-inner">
				<h2><?php echo Yii::t('themes.spectre.main', 'Recent Posts'); ?></h2>
				<?php 
					$content = new Content;
					$criteria = $content->getBaseCriteria();
					$criteria->addCondition('author_id = :author_id');
					$criteria->params = array(':author_id' => $model->id);
					$content = $content->findAll($criteria, array('order' => 'created ASC', 'limit' => 5)); 
				?>
				<dl>
					<?php foreach ($content as $item): ?>
						<div class="dl-container">
							<dt><?php echo Cii::timeago($item->created); ?></dt>
							<dd><?php echo CHtml::link($item->title, $this->createUrl($item->slug)); ?></dd>							
						</div>
					<?php endforeach; ?>
				</dl>
			</div>
		</div>
	<?php endif; ?>

	<?php if (Cii::getCommentProvider() == 'CiiComments'): ?>
		<!-- Show this section only if we are using CiiComments -->
		<div class="post pure-u-1-2 pull-right container-50">
			<div class="post-inner">
				<h2><?php echo Yii::t('themes.spectre.main', 'Recent Comments'); ?> </h2>
				<div class="ciims-comments" id="ciims_comments">
					<div class="loader fa fa-spinner fa-spin"></div>
				</div>
				<?php Yii::app()->clientScript->registerScript('getUserComments', "Theme.profileComments($model->id)"); ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>