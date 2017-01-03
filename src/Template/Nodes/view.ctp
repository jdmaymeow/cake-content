<?php $this->layout = 'CakeBootstrap.default'; ?>
<?php $this->start('subtitle_for_page'); ?>
Cms
<?php $this->end() ?>
<!-- Header -->
<div class="cinema border-bottom-gray bg-amethyst-sl">
    <div class="container">
        <h3><?= h($node->title) ?>
            <div class="pull-right">

                <div class="btn-group">
                    <?= $this->Html->link(__('New Node'), ['action' => 'add'], ['class' => 'btn btn-sm btn-default']) ?>
                    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><?= $this->Html->link(__('Edit Node'), ['action' => 'edit', $node->id]) ?> </li>
                        <li><?= $this->Html->link(__('List Nodes'), ['action' => 'index']) ?> </li>
                        <li><?= $this->Html->link(__('New Node'), ['action' => 'add']) ?> </li>
                        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
                        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
                        <li><?= $this->Html->link(__('List Terms'), ['controller' => 'Terms', 'action' => 'index']) ?> </li>
                        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Terms', 'action' => 'add']) ?> </li>
                        <li><?= $this->Html->link(__('List Parent Nodes'), ['controller' => 'Nodes', 'action' => 'index']) ?> </li>
                        <li><?= $this->Html->link(__('New Parent Node'), ['controller' => 'Nodes', 'action' => 'add']) ?> </li>
                        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
                        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
                    </ul>
                </div>
            </div>
        </h3>
    </div>
</div>


<!-- Begin page content -->
<main id="main-container">

    <!-- Content -->
    <div class="container">

        <table class="table table-hover">
            <tr>
                <th><?= __('Title') ?></th>
                <td style="text-align: right"><?= h($node->title) ?></td>
            </tr>
            <tr>
                <th><?= __('User') ?></th>
                <td style="text-align: right"><?= $node->has('user') ? $this->Html->link($node->user->id, ['controller' => 'Users', 'action' => 'view', $node->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Term') ?></th>
                <td style="text-align: right"><?= $node->has('term') ? $this->Html->link($node->term->name, ['controller' => 'Terms', 'action' => 'view', $node->term->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Parent Node') ?></th>
                <td style="text-align: right"><?= $node->has('parent_node') ? $this->Html->link($node->parent_node->title, ['controller' => 'Nodes', 'action' => 'view', $node->parent_node->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td style="text-align: right"><?= $this->Number->format($node->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Lft') ?></th>
                <td style="text-align: right"><?= $this->Number->format($node->lft) ?></td>
            </tr>
            <tr>
                <th><?= __('Rght') ?></th>
                <td style="text-align: right"><?= $this->Number->format($node->rght) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td style="text-align: right"><?= h($node->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td style="text-align: right"><?= h($node->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Attributes') ?></th>
                <td style="text-align: right"><?= $node->node_attributes ?></td>
            </tr>
            <tr>
                <th><?= __('Node type') ?></th>
                <td style="text-align: right"><?= $node->node_type ?></td>
            </tr>
        </table>


        <div class="">
            <h4><?= __('Body') ?></h4>
            <?= $this->Text->autoParagraph(h($node->body)); ?>
            <h4><?= __('Markdown') ?></h4>
            <?= $this->Text->autoParagraph($node->markdown_body); ?>
        </div>

        <div class="">
            <h4><?= __('Image') ?></h4>
            <?= $this->Html->image('/' . $node->CustomAttributes->image, ['class' => 'img-thumbnail', 'width' => 200, 'height' => 200]); ?>
        </div>
        <div class="related">
            <?php if (!empty($node->child_nodes)): ?>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?= __('Related Nodes') ?>
                            <?= $this->Html->link(__('CREATE'), ['controller' => 'Nodes', 'action' => 'add']) ?>
                        </h4>
                    </div>
                    <table class="table table-hover">
                        <tr>
                            <td><?= __('Id') ?></td>
                            <td><?= __('Title') ?></td>
                            <td><?= __('Body') ?></td>
                            <td><?= __('User Id') ?></td>
                            <td><?= __('Term Id') ?></td>
                            <td><?= __('Parent Id') ?></td>
                            <td><?= __('Lft') ?></td>
                            <td><?= __('Rght') ?></td>
                            <td><?= __('Created') ?></td>
                            <td><?= __('Modified') ?></td>
                            <td class="actions"><?= __('Actions') ?></td>
                        </tr>
                        <?php foreach ($node->child_nodes as $childNodes): ?>
                            <tr>
                                <td><?= h($childNodes->id) ?></td>
                                <td><?= h($childNodes->title) ?></td>
                                <td><?= h($childNodes->body) ?></td>
                                <td><?= h($childNodes->user_id) ?></td>
                                <td><?= h($childNodes->term_id) ?></td>
                                <td><?= h($childNodes->parent_id) ?></td>
                                <td><?= h($childNodes->lft) ?></td>
                                <td><?= h($childNodes->rght) ?></td>
                                <td><?= h($childNodes->created) ?></td>
                                <td><?= h($childNodes->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Nodes', 'action' => 'view', $childNodes->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Nodes', 'action' => 'edit', $childNodes->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Nodes', 'action' => 'delete', $childNodes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childNodes->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <div class="related">
            <?php if (!empty($node->tags)): ?>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?= __('Related Tags') ?>
                            <?= $this->Html->link(__('CREATE'), ['controller' => 'Tags', 'action' => 'add']) ?>
                        </h4>
                    </div>
                    <table class="table table-hover">
                        <tr>
                            <td><?= __('Id') ?></td>
                            <td><?= __('Name') ?></td>
                            <td><?= __('Description') ?></td>
                            <td><?= __('Slug') ?></td>
                            <td><?= __('Created') ?></td>
                            <td><?= __('Modified') ?></td>
                            <td class="actions"><?= __('Actions') ?></td>
                        </tr>
                        <?php foreach ($node->tags as $tags): ?>
                            <tr>
                                <td><?= h($tags->id) ?></td>
                                <td><?= h($tags->name) ?></td>
                                <td><?= h($tags->description) ?></td>
                                <td><?= h($tags->slug) ?></td>
                                <td><?= h($tags->created) ?></td>
                                <td><?= h($tags->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Content -->

</main>
<!-- End page Content -->
