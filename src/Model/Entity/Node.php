<?php
namespace CakeContent\Model\Entity;

use Cake\Collection\Collection;
use Cake\ORM\Entity;

/**
 * Node Entity
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $user_id
 * @property int $term_id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \CakeContent\Model\Entity\User $user
 * @property \CakeContent\Model\Entity\Term $term
 * @property \CakeContent\Model\Entity\Node $parent_node
 * @property \CakeContent\Model\Entity\Node[] $child_nodes
 * @property \CakeContent\Model\Entity\Tag[] $tags
 */
class Node extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'tag_string' => true,
    ];

    protected function _getTagString()
    {
        if (isset($this->_properties['tag_string'])) {
            return $this->_properties['tag_string'];
        }
        if (empty($this->tags)) {
            return '';
        }
        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag) {
            return $string . $tag->title . ', ';
        }, '');
        return trim($str, ', ');
    }
}
