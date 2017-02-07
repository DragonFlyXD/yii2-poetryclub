# Yii2-Poetryclub(uncompleted)![](https://avatars3.githubusercontent.com/u/22745316?v=3&s=30)

## 安装步骤(HOW TO USE)

* step1: 克隆项目到本地。

  `git clone https://github.com/DragonFlyXD/yii2-poetryclub poetryclub`

* step2: 切换到项目根目录`cd poetryclub`。

* step3: `composer install`

* step4: `php install`

* step5: 配置`./common/config/main-local.php`里的数据库信息。

* step6: 建表与导入数据入库。文件位于`./poetryclub.sql`

  例如 ：

  ```
  sudo mysql -u root -p
  use demo
  sudo source ~/www/poetryclub/poetryclub.sql
  ```

* step7: 配置虚拟主机,否则网站一些静态资源访问不到。

  如：`poetryclub.dev`指向`~/www/poetryclub/frontend/web`

* step8: 访问网站。

  * 前台：`localhost/poetryclub/frontend/web`
  * 后台:  `localhost/poetryclub/backend/web`


***

总体而言，**Yii2**框架有着高效、快速的开发环境，加之其`widget` ，`gii` 等功能二次封装后更使开发如鱼得水。但缺点也很明显，其前后端代码耦合程度高。
