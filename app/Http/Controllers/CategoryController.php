<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Morilog\Jalali\Jalalian;

class CategoryController extends Controller
{
    public function create(Request $request): array
    {
        $validate = $request->validate([
            'name' => ['required', 'max:50', 'regex:/^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/', Rule::unique(Category::class)]
        ], [
            'name.regex' => 'دسته بندی وارد شده معتبر نیست',
            'name.unique' => 'این دسته بندی تکراری است'
        ]);

        $cate = new Category();
        $cate->name = $validate['name'];
        $cate->status = $request->get('status') ? 1 : 0;

        $cate->save();

        $jdate = Jalalian::fromDateTime($cate->created_at)->format('ِY/m/d');
        return ['cate' => ['id' => $cate->id, 'name' => $cate->name, 'status' => $cate->status, 'date' => $jdate]];
    }

    public function getCates(): array
    {
        $cates = Category::query()->where('status', '!=', 0)->pluck('name')->toArray();
        return $cates;
    }

    public function updateStatus($id): array
    {
        $cate = Category::find($id);

        $cate->status = $cate->status ? 0 : 1;
        $cate->update();

        return ['cate' => ['id' => $cate->id, 'status' => $cate->status]];
    }

    public function update(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'max:50', 'regex:/^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/', Rule::unique(Category::class)]
        ], [
            'name.regex' => 'دسته بندی وارد شده معتبر نیست',
            'name.unique' => 'این دسته بندی تکراری است'
        ]);
        $cate = Category::find($request->get('id'));
        $cate->update([
            'name' => $validated['name']
        ]);

        return ['cate' => $cate];
    }

    public function getInfo($id): array
    {
        $cate = Category::where('id', '=', $id)->where('deleted_at', '=', null)->first();

        return ['cate' => $cate];
    }

    public function delete($id): array
    {
        $cate = Category::find($id);
        $cate->delete();
        return ['id' => $cate->id];
    }

    public function search(Request $request): array
    {
        $sCats = Category::where('name', 'like', $request->get('name') . '%')->get();
        return ['cats' => $sCats];
    }
}
