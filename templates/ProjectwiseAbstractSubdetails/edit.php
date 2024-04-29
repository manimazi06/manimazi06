<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectwiseAbstractSubdetail $projectwiseAbstractSubdetail
 * @var string[]|\Cake\Collection\CollectionInterface $projectwiseAbstractDetails
 * @var string[]|\Cake\Collection\CollectionInterface $buildingItems
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $projectwiseAbstractSubdetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $projectwiseAbstractSubdetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Projectwise Abstract Subdetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectwiseAbstractSubdetails form content">
            <?= $this->Form->create($projectwiseAbstractSubdetail) ?>
            <fieldset>
                <legend><?= __('Edit Projectwise Abstract Subdetail') ?></legend>
                <?php
                    echo $this->Form->control('projectwise_abstract_detail_id', ['options' => $projectwiseAbstractDetails, 'empty' => true]);
                    echo $this->Form->control('building_item_id', ['options' => $buildingItems, 'empty' => true]);
                    echo $this->Form->control('item_code');
                    echo $this->Form->control('item_description');
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('rate');
                    echo $this->Form->control('amount');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('created_date', ['empty' => true]);
                    echo $this->Form->control('modified_by');
                    echo $this->Form->control('modified_date', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
