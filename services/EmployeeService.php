<?php

namespace app\services;

use app\repositories\EmployeeRepository;

class EmployeeService
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {

    }

    public function getAll()
    {
        return $this->employeeRepository->getAll();
    }

    public function getDetail(array $params)
    {
        return $this->employeeRepository->getDetail($params);
    }

    public function create(array $params): bool
    {
        return $this->employeeRepository->create($params);
    }

    public function update(array $params, int $id): bool
    {
        return $this->employeeRepository->update($params, $id);
    }

    public function delete(int $id): bool
    {
        return $this->employeeRepository->delete($id);
    }
}
