<?php $this->renderPartial('//content/all', array(
	'data' => $data, 
	'pages' => $pages, 
	'url' => $category->slug,
	'md' => new CMarkdownParser
)); ?>