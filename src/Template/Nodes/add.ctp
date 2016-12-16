<?php $this->layout = 'CakeBootstrap.default'; ?>
<?php $this->start('subtitle_for_page'); ?>
Cms
<?php $this->end(); ?>

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
             <div class="panel panel-default">
                 <div class="panel-heading">
                     <h4 class="panel-title">Form</h4>
                 </div>
                 <div class="panel-body">
                     <?= $this->Form->create($node, ['align' => [
                     'sm' => [
                     'left' => 6,
                     'middle' => 6,
                     'right' => 12
                     ],
                     'md' => [
                     'left' => 3,
                     'middle' => 9
                     ]
                     ]]) ?>

                     <div class="form-body">
                         <?php
                                                  echo $this->Form->input('title');
                                                  echo $this->Form->input('body');
                                                  //echo $this->Form->input('user_id', ['options' => $users]);
                                                  echo $this->Form->input('term_id', ['options' => $terms]);
                                                  echo $this->Form->input('parent_id', ['options' => $parentNodes, 'empty' => true]);
                                                  //echo $this->Form->input('lft');
                                                  //echo $this->Form->input('rght');
                                                  echo $this->Form->input('active');
                                                  echo $this->Form->input('published');
                                                  echo $this->Form->input('tag_string');
                                                  ?>
                     </div>
                     <div class="form-action">
                         <div class="row">
                             <div class="col-md-offset-3 col-md-4">
                                 <?= $this->Form->button(__('Submit'), ['class' => 'btn green']) ?>
                             </div>
                         </div>
                     </div>
                     <?= $this->Form->end() ?>
                 </div>
             </div>
         </div>
         <!-- Content -->

	</main>
<!-- End page Content -->
