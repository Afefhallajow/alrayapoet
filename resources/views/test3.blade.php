<div>
<form action="{{route('perupdate')}}" method="post">
    @csrf
    <input id="id" type="hidden" name="id" class="form-control"
           value="{{ $user->id }}">
    <ul>
        <div class="row">
            <div style= "    margin-right: 2%;  ;width:19%" class="">
                <label> الحقل</label>
            </div>
            <div style="width:19%" class="">
                <label> اضافة</label>
            </div>

            <div style="width:19%" class="">
                <label> عرض</label>
            </div>
            <div style="width:19%" class="">
                <label>         تعديل
                </label>
            </div>
            <div style="width:19%" class="">
                <label> حذف</label>
            </div>



        </div>
        <div class="row">
            <div style="width:19%" class="">
                <label> المتقدمين</label>
            </div>
            <div style="width:19% ;margin-right: 4%" class="">

                <input  id="" type="checkbox" value="1"  disabled name="" ></input>
            </div>
            <div style="width:19%" class="">

                @if($user->hasPermissionTo("view register"))
                    <input  id="viewregistered" type="checkbox" value="1" checked name="viewregister" ></input>
                @else
                    <input  id="viewregistered" type="checkbox" value="1"  name="viewregister" ></input>
                @endif
            </div> <div style="width:19%" class="">

                @if($user->hasPermissionTo("update register"))
                    <input  id="updateregister" type="checkbox" value="1" checked name="updateregister" > </input>
                @else
                    <input  id="updateregister" type="checkbox" value="1"  name="updateregister" ></input>
                @endif
            </div>
            <div style="width:19%" class="">

                @if($user->hasPermissionTo("delete register"))
                    <input  id="deleteregistered" type="checkbox" value="1" checked name="deleteregister" ></input>
                @else
                    <input  id="deleteregistered" type="checkbox" value="1"  name="deleteregister" ></input>
                @endif

            </div>
        </div>
        <div class="row">
            <div style="width:19%" class="">
                <label>المستخدمين</label>
            </div>
            <div style="width:19%;margin-right: 4%" class="">

                @if($user->hasPermissionTo("add user"))
                    <input  id="adduser" type="checkbox" value="1" checked name="adduser" > </input>
                @else
                    <input  id="adduser" type="checkbox" value="1"  name="adduser" ></input>
                @endif
            </div>

            <div style="width:19%" class="">

                @if($user->hasPermissionTo("view user"))
                    <input  id="viewuser" type="checkbox" value="1" checked name="viewuser" ></input>
                @else
                    <input  id="viewuser" type="checkbox" value="1"  name="viewuser" ></input>
                @endif
            </div> <div style="width:19%" class="">

                @if($user->hasPermissionTo("update user"))
                    <input  id="updateuser" type="checkbox" value="1" checked name="updateuser" > </input>
                @else
                    <input  id="updateuser" type="checkbox" value="1"  name="updateuser" ></input>
                @endif
            </div>            <div style="width:19%" class="">

                @if($user->hasPermissionTo("delete user"))
                    <input  id="deleteuser" type="checkbox" value="1" checked name="deleteuser" ></input>
                @else
                    <input  id="deleteuser" type="checkbox" value="1"  name="deleteuser" ></input>
                @endif

            </div>
        </div>
        <div class="row">
            <div style="width:19%" class="">
                <label>المشاركين</label>
            </div>
            <div style="width:19%;margin-right: 4%" class="">

                @if($user->hasPermissionTo("add final"))
                    <input  id="addfinal" type="checkbox" value="1" checked name="addfinal" > </input>
                @else
                    <input  id="addfinal" type="checkbox" value="1"  name="addfinal" ></input>
                @endif
            </div>

            <div style="width:19%" class="">

                @if($user->hasPermissionTo("view final"))
                    <input  id="viewfinal" type="checkbox" value="1" checked name="viewfinal" ></input>
                @else
                    <input  id="viewfinal" type="checkbox" value="1"  name="viewfinal" ></input>
                @endif
            </div> <div style="width:19%" class="">
                <input  id="" type="checkbox" value="1"  disabled name="" ></input>

            </div>
            <div style="width:19%" class="">

                @if($user->hasPermissionTo("delete final"))
                    <input  id="deletefinal" type="checkbox" value="1" checked name="deletefinal" ></input>
                @else
                    <input  id="deletefinal" type="checkbox" value="1"  name="deletefinal" ></input>
                @endif

            </div>
        </div>
        <div class="row">
            <div style="width:19%" class="">
                <label>الاعدادات</label>
            </div>
            <div style="width:19%;margin-right: 4%" class="">

                <input  id="" type="checkbox" value="1"  disabled name="" ></input>
            </div>

            <div style="width:19%" class="">

                @if($user->hasPermissionTo("view setting"))
                    <input  id="viewsetting" type="checkbox" value="1" checked name="viewsetting" ></input>
                @else
                    <input  id="viewsetting" type="checkbox" value="1"  name="viewsetting" ></input>
                @endif
            </div> <div style="width:19%" class="">

                @if($user->hasPermissionTo("update setting"))
                    <input  id="updatesetting" type="checkbox" value="1" checked name="updatesetting" > </input>
                @else
                    <input  id="updatesetting" type="checkbox" value="1"  name="updatesetting" ></input>
                @endif
            </div>            <div style="width:19%" class="">

                <input  id="" type="checkbox" value="1"  disabled name="" ></input>
            </div>
        </div>
        <div class="row">
            <div style="width:19%" class="">
                <label>موسم</label>
            </div>
            <div style="width:19%;margin-right: 4%" class="">

                @if($user->hasPermissionTo("add season"))
                    <input  id="addseason" type="checkbox" value="1" checked name="addseason" > </input>
                @else
                    <input  id="addseason" type="checkbox" value="1"  name="addseason" ></input>
                @endif
            </div>

            <div style="width:19%" class="">
                <input  id="" type="checkbox" value="1"  disabled name="" ></input>


            </div> <div style="width:19%" class="">
                <input  id="" type="checkbox" value="1"  disabled name="" ></input>
            </div>            <div style="width:19%" class="">

                @if($user->hasPermissionTo("delete season"))
                    <input  id="deleteseason" type="checkbox" value="1" checked name="deleteseason" ></input>
                @else
                    <input  id="deleteseason" type="checkbox" value="1"  name="deleteseason" ></input>
                @endif

            </div>
        </div>
        <div class="row">
            <div style="width:19%" class="">
                <label>لجنة التحكيم</label>
            </div>
            <div style="width:19%;margin-right: 4%" class="">
                <input  id="" type="checkbox" value="1"  disabled name="" ></input>
            </div>

            <div style="width:19%" class="">

                @if($user->hasPermissionTo("view refree"))
                    <input  id="viewrefree" type="checkbox" value="1" checked name="viewrefree" ></input>
                @else
                    <input  id="viewrefree" type="checkbox" value="1"  name="viewrefree" ></input>
                @endif
            </div> <div style="width:19%" class="">

                <input  id="" type="checkbox" value="1"  disabled name="" ></input>
            </div>            <div style="width:19%" class="">

                <input  id="" type="checkbox" value="1"  disabled name="" ></input>

            </div>
        </div>
    </ul>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
                data-dismiss="modal">إلغاء</button>
        <button type="submit"
                class="btn btn-danger">حفظ</button>
    </div>
</form>
</div>
