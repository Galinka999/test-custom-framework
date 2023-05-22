<?php

declare(strict_types=1);

namespace Feature;

use App\Models\Item;
use Carbon\Carbon;
use Tests\TestBase;

final class ItemTest extends TestBase
{
    protected $item;

    protected function setUp(): void
    {
        parent::setUp();

        Item::query()->delete();

        Item::query()->create([
            'name' => 'Galina',
            'phone' => '89246520000',
            'key' => '111111112',
            'created_at' => Carbon::now(),
        ]);

        $this->item = Item::first();
    }

    public function testGet()
    {
        $item = Item::query()->first();

        $this->assertNotNull($item);
        $this->assertEquals('Galina', $item->name);
        $this->assertEquals('89246520000', $item->phone);
    }

    public function testCreate()
    {
        $sql = Item::query()->create([
            'name' => 'TestName',
            'phone' => '89246520001',
            'key' => '111111133',
            'created_at' => Carbon::now(),
        ]);

        $this->assertNotNull($sql);
    }

    public function testDelete()
    {
        $sql = $this->item->delete();

        $item = Item::query()->where('name', 'Galina')->first();

        $this->assertNotNull($sql);
        $this->assertEquals(null, $item);
    }
}