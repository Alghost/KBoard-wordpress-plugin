<div id="kboard-document">
	<div id="kboard-thumbnail-document">
		<div class="kboard-document-wrap" itemscope itemtype="http://schema.org/Article">
			<div class="kboard-title" itemprop="name">
				<p><?php echo $content->title?></p>
			</div>
			
			<div class="kboard-detail">
				<?php if($content->category1):?>
				<div class="detail-attr detail-category1">
					<div class="detail-name"><?php echo $content->category1?></div>
				</div>
				<?php endif?>
				<?php if($content->category2):?>
				<div class="detail-attr detail-category2">
					<div class="detail-name"><?php echo $content->category2?></div>
				</div>
				<?php endif?>
				<div class="detail-attr detail-writer">
					<div class="detail-name"><?php echo __('Author', 'kboard')?></div>
					<div class="detail-value"><?php echo $content->member_display?></div>
				</div>
				<div class="detail-attr detail-date">
					<div class="detail-name"><?php echo __('Date', 'kboard')?></div>
					<div class="detail-value"><?php echo date('Y-m-d H:i', strtotime($content->date))?></div>
				</div>
				<div class="detail-attr detail-view">
					<div class="detail-name"><?php echo __('Views', 'kboard')?></div>
					<div class="detail-value"><?php echo $content->view?></div>
				</div>
			</div>
			
			<div class="kboard-content" itemprop="description">
				<div class="content-view">
					<?php echo $content->content?>
				</div>
			</div>
			
			<?php foreach($content->attach as $key=>$attach):?>
			<div class="kboard-attach">
				<?php echo __('Attachment', 'kboard')?> : <a href="<?php echo $url->getDownloadURLWithAttach($content->uid, $key)?>"><?php echo $attach[1]?></a>
			</div>
			<?php endforeach?>
		</div>
		
		<?php if($content->visibleComments()):?>
		<div class="kboard-comments-area"><?php echo $board->buildComment($content->uid)?></div>
		<?php endif?>
		
		<div class="kboard-document-navi">
			<div class="kboard-prev-document">
				<?php
				$bottom_content_uid = $content->getPrevUID();
				if($bottom_content_uid):
				$bottom_content = new KBContent();
				$bottom_content->initWithUID($bottom_content_uid);
				?>
				<a href="<?php echo $url->getDocumentURLWithUID($bottom_content_uid)?>">
					<span class="navi-arrow">«</span>
					<span class="navi-document-title kboard-thumbnail-cut-strings"><?php echo $bottom_content->title?></span>
				</a>
				<?php endif?>
			</div>
			
			<div class="kboard-next-document">
				<?php
				$top_content_uid = $content->getNextUID();
				if($top_content_uid):
				$top_content = new KBContent();
				$top_content->initWithUID($top_content_uid);
				?>
				<a href="<?php echo $url->getDocumentURLWithUID($top_content_uid)?>">
					<span class="navi-document-title kboard-thumbnail-cut-strings"><?php echo $top_content->title?></span>
					<span class="navi-arrow">»</span>
				</a>
				<?php endif?>
			</div>
		</div>
		
		<div class="kboard-control">
			<div class="left">
				<a href="<?php echo $url->toString()?>" class="kboard-thumbnail-button-small"><?php echo __('List', 'kboard')?></a>
				<?php if($board->isWriter() && !$content->notice):?><a href="<?php echo $url->set('parent_uid', $content->uid)->set('mod', 'editor')->toString()?>" class="kboard-thumbnail-button-small"><?php echo __('Reply', 'kboard')?></a><?php endif?>
			</div>
			<?php if($board->isEditor($content->member_uid) || $board->permission_write=='all'):?>
			<div class="right">
				<a href="<?php echo $url->set('uid', $content->uid)->set('mod', 'editor')->toString()?>" class="kboard-thumbnail-button-small"><?php echo __('Edit', 'kboard')?></a>
				<a href="<?php echo $url->set('uid', $content->uid)->set('mod', 'remove')->toString()?>" class="kboard-thumbnail-button-small" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><?php echo __('Delete', 'kboard')?></a>
			</div>
			<?php endif?>
		</div>
		
		<div class="kboard-thumbnail-poweredby">
			<a href="http://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
		</div>
	</div>
</div>