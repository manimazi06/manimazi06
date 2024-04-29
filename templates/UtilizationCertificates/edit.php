<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UtilizationCertificate $utilizationCertificate
 * @var string[]|\Cake\Collection\CollectionInterface $projectWorks
 * @var string[]|\Cake\Collection\CollectionInterface $projectWorkSubdetails
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $utilizationCertificate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $utilizationCertificate->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Utilization Certificates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="utilizationCertificates form content">
            <?= $this->Form->create($utilizationCertificate) ?>
            <fieldset>
                <legend><?= __('Edit Utilization Certificate') ?></legend>
                <?php
                    echo $this->Form->control('project_work_id', ['options' => $projectWorks, 'empty' => true]);
                    echo $this->Form->control('project_work_subdetail_id', ['options' => $projectWorkSubdetails, 'empty' => true]);
                    echo $this->Form->control('remarks');
                    echo $this->Form->control('certificated_date', ['empty' => true]);
                    echo $this->Form->control('certificate_upload');
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
