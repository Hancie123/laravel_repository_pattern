<?php

namespace App\Contracts;

interface ContactRepositoryInterface
{
    public function getAll();

    public function delete($id);

    public function findById($id);
}
