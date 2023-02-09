<h1 align="center">Project Kiosk Dashboard Admin Web</h1>
<p> Fawaz

# DEV BACKEND
https://api-ekiosk.bisaai.id:8081/ekiosk_dev/
# PROD BACKEND
https://gate.bisaai.id:8080/ekiosk_prod

## Link Yang Sudah Di Deploy Di Server
https://kioskdashboard.bisaai.id/
## Install

```sh
npm install
composer install
```
```sh

## Fix if php error  
composer self-update
composer clear-cache
rm -rf vendor
rm composer.lock
composer install --ignore-platform-reqs
```

## Run tests

```sh
- Composer Install
- NPM Install
- git clone proyek
- cp .env.example .env
- php artisan key:generate
- php artisan storage:link
- php artisan serve
```

## How To Deploy In Server
```sh
No Docker
- Composer Install
- NPM Install
- git clone proyek
- cp .env.example .env
- php artisan key:generate
- php artisan storage:link
```

```sh
Docker 
1. sudo apt update
2. sudo apt install docker.io docker-compose -y
3. docker -v
4. sudo usermod -aG docker $USER
5. sudo reboot
 keluar dahulu
6. docker ps
7. git clone proyek... webapp
8. cek ls masuk cd 
9. cp .env.example .env
10 . docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
11. docker run --rm -it -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    php artisan sail:install
12. 0
13. vendor/bin/sail up -d
14. vendor/bin/sail artisan key:generate
```
## User test
```sh
Super Admin
    Email: superadmin2@gmail.com
    Pass : superadmin2
Admin
    Email: adminpenjual1@gmail.com
    Pass : adminpenjual1
```
## Tata Cara Akses Web Dashboard Admin 
```sh
Tata cara akses web
https://kioskdashboard.bisaai.id/
Disini disediakan 2 role

*Role superadmin 
email:superadmin2@gmail.com
pass : superadmin2

alur
Buat dahulu New client di superadmin
Lalu buat new admin
setelah itu baru bisa buat canteen baru dan parking spot baru
dan kita bisa melihat di overview smart canteen dan smart parking
lalu kita bisa menggunakan role admin kantin tersebut  

Menu Overview 
smart canteen   = disini terdapat list list canteen yang ada beserta beberapa widget-widget dan link data science canteen
smart parking   = disini terdapat list list parking spot yang ada beserta beberapa widget-widget dan link data science parking

Menu canteen 
Canteen List    = Berisi tentang list kantin dan widget widget serta bisa edit dan delete kantin
Add new canteen = Menambah kantin baru
Categories      = Berisi Tentang list kategori seperti makanan minuman dan kategori lainnya

Parking
Parking Spot    = Berisi tentang list list parking spot
Add new parking = Menambah Parking spot baru

Superadmin
Add new client  = Berisi list - list client dan menambah,edit,menghapus client
Add new Admin   = Berisi list - list admin dan menambah,edit,menghapus admin
Add new user    = Berisi list - list user dan menambah,edit,menghapus user

*Role admin
Email : adminpenjual1@gmail.com
pass  : adminpenjual1

alur 
buat produk baru add produk
lalu kita bisa lihat di overview list produk
untuk orders kita bisa mencoba dengan masukan orders di database langsung siapkan alat pager IoT, select page -> Notification -> Taken

#notif = kasih tau pagernya harus bunyi atau engga
#taken = kasih tau makanan sudah diambil

Canteen 
Overview        = Berisi tentang list product kantin tersebut dan widget widget yang ada serta canteen statusnya masing - masing serta ada filter rating,nama,harga 
Add Product     = Menambah Product kantin tersebut
Orders          = Berisi tentang invoice orders dan detail status dari alat pager IoT
```
