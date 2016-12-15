<?php $this->layout = 'CakeBootstrap.default'; ?>
<?php $this->start('subtitle_for_page'); ?>
Cms
<?php $this->end() ?>

<!-- Header -->
<div class="cinema border-bottom-gray bg-amethyst-sl">
    <div class="container">
        <h3><?= __('Nodes') ?>
            <div class="pull-right">

                <div class="btn-group">
                    <?= $this->Html->link(__('New Node'), ['action' => 'add'], ['class' => 'btn btn-sm btn-default']) ?>
                    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left">
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
             <?php if(count($nodes) > 0) : ?>
             <div class="row">
                 <div class="col-md-12">

                     <div class="table-responsive">
                    <table class="table table-hover table-vcenter">
                        <thead>
                        <tr>
                                                        <td><?= $this->Paginator->sort('id') ?></td>
                                                        <td><?= $this->Paginator->sort('title') ?></td>
                                                        <td><?= $this->Paginator->sort('user_id') ?></td>
                                                        <td><?= $this->Paginator->sort('term_id') ?></td>
                                                        <td><?= $this->Paginator->sort('parent_id') ?></td>

                                                        <td class="actions text-center"><?= __('Actions') ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($nodes as $node): ?>
                        <tr>
                                                        <td><?= $this->Number->format($node->id) ?></td>
                                                        <td>
                                                            <strong><i class="fa fa-square text-amethyst"></i></strong>
                                                            <?= h($node->title) ?></td>
                                                        <td>
                                <?= $node->has('user') ? $this->Html->link($node->user->username, ['controller' => 'Users', 'action' => 'view', $node->user->id]) : '' ?>
                            </td>
                                                        <td>
                                <?= $node->has('term') ? $this->Html->link($node->term->name, ['controller' => 'Terms', 'action' => 'view', $node->term->id]) : '' ?>
                            </td>
                                                        <td>
                                <?= $node->has('parent_node') ? $this->Html->link($node->parent_node->title, ['controller' => 'Nodes', 'action' => 'view', $node->parent_node->id]) : '' ?>
                            </td>

                                                        <td class="actions text-center">
                                <div class="btn-group">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $node->id], ['class' => 'btn btn-xs btn-default']) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $node->id], ['class' => 'btn btn-xs btn-default']) ?>
                                        <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#modal-delete-<?= $node->id?>">Delete</button>

                                </div>
                                <?= $this->element('CakeBootstrap.deletemodal', ['id' => $node->id, 'name' => $node->id]); ?>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                 </div>
             </div>
             <div class="row">
                    <div class="col-md-12">
                        <ul class="pagination">
                            <?php //echo $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?php //echo $this->Paginator->next(__('next') . ' >') ?>
                        </ul>
                    </div>
                </div>

                <?php else : ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body text-center">
                                        <h2><i class="fa fa-plus-square-o text-amethyst"></i></h2>
                                        <p><strong>You currently have now nodes</strong></p>
                                        <o>To get started, click to button bellow and create new node</p>
                                        <?= $this->Html->link(__('Add new node'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary']); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

         </div>
         <!-- Content -->

	</main>
<!-- End page Content -->
