<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProjectFundRequestDetail $projectFundRequestDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Project Fund Request Detail'), ['action' => 'edit', $projectFundRequestDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Project Fund Request Detail'), ['action' => 'delete', $projectFundRequestDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectFundRequestDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Project Fund Request Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Project Fund Request Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="projectFundRequestDetails view content">
            <h3><?= h($projectFundRequestDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Project Work') ?></th>
                    <td><?= $projectFundRequestDetail->has('project_work') ? $this->Html->link($projectFundRequestDetail->project_work->id, ['controller' => 'ProjectWorks', 'action' => 'view', $projectFundRequestDetail->project_work->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Project Work Subdetail') ?></th>
                    <td><?= $projectFundRequestDetail->has('project_work_subdetail') ? $this->Html->link($projectFundRequestDetail->project_work_subdetail->id, ['controller' => 'ProjectWorkSubdetails', 'action' => 'view', $projectFundRequestDetail->project_work_subdetail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Fund Status') ?></th>
                    <td><?= $projectFundRequestDetail->has('fund_status') ? $this->Html->link($projectFundRequestDetail->fund_status->name, ['controller' => 'FundStatuses', 'action' => 'view', $projectFundRequestDetail->fund_status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($projectFundRequestDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fund Amount') ?></th>
                    <td><?= $projectFundRequestDetail->fund_amount === null ? '' : $this->Number->format($projectFundRequestDetail->fund_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Balance Amount') ?></th>
                    <td><?= $projectFundRequestDetail->balance_amount === null ? '' : $this->Number->format($projectFundRequestDetail->balance_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td><?= $projectFundRequestDetail->created_by === null ? '' : $this->Number->format($projectFundRequestDetail->created_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified By') ?></th>
                    <td><?= $projectFundRequestDetail->modified_by === null ? '' : $this->Number->format($projectFundRequestDetail->modified_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Request Date') ?></th>
                    <td><?= h($projectFundRequestDetail->request_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Approval Date') ?></th>
                    <td><?= h($projectFundRequestDetail->approval_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($projectFundRequestDetail->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($projectFundRequestDetail->modified_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Remarks') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projectFundRequestDetail->remarks)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Project Fund Request Stages') ?></h4>
                <?php if (!empty($projectFundRequestDetail->project_fund_request_stages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Project Fund Request Detail Id') ?></th>
                            <th><?= __('Fund Status Id') ?></th>
                            <th><?= __('Forward Date') ?></th>
                            <th><?= __('Remarks') ?></th>
                            <th><?= __('Created By') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th><?= __('Modified Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($projectFundRequestDetail->project_fund_request_stages as $projectFundRequestStages) : ?>
                        <tr>
                            <td><?= h($projectFundRequestStages->id) ?></td>
                            <td><?= h($projectFundRequestStages->project_fund_request_detail_id) ?></td>
                            <td><?= h($projectFundRequestStages->fund_status_id) ?></td>
                            <td><?= h($projectFundRequestStages->forward_date) ?></td>
                            <td><?= h($projectFundRequestStages->remarks) ?></td>
                            <td><?= h($projectFundRequestStages->created_by) ?></td>
                            <td><?= h($projectFundRequestStages->created_date) ?></td>
                            <td><?= h($projectFundRequestStages->modified_by) ?></td>
                            <td><?= h($projectFundRequestStages->modified_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ProjectFundRequestStages', 'action' => 'view', $projectFundRequestStages->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ProjectFundRequestStages', 'action' => 'edit', $projectFundRequestStages->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProjectFundRequestStages', 'action' => 'delete', $projectFundRequestStages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectFundRequestStages->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
