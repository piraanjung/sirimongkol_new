<?php

use yii\db\Migration;

/**
 * Handles adding comment to table `instalmentcostdetails`.
 */
class m180122_063233_add_comment_column_to_instalmentcostdetails_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('instalmentcostdetails', 'comment', $this->text()->after('saver_id'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%instalmentcostdetails}}', 'comment');
    }
}
