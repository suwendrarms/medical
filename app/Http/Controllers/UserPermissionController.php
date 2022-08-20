<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role_has_permission;
use App\Models\User;

class UserPermissionController extends Controller
{
    //use HasRoles;
    //protected $guard_name='web';

    public function index()
    {
        $permissions = Permission::where('delete_status',null)->get();
       // dd($permissions);
        $roles = Role::where('delete_status',null)->get();
        return view('pages.user_permissions.role',compact('permissions','roles'));
    }

    public function permissionIndex()
    {

        $permissions = Permission::where('delete_status',null)->get();
        return view('pages.user_permissions.permission',compact('permissions'));
    }

    public function Create(){
        $permissions = Permission::where('delete_status',null)->get();
        //dd($permissions);
        $roles = Role::get();
        return view('pages.user_permissions.role_create',compact('permissions','roles'));
    }

    public function permissionForUser()
    {
        $roles = Role::where('delete_status',null)->get();
        $users =User::all();
        $data=[];

        foreach($users as $val){
           //dd(count($val->roles->pluck('name')));
           //dd($val->hasAllRoles(Role::all()));
           if(count($val->roles->pluck('name'))!=0){
               $data[]=['id'=>$val->id,'dev_id'=>$val->device_id,'name'=>$val->name,'email'=>$val->email,'role'=>$val->roles->pluck('name')];
           }
        }
       // dd($data);
        return view('pages.user_permissions.give_user_permission',compact('roles','users','data'));
    }

    public function createUserRole()
    {
        $roles = Role::where('delete_status',null)->get();
        $users =User::all();
        
        return view('pages.user_permissions.user_permission',compact('roles','users'));
    }

    public function editUserRole($id)
    {
        $roles = Role::where('delete_status',null)->get();
        $users =User::where('id',$id)->first();

        //$userDate=$user->id;
        $roleData=[];

        foreach($users->roles as $val){
            $roleData[]=$val->id;
        }

       // dd($roleData);
        
        return view('pages.user_permissions.edit_user_permission',compact('roles','users','roleData'));
    }

    public function UpdateUserRole(Request $request){

              
              $data = $request->all();
              $user=User::where('id',$data['user'])->first();

              foreach($user->roles as $val){
                $user->removeRole($val->id);
              }
      
              foreach($data['roles'] as $role){
                
                  $user->assignRole($role);
                  $rolee=Role::where('id',$role)->first();
               
                  foreach($rolee->permissions as $perm){
      
                      $user->givePermissionTo($perm->id);
                  }
              }

        return redirect()->route('permission.user');
    }

    public function roleCreate(Request $request){
        $data=$request->all();
        //dd( $data['param']);
        $role = Role::create(['name' => $request->name]);

        foreach($data['param'] as $permission){
            $role->givePermissionTo($permission);
        }

        return redirect()->route('role.index');
    }

    public function userRoleRemove(Request $request){
        $user=User::where('id',$request->id)->first();

              foreach($user->roles as $val){
                $user->removeRole($val->id);
              }

        return 'success';
    }

    public function permissionCreate(Request $request){

        $permission = Permission::create(['name' => $request->name]);
        return redirect()->back();
    }

    public function userRoleCreate(Request $request){

        $data = $request->all();
        $user=User::where('id',$data['user'])->first();

       
        foreach($data['roles'] as $role){
          
            $user->assignRole($role);
            $rolee=Role::where('id',$role)->first();
         
            foreach($rolee->permissions as $perm){

                $user->givePermissionTo($perm->id);
            }
        }

        return redirect()->back();
    }

    public function permissionRemove(Request $request){
        $id=$request->id;
     
        $book=Permission::where('id',$id)->update([            
            'delete_status'=>1,               
        ]);
			// DB::table('dealers')
            // ->where('id',$id)
            // ->delete();

		return 'success';	
    }

    public function permissionUpdate(Request $request){

        $book=Permission::where('id',$request->perm_id)->update([            
                    'name'=>$request->name,               
        ]);

        return redirect()->back();
    }

    public function REdit($id){
        $role = Role::where('id',$id)->first();
        $permissions = Permission::where('delete_status',null)->get();
        $permission_role = $role->permissions;

        $data=[];
        foreach($permission_role as $val){
            // dd($val->id);
            $data[]=$val->id;
        }
        //dd($data);

        return view('pages.user_permissions.role_edit',compact('role','permissions','data'));
    }

    public function RoleUpdate(Request $request){
        //dd($request->all());
        $role = Role::where('id',$request->role_id)->first();
        $roles=Role::where('id',$request->role_id)->update([            
            'name'=>$request->name,               
        ]);
        $permission_role = $role->permissions->pluck('name');

        foreach($permission_role as $val){
            $role->revokePermissionTo($val);
        }

        foreach($request['param'] as $permission){

            $role->givePermissionTo($permission);
        }

        return redirect()->route('role.index');

    }

    public function RoleRemove(Request $request){
        $roles=Role::where('id',$request->id)->update([            
            'delete_status'=>1,               
        ]);
        $role = Role::where('id',$request->id)->first();
        $permission_role = $role->permissions->pluck('name');

        foreach($permission_role as $val){
            $role->revokePermissionTo($val);
        }

        return 'success';
    }
}
