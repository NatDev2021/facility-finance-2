<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\CreateUser;
use App\Models\Menu;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Helper;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');

        parent::__construct($request);
    }

    public function newUser()
    {
        return view('user.newUser');
    }

    public function userPage($id)
    {

        $user = User::find($id);

        $userPermissions = new UserPermissions();
        $permissions = $userPermissions->where('user_id', $id)->get()->toArray();
        $arrayPermissions = array_map(function ($item) {
            return $item['sub_menu_id'];
        }, $permissions);

        $menus = Menu::select('conf_menu.*')
            ->with(['subMenus' => function ($query) {
                $query->where('conf_sub_menus.actived', true);
            }])
            ->join('conf_sub_menus', 'conf_menu.id', '=', 'conf_sub_menus.menu_id')
            ->where('conf_menu.actived', true)
            ->groupBy('conf_menu.id')
            ->get();

        foreach ($menus as $key => $rows) {


            foreach ($rows->subMenus as $subKey => $subRows) {

                if (in_array($subRows->id, $arrayPermissions)) {
                    $menus[$key]->subMenus[$subKey]['checked'] = 'checked';
                }
            }
        }


        return view('user.userPage', [
            'user' => $user,
            'user_permissions' => $menus
        ]);
    }

    public function saveUser()
    {
        $data = $this->request->post();

        if (empty($data['id_user'])) {
            $idUser =  $this->createUser($data);
        } else {
            $idUser = $this->updateUser($data);
        }

        return redirect('/user/page/' .  $idUser);
    }

    public function createUser($data)
    {
        $user = User::create([
            'document' => Helper::removeMask($data['document'] ?? ''),
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'profile' => $data['profile'] ?? null,
            "id_user_ins" => $this->request->user()->id,
            'image_profile' => 'avatar.png',
            'password' => Hash::make(Helper::removeMask($data['document'] ?? '') . '@' . date("Y")),

        ]);

        Mail::to($data['email'], $data['name'])->send(new CreateUser([
            'url' =>route('first_access', ['token' => Password::createToken($user),
            'email' => $data['email']
            ])
        ]));


        toast('Usuário criado.', 'success');
        return $user->id;
    }

    public function updateUser($data)
    {

        $user = User::find($data['id_user']);

        $user->update([
            'document' => Helper::removeMask($data['document'] ?? ''),
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'profile' => $data['profile'] ?? null
        ]);


        $this->updatePermissions($data);

        toast('Usuário atualizao.', 'success');
        return $data['id_user'];
    }

    private function updatePermissions(array|string|null $data): bool
    {
        $userPermissions = new UserPermissions();
        $userPermissions::where('user_id', $data['id_user'])->delete();

        if (!empty($data['permissions'])) {

            foreach ($data['permissions'] as $row) {

                $userPermissions::create([
                    'id_user_ins' => $this->request->user()->id,
                    'user_id' => $data['id_user'],
                    'sub_menu_id' => $row
                ]);
            }
        }

        return true;
    }
}
