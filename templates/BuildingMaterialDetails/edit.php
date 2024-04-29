<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BuildingMaterialDetail $buildingMaterialDetail
 * @var string[]|\Cake\Collection\CollectionInterface $buildingMaterials
 * @var string[]|\Cake\Collection\CollectionInterface $buildingSubmaterials
 * @var string[]|\Cake\Collection\CollectionInterface $units
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $buildingMaterialDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $buildingMaterialDetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Building Material Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="buildingMaterialDetails form content">
            <?= $this->Form->create($buildingMaterialDetail) ?>
            <fieldset>
                <legend><?= __('Edit Building Material Detail') ?></legend>
                <?php
                    echo $this->Form->control('building_material_id', ['options' => $buildingMaterials, 'empty' => true]);
                    echo $this->Form->control('building_submaterial_id', ['options' => $buildingSubmaterials, 'empty' => true]);
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('unit_id', ['options' => $units, 'empty' => true]);
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
