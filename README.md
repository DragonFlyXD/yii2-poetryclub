# Yii2-Poetryclub(uncompleted)

## 安装步骤(HOW TO USE)

* step1: comoser install

* step2: 配置`./common/config/main-local.php`里的数据库信息。

* step3: 建表与导入数据入库。文件位于`./poetryclub.sql`

  例如 ：

  ```
  sudo mysql -u root -p
  use demo
  sudo source ~/www/poetryclub/poetryclub.sql
  ```

* step4: 配置虚拟主机,否则网站一些静态资源访问不到。

  如：`poetryclub.dev`指向`~/www/poetryclub/frontend/web`

* step4: 访问网站。

  * 前台：`localhost/poetryclub/frontend/web`
  * 后台:  `localhost/poetryclub/backend/web`



***

总体而言，**Yii2**框架有着高效、快速的开发环境，加之其`widget` ，`gii` 等功能二次封装后更使开发如鱼得水。但缺点也很明显，其前后端代码耦合程度高。