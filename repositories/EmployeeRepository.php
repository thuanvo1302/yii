<?php

namespace app\repositories;

use app\models\Employees;
use yii\data\ActiveDataProvider;

class EmployeeRepository
{
    const DEFAULT_PAGE_SIZE = 10;
    public function getAll(): array
    {
        $query =  Employees::find();

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => EmployeeRepository::DEFAULT_PAGE_SIZE,
            ],
        ]);

        return [
            'items' => $provider->getModels(),

            'pagination' => [
                'currentPage' => $provider->pagination->getPage() + 1,
                'pageCount' => $provider->pagination->getPageCount(),
                'perPage' => $provider->pagination->getPageSize(),
                'totalCount' => $provider->getTotalCount(),
            ],
        ];
    }

    public function getDetail(array $params)
    {
        return Employees::find()->where(['id' => $params['id']])->one();
    }

    public function create(array $params): bool
    {
        $employee = new Employees();
        $employee->load($params, '');
        return $employee->insert();
    }

    public function update(array $params, int $id): bool
    {
        $employee = Employees::findOne($id);

        if ($employee !== null) {
            $employee->load($params, '');
        }

        return $employee->update($employee);
    }

    public function delete(int $id): bool
    {
        $employee = Employees::findOne($id);
        return $employee->delete();
    }
}
