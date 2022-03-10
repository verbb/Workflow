<?php
namespace verbb\workflow\migrations;

use craft\db\Migration;
use craft\helpers\Db;

class Install extends Migration
{
    // Public Methods
    // =========================================================================

    public function safeUp(): bool
    {
        $this->createTables();
        $this->createIndexes();
        $this->addForeignKeys();

        return true;
    }

    public function safeDown(): bool
    {
        $this->dropForeignKeys();
        $this->dropTables();

        return false;
    }

    public function createTables(): void
    {
        $this->createTable('{{%workflow_submissions}}', [
            'id' => $this->primaryKey(),
            'ownerId' => $this->integer(),
            'ownerSiteId' => $this->integer(),
            'ownerDraftId' => $this->integer(),
            'editorId' => $this->integer(),
            'publisherId' => $this->integer(),
            'status' => $this->enum('status', ['approved', 'pending', 'rejected', 'revoked']),
            'editorNotes' => $this->text(),
            'publisherNotes' => $this->text(),
            'data' => $this->mediumText(),
            'dateApproved' => $this->dateTime(),
            'dateRejected' => $this->dateTime(),
            'dateRevoked' => $this->dateTime(),
            'dateCreated' => $this->dateTime()->notNull(),
            'dateUpdated' => $this->dateTime()->notNull(),
            'uid' => $this->uid(),
        ]);

        $this->createTable('{{%workflow_reviews}}', [
            'id' => $this->primaryKey(),
            'submissionId' => $this->integer(),
            'userId' => $this->integer(),
            'approved' => $this->boolean(),
            'notes' => $this->text(),
            'dateCreated' => $this->dateTime()->notNull(),
            'dateUpdated' => $this->dateTime()->notNull(),
            'uid' => $this->uid(),
        ]);
    }

    public function dropTables(): void
    {
        $this->dropTable('{{%workflow_submissions}}');
        $this->dropTable('{{%workflow_reviews}}');
    }

    public function createIndexes(): void
    {
        $this->createIndex($this->db->getIndexName(), '{{%workflow_submissions}}', 'id', false);
        $this->createIndex($this->db->getIndexName(), '{{%workflow_submissions}}', 'ownerId', false);
        $this->createIndex($this->db->getIndexName(), '{{%workflow_submissions}}', 'ownerDraftId', false);
        $this->createIndex($this->db->getIndexName(), '{{%workflow_submissions}}', 'ownerSiteId', false);
        $this->createIndex($this->db->getIndexName(), '{{%workflow_submissions}}', 'editorId', false);
        $this->createIndex($this->db->getIndexName(), '{{%workflow_submissions}}', 'publisherId', false);
    }

    public function addForeignKeys(): void
    {
        $this->addForeignKey($this->db->getForeignKeyName(), '{{%workflow_submissions}}', 'id', '{{%elements}}', 'id', 'CASCADE', null);
        $this->addForeignKey($this->db->getForeignKeyName(), '{{%workflow_submissions}}', 'ownerDraftId', '{{%drafts}}', 'id', 'SET NULL', null);
        $this->addForeignKey($this->db->getForeignKeyName(), '{{%workflow_submissions}}', 'ownerSiteId', '{{%sites}}', 'id', 'CASCADE', null);
        $this->addForeignKey($this->db->getForeignKeyName(), '{{%workflow_submissions}}', 'editorId', '{{%users}}', 'id', 'CASCADE', null);
        $this->addForeignKey($this->db->getForeignKeyName(), '{{%workflow_submissions}}', 'ownerId', '{{%elements}}', 'id', 'SET NULL', null);
        $this->addForeignKey($this->db->getForeignKeyName(), '{{%workflow_submissions}}', 'publisherId', '{{%users}}', 'id', 'CASCADE', null);

        $this->addForeignKey($this->db->getForeignKeyName(), '{{%workflow_reviews}}', 'submissionId', '{{%workflow_submissions}}', 'id', 'CASCADE', null);
        $this->addForeignKey($this->db->getForeignKeyName(), '{{%workflow_reviews}}', 'userId', '{{%users}}', 'id', 'CASCADE', null);
    }

    public function dropForeignKeys(): void
    {
        Db::dropForeignKeyIfExists('{{%workflow_submissions}}', ['id'], $this);
        Db::dropForeignKeyIfExists('{{%workflow_submissions}}', ['ownerDraftId'], $this);
        Db::dropForeignKeyIfExists('{{%workflow_submissions}}', ['ownerSiteId'], $this);
        Db::dropForeignKeyIfExists('{{%workflow_submissions}}', ['editorId'], $this);
        Db::dropForeignKeyIfExists('{{%workflow_submissions}}', ['ownerId'], $this);
        Db::dropForeignKeyIfExists('{{%workflow_submissions}}', ['publisherId'], $this);

        Db::dropForeignKeyIfExists('{{%workflow_reviews}}', ['submissionId'], $this);
        Db::dropForeignKeyIfExists('{{%workflow_reviews}}', ['userId'], $this);
    }
}
