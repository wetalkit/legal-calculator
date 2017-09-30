<?php

use Illuminate\Database\Seeder;
use App\Procedure;
use App\ProcedureItem;
use App\ProcedureFormula;

class ProceduresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedure1 = Procedure::create([
            'name' => 'Купопродажба на недвижен имот'
        ]);
        $id1 = $procedure1->id;
        ProcedureItem::create([
            'procedure_id' => $id1,
            'label' => 'Вред. на имот',
            'name' => 'vrednost_imot',
            'type' => ProcedureItem::ITEM_TEXT,
            'is_mandatory' => 1,
            'options' => [
                'placeholder' => '30,000'
            ],
            'comments' => 'член 22 од законот за даноците на имот'
        ]);
        ProcedureItem::create([
            'procedure_id' => $id1,
            'label' => 'Број на странки',
            'name' => 'broj_stranki',
            'type' => ProcedureItem::ITEM_SELECT,
            'options' => [
                'placeholder' => 'Изберете број на странки',
                'options' => [
                    0 => '0',
                    1 => '1',
                    2 => '2',
                    3 => '3'
                ]
            ],
            'comments' => 'Број на странки'
        ]);
        ProcedureFormula::create([
            'name' => 'Купопродажен договор',
            'category' => ProcedureFormula::FORMULA_LAWYER,
            'formula' => '0.03*vrednost_imot',
            'procedure_id' => $id1
        ]);

        $procedure = Procedure::create([
            'name' => 'Купопродажба на возило'
        ]);
        $id = $procedure->id;
        ProcedureItem::create([
            'procedure_id' => $id,
            'label' => 'Вред. на возило',
            'name' => 'vrednost_vozilo',
            'type' => ProcedureItem::ITEM_TEXT,
            'is_mandatory' => 1,
            'options' => [
                'placeholder' => '10,000'
            ],
            'comments' => 'член 22 од законот за даноците на имот'
        ]);
        ProcedureItem::create([
            'procedure_id' => $id,
            'label' => 'Регистарски таблички (Дали е во друг град)',
            'name' => 'reg_tablicki',
            'type' => ProcedureItem::ITEM_SELECT,
            'options' => [
                'placeholder' => 'Дали е во друг град',
                'options' => [
                    0 => 'Да',
                    1 => 'Не'
                ]
            ],
            'comments' => 'Дали е во друг град'
        ]);
        ProcedureItem::create([
            'procedure_id' => $id,
            'label' => 'Регистарски таблички (Дали е во друг град)',
            'name' => 'reg_tablicki',
            'type' => ProcedureItem::ITEM_SELECT,
            'options' => [
                'placeholder' => 'Дали е во друг град',
                'options' => [
                    0 => 'Да',
                    1 => 'Не'
                ]
            ],
            'comments' => 'Дали е во друг град'
        ]);
        ProcedureItem::create([
            'procedure_id' => $id,
            'label' => 'Регистарски таблички (Дали е во друг град)',
            'name' => 'reg_tablicki',
            'type' => ProcedureItem::ITEM_SELECT,
            'options' => [
                'placeholder' => 'Дали е во друг град',
                'options' => [
                    0 => 'Да',
                    1 => 'Не'
                ]
            ],
            'comments' => 'Дали е во друг град'
        ]);
        ProcedureItem::create([
            'procedure_id' => $id,
            'label' => 'Регистарски таблички (Дали е во друг град)',
            'name' => 'reg_tablicki',
            'type' => ProcedureItem::ITEM_SELECT,
            'options' => [
                'placeholder' => 'Дали е во друг град',
                'options' => [
                    0 => 'Да',
                    1 => 'Не'
                ]
            ],
            'comments' => 'Дали е во друг град'
        ]);
        ProcedureItem::create([
            'procedure_id' => $id,
            'label' => 'Регистарски таблички (Дали е во друг град)',
            'name' => 'reg_tablicki',
            'type' => ProcedureItem::ITEM_SELECT,
            'options' => [
                'placeholder' => 'Дали е во друг град',
                'options' => [
                    0 => 'Да',
                    1 => 'Не'
                ]
            ],
            'comments' => 'Дали е во друг град'
        ]);
        ProcedureItem::create([
            'procedure_id' => $id,
            'label' => 'Регистарски таблички (Дали е во друг град)',
            'name' => 'reg_tablicki',
            'type' => ProcedureItem::ITEM_SELECT,
            'options' => [
                'placeholder' => 'Дали е во друг град',
                'options' => [
                    0 => 'Да',
                    1 => 'Не'
                ]
            ],
            'comments' => 'Дали е во друг град'
        ]);
        ProcedureItem::create([
            'procedure_id' => $id,
            'label' => 'Регистарски таблички (Дали е во друг град)',
            'name' => 'reg_tablicki',
            'type' => ProcedureItem::ITEM_SELECT,
            'options' => [
                'placeholder' => 'Дали е во друг град',
                'options' => [
                    0 => 'Да',
                    1 => 'Не'
                ]
            ],
            'comments' => 'Дали е во друг град'
        ]);
        ProcedureFormula::create([
            'name' => 'Купопродажен договор',
            'category' => ProcedureFormula::FORMULA_LAWYER,
            'formula' => '0.03*vrednost_imot',
            'procedure_id' => $id
        ]);
        ProcedureFormula::create([
            'name' => 'Купопродажен договор',
            'category' => ProcedureFormula::FORMULA_LAWYER,
            'formula' => '1200*reg_tablicki',
            'procedure_id' => $id
        ]);
    }
}
