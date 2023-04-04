<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Morilog\Jalali\Jalalian;

class TagController extends Controller
{
    public function create(Request $request): array
    {
        $validate = $request->validate([
            'name' => ['required', 'max:50', 'regex:/^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/', Rule::unique(Tag::class)]
        ], [
            'name.regex' => 'دسته بندی وارد شده معتبر نیست',
            'name.unique' => 'این برچسب تکراری است'
        ]);

        $tag = new Tag();
        $tag->name = $validate['name'];
        $tag->status = $request->get('status') == null ? 1 : ($request->get('status') ? 1 : 0);

        $tag->save();

        $jdate = Jalalian::fromDateTime($tag->create_at)->format('Y/m/d');

        return ['tag' => ['id' => $tag->id, 'name' => $tag->name, 'status' => $tag->status, 'date' => $jdate]];
    }

    public function getTags(): array
    {
        $tags = Tag::query()->where('status', '!=', 0)->pluck('name')->toArray();

        return $tags;
    }

    public function updateStatus($id): array
    {
        $tag = Tag::find($id);

        $tag->status = $tag->status ? 0 : 1;
        $tag->update();

        return ['tag' => $tag];
    }

    public function update(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'max:50', 'regex:/^(?:(?![`@$%^&*+\=\\|<>\/~]).)*$/', Rule::unique(Tag::class)]
        ], [
            'name.regex' => 'دسته بندی وارد شده معتبر نیست',
            'name.unique' => 'این دسته بندی تکراری است'
        ]);

        $tag = Tag::find($request->get('id'));
        $tag->name = $validated['name'];

        $tag->update();

        return ['tag' => $tag];
    }

    public function getInfo($id): array
    {
        $tag = Tag::find($id);

        return ['tag' => $tag];
    }

    public function delete($id): array
    {
        $tag = Tag::find($id);
        $tag->delete();
        return ['id' => $tag->id];
    }

    public function search(Request $request): array
    {
        $sTags = Tag::where('name', 'like', $request->get('name') . '%')->get();
        return ['tags' => $sTags];
    }
}
