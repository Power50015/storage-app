<?php

namespace Database\Seeders\People;

use App\Models\People\People;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        People::truncate();
        Storage::deleteDirectory('public/image/people');
        People::factory()->create([
            'name' => 'الشركة المصرية الألمانية لصناعة البورسلين',
            'phone' => '01227436431',
            'logo' => function () {
                $url = "https://egyptianporcelain-fm.com/wp-content/uploads/2020/04/logo.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'مصر إسكندريه الصحراوى',
            'type' => 'مورد',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'عبدو',
            'phone' => '010215436431',
            'logo' => function () {
                $url = "https://global.canon/en/corporate/logo/img/logo_1956.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'عبدين',
            'type' => 'عميل',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'المعلم القرموطى',
            'phone' => '01215436431',
            'logo' => function () {
                $url = "https://99designs-start-assets.imgix.net/images/homepage/testimonials/testimonial-4-artwork-3665771dea.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'المقطم',
            'type' => 'عميل',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'الماسه',
            'phone' => '01115436432',
            'logo' => function () {
                $url = "https://cdn.phenompeople.com/CareerConnectResources/CRITUS/en_us/mobile/assets/images/v-1606029317799-header_logo.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'المقطم',
            'type' => 'عميل',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'الشحات',
            'phone' => '01115436432',
            'logo' => function () {
                $url = "https://logopond.com/assets/img/logo-footer.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'المقطم',
            'type' => 'عميل',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'منصورى',
            'phone' => '01115436432',
            'logo' => function () {
                $url = "https://www.theartian.com/wp-content/uploads/2021/09/logo-Google-1.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'المقطم',
            'type' => 'عميل',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'الحمد',
            'phone' => '01616436431',
            'logo' => function () {
                $url = "https://duckworthbooks.com/wp-content/uploads/2017/06/logo-tv-logo.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'بنى سويف',
            'type' => 'عميل',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'فيداكس',
            'phone' => '01115436432',
            'logo' => function () {
                $url = "https://cdn.logo.com/hotlink-ok/logo-social-sq.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'المقطم',
            'type' => 'عميل',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'موسي',
            'phone' => '01115436432',
            'logo' => function () {
                $url = "https://static-cse.canva.com/_next/static/assets/logo_w2000xh641_3b021976d60d0277e95febf805ad9fe8c7d6d54f86969ec03b83299084b7cb93.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'المقطم',
            'type' => 'مورد',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'نيكى',
            'phone' => '01515436432',
            'logo' => function () {
                $url = "https://logos-world.net/wp-content/uploads/2020/12/Lays-Logo.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'اسوان',
            'type' => 'مورد',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'السلام',
            'phone' => '01215436431',
            'logo' => 'no_image.png',
            'address' => 'المقطم',
            'type' => 'عميل',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'لكو',
            'phone' => '01515436432',
            'logo' => function () {
                $url = "https://cdn.cookielaw.org/logos/b53abdb2-31cd-46f6-8017-f40e68b8194a/7c45c70a-b4e7-4479-8911-7159fff625a8/46fe07db-8c82-4ea0-9d90-4bf5fdb735ad/salesloft-logo-full-color-rgb.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'عين شمس',
            'type' => 'مورد',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'بفاريا',
            'phone' => '01515436432',
            'logo' => function () {
                $url = "https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Disney_wordmark.svg/1200px-Disney_wordmark.svg.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'عين شمس',
            'type' => 'مورد',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'سبوتى فاى',
            'phone' => '01515436432',
            'logo' => function () {
                $url = "https://elahrarpress.com/wp-content/uploads/2019/08/Spotify-logo.png";
                $contents = file_get_contents($url);
                $name = substr($url, strrpos($url, '/') + 1);
                Storage::put('public/image/people/' . $name, $contents);
                return 'image/people/' . $name;
            },
            'address' => 'حمام الثلاث',
            'type' => 'مورد',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory()->create([
            'name' => 'شيرو',
            'phone' => '01215436431',
            'logo' => 'no_image.png',
            'address' => 'حمام الثلاث',
            'type' => 'عميل',
            'user_id' => User::all()->random()->id,
        ]);
        People::factory(15)->create();
        People::factory(15)->create();
        People::factory(15)->create();
        People::factory(15)->create();
        People::factory(15)->create();
        People::factory(15)->create();
        People::factory(15)->create();
        People::factory(15)->create();
        People::factory(15)->create();
        People::factory(15)->create();
        People::factory(15)->create();
    }
}
