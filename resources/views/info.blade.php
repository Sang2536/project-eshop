{{--
npm install         (chưa có sẵn, phải cài từ bên ngoài vào nếu muốn sử dụng nó)
    bootstrap
    jquery
    popperjs
    datatables
    fontawesome

composer require    (dã có sẵn, chỉ yêu cầu chạy khi cần sử dụng)
    laravelcollective/html      (Laravel Collective Form)       (hỗ trợ viết html nhanh trong Blade)

php artisan         (tao các fie phuc vụ)
    migrate
    model
    controller
    view
    request

???
    1.   lafm ntn ddeer project chạy trên nhiều môi trường khác nhau?
        ->  Cấu hình nhiều file môi trường (.env). Cấu hình ntn?

Project
    1. Auth:   Login, Logout, Register,
            Change Password, Forgot Password, Password Expired,
            Two Factor Authentication, Email Verification
    2. CRUD: Categories, Products, Tags,
            Users, Contacts,
            Bills,

Custom Laravel
    1. Custom helper Laravel
        B1: Create file helper in app/Helpers/Helper.php
        B2: Add helper file path in composer.json file (in "autoload")
            "files": [
                "app/Helpers/Helper.php"
            ]
        B3: Run Command: composer dump-autoload
        B4: Now, can be used anywhere in the project

    2. Laravel Collection
        -> cung cấp các phương thức cho việc xử lý mảng dữ liệu
            (Ví dụ: dữ liệu trả về từ database là một Collection)
        -> Các Collection hay dùng: all(), get(), first(), pluck(), SortBy(), count()


    Note
    - Auth: Regiser - Login - Logout
    - User: Create - Read - Update
    - Role: Create - Read - Update
    - Unit: Create - Read - Update
    - Category: Create  Read - Update
            -> View(edit + create): Cannot select null
    - Contact: Create - Read - Update
            -> Show: err select
            -> All: Cannot save image + canot read image
    - Product: Create - Read - Update
            -> All: Cannot save image + canot read image
    - Invoie Discount: Create - Read - Update
            -> Create & Update: Unable to display error message
    - Dashboard
            -> too many queries
    - Transaction: Create - Show
            -> Create & Update: Cannot select quantity add/update
            -> Create & Update: Cannot minus 1 after transaction
--}}
