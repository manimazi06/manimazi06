<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OpeningBalanceDetail $openingBalanceDetail
 * @var string[]|\Cake\Collection\CollectionInterface $offices
 * @var string[]|\Cake\Collection\CollectionInterface $divisions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $openingBalanceDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $openingBalanceDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Opening Balance Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="openingBalanceDetails form content">
            <?= $this->Form->create($openingBalanceDetail) ?>
            <fieldset>
                <legend><?= __('Edit Opening Balance Detail') ?></legend>
                <?php
                    echo $this->Form->control('office_id', ['options' => $offices]);
                    echo $this->Form->control('division_id', ['options' => $divisions]);
                    echo $this->Form->control('opening_balance');
                    echo $this->Form->control('balance_date');
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
