<?php
namespace CakeContent\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Nodes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Terms
 * @property \Cake\ORM\Association\BelongsTo $ParentNodes
 * @property \Cake\ORM\Association\HasMany $ChildNodes
 * @property \Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \CakeContent\Model\Entity\Node get($primaryKey, $options = [])
 * @method \CakeContent\Model\Entity\Node newEntity($data = null, array $options = [])
 * @method \CakeContent\Model\Entity\Node[] newEntities(array $data, array $options = [])
 * @method \CakeContent\Model\Entity\Node|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CakeContent\Model\Entity\Node patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CakeContent\Model\Entity\Node[] patchEntities($entities, array $data, array $options = [])
 * @method \CakeContent\Model\Entity\Node findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class NodesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('nodes');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'CakeContent.Users'
        ]);
        $this->belongsTo('Terms', [
            'foreignKey' => 'term_id',
            'joinType' => 'INNER',
            'className' => 'CakeContent.Terms'
        ]);
        $this->belongsTo('ParentNodes', [
            'className' => 'CakeContent.Nodes',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildNodes', [
            'className' => 'CakeContent.Nodes',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'node_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'nodes_tags',
            'className' => 'CakeContent.Tags'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentNodes'));

        return $rules;
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
    }

    protected function _buildTags($tagString)
    {
        // Trim tags
        $newTags = array_map('trim', explode(',', $tagString));
        // Remove all empty tags
        $newTags = array_filter($newTags);
        // Reduce duplicated tags
        $newTags = array_unique($newTags);

        $out = [];
        $query = $this->Tags->find()
            ->where(['Tags.name IN' => $newTags]);

        // Remove existing tags from the list of new tags.
        foreach ($query->extract('name') as $existing) {
            $index = array_search($existing, $newTags);
            if ($index !== false) {
                unset($newTags[$index]);
            }
        }
        // Add existing tags.
        foreach ($query as $tag) {
            $out[] = $tag;
        }
        // Add new tags.
        foreach ($newTags as $tag) {
            $out[] = $this->Tags->newEntity(['name' => $tag]);
        }
        return $out;
    }

    public function findTagged(Query $query, array $options)
    {
        return $this->find()
            ->distinct(['Nodes.id'])
            ->matching('Tags', function ($q) use ($options) {
                if (empty($options['tags'])) {
                    return $q->where(['Tags.name IS' => null]);
                }
                return $q->where(['Tags.name IN' => $options['tags']]);
            });
    }
}
