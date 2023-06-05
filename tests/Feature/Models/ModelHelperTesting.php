<?php

namespace Tests\Feature\Models;

use Illuminate\Database\Eloquent\Model;

trait ModelHelperTesting
{
    /**
     * A test to insert data
     *
     * @return void
     */
    public function testInsertData()
    {
        $model = $this->model();
        $table = $model->getTable();

        $data = $model::factory()->make()->toArray();

        $model::create($data);

        $this->assertDatabaseHas($table, $data);
    }

    abstract protected function model(): Model;
}
