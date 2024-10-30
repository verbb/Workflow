<?php
namespace verbb\workflow\migrations;

use craft\db\Migration;
use craft\db\Query;
use craft\helpers\MigrationHelper;

use Throwable;

class m241030_000000_user_fk extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        MigrationHelper::dropAllForeignKeysOnTable('{{%workflow_reviews}}');

        $this->addForeignKey(null, '{{%workflow_reviews}}', 'submissionId', '{{%workflow_submissions}}', 'id', 'CASCADE', null);
        $this->addForeignKey(null, '{{%workflow_reviews}}', 'elementId', '{{%elements}}', 'id', 'SET NULL', null);
        $this->addForeignKey(null, '{{%workflow_reviews}}', 'elementSiteId', '{{%sites}}', 'id', 'CASCADE', null);
        $this->addForeignKey(null, '{{%workflow_reviews}}', 'draftId', '{{%drafts}}', 'id', 'SET NULL', null);
        $this->addForeignKey(null, '{{%workflow_reviews}}', 'userId', '{{%users}}', 'id', 'SET NULL', null);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m241030_000000_user_fk cannot be reverted.\n";
        return false;
    }
}
