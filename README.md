# ECommerce

Başlamadan Önce:

Projeyi yerel bilgisayarınızda çalıştırmak için aşağıdaki adımları takip edebilirsiniz:

### 1) Projeyi bilgisayarınıza klonlayın:
```
git clone https://github.com/lnsyder/ecommerce.git
cd ecommerce
```
### 2) Docker konteynerlarını ayağa kaldırın:
```
docker-compose up -d --build
```
### 3) Gerekli bağımlılıkları yükleyin:
```
docker exec -it symfony-app bash -c "composer install"
```
### 4) Veritabanı bilgilerini girin:
.env dosyasına aşağıdaki parametreyi ekleyin:
```
DATABASE_URL=postgresql://user:password@database:5432/postgres?charset=utf8
```
### 5) Veritabanını oluşturun ve gerekli verileri seeder'dan import edin:
```
docker exec -it symfony-app bash -c "bin/console make:migration"
```
```
docker exec -it symfony-app bash -c "bin/console doctrine:migrations:migrate"
```
```
docker exec -it symfony-app bash -c "php bin/console doctrine:fixtures:load"
```

### Uygulama artık http://localhost/ adresinden erişilebilir olacaktır.

### Kullanıcılar admin yetkisine sahip olarak oluşturuluyor. Yetki yönetimini kontrol etmek için TblUser tablosundaki roles alanını boş dizi haline getirebilirsiniz.
(Mağaza'yı sadece yetkili veya yetkisiz üyeler görebiliyor/kullanabiliyor, sadece admin yetkisi olan üyeler yönetebiliyor)


### Kullanılan Teknolojiler:

PHP 8.0

Symfony 5.4

PostgreSQL

Twig

Jquery
