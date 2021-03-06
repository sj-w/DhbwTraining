<?php

/**
 * Class xdhtQuestionPoolFactory
 *
 * @author: Benjamin Seglias   <bs@studer-raimann.ch>
 */
class xdhtQuestionPoolFactory implements xdhtQuestionPoolFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function getSelectOptionsArray()
    {
        $question_pools_array = $this->getQuestionPools();
        $sel_opt_array = [];
        foreach ($question_pools_array as $question_pool) {
            $sel_opt_array[$question_pool['obj_id']] = $question_pool['title'];
        }

        return $sel_opt_array;
    }


    /**
     * @inheritDoc
     */
    public function getQuestionPools()
    {
        global $ilDB;

        $sql = "SELECT * FROM object_data AS object
				inner join object_reference AS reference ON object.obj_id = reference.obj_id
				WHERE object.type = 'qpl'";

        $set = $ilDB->query($sql);

        $arr_question_pools = array();
        while ($row = $ilDB->fetchAssoc($set)) {
            $arr_question_pools[] = $row;
        }

        return $arr_question_pools;
    }
}