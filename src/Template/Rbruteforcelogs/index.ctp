<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Delete All'), ['action' => 'deleteall']) ?></li>
	</ul>
</div>
<div class="rbruteforcelogs index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('id') ?></th>
			<th><?= $this->Paginator->sort('data') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($rbruteforcelogs as $rbruteforcelog): ?>
		<tr>
			<td><?= $this->Number->format($rbruteforcelog->id) ?></td>
			<td><?php print_r(unserialize($rbruteforcelog->data)); ?></td>
			<td class="actions">
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rbruteforcelog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rbruteforcelog->id)]) ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'));
			echo $this->Paginator->numbers();
			echo $this->Paginator->next(__('next') . ' >');
		?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>
</div>
