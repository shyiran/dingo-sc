**使用到的一些技术：**

1.阿里云OSS

2.阿里云短信服务

3.微信公众号

4.微信，支付宝支付接口

5.语言包zh_CN（composer require laravel-lang/lang:^10.1.7）

6.dingo-serializer-switch

7.分类树插件

8.缓存

9.模型事件（观察者模式）

**API接口：**

**1.1注册（api/auth/register）**

name:

email:

password:

**1.2登录（api/auth/login）**

email:

password:

**1.3退出登录（api/auth/logout）**

**1.4刷新TOKEN（api/auth/refresh）**

**2.1用户列表**

api/admin/users

**2.1用户详情**

api/admin/users/1

**3.1禁用启用用户**

api/admin/users/1/lock

**4.1分类列表**

api/admin/category（get请求）

**4.2添加分类**

api/admin/category（post请求）

**4.3分类修改**

api/admin/category/14（put请求）

**4.4分类禁用和启用**

api/admin/category/14/status（patch请求）

**5.1添加商品**

api/admin/goods（post）

category_id：

description：

price：

stock：

cover：

pics[]：

details：

title：

【include=category,user】

**5.2商品列表**

api/admin/goods（get）

**5.3商品详情**

api/admin/goods/1?include=category,user

**5.4更新商品**

api/admin/goods/1（put）

**5.5是否上架**

api/admin/goods/1/on（patch）

**5.6是否推荐**

api/admin/goods/1/recommend（patch）







原生查询

异常及自定义异常

表单验证

JWT

OAUTH2.0

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
