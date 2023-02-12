<?php

namespace App\Models\ACL;

use App\Models\ACL\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Permission extends Model
{
    use HasFactory ;

    protected $fillable = ['key', 'title'];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    const LIST_OF_PERMISSIONS = [
        // 'manage_news'               =>      ['title' => 'مدیریت اخبار'],
        // 'edit_news'                 =>      ['title' => 'مجاز به ویرایش اخبار' ],
        // 'create_news'               =>      ['title' => 'مجاز به ساخت اخبار' ],
        // 'delete_news'               =>      ['title' => 'مجاز به حذف اخبار' ],
        // 'manage_places'             =>      ['title' => 'مدیریت مکان گردشگری'],
        // 'edit_places'               =>      ['title' => 'مجاز به ویرایش مکان گردشگری' ],
        // 'create_places'             =>      ['title' => 'مجاز به ساخت مکان گردشگری' ],
        // 'delete_places'             =>      ['title' => 'مجاز به حذف مکان گردشگری' ],
        // 'manage_public_cell'        =>      ['title' => 'مدیریت فراخوان عمومی'],
        // 'edit_public_cell'          =>      ['title' => 'مجاز به ویرایش فراخوان عمومی' ],
        // 'create_public_cell'        =>      ['title' => 'مجاز به ساخت فراخوان عمومی' ],
        // 'delete_public_cell'        =>      ['title' => 'مجاز به حذف فراخوان عمومی' ],
        // 'manage_sliders'            =>      ['title' => 'مدیریت اسلایدر'],
        // 'edit_slider'               =>      ['title' => 'مجاز به ویرایش اسلایدر ها' ],
        // 'delete_slider'             =>      ['title' => 'مجاز به حذف اسلایدر ها' ],
        // 'create_slider'             =>      ['title' => 'مجاز به ساخت اسلایدر ها' ],
        // 'manage_pages'              =>      ['title' => 'مدیریت صفحات'],
        // 'edit_page'                 =>      ['title' => 'مجاز به ویرایش صفحات' ],
        // 'delete_page'               =>      ['title' => 'مجاز به حذف صفحات' ],
        // 'create_page'               =>      ['title' => 'مجاز به ساخت صفحات' ],
        // 'manage_menus'              =>      ['title' => 'مدیریت منو'],
        // 'edit_menu'                 =>      ['title' => 'مجاز به ویرایش منوها' ],
        // 'delete_menu'               =>      ['title' => 'مجاز به حذف منوها' ],
        // 'create_menu'               =>      ['title' => 'مجاز به ساخت منوها' ],
        // 'manage_users'              =>      ['title' => 'مدیریت کاربران'],
        // 'edit_user'                 =>      ['title' => 'مجاز به ویرایش کاربران' ],
        // 'delete_user'               =>      ['title' => 'مجاز به حذف کاربران' ],
        // 'create_user'               =>      ['title' => 'مجاز به ساخت کاربران' ],
        // 'set_user_permission'       =>      ['title' => 'دسترسی دادن به کاربران' ],
        // 'manage_files'              =>      ['title' => 'مدیریت فایل ها'],
        // 'manage_logs'               =>      ['title' => 'مدیریت لاگ ها' ],
        // 'restore_trashed'           =>      ['title' => 'بازیابی از سطل زباله' , ],
        // 'delete_trashed'            =>      ['title' => 'حذف از سطل زباله' ],
        'manage_roles'              =>      ['title' => 'مدیریت نقش ها' ],
        'delete_roles'              =>      ['title' => 'مجاز به حذف نقش ها' ],
        'edit_roles'                =>      ['title' => 'مجاز به ویرایش نقش ها' ],
        'create_roles'              =>      ['title' => 'مجاز به ساخت نقش ها' ],
        'set_user_permission_role'  =>      ['title' => 'دسترسی دادن به نقش ها' ],
    ];

    


}