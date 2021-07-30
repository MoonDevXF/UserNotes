<?php

namespace DEKU\UserNotes\Entity;

use XF\Mvc\Entity\Structure;
use XF\Mvc\Entity\Entity;

class Note extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_deku_user_notes';
        $structure->shortName = 'DEKU\UserNotes:Note';
        $structure->primaryKey = 'user_id';
        $structure->columns = [
            'user_id' => ['type' => self::UINT, 'required' => true],
            'note' => ['type' => self::STR, 'required' => false]
        ];
        $structure->getters = [];

        return $structure;
    }

}