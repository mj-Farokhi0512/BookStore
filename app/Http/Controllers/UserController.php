<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //

    public function show(Request $request): View
    {
        // User::factory(5)->create();
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('deleted_at', '=', null);
        $sort = $request->query('sort_by');

        switch ($sort) {
            case 'name':
                $users = $users->orderBy('name', 'asc')->paginate(10);
                break;
            case 'date':
                $users = $users->orderBy('created_at', 'asc')->paginate(10);
                break;
            default:
                $users = $users->paginate(10);
        }

        return view('dashboard.user.users', ['users' => $users, 'roles' => Role::all()]);
    }

    public function destroy(Request $request): array
    {
        $user = User::find($request->input('id'));

        $user->delete();

        return ['message' => "کاربر با موفقیت حذف شد"];
    }

    public function info(Request $request): array
    {
        $user = User::find($request->get('id'));
        return ["user" => ['id' => $user->id, 'name' => $user->name, "email" => $user->email]];
    }

    public function updateRole(Request $request)
    {
        //        $user_role = DB::table('model_has_roles')
        //            ->where('model_id', '=', $request->userId)
        //            ->where('deleted_at', '=', null);
        //
        //        $user_role->update([
        //            'role_id' => $request->roleId
        //        ]);
        //        $user = $user_role->first();
        $user = User::find($request->get('userId'));
        $role_name = Role::find($request->get('roleId'));
        $user->syncRoles([$role_name]);
        return ['user' => ['role_id' => $user->roles[0]->pivot->role_id, 'user_id' => $user->roles[0]->pivot->model_id]];
    }

    public function updateStatus(Request $request, $id): array
    {
        $user = User::where('id', '=', $id)
            ->where('deleted_at', '=', null);
        $user->update([
            'status' => $user->first()->status == 1 ? false : true,
        ]);
        return ['user' => $user->first()];
    }

    public function update(UpdateUsersRequest $request, $id): array
    {
        $validated = $request->validated();

        $user = User::find($id);

        $user->update([
            'name' => $validated['name'],
            'password' => Hash::make($validated['password'])
        ]);

        return ['message' => "کاربر با موفقیت آپدیت شد", 'user' => ['id' => $user->id, 'name' => $user->name]];
    }

    public function search(Request $request): array
    {
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_id')
            ->where('deleted_at', '=', null)
            ->where('name', 'like', $request->get('search') . '%')
            ->select(['id', 'name', 'profile', 'email', 'created_at', 'status', 'role_id'])
            ->get();
        $roles = Role::all();
        return ['users' => $users, 'roles' => $roles];
    }
}
