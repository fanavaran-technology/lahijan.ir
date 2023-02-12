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
        'manage_news'               =>      ['title' => 'مدیریت اخبار', 'check_owner' => false],
        'edit_news'                 =>      ['title' => 'مجاز به ویرایش اخبار' , 'check_owner' => false],
        'publish_news'              =>      ['title' => 'مجاز به انتشار اخبار' , 'check_owner' => false],
        'delete_news'               =>      ['title' => 'مجاز به حذف اخبار' , 'check_owner' => false],
        'manage_places'             =>      ['title' => 'مدیریت مکان گردشگری', 'check_owner' => false],
        'edit_places'               =>      ['title' => 'مجاز به ویرایش مکان گردشگری' , 'check_owner' => false],
        'publish_places'            =>      ['title' => 'مجاز به انتشار مکان گردشگری' , 'check_owner' => false],
        'delete_places'             =>      ['title' => 'مجاز به حذف مکان گردشگری' , 'check_owner' => false],
        'manage_public_cell'        =>      ['title' => 'مدیریت فراخوان عمومی', 'check_owner' => false],
        'edit_public_cell'          =>      ['title' => 'مجاز به ویرایش فراخوان عمومی' , 'check_owner' => false],
        'publish_public_cell'       =>      ['title' => 'مجاز به انتشار فراخوان عمومی' , 'check_owner' => false],
        'delete_public_cell'        =>      ['title' => 'مجاز به حذف فراخوان عمومی' , 'check_owner' => false],
        'manage_sliders'            =>      ['title' => 'مدیریت اسلایدر', 'check_owner' => false],
        'edit_slider'               =>      ['title' => 'مجاز به ویرایش اسلایدر ها' , 'check_owner' => false],
        'delete_slider'             =>      ['title' => 'مجاز به حذف اسلایدر ها' , 'check_owner' => false],
        'manage_pages'              =>      ['title' => 'مدیریت صفحات', 'check_owner' => false],
        'edit_page'                 =>      ['title' => 'مجاز به ویرایش صفحات' , 'check_owner' => false],
        'delete_page'               =>      ['title' => 'مجاز به حذف صفحات' , 'check_owner' => false],
        'manage_menus'              =>      ['title' => 'مدیریت منو', 'check_owner' => false],
        'edit_menu'                 =>      ['title' => 'مجاز به ویرایش منوها' , 'check_owner' => false],
        'delete_menu'               =>      ['title' => 'مجاز به حذف منوها' , 'check_owner' => false],
        'manage_users'              =>      ['title' => 'مدیریت کاربران', 'check_owner' => false],
        'edit_user'                 =>      ['title' => 'مجاز به ویرایش کاربران' , 'check_owner' => false],
        'delete_user'               =>      ['title' => 'مجاز به حذف کاربران' , 'check_owner' => false],
        'set_user_permission'       =>      ['title' => 'دسترسی دادن به کاربران' , 'check_owner' => false],
        'manage_permissions'        =>      ['title' => 'مدیریت دسترسی ها', 'check_owner' => false],
        'edit_permission'           =>      ['title' => 'مجاز به ویرایش دسترسی' , 'check_owner' => false],
        'delete_permission'         =>      ['title' => 'مجاز به حذف دسترسی' , 'check_owner' => false],
        'manage_files'              =>      ['title' => 'مدیریت فایل ها', 'check_owner' => false],
        'manage_logs'               =>      ['title' => 'مدیریت لاگ ها' , 'check_owner' => false],
        'restore_trashed'           =>      ['title' => 'بازیابی از سطل زباله' , 'check_owner' => false],
        'delete_trashed'            =>      ['title' => 'حذف از سطل زباله' , 'check_owner' => false],
        'manage_roles'              =>      ['title' => 'مدیریت نقش ها' , 'check_owner' => false],
    ];

    


}