# Slim Shopping Cart

![GitHub repo size](https://img.shields.io/github/repo-size/codinglinhtinh/Slim-Shopping-Cart?style=for-the-badge)
![GitHub language count](https://img.shields.io/github/languages/count/codinglinhtinh/Slim-Shopping-Cart?style=for-the-badge)
![GitHub forks](https://img.shields.io/github/forks/codinglinhtinh/Slim-Shopping-Cart?style=for-the-badge)
![Bitbucket open issues](https://img.shields.io/bitbucket/issues/codinglinhtinh/Slim-Shopping-Cart?style=for-the-badge)
![Bitbucket open pull requests](https://img.shields.io/bitbucket/pr-raw/codinglinhtinh/Slim-Shopping-Cart?style=for-the-badge)


## Description
>Một mô hình thanh toán dạng sandbox.

>Sử dụng Braintree, thanh toán thông qua PayPal.

>Áp dụng PHP framework: Slim 3.0.

## Getting Started
### 💻 Dependencies

* Nên sử dụng SublimeText 3 hoặc 4.
* Nên cài đặt sẵn XAMPP

### 🚀 Installing

* XAMPP download👇👇


    <a href="https://www.apachefriends.org/download.html">
        Download Here
    </a>

* Trong XAMPP Control Panel
-->Nhấn vào <b>Config</b> ở góc phải màn hình.
--><b>Autostart of modules</b>: Nhấn vào Apache, MySQL --> Save => Nó sẽ tự khởi động server cùng với máy tính.

* Sử dụng composer(v7.x.x) để cài tất cả:

---> Slim 

<code>
    composer require slim/slim "^3.0"
</code>


---> Illuminate/database

<code>
    composer require illuminate/database "^5.4"
</code>


---> Slim-bridge

<code>
    composer require php-di/slim-bridge "^1.1.0"
</code>


---> Vlucas/phpdotenv

<code>
    composer require vlucas/phpdotenv "^2.4"
</code>


---> Respect/validation

<code>
    composer require respect/validation "^1.1"
</code>


---> Ircmaxell/random-lib

<code>
    composer require ircmaxell/random-lib "^1.2"
</code>


---> Slim/twig-view

<code>
    composer require slim/twig-view "^2.1.1"
</code>


---> Braintree/braintree_php

<code>
    composer require braintree/braintree_php "^3.22"
</code>


### 🚀 Executing program

* Mở SQL trong XAMPP theo đường dẫn <a href="http://localhost:80/phpmyadminh"> http://localhost:80/phpmyadminh</a> | <a href="http://localhost:8080/phpmyadmin"> http://localhost:8080/phpmyadmin</a>
* Tạo một database mới đặt tên là 'cart'(có thể thay đổi trong file .env), sử dụng file 'db_schema.sql' để tạo bảng.

## 📫 Contributing to Slim Shopping Cart
Để đóng góp Slim-Shopping-Cart hãy làm theo các bước sau:

    >1. Fork kho lưu trữ này.
    >2. Tạo một nhánh: `git checkout -b <branch_name>`.
    >3. Thực hiện các thay đổi của bạn và commit chúng: `` git commit -m '<commit_message>' '
    >4. Gửi đến nhánh gốc: `git push origin <project_name> / <location>`
    >5. Tạo yêu cầu fork.

Hoặc là thả sao ⭐⭐⭐⭐⭐

## 🔎 Help

### 🛒 Braintree PayPal Payment
* Hãy truy cập vào trang <a href="https://www.braintreepayments.com/sandbox"> Braintree sandbox </a> và tạo một tài khoản Braintree, đừng lo vì nó free mà :> 

* Sau khi đã đăng ký xong, hãy nhấn vào biểu tượng này ⚙ ở góc phải trên màn hình, chọn <b>API</b>. Ở <b>API Keys</b>, bạn nhấn <b>View</b> ở dưới <i>PrivateKey</i>. Lúc này bạn sẽ thấy tất cả Key, Copy chúng vào file .env, lưu ý không thêm ký tự gì vào, chỉ copy và bỏ vô thôi.

Chúc bạn thành công!
Bạn có thể báo lỗi ở Issues. 

## 🧐 Authors

CodingLinhTinh 
[Gmail](ngocquachgamedevz@gmail.com)


## License

This project is licensed under the ISC License.

## See my other repos
<a href="https://github.com/CodingLinhTinh/Node.js-blockchain-basic.git">BlockChain Basic with Node.js, TypeScript</a>

<a href="https://github.com/CodingLinhTinh/Cookies-Auto-Clicking-Bot.git">Cookies-Auto-Clicking-Bot</a>
