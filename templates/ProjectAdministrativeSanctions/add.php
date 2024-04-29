<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectAdministrativeSanction $projectAdministrativeSanction
 * @var \Cake\Collection\CollectionInterface|string[] $projectWorks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Project Administrative Sanctions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectAdministrativeSanctions form content">
            <?= $this->Form->create($projectAdministrativeSanction) ?>
            <fieldset>
                <legend><?= __('Add Project Administrative Sanction') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks]);
                    echo $this->Form->control('go_no');
                    echo $this->Form->control('go_date');
                    echo $this->Form->control('go_file_upload');
                    echo $this->Form->control('sanctioned_amount');
                    echo $this->Form->control('is_active');
                    echo $this->Form->control('created_by');
                    echo $this->Form->control('created_date');
                    echo $this->Form->control('modified_by');
                    echo $this->Form->control('modified_date', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
