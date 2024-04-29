<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalSanction $technicalSanction
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Technical Sanctions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="technicalSanctions form content">
            <?= $this->Form->create($technicalSanction) ?>
            <fieldset>
                <legend><?= __('Add Technical Sanction') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks, 'empty' => true]);
                    echo $this->Form->control('detailed_estimate_upload');
                    echo $this->Form->control('description');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('created_date');
                    echo $this->Form->control('modified_by');
                    echo $this->Form->control('modified_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
