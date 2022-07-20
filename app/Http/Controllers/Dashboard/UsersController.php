<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = [
            'title' => 'Users management'
        ];
        return view("dashboard.pages.users.index", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $id= $request->id ? ",$request->id" : null;

        $request->validate([
            'name' => 'required|string',
            'email'=>'required|email|unique:users,email'.$id,
            'password' => 'sometimes|required|confirmed|min:8',
            'type' => 'sometimes|nullable',
            'status' => 'sometimes|nullable|in:active,blocked'
        ]);

        $request->merge(['password' => Hash::make($request->password)]);

        $data = User::updateOrCreate(['id' => $request->id],$request->except("_token","id"));

        return json("$request->name was updated successfully", 1, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function block(Request $request, User $user)
    {
        abort_if(!$request->ajax(), 404);

        $data = $user->update([
            'status' => $user->isBlocked() ? "active" : "blocked"
        ]);

        return json("$user->name was blocked successfully", 1, $data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return json(msg: "$user->name was deleted successfully", status: 1);
    }

    /**
     *
     *
     * @param Request $request
     * @return JsonResponse|never
     * @throws \Yajra\DataTables\Exceptions\Exception
     */
    public function apiIndex(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(User::orderByDesc("created_at")->get())
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('type', function ($data) {
                    $color = $data->type == "admin" ? "success" : "dark";
                    return "<a class='text-$color text-dark'>" . ucfirst($data->type) . "</a>";
                })
                ->addColumn('status', function ($data) {
                    $color = $data->status == "blocked" ? "danger" : "success";
                    $status = ucfirst($data->status);

                    return "<span class='badge badge-$color'>$status</span>";
                })
                ->addColumn('action', function ($data) use ($request) {
                    $btn = "<div class='btn btn-primary mr-1 btn-edit-user' title='Edit $data->name' data-data='$data'><i class='fa fa-edit'></i> Edit</div>";


                    $blockClass = $data->isBlocked() ? "btn-info" : "btn-warning";
                    $blockTitle = $data->isBlocked() ? "Active" : "Block";
                    $btn .= "<div class='btn mr-1 btn-block-user $blockClass' data-widget='" . $data->isBlocked() . "' title='$blockTitle $data->name' data-name='$data->name' data-id='$data->id'><i class='fa-solid fa-ban'></i> $blockTitle</div>";

                    $btn .= '<button class="btn btn-danger btn-delete " type="button"
                       data-url="' . route("users.destroy", $data->id) . '"
                       data-name="' . ($data->name) . '"
                       data-token="' . csrf_token() . '"
                       data-title="Are you Sure"
                       data-text="Delete ' . ($data->name) . '"
                       data-back="' . route("users.index") . '">
                       <i class="fa fa-trash"></i> Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'type', 'status'])
                ->make(true);
        } //end if cond
        return abort(404);
    }

}
