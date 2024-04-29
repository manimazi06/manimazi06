<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FinancialYear $financialYear
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $financialYear->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $financialYear->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Financial Years'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="financialYears form content">
            <?= $this->Form->create($financialYear) ?>
            <fieldset>
                <legend><?= __('Edit Financial Year') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('order_flag');
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
