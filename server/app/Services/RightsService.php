<?php

namespace App\Services;

class RightsService
{
    public function getRights()
    {
        // TODO service call
        return $this->formatData( $this->getRightsData() );
    }

    private function formatData($rights)
    {
        return $rights;
    }

    private function getRightsData()
    {
        return [
            [
                'id' => 1,
                'name' => 'users_management',
                'description' => 'To create, edit and disable users',
            ],
            [
                'id' => 2,
                'name' => 'rights_management',
                'description' => 'To create, edit and delete rights',
            ],
            [
                'id' => 3,
                'name' => 'roles_management',
                'description' => 'To create, edit and delete roles',
            ],
            [
                'id' => 4,
                'name' => 'rooms_management',
                'description' => 'To create, edit and delete rooms',
            ],
        ];
    }
}