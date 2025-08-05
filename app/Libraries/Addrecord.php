<?php

namespace App\Libraries;
use App\Models\StudentModel;
class Addrecord 
{
	public function addData(array $data)
	{
		$model = new StudentModel();

        try {
            return $model->insert($data);
        } catch (\Exception $e) {
            log_message('error', 'Insert Failed: ' . $e->getMessage());
            return false;
        }
	}
}