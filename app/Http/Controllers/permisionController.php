<?php

namespace App\Http\Controllers;
use App\Models\season;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class permisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public function test()
{
    $user =User::findorfail();
    $user->password= Hash::make('12312312');
$user->save();

}

    public function index()
    {

        return view('Permission.permission',['Grades'=>\App\Models\permission::all(),'seasons'=>season::all()]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
/*8
        $permission = \Spatie\Permission\Models\Permission::create(['name' => 'view register']);
        $permission = Permission::create(['name' => 'update register']);
        $permission = Permission::create(['name' => 'delete register']);
        $permission = Permission::create(['name' => 'view user']);
        $permission = Permission::create(['name' => 'update user']);
        $permission = Permission::create(['name' => 'delete user']);
        $permission = Permission::create(['name' => 'add user']);
  **/
        $permission = Permission::create(['name' => 'add final']);
        $permission = Permission::create(['name' => 'view final']);
        $permission = Permission::create(['name' => 'delete final']);
        $permission = Permission::create(['name' => 'view setting']);
        $permission = Permission::create(['name' => 'update setting']);
        $permission = Permission::create(['name' => 'add season']);
        $permission = Permission::create(['name' => 'delete season']);
        $permission = Permission::create(['name' => 'view refree']);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $user=User::findorfail($request->id);
        if($request->viewregister)
        $user->givePermissionTo('view register');

        if($request->updateregister)
            $user->givePermissionTo('update register');
        if($request->deleteregister)
            $user->givePermissionTo('delete register');
        if($request->viewuser)
            $user->givePermissionTo('view user');
        if($request->adduser)
            $user->givePermissionTo('add user');
        if($request->updateuser)
            $user->givePermissionTo('update user');
        if($request->deleteuser)
            $user->givePermissionTo('deleteuser');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $user=User::findorfail($request->id);
        if($request->viewregister)
            $user->givePermissionTo('view register');
else
    $user->revokePermissionTo('view register');
        if($request->viewuser)
            $user->givePermissionTo('view user');
        else
            $user->revokePermissionTo('view user');

        if($request->viewfinal)
            $user->givePermissionTo('view final');
        else
            $user->revokePermissionTo('view final');
        if($request->viewsetting)
            $user->givePermissionTo('view setting');
        else
            $user->revokePermissionTo('view setting');
        if($request->viewrefree)
            $user->givePermissionTo('view refree');
        else
            $user->revokePermissionTo('view refree');



        if($request->updateregister) {
            $user->givePermissionTo('update register');
            $user->givePermissionTo('view register');

        }else
            $user->revokePermissionTo('update register');

        if($request->deleteregister) {
            $user->givePermissionTo('delete register');
            $user->givePermissionTo('view register');

        }else
            $user->revokePermissionTo('delete register');
        if($request->adduser) {
            $user->givePermissionTo('add user');
            $user->givePermissionTo('view user');
        }
        else
            $user->revokePermissionTo('add user');



        if($request->updateuser) {
            $user->givePermissionTo('update user');
            $user->givePermissionTo('view user');

        } else
            $user->revokePermissionTo('update user');

        if($request->deleteuser) {
            $user->givePermissionTo('delete user');
            $user->givePermissionTo('view user');

        }else
            $user->revokePermissionTo('delete user');

        if($request->deletefinal) {
            $user->givePermissionTo('delete final');
            $user->givePermissionTo('view final');
        }
        else
            $user->revokePermissionTo('delete final');
        if($request->deleteseason) {
            $user->givePermissionTo('delete season');
            $user->givePermissionTo('view setting');

        }
        else
            $user->revokePermissionTo('delete season');
        if($request->addfinal) {
            $user->givePermissionTo('add final');
            $user->givePermissionTo('view refree');

        }
        else
            $user->revokePermissionTo('add final');
        if($request->addseason) {
            $user->givePermissionTo('add season');
            $user->givePermissionTo('view setting');

        }
        else
            $user->revokePermissionTo('add season');
        if($request->updatesetting) {
            $user->givePermissionTo('update setting');
            $user->givePermissionTo('view setting');

        }
        else
            $user->revokePermissionTo('update setting');
toastr()->success('dsadsadas');

  return redirect()->to( route('add_new_user'));
    }
public function add_valide_time_to_user(Request $request)
{
    $user = User::findorfail($request->id);
//return $request;
    if ($request->active==1) {
        $user->status = 1;
        $user->validetime = null;

    } elseif ($request->active==0) {

        $user->status = 0;
        $user->validetime = null;

    }
    else{
        $user->status = 1;
    $user->validetime = $request->validetime;
}
$user->save();
    toastr()->success('تمت العملية بنجاح');
return redirect()->to(route('add_new_user'));
}




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {

        $user=permission::findorfail($request->id);

        $user->delete();
    }
}
