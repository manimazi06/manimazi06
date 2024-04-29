<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UtilizationCertificate[]|\Cake\Collection\CollectionInterface $utilizationCertificates
 */
?>
<div class="utilizationCertificates index content">
    <?= $this->Html->link(__('New Utilization Certificate'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Utilization Certificates') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_id') ?></th>
                    <th><?= $this->Paginator->sort('project_work_subdetail_id') ?></th>
                    <th><?= $this->Paginator->sort('certificated_date') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_by') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilizationCertificates as $utilizationCertificate): ?>
                <tr>
                    <td><?= $this->Number->format($utilizationCertificate->id) ?></td>
                    <td><?= $utilizationCertificate->has('project_work') ? $this->Html->link($utilizationCertificate->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $utilizationCertificate->project_work->id]) : '' ?></td>
                    <td><?= $utilizationCertificate->has('project_work_subdetail') ? $this->Html->link($utilizationCertificate->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $utilizationCertificate->project_work_subdetail->id]) : '' ?></td>
                    <td><?= h($utilizationCertificate->certificated_date) ?></td>
                    <td><?= $utilizationCertificate->is_active === null ? '' : $this->Number->format($utilizationCertificate->is_active) ?></td>
                    <td><?= $utilizationCertificate->created_by === null ? '' : $this->Number->format($utilizationCertificate->created_by) ?></td>
                    <td><?= h($utilizationCertificate->created_date) ?></td>
                    <td><?= $utilizationCertificate->modified_by === null ? '' : $this->Number->format($utilizationCertificate->modified_by) ?></td>
                    <td><?= h($utilizationCertificate->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $utilizationCertificate->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'utilizationcertificatesedit', $utilizationCertificate->id,$pw_id,$work_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $utilizationCertificate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $utilizationCertificate->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
