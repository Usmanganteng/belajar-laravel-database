<?php

namespace Tests\Feature;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use function PHPUnit\Framework\assertCount;

class TransactionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        DB::delete('delete from categories');
    }

    public function testTransactionSuccess()
    {
        DB::transaction(function () {
            DB::insert('insert into categories(id, name, description, created_at) values (?, ?, ? , ?)', [
                "GADGET", "Gadget", "Gadget Category", "2020-10-10 10:10:10"
            ]);
            DB::insert('insert into categories(id, name, description, created_at) values (?, ?, ? , ?)', [
                "FOOD", "Food", "Food Category", "2020-10-10 10:10:10"
            ]);
        });

        $results = DB::select("select * from categories");
        self::assertCount(2, $results);

    }

    public function testTransactionFailed()
    {
        try {
            DB::transaction(function () {
                DB::insert('insert into categories(id, name, description, created_at) values (?, ?, ? , ?)', [
                    "GADGET", "Gadget", "Gadget Category", "2020-10-10 10:10:10"
                ]);
                DB::insert('insert into categories(id, name, description, created_at) values (?, ?, ? , ?)', [
                    "GADGET", "Food", "Food Category", "2020-10-10 10:10:10"
                ]);
            });
        } catch (QueryException $error) {
            // expected
        }

        $results = DB::select("select * from categories");
        self::assertCount(0, $results);

    }

    public function testMaualTransactionSuccess()
    {
        try {
            DB::beginTransaction();
            DB::insert('insert into categories(id, name, description, created_at) values (?, ?, ? , ?)', [
                "GADGET", "Gadget", "Gadget Category", "2020-10-10 10:10:10"
            ]);
            DB::insert('insert into categories(id, name, description, created_at) values (?, ?, ? , ?)', [
                "FOOD", "Food", "Food Category", "2020-10-10 10:10:10"
            ]);
            DB::commit();
        } catch (QueryException $error) {
            DB::rollBack();
        }

        $results = DB::select("select * from categories");
        self::assertCount(2, $results);

    }

    public function testMaualTransactionFailed()
    {
        try {
            DB::beginTransaction();
            DB::insert('insert into categories(id, name, description, created_at) values (?, ?, ? , ?)', [
                "GADGET", "Gadget", "Gadget Category", "2020-10-10 10:10:10"
            ]);
            DB::insert('insert into categories(id, name, description, created_at) values (?, ?, ? , ?)', [
                "GADGET", "Food", "Food Category", "2020-10-10 10:10:10"
            ]);
            DB::commit();
        } catch (QueryException $error) {
            DB::rollBack();
        }

        $results = DB::select("select * from categories");
        self::assertCount(0, $results);

    }

}