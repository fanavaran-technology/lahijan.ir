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
        'manage_news'               =>      ['title' => 'مدیریت اخبار'],
        'edit_news'                 =>      ['title' => 'مجاز به ویرایش اخبار' ],
        'publish_news'              =>      ['title' => 'مجاز به انتشار اخبار' ],
        'delete_news'               =>      ['title' => 'مجاز به حذف اخبار' ],
        // 'manage_places'             =>      ['title' => 'مدیریت مکان گردشگری'],
        // 'edit_places'               =>      ['title' => 'مجاز به ویرایش مکان گردشگری' ],
        // 'publish_places'            =>      ['title' => 'مجاز به انتشار مکان گردشگری' ],
        // 'delete_places'             =>      ['title' => 'مجاز به حذف مکان گردشگری' ],
        // 'manage_public_cell'        =>      ['title' => 'مدیریت فراخوان عمومی'],
        // 'edit_public_cell'          =>      ['title' => 'مجاز به ویرایش فراخوان عمومی' ],
        // 'publish_public_cell'       =>      ['title' => 'مجاز به انتشار فراخوان عمومی' ],
        // 'delete_public_cell'        =>      ['title' => 'مجاز به حذف فراخوان عمومی' ],
        // 'manage_sliders'            =>      ['title' => 'مدیریت اسلایدر'],
        // 'edit_slider'               =>      ['title' => 'مجاز به ویرایش اسلایدر ها' ],
        // 'delete_slider'             =>      ['title' => 'مجاز به حذف اسلایدر ها' ],
        // 'manage_pages'              =>      ['title' => 'مدیریت صفحات'],
        // 'edit_page'                 =>      ['title' => 'مجاز به ویرایش صفحات' ],
        // 'delete_page'               =>      ['title' => 'مجاز به حذف صفحات' ],
        // 'manage_menus'              =>      ['title' => 'مدیریت منو'],
        // 'edit_menu'                 =>      ['title' => 'مجاز به ویرایش منوها' ],
        // 'delete_menu'               =>      ['title' => 'مجاز به حذف منوها' ],
        'manage_users'              =>      ['title' => 'مدیریت کاربران'],
        'edit_user'                 =>      ['title' => 'مجاز به ویرایش کاربران' ],
        'delete_user'               =>      ['title' => 'مجاز به حذف کاربران' ],
        // 'set_user_permission'       =>      ['title' => 'دسترسی دادن به کاربران' , ],
        // 'manage_permissions'        =>      ['title' => 'مدیریت دسترسی ها'],
        // 'edit_permission'           =>      ['title' => 'مجاز به ویرایش دسترسی' ],
        // 'delete_permission'         =>      ['title' => 'مجاز به حذف دسترسی' ],
        // 'manage_files'              =>      ['title' => 'مدیریت فایل ها'],
        // 'manage_logs'               =>      ['title' => 'مدیریت لاگ ها' ],
        // 'restore_trashed'           =>      ['title' => 'بازیابی از سطل زباله' , ],
        // 'delete_trashed'            =>      ['title' => 'حذف از سطل زباله' ],
        // 'manage_roles'              =>      ['title' => 'مدیریت نقش ها' ],
    ];

    


}