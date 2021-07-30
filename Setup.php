<?php

namespace DEKU\UserNotes;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    public function installStep1()
    {
        $this->SchemaManager()->createTable('xf_deku_user_notes', function(Create $table)
        {
            $table->addColumn('user_id', 'int');
            $table->addColumn('note', 'text');
            $table->addPrimaryKey('user_id');
        });
    }

    public function uninstallStep1()
    {
        $this->schemaManager()->dropTable('xf_deku_user_notes');
    }
}