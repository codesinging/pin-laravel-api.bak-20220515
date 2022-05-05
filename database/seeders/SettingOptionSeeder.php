<?php

namespace Database\Seeders;

use App\Models\SettingOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingOptionSeeder extends Seeder
{
    protected array  $options = [
        [
            'group_id' => 1,
            'name' => '网站名称',
            'type' => 'input',
            'attributes' => [],
            'options' => [],
        ],
        [
            'group_id' => 1,
            'name' => '网站介绍',
            'type' => 'textarea',
            'attributes' => [],
            'options' => [],
        ],
        [
            'group_id' => 1,
            'name' => '网站状态',
            'type' => 'switch',
            'attributes' => [],
            'options' => [],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->options as $option) {
            SettingOption::creates($option);
        }
    }
}
